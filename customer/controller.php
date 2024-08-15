<?php

require_once ("../include/initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'eydit' :
		doEydit();
		break;

	case 'delete' :
	doDelete();
	break;

 

	case 'processorder' :
	processorder();
	break;

	case 'addwish' :
	addwishlist();
	break;

	case 'wishlist' :
	processwishlist();
	break;

	case 'photos' :
	doupdateimage();
	break;

	case 'changepassword' :
	doChangePassword();
	break;


	}

   
	function doInsert() {
		header('Content-Type: application/json');
		global $mydb;
		
		if(isset($_POST['submit'])) {
			try {
				// Check if the email already exists
				$email = trim($_POST['CUSUNAME']);
				$existingCustomer = new Customer();
				$isEmailExists = $existingCustomer->find_customer_by_email($email);
	
				if ($isEmailExists) {
					echo json_encode(['status' => 'info', 'message' => 'Email already exists! Please use a different email.']);
					exit;
				}
	
				$customer = new Customer();
				$customer->FNAME = $_POST['FNAME'];
				$customer->LNAME = $_POST['LNAME'];
				$customer->CITYADD = $_POST['CITYADD'];
				$customer->GENDER = $_POST['GENDER'];
				$customer->PHONE = $_POST['PHONE'];
				$customer->CUSUNAME = $email;
				$customer->CUSPASS = sha1($_POST['CUSPASS']);
				$customer->DATEJOIN = date('Y-m-d H:i:s');
				$customer->TERMS = 1;
				$customer->create();
	
				$h_upass = sha1(trim($_POST['CUSPASS']));
	
				$user = new Customer();
				$res = $user->cusAuthentication($email, $h_upass);
	
				if($_POST['proid'] == '') {
					$response = [
						'status' => 'success', 
						'message' => 'You are now successfully registered. It will redirect to your order details.', 
						'redirect' => web_root . "index.php?q=product"
					];
				} else {
					$proid = $_POST['proid'];
					$id = $mydb->insert_id();
					$query = "INSERT INTO `tblwishlist` (`PROID`, `CUSID`, `WISHDATE`, `WISHSTATS`) VALUES ('{$proid}','{$id}','" . date('Y-m-d') . "',0)";
					$mydb->setQuery($query);
					$mydb->executeQuery();
					$response = [
						'status' => 'success', 
						'message' => 'You are now successfully registered. It will redirect to your profile.', 
						'redirect' => web_root . "index.php?q=profile"
					];
				}
	
				// Log the response for debugging
				error_log("Response: " . json_encode($response));
	
				echo json_encode($response);
			} catch (Exception $e) {
				error_log("Error in doInsert: " . $e->getMessage());
				echo json_encode(['status' => 'error', 'message' => 'An error occurred during registration.']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
		}
		exit;
	}
	
 
	function doEdit() {
		header('Content-Type: application/json');
	
		if(isset($_POST['save']) || isset($_POST['FNAME'])) {  
			try {
				$customer = New Customer();
				$customer->FNAME = $_POST['FNAME'];
				$customer->LNAME = $_POST['LNAME'];
				$customer->CITYADD = $_POST['CITYADD'];
				$customer->GENDER = $_POST['GENDER'];
				$customer->PHONE = $_POST['PHONE'];
				$customer->CUSUNAME = $_POST['CUSUNAME'];
				
				// Check if any changes were made
				$original = $customer->single_customer($_SESSION['CUSID']);
				$changes_made = false;
				
				foreach($customer as $key => $value) {
					if($original->$key != $value) {
						$changes_made = true;
						break;
					}
				}
				
				if($changes_made) {
					$customer->update($_SESSION['CUSID']);
					echo json_encode(['status' => 'success']);
				} else {
					echo json_encode(['status' => 'no_changes']);
				}
			} catch (Exception $e) {
				echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Form data not received properly']);
		}
		exit;
	}
	
	function doEydit(){
		global $mydb; 
	
		if ($_GET['actions']=='confirm') {
			$status = 'Confirmed';    
			$remarks = 'Your order has been accepted.';
			$delivered = Date('Y-m-d');
		} elseif ($_GET['actions']=='pending') {
			$status = 'Pending'; 
			$remarks = 'Your order is on process.';
			$delivered = Date('Y-m-d');
		} elseif ($_GET['actions']=='deliver') {
			$status = 'On The Way';    
			$remarks = 'Your order is currently being processed and prepared for delivery.';
			$delivered = Date('Y-m-d');
		} elseif ($_GET['actions']=='approaching') {
			$status = 'Approaching Destination';    
			$remarks = 'The delivery is nearing your destination. Get ready for arrival.';
			$delivered = Date('Y-m-d');
		} elseif ($_GET['actions']=='receive') {
			$status = 'Received';    
			$remarks = 'Order has been already received.';
			$delivered = Date('Y-m-d');
		} elseif ($_GET['actions']=='cancel'){
			// Cancelling the order
			$status = 'Cancelled';
			$remarks = 'You cancelled your order.';
			$delivered = Date('Y-m-d');
	
			// Restore product quantities
			$query = "SELECT * FROM `tblorder` WHERE `ORDEREDNUM`=".$_GET['id'];
			$mydb->setQuery($query);
			$order_items = $mydb->loadResultList(); 
	
			foreach ($order_items as $item) {
				$sql_update_quantity = "UPDATE `tblproduct` SET `PROQTY` = `PROQTY` + {$item->ORDEREDQTY} WHERE `PROID` = {$item->PROID}";
				$mydb->setQuery($sql_update_quantity);
				$mydb->executeQuery();
			}
			$_SESSION['order_cancelled'] = true;
		}
	
		// Update order status
		$order = New Order();
		$order->STATS = $status;
		$order->pupdate($_GET['id']);
	
		// Update summary
		$summary = New Summary();
		$summary->ORDEREDSTATS = $status;
		$summary->ORDEREDREMARKS = $remarks;
		$summary->CLAIMEDADTE = $delivered;
		$summary->HVIEW = 0;
		$summary->update($_GET['id']);
	
		// Insert message
		// $query = "SELECT * FROM `tblsummary` s ,`tblcustomer` c 
		// 	WHERE s.`CUSTOMERID`=c.`CUSTOMERID` and ORDEREDNUM=".$_GET['id'];
		// $mydb->setQuery($query);
		// $cur = $mydb->loadSingleResult();
	
		// $sql = "INSERT INTO `messageout` (`Id`, `MessageTo`, `MessageFrom`, `MessageText`) 
		// 	VALUES (Null, '".$cur->PHONE."','Janno','FROM Bachelor of Science and Entrepreneurs : Your order has been '".$status. "'. The amount is '".$cur->PAYMENT. "')";
		// $mydb->setQuery($sql);
		// $mydb->executeQuery();
	
		// Insert messages for product owners
		// $query = "SELECT * 
		// 	FROM  `tblproduct` p,`tblorder` o,  `tblsummary` s
		// 	WHERE  p.`PROID` = o.`PROID` 
		// 	AND o.`ORDEREDNUM` = s.`ORDEREDNUM`  
		// 	AND o.`ORDEREDNUM`=".$_GET['id'];
		// $mydb->setQuery($query);
		// $cur = $mydb->loadResultList(); 
		// foreach ($cur as $result) {
		// 	$sql = "INSERT INTO `messageout` (`Id`, `MessageTo`, `MessageFrom`, `MessageText`) 
		// 		VALUES (Null, '".$result->OWNERPHONE."','Janno','FROM Bachelor of Science and Entrepreneurs : Your  product has been ordered'. The amount is '".$result->PAYMENT. "')";
		// 	$mydb->setQuery($sql);
		// 	$mydb->executeQuery();
		// }
	
		header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => "Order has been {$summary->ORDEREDSTATS}!"]);
    exit;
	}
	
	function doDelete(){

		if(isset($_SESSION['U_ROLE'])=='Customer'){

			if (isset($_POST['selector'])==''){
			message("Select the records first before you delete!","error");
			redirect(web_root.'index.php?page=9');
			}else{
		
			$id = $_POST['selector'];
			$key = count($id);

			for($i=0;$i<$key;$i++){ 

			$order = New Order();
			$order->delete($id[$i]);
 
			message("Order has been Deleted!","info");
			redirect(web_root."index.php?q='product'"); 


		} 


		}
	}else{

		if (isset($_POST['selector'])==''){
			message("Select the records first before you delete!","error");
			redirect('index.php');
			}else{

			$id = $_POST['selector'];
			$key = count($id);

			for($i=0;$i<$key;$i++){ 

			$customer = New Customer();
			$customer->delete($id[$i]);

			$user = New User();
			$user->delete($id[$i]);

			message("Customer has been Deleted!","info");
			redirect('index.php');

			}
		}

	}
		
	}

	 
		function processorder(){

		 
 
		//	$_SESSION['ORDEREDNUM'] = $_POST['ORDEREDNUM'];
			 
			
		 	// $autonumber = New Autonumber();
 			// $res = $autonumber->set_autonumber('ordernumber');


			$count_cart = count($_SESSION['gcCart']);
             for ($i=0; $i < $count_cart  ; $i++) { 
 
			$order = New Order();
			$order->PROID		    = $_SESSION['gcCart'][$i]['productid']; 
			$order->ORDEREDQTY		= $_SESSION['gcCart'][$i]['qty'];
			$order->ORDEREDPRICE	= $_SESSION['gcCart'][$i]['price'];   
			$order->ORDEREDNUM		= $_POST['ORDEREDNUM']; 
	     	$order->create(); 
 
		  	$product = New Product();			 
			$product->qtydeduct($_SESSION['gcCart'][$i]['productid'],$_SESSION['gcCart'][$i]['qty']); 


			$summary = New Summary();
			$summary->ORDEREDDATE 	= date("Y-m-d h:i:s");
			$summary->CUSTOMERID		= $_SESSION['CUSID'];
			$summary->ORDEREDNUM  	= $_POST['ORDEREDNUM'];  
			$summary->DELFEE  		= $_POST['PLACE']; 
			$summary->PAYMENTMETHOD	= $_POST['paymethod'];
			$summary->PAYMENT 		= $_POST['alltot'];
			$summary->ORDEREDSTATS 	= 'Pending';
			$summary->CLAIMEDDATE		= $_POST['CLAIMEDDATE'];
			$summary->ORDEREDREMARKS 	= 'Your order is on process.';
			$summary->HVIEW 			= 0	;
			$summary->create();
		  }

     


		$autonumber = New Autonumber();
		$autonumber->auto_update('ordernumber');

 
		unset($_SESSION['gcCart']);  
		unset($_SESSION['orderdetails']); 

		header('Content-Type: application/json');
		echo json_encode(['success' => true, 'message' => 'Order created successfully!']);
		exit; 
		}
			 


	function processwishlist(){
		if(isset($_GET['wishid'])){

		  $query ="UPDATE `tblwishlist` SET `WISHSTATS`=1  WHERE `WISHLISTID`=" .$_GET['wishid'];
		 $res =  mysql_query($query) or die(mysql_error());
		 if (isset($res)){
		 		message("Product has been removed in your wishlist", "success"); 		 
			redirect(web_root."index.php?q=profile");
		 }

		

		}
		

		}
			 

	function addwishlist(){
		global $mydb;
			$proid = $_GET['proid'];
			 	$id =$_SESSION['CUSID'];

	 $query="SELECT * FROM `tblwishlist` WHERE  CUSID=".$id." AND `PROID` ="  .$proid ;
	 $mydb->setQuery($query);
	 $result = $mydb->executeQuery();
	 var_dump($query);exit;
	 $maxrow = $mydb->num_rows($result);
	 // $row = mysql_fetch_assoc($result);
	
	if($maxrow>0){
				message("Product is already added to your wishlist", "error"); 		 
			redirect(web_root."index.php?q=profile"); 
		}else{
			$query ="INSERT INTO `tblwishlist` (`PROID`, `CUSID`, `WISHDATE`, `WISHSTATS`)  VALUES ('{$proid}','{$id}','".DATE('Y-m-d')."',0)";
			$mydb->setQuery($query);
			$mydb->executeQuery();
			  	// mysql_query($query) or die(mysql_error());
			 
	 	message("Product has been added to your wishlist", "success"); 		 
			redirect(web_root."index.php?q=profile"); 
		}
			 
			 
	 

		}
		function doupdateimage(){
			$allowed_types = ['image/png', 'image/jpg', 'image/jpeg'];
			$max_file_size = 8000000; // 8MB in bytes
		
			$errorfile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile = $_FILES['photo']['name'];
			$location = "customer_image/" . $myfile;
		
			if ($errorfile > 0) {
				message("No Image Selected!", "error");
				redirect(web_root . "index.php?q=profile");
			} elseif (!in_array($type, $allowed_types)) {
				message("Uploaded file is not a valid image format (PNG, JPG, JPEG)!", "error");
				redirect(web_root . "index.php?q=profile");
			} elseif ($_FILES['photo']['size'] > $max_file_size) {
				message("Uploaded file exceeds the maximum size of 8 MB!", "error");
				redirect(web_root . "index.php?q=profile");
			} else {
				$image_size = getimagesize($temp);
				if ($image_size === FALSE) {
					message("Uploaded file is not an image!", "error");
					redirect(web_root . "index.php?q=profile");
				} else {
					// Upload the file
					move_uploaded_file($temp, $location);
		
					$customer = New Customer();
					$customer->CUSPHOTO = $location;
					$customer->update($_SESSION['CUSID']);
		
					// Set a session variable for the success message
					$_SESSION['upload_success'] = true;
		
					redirect(web_root . "index.php?q=profile");
				}
			}
		}


		function doChangePassword(){
			if (isset($_POST['save'])) {
				# code...
				$customer = New Customer(); 
				$customer->CUSPASS			= sha1($_POST['CUSPASS']);	
				$customer->update($_SESSION['CUSID']);


				$_SESSION['success_message'] = "Password has been updated successfully!";
			redirect(web_root.'index.php?q=profile');
			}
		}
 
 
?>
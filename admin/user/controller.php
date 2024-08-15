<?php

require_once ("../../include/initialize.php");

	 if (!isset($_SESSION['USERID'])){

      redirect(web_root."admin/index.php");

     }



$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';



switch ($action) {

	case 'add' :

	doInsert();

	break;

	

	case 'edit' :

	doEdit();

	break;

	

	case 'delete' :

	doDelete();

	break;



	case 'photos' :

	doupdateimage();

	break;



 

	}

   

	function doInsert(){

		if(isset($_POST['save'])){





		if ($_POST['U_NAME'] == "" OR $_POST['U_USERNAME'] == "" OR $_POST['U_PASS'] == "") {

			$messageStats = false;

			message("All field is required!","error");

			redirect('index.php?view=add');

		}else{	

			$user = New User();

			// $user->USERID 		= $_POST['user_id'];

			$user->U_NAME 		= $_POST['U_NAME'];

			$user->U_USERNAME		= $_POST['U_USERNAME'];

			$user->U_CON		= $_POST['U_CON'];

			$user->U_EMAIL		= $_POST['U_EMAIL'];

			$user->U_PASS			=sha1($_POST['U_PASS']);

			$user->U_ROLE			=  $_POST['U_ROLE'];

			$user->create();



						// $autonum = New Autonumber(); 

						// $autonum->auto_update(2);


  // Assume the save was successful, set a session variable
  $_SESSION['success'] = "New user added successfully!";
    
			redirect("index.php");

			

		}

		}



	}


	function doEdit() {
		if (isset($_POST['save'])) {
			$user = new User();
			$user->U_NAME = $_POST['U_NAME'];
			$user->U_USERNAME = $_POST['U_USERNAME'];
			$user->U_ROLE = $_POST['U_ROLE'];
	
			// Only update the password if it's not empty
			if (!empty($_POST['U_PASS'])) {
				$user->U_PASS = sha1($_POST['U_PASS']);
			}
	
	
			$user->update($_POST['USERID']);
	
			$_SESSION['success'] = "User account updated successfully!";
	
			if ($_SESSION['USERID'] == $_POST['USERID'] && $_SESSION['U_ROLE'] == 'Staff') {
				redirect(web_root . "admin/dashboard/index.php");
			} else {
				// For admin or when admin edits other accounts	
				redirect(web_root . "admin/user/index.php");
			}
		}
	}





	function doDelete(){

		

		// if (isset($_POST['selector'])==''){

		// message("Select the records first before you delete!","info");

		// redirect('index.php');

		// }else{



		// $id = $_POST['selector'];

		// $key = count($id);



		// for($i=0;$i<$key;$i++){



		 	



		

				$id = 	$_GET['id'];



				$user = New User();

	 		 	$user->delete($id);

			 

			$_SESSION['success'] = "User account deleted successfully!";

			redirect('index.php');

		// }

		// }



		

	}



	function doupdateimage(){

 

			$errofile = $_FILES['photo']['error'];

			$type = $_FILES['photo']['type'];

			$temp = $_FILES['photo']['tmp_name'];

			$myfile =$_FILES['photo']['name'];

		 	$location="photos/".$myfile;





		if ( $errofile > 0) {

				message("No Image Selected!", "error");

				redirect("index.php?view=view&id=". $_GET['id']);

		}else{

	 

				@$file=$_FILES['photo']['tmp_name'];

				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));

				@$image_name= addslashes($_FILES['photo']['name']); 

				@$image_size= getimagesize($_FILES['photo']['tmp_name']);



			if ($image_size==FALSE ) {

				message("Uploaded file is not an image!", "error");

				redirect("index.php?view=view&id=". $_GET['id']);

			}else{

					//uploading the file

					move_uploaded_file($temp,"photos/" . $myfile);

		 	

					 



						$user = New User();

						$user->USERIMAGE 			= $location;

						$user->update($_SESSION['USERID']);

						redirect("index.php");

						 

							

					}

			}

			 

		}

 

?>
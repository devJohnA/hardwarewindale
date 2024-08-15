

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



 

	}

   

	function doInsert(){

		if(isset($_POST['save'])){





		if ( $_POST['CATEGORY'] == "" ) {

			$messageStats = false;

			message("All field is required!","error");

			redirect('index.php?view=add');

		}else{	

			$category = New Category();

			$category->CATEGORIES	= $_POST['CATEGORY'];

			$category->create();



		  // Assume the save was successful, set a session variable
		  $_SESSION['success'] = "Category added successfully!";
    
		  // Redirect to the category list page
		  header("Location: index.php");
		  exit();

			

		}

		}



	}



	function doEdit(){

		if(isset($_POST['save'])){



			$category = New Category();

			$category->CATEGORIES	= $_POST['CATEGORY'];

			$category->update($_POST['CATEGID']);



			$_SESSION['success'] = "Category updated successfully!";
			header("Location: index.php");
			exit();

		}



	}





	function doDelete(){

		// if (isset($_POST['selector'])==''){

		// message("Select a records first before you delete!","error");

		// redirect('index.php');

		// }else{



			$id = $_GET['id'];



			$category = New Category();

			$category->delete($id);



			$_SESSION['success'] = "Category successfully deleted!";

			redirect('index.php');



		// $id = $_POST['selector'];

		// $key = count($id);



		// for($i=0;$i<$key;$i++){



		// 	$category = New Category();

		// 	$category->delete($id[$i]);



		// 	message("Category already Deleted!","info");

		// 	redirect('index.php');

		// }

		// }

		

	}

?>
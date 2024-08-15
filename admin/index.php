<?php 

require_once("../include/initialize.php");

	 if (!isset($_SESSION['USERID'])){

      redirect(web_root."admin/login.php");

     } 



$content='home.php';

$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';

switch ($view) {

	case '1' :

        $title="Dashboard";	

		$content='dashboard/';		

		break;	

	default :

	 //    $title="Products";	

		// $content ='products/';		

	redirect("dashboard/");

}

require_once("theme/templates.php");

?><?php 

require_once("../include/initialize.php");

	 if (!isset($_SESSION['USERID'])){

      redirect(web_root."admin/login.php");

     } 



$content='home.php';

$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';

switch ($view) {

	case '1' :

        $title="Dashboard";	

		$content='dashboard/';		

		break;	

	default :

	 //    $title="Products";	

		// $content ='products/';		

	redirect("dashboard/");

}

require_once("theme/templates.php");

?>
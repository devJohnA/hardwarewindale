<head>
    <style>
    @media print {
        body * {
            visibility: hidden;
        }

        #printout,
        #printout * {
            visibility: visible;
        }

        #printout {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        @page {
            size: auto;
            margin: 0mm;
        }

        a,
        a:visited {
            text-decoration: underline;
        }

        a[href]:after {
            content: " ("attr(href) ")";
        }

        abbr[title]:after {
            content: " ("attr(title) ")";
        }

        .ir a:after,
        a[href^="javascript:"]:after,
        a[href^="#"]:after {
            content: "";
        }

        pre,
        blockquote {
            border: 1px solid #999;
            page-break-inside: avoid;
        }

        thead {
            display: table-header-group;
        }

        tr,
        img {
            page-break-inside: avoid;
        }

        img {
            max-width: 100% !important;
        }

        @page {
            margin: 2cm .5cm;
        }

        p,
        h2,
        h3 {
            orphans: 3;
            widows: 3;
        }

        h2,
        h3 {
            page-break-after: avoid;
        }

        .navbar {
            display: none;
        }

        .sidebar {

            position: relative;
            top: 0;
            bottom: 0;
            right: 0;
        }

        .table td,
        .table th {
            background-color: #fff !important;
        }

        th {
            font-size: 6px !important;
        }

        .btn>.caret,
        .dropup>.btn>.caret {
            border-top-color: #000 !important;
        }

        .label {
            border: 1px solid #000;
        }

        .table {
            border-collapse: collapse !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }
    }
    </style>
</head>
<?php
require_once ("../../include/initialize.php");
	 if (!isset($_SESSION['USERID'])){
      redirect(web_root."index.php");
     }


// if (isset($_POST['id'])){

// if ($_POST['actions']=='confirm') {
// 							# code...
// 	$status	= 'Confirmed';	
// 	// $remarks ='Your order has been confirmed. The ordered products will be yours in the exact date and time that you have set.';
	 
// }elseif ($_POST['actions']=='cancel'){
// 	// $order = New Order();
// 	$status	= 'Cancelled';
// 	// $remarks ='Your order has been cancelled due to lack of communication and incomplete information.';
// }

// $order = New Order();
// $order->STATS       = $status;
// $order->update($_POST['id']);


// }

if(isset($_POST['close'])){
	unset($_SESSION['ordernumber']);
}

if (isset($_POST['ordernumber'])){
	$_SESSION['ordernumber'] = $_POST['ordernumber'];
}


$query = "SELECT * FROM tblsummary s ,tblcustomer c 
				WHERE   s.CUSTOMERID=c.CUSTOMERID and ORDEREDNUM=".$_SESSION['ordernumber'];
		$mydb->setQuery($query);
		$cur = $mydb->loadSingleResult();


?>

<div class="modal-dialog" style="width:70%">
    <!-- <div class="modal-content">
        <div class="modal-header"> -->
    <!-- <button class="close" id="btnclose" data-dismiss="modal" type="button">×</button> -->
    <span id="printout">
        <h2 style="text-align:center;">Order Number: <?php echo $_SESSION['ordernumber']; ?></h2>

        <!-- <h2 class="modal-title" id="myModalLabel"><strong>List of Ordered Products</strong></h2> -->





        <div class="row" style="margin:2%">
            <div class="col-md-6">Name: <?php echo $cur->FNAME . ' '.  $cur->LNAME ;?></div>
            <div class="col-md-6">Address:
                <?php echo $cur->CUSHOMENUM . ' ' . $cur->STREETADD . ' ' .$cur->BRGYADD . ' ' . $cur->CITYADD . ' ' .$cur->PROVINCE . ' ' .$cur->COUNTRY; ?>
            </div>
            <div class="col-md-6">Contact No.: <?php echo $cur->PHONE;?></div>
        </div>



        <form action="controller.php?action=photos&id=<?php echo $customerid; ?>" enctype="multipart/form-data"
            method="post">
            <div class="modal-body">
                <table id="table" class="table">
                    <thead>
                        <tr>

                            <th style="text-align:center;" width="20%">PRODUCT</th>
                            <th style="text-align:center;" width="20%">PRICE</th>
                            <th style="text-align:center;">QUANTITY</th>
                            <th style="text-align:center;" width="20%">TOTAL</th>

                            <!-- <th></th>  -->
                        </tr>
                    </thead>
                    <tbody>

                        <?php
				  $subtot =0;
				  $query = "SELECT * 
							FROM  tblproduct p, tblcategory ct,  tblcustomer c,  tblorder o,  tblsummary s
							WHERE p.CATEGID = ct.CATEGID 
							AND p.PROID = o.PROID 
							AND o.ORDEREDNUM = s.ORDEREDNUM 
							AND s.CUSTOMERID = c.CUSTOMERID 
							AND o.ORDEREDNUM=".$_SESSION['ordernumber'];
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList(); 
						foreach ($cur as $result) {
							$result->ORDEREDPRICE = $result->PROPRICE * $result->ORDEREDQTY;
						echo '<tr>';  
				  		
				  	 	echo '<td align="center" width="20%">'. $result->PRODESC.'</td>';
				  		echo '<td align="center" width="20%"> &#8369;'.number_format($result->PROPRICE,2).' </td>';
				  		echo '<td align="center">'. $result->ORDEREDQTY.'</td>';
				  		?>
                        <td align="center" width="20%">
                            &#8369;<output><?php echo number_format($result->ORDEREDPRICE,2); ?></output></td>
                        <?php
				  		
				  	 	echo '</tr>';
				 $subtot +=$result->ORDEREDPRICE;
				}
				?>
                    </tbody>
                    <?php 
				 $query = "SELECT * FROM tblsummary s ,tblcustomer c 
				WHERE   s.CUSTOMERID=c.CUSTOMERID and ORDEREDNUM=".$_SESSION['ordernumber'];
		$mydb->setQuery($query);
		$cur = $mydb->loadSingleResult();

		if ($cur->PAYMENTMETHOD=="Cash on Delivery") {
			# code...
			$price = $cur->DELFEE;
		}else{
			$price = 0.00;
		}


		 $cur->PAYMENT = $subtot + $price;
		?>

                </table>
                <hr />
                <div class="row">
                    <div class="col-md-6 pull-left">
                        <div>Ordered Date:
                            <?php echo date_format(date_create($cur->ORDEREDDATE),"M/d/Y h:i:s "); ?></div>
                        <div>Payment Method: <?php echo $cur->PAYMENTMETHOD; ?></div>

                    </div>
                    <div class="col-md-6 pull-right">
                        <p align="right">Total Price: &#8369;<?php echo number_format($subtot,2);?></p>
                        <p align="right">Delivery Fee: &#8369;<?php echo number_format($price,2); ?></p>
                        <p align="right">Overall Total: &#8369;<?php echo number_format($cur->PAYMENT,2); ?></p>
                    </div>
                </div>
                <p align="center">Thank You. If you like it Order again, Godbless!</p>
    </span>
</div>
</div>
<div class="modal-footer">
    <div id="divButtons" name="divButtons">
        <?php if($cur->ORDEREDSTATS!='Pending' || $cur->ORDEREDSTATS!='Cancelled' ){ ?>

        <button onclick="tablePrint();" class="btn btn-pup pull-right "><span class="fa fa-print"></span>
            Print</button>

        <?php } ?>

    </div>

    </form>
    <!-- </div>
</div> -->

    <script>
    function tablePrint() {
        // Create a new window
        window.print();
    }


    var table = document.getElementById('table');
    var items = table.getElementsByTagName('output');
    var sum = 0;

    // total price
    for (var i = 0; i < items.length; i++)
        sum += parseInt(items[i].value);
    // for cart
    var totprice = document.getElementById('sum');
    totprice.innerHTML = sum.toFixed(2);
    </script>
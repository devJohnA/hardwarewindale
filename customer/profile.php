<head>
    <style>
    img {
        display: block;
        /* make the image a block element */
        margin: 0 auto;
        /* center the image horizontally */
    }

    .img-hover {
        width: 150px;
        height: 150px;
        border-radius: 10%;
        background-color: #f4f4f4;
    }
    </style>
</head>
<?php  
 
       if (!isset($_SESSION['CUSID'])){
      redirect("index.php");
     }


     // if($_SESSION['fixnmixConfiremd']>0){
     //   $query = "update `tblpayment` SET `HVIEW` = true WHERE `CUSTOMERID`='".$_SESSION['CUSID']."' AND STATS in ('Confirmed','Cancelled')  AND HVIEW=0";
     //    mysql_query($query);
     // }
    

     $customer = New Customer();
      $res = $customer->single_customer($_SESSION['CUSID']);
    ?>
<div class="col-sm-3">
    <div class="panel">
        <div class="panel-body">
            <a data-target="#myModal" data-toggle="modal" href=""><img class="img-hover"
                    src="<?php echo web_root. "customer/".$res->CUSPHOTO; ?>" title="Profile Picture"></a>
        </div>
        <p style="text-align:center;">Just click the image to update your Profile Picture</p>
        <ul class="list-group">
            <!-- <li class="list-group-item text-muted">Profile</li> -->
            <li class="list-group-item text-right"><span class="pull-left"><strong>Account</strong></span>
                <?php echo $res->FNAME .' '.$res->LNAME; ?></li>
            <li class="list-group-item text-right">
                <div class="panel-group" id="accordion">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Change Password</a>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form action="<?php echo web_root; ?>customer/controller.php?action=changepassword"
                                method="POST">
                                <input type="password" class="form-control" name="CUSPASS" required
                                    placeholder="Password"><br />
                                <input class="btn btn-sm btn-primary" type="submit" name="save" value="Change">
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!--/col-3-->
<div class="col-sm-9">
    <div class="panel">
        <div class="panel-body">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#home">List of Orders</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#settings">Update
                        Account</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <?php
                            check_message();
                              
                            ?>
                    <div class="table-responsive" style="margin-top:5%;">
                        <form action="customer/controller.php?action=delete" method="post">
                            <table cellspacing="0" class="table table-striped table-bordered table-hover" id="example"
                                style="font-size:12px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order#</th>
                                        <th>Date Ordered</th>
                                        <th>TotalPrice</th>
                                        <th>PaymentMethod</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>View</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                                                    $query = "SELECT * FROM `tblsummary`  
                                                                  WHERE  `CUSTOMERID`=".$_SESSION['CUSID'] ." ORDER BY   `ORDEREDNUM` desc ";
                                                                  $mydb->setQuery($query);
                                                                  $cur = $mydb->loadResultList();

                                                                foreach ($cur as $result) {
                                                                  ?>
                                    <tr>
                                        <td width="5%"></td>
                                        <!--   <td width="10%"  class="orderid   "  data-target="#myOrdered" data-toggle="modal" data-id="<?php echo  $result->ORDEREDNUM; ?>">
                            <a href="#"  title="View list Of ordered products"  class="orderid   "  data-target="#myOrdered" data-toggle="modal" data-id="<?php echo  $result->ORDEREDNUM; ?>"><i class="fa fa-info-circle fa-fw"></i> view orders</a> 
                         </td> -->
                                        <!-- <td> <a href="#" class="get-id"  data-target="#myModal" data-toggle="modal" data-id="<?php echo  $result->ORDERNUMBER; ?>"><?php echo  $result->ORDERNUMBER; ?></a>
                               </td> -->
                                        <td>
                                            <?php echo  $result->ORDEREDNUM; ?>
                                            <!-- <a href="#"  title="View list Of ordered products"  class="orderid   "  data-target="#myOrdered" data-toggle="modal" data-id="<?php echo  $result->ORDEREDNUM; ?>"><i class="fa fa-info-circle fa-fw"></i><?php echo  $result->ORDEREDNUM; ?></a> -->
                                        </td>
                                        <td>
                                            <?php echo date_format(date_create($result->ORDEREDDATE),"M/d/Y h:i:s A") ; ?>
                                        </td>
                                        <td>&#8369;<?php echo  number_format($result->PAYMENT,2); ?></td>
                                        <td>
                                            <?php echo  $result->PAYMENTMETHOD; ?></td>
                                        <td>
                                            <?php echo  $result->ORDEREDSTATS; ?></td>
                                        <td>
                                            <?php echo  $result->ORDEREDREMARKS; ?></td>
                                        <td class="tooltip-demo">
                                            <center>
                                                <a class="orderid btn btn-pup btn-xs"
                                                    data-id="<?php echo $result->ORDEREDNUM; ?>"
                                                    data-target="#myOrdered" data-toggle="modal" href="#"
                                                    title="View list Of ordered products">
                                                    <i class="fa fa-info-circle fa-fw"></i> <span
                                                        class="tooltip tooltip.top">view</span></a>
                                            </center>
                                            <!-- <a class="btn btn-info btn-xs"
                                                data-toggle="lightbox" href="<?php echo web_root."index.php?q=trackorder&id=".$result->EORDEREDNUM; ?>">
                                                <i class="fa fa-truck fa-fw"
                                                data-placement="left"
                                                data-toggle="tooltip" title=
                                                "Track Order"></i> </a>-->
                                        </td>
                                        <?php if($result->ORDEREDSTATS=='Pending'){
				  				echo '<td style="text-align: center;"><a  href="#"  class="btn btn-warning btn-xs" disabled>Pending</a>
                                  <a href="#" onclick="confirmCancel('.$result->ORDEREDNUM.', '.$result->CUSTOMERID.')" class="btn btn-danger btn-xs">Cancel</a></td>';
                                
			  	 		}elseif($result->ORDEREDSTATS=='Cancelled'){
							echo '<td style="text-align: center;"> <a  href="#"  class="btn btn-danger btn-xs" disabled>Cancelled</a></td>';
					   } 
						if($result->ORDEREDSTATS=='Confirmed'){
				  	 			echo '<td style="text-align: center;"><a href="#"  class="btn btn-success btn-xs" disabled>Confirmed</a></td>';
						}elseif($result->ORDEREDSTATS=='Preparing for Delivery'){
                            echo '<td style="text-align: center;">
                            <a href="customer/controller.php?action=eydit&id='.$result->ORDEREDNUM.'&customerid='.$result->CUSTOMERID.'&actions=receive"  class="btn btn-success btn-xs" disabled>Preparing for Delivery</a></td>';	                       
                 }elseif($result->ORDEREDSTATS=='Approaching Destination'){
									echo '<td style="text-align: center;">
                                    <a href="customer/controller.php?action=eydit&id='.$result->ORDEREDNUM.'&customerid='.$result->CUSTOMERID.'&actions=receive"  class="btn btn-success btn-xs" disabled>Approaching Destination</a></td>';	                       
                         }elseif($result->ORDEREDSTATS=='Delivered Successfully'){
                            echo '<td style="text-align: center;">
                            <a href="customer/controller.php?action=eydit&id='.$result->ORDEREDNUM.'&customerid='.$result->CUSTOMERID.'&actions=receive"  class="btn btn-success btn-xs" disabled>Delivered</a></td>';	                       
                 }
                        //   elseif($result->ORDEREDSTATS=='Received'){
						// 			echo '<td style="text-align: center;"><a href="#"  class="btn btn-success btn-xs" disabled>Received</a></td>';	 
			  	 		// }
                        ?>
                                    </tr><?php
                                                                       
                                                                        } 
                                                                        ?>
                                </tbody>
                            </table>
                        </form>
                        <!--      <div class="row">
                  <div class="col-md-4 col-md-offset-4 text-center">
                    <ul class="pagination" id="myPager"></ul>
                  </div>
                </div> -->
                    </div>
                    <!--/table-resp-->
                </div>
                <!--/tab-pane-->
                <div class="tab-pane" id="settings">
                    <?php require_once  "signup.php" ?>
                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->
        </div>
    </div>
    <!--/col-9-->
</div><!-- Modal photo -->
<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">×</button>
                <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
                <p>Note: Image size must be <i style="color:red;">under 8 MB</i> only. Allowed formats: PNG, JPG, JPEG.</p>
            </div>
            <form action="customer/controller.php?action=photos" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input name="MAX_FILE_SIZE" type="hidden" value="8000000">
                                        <input id="photo" name="photo" type="file" accept=".png, .jpg, .jpeg">
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                    <button class="btn btn-pup" name="savephoto" type="submit">Upload Photo</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
<!--   
  <script>
$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
}); 

  </script> -->
  <script>
    <?php if(isset($_SESSION['upload_success']) && $_SESSION['upload_success']): ?>
        Swal.fire({
            title: 'Success!',
            text: 'Uploaded Successfully',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION['upload_success']); ?>
    <?php endif; ?>


    function confirmCancel(orderId, customerId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to cancel your order.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, cancel it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Make an AJAX call to cancel the order
            $.ajax({
                url: `customer/controller.php?action=eydit&id=${orderId}&customerid=${customerId}&actions=cancel`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'Cancelled!',
                            text: 'You cancelled your order.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reload the page or update the order status in the UI
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'There was an error cancelling your order.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'There was an error cancelling your order.', 'error');
                }
            });
        }
    });
}

//password changed
document.addEventListener("DOMContentLoaded", function() {
    <?php if (isset($_SESSION['success_message'])) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?php echo $_SESSION['success_message']; ?>'
        });
        <?php unset($_SESSION['success_message']); // Remove the message after displaying ?>
    <?php } ?>
});

</script>
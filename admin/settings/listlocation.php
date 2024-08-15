<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<?php

if (!isset($_SESSION['USERID'])){

    redirect(web_root."index.php");

   }

   if (isset($_SESSION['success'])) {
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "'.$_SESSION['success'].'"
        });
    </script>';
    unset($_SESSION['success']);
}
		?>


<div class="app-card-body" style="margin: 0 15px;">
                <div class="row">
                    <div class="col-lg-12" style="margin: 15px">
                            <h1> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDeliveryModal">
                                <i class="fa fa-plus-circle fw-fa"></i> New
                            </button>
                            </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                    <form action="controller.php?action=delete" Method="POST">
                        <div class="table-responsive">
                        <table id="myTable" class="table app-table-hover mb-0 text-left">

                                <thead>
                                    <tr>
                                        <th>Place</th>
                                        <th>Delivery Fee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
				  		$query = "SELECT * FROM `tblsetting` ";
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) { 
				  		echo '<tr>'; 
				    		
				  		echo '<td>'.$result->BRGY.' '.$result->PLACE.'  </a></td>';  ; 
				  		echo '<td> &#8369;'.  number_format($result->DELPRICE,2).'</td>'; 
				  		echo
				  		 '<td align="left">
							<a title="Edit" href="#" class="btn btn-primary btn-sm edit-btn" data-id="' . $result->SETTINGID . '" data-place="' . $result->PLACE . '" data-fee="' . $result->DELPRICE . '">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                            <a href="'.web_root.'admin/settings/controller.php?action=delete&id='.$result->SETTINGID.'" class="btn btn-danger btn-sm delete-btn"> <i class="fas fa-trash"></i></a>
						 </td>';
				  	} 
				  	?>
                                </tbody>


                            </table>

                            <!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><i class="fa fa-trash fw-fa"></i> Delete Selected</button>
				</div> -->
                        </div>
                    </form>
                </div>
                </div>

<?php
include 'add.php';
?>


<?php
include 'edit.php';
?>
<script>
   $(document).ready(function () {
    $('#myTable').DataTable();

    $('.edit-btn').click(function() {
        var settingId = $(this).data('id');
        var placeName = $(this).data('place');
        var deliveryFee = $(this).data('fee');

        $('#editDeliveryModal #SETTINGID').val(settingId);
        $('#editDeliveryModal #PLACE').val(placeName);
        $('#editDeliveryModal #DELPRICE').val(deliveryFee);

        $('#editDeliveryModal').data('initialPlace', placeName);
        $('#editDeliveryModal').data('initialFee', deliveryFee);
        
        $('#editDeliveryModal').modal('show');
    });

    $('#editDeliveryModal form').on('submit', function(e) {
        var initialPlace = $('#editDeliveryModal').data('initialPlace');
        var currentPlace = $('#editDeliveryModal #PLACE').val();
        var initialFee = $('#editDeliveryModal').data('initialFee');
        var currentFee = $('#editDeliveryModal #DELPRICE').val();

        if (initialPlace === currentPlace && parseFloat(initialFee) === parseFloat(currentFee)) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'No changes made',
                text: 'Please make changes to the location or delivery fee before saving.'
            });
        }
    });
});

$('.delete-btn').click(function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var deleteUrl = $(this).attr('href'); // Get the URL from the link

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, redirect to the delete URL
                window.location.href = deleteUrl;
            }
        });
    });

</script>

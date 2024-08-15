<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<?php 
    if (!isset($_SESSION['USERID'])){
        redirect(web_root."admin/index.php");
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

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body" style="margin: 0 15px;">
                <div class="row">
                    <div class="col-lg-12" style="margin: 15px">
                        <h1>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCategoryModal">
                                <i class="fa fa-plus-circle fw-fa"></i> New
                            </button>
                        </h1>
                    </div>
                </div>

                <form action="controller.php?action=delete" method="POST">
                    <div class="table-responsive">
                        <table id="myTable" class="table app-table-hover mb-0 text-left" style="font-size:12px;" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $mydb->setQuery("SELECT * FROM tblcategory");
                                    $cur = $mydb->loadResultList();
                                    foreach ($cur as $result) {
                                        echo '<tr>';
                                        echo '<td>' . $result->CATEGORIES . '</td>';
                                        echo '<td align="center">
                                               <a title="Edit" href="#" class="btn btn-primary btn-sm edit-btn" data-id="' . $result->CATEGID . '" data-name="' . $result->CATEGORIES . '">
          <i class="fas fa-edit"></i>
        </a>
                                                <a title="Delete" href="controller.php?action=delete&id='.$result->CATEGID.'" class="btn btn-danger btn-sm delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                              </td>';
                                        echo '</tr>';
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
include 'add.php';
?>

<?php 
include 'edit.php';
?>



<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>
<script>
  $('.edit-btn').click(function() {
  var categoryId = $(this).data('id');
  var categoryName = $(this).data('name');

  $('#editCategoryModal #CATEGID').val(categoryId);
  $('#editCategoryModal #CATEGORY').val(categoryName);

  $('#editCategoryModal').data('initialCategory', categoryName);
  $('#editCategoryModal').modal('show');
});

$('#editCategoryModal form').on('submit', function(e) {
  var initialCategory = $('#editCategoryModal').data('initialCategory');
  var currentCategory = $('#editCategoryModal #CATEGORY').val();

  if (initialCategory === currentCategory) {
    e.preventDefault();
    Swal.fire({
      icon: 'info',
      title: 'No changes made',
      text: 'Please make changes to the category before saving.'
    });
  }
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




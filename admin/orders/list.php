<?php
    
    if (!isset($_SESSION['USERID'])) {
        redirect(web_root."admin/index.php");
    }

    
    check_message();
    ?>
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">Order No:</th>
                                <th class="cell">Customer</th>
                                <th class="cell">DateOrdered</th>
                                <th class="cell">Price</th>
                                <th class="cell">PaymentMethod</th>
                                <th class="cell">Status</th>
                                <th class="cell">Action</th>
                                <th class="cell">View Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $query = "SELECT * FROM tblsummary s ,tblcustomer c 
                                              WHERE s.CUSTOMERID=c.CUSTOMERID ORDER BY ORDEREDNUM desc ";
                                    $mydb->setQuery($query);
                                    $cur = $mydb->loadResultList();

                                    foreach ($cur as $result) {
                                        echo '<tr>';
                                        echo '<td width="3%" align="center">' . $result->ORDEREDNUM . '</td>';
                                        echo '<td><a href="index.php?view=customerdetails&customerid=' . $result->CUSTOMERID . '" title="View customer information">' . $result->FNAME . ' ' . $result->LNAME . '</a></td>';
                                        echo '<td>' . date_format(date_create($result->ORDEREDDATE), "M/d/Y h:i:s ") . '</td>';
                                        echo '<td> &#8369;' . number_format($result->PAYMENT, 2) . '</td>';
                                        echo '<td>' . $result->PAYMENTMETHOD . '</td>';
                                        echo '<td>' . $result->ORDEREDSTATS . '</td>';

                                        // Actions based on order status
                                        if ($result->ORDEREDSTATS == 'Pending') {
                                            echo '<td style="text-align: center;">
                                                   
                                                    <a href="controller.php?action=edit&id=' . $result->ORDEREDNUM . '&customerid=' . $result->CUSTOMERID . '&actions=confirm" class="btn btn-warning btn-sm">Confirm</a>
                                                </td>';
                                        } elseif ($result->ORDEREDSTATS == 'Cancelled') {
                                            echo '<td style="text-align: center;">
                                                    <a href="#" class="btn btn-danger btn-sm" disabled>Cancelled</a>
                                                </td>';
                                        } elseif ($result->ORDEREDSTATS == 'Confirmed') {
                                            if ($result->PAYMENTMETHOD == "Cash on Delivery") {
                                                echo '<td style="text-align: center;">
                                                        <a href="#" class="btn btn-success btn-sm" disabled>Confirmed</a>
                                                        <a href="controller.php?action=edit&id=' . $result->ORDEREDNUM . '&customerid=' . $result->CUSTOMERID . '&actions=deliver" class="btn btn-primary btn-sm">On The Way</a>
                                                    </td>';
                                            } elseif ($result->PAYMENTMETHOD == "Cash on Pickup") {
                                                echo '<td style="text-align: center;">
                                                        <a href="#" class="btn btn-success btn-sm" disabled>Confirmed</a>
                                                    </td>';
                                            } elseif ($result->ORDEREDSTATS == 'Received') {
                                                echo '<td style="text-align: center;">
                                                        <a href="#" class="btn btn-success btn-sm" disabled>Received</a>
                                                    </td>';
                                            }
                                        } elseif ($result->ORDEREDSTATS == 'On The Way') {
                                            echo '<td style="text-align: center;">
                                                    <a href="#" class="btn btn-success btn-sm" disabled>On The Way</a>
                                                </td>';
                                        } elseif ($result->ORDEREDSTATS == 'Received') {
                                            echo '<td style="text-align: center;">
                                                    <a href="#" class="btn btn-success btn-sm" disabled>Received</a>
                                                </td>';
                                        }

                                        // View Order button
                                        echo '<td><center><a href="#" title="View list Of ordered" class="orders btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" data-id="' . $result->ORDEREDNUM . '">View Order</a></center></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 style="cursor:pointer;" class="close" data-dismiss="modal" onclick="handleModalClose()">
                            <span class="btn-close" aria-label="Close"> </span>
                        </h1>
                        <h4 class="modal-title">Order Details</h4>
                    </div>
                    <div class="modal-body" id="modal-body-content">
                        <!-- Content will be loaded here dynamically -->
                    </div>
                </div>
            </div>
        </div>
        <nav class="app-pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>


</div>

<script src="assets/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.orders').click(function(e) {
        e.preventDefault();
        var ordernumber = $(this).data('id');
        $.ajax({
            url: 'orderedproduct.php',
            type: 'post',
            data: {
                ordernumber: ordernumber
            },
            success: function(response) {
                $('#modal-body-content').html(response);
                $('#myModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$('#myModal').on('hidden.bs.modal', function() {
    $('#modal-body-content').html('');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('html, body').animate({
        scrollTop: 0
    }, 'fast');
});

function handleModalClose() {
    $('#myModal').modal('hide');
}
</script>
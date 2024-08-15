<?php
admin_confirm_logged_in();
?>


<?php
$query = "SELECT * FROM tblsummary WHERE ORDEREDSTATS = 'Pending'";
$mydb->setQuery($query);
$cur = $mydb->executeQuery();
$rowscount = $mydb->num_rows($cur);
$res = isset($rowscount) ? $rowscount : 0;

if ($res > 0) {
    $order = '<span style="color:red;">(' . $res . ')</span>';
} else {
    $order = '<span> (' . $res . ')</span>';
}
?>

<?php
$query = "SELECT * FROM messagein WHERE ReceiveTime >= CURRENT_DATE()";
$mydb->setQuery($query);
$cur = $mydb->executeQuery();
$rowscount = $mydb->num_rows($cur);
$res = isset($rowscount) ? $rowscount : 0;

if ($res > 0) {
    $code = '<span style="color:red;">(' . $res . ')</span>';
} else {
    $code = '<span> (' . $res . ')</span>';
}
?>
<?php
function isCurrentPage($link) {
    $currentPage = $_SERVER['PHP_SELF'];
    return (strpos($currentPage, $link) !== false);
}
?>

<?php
require_once '../../admin/dbcon/conn.php';

$sql = "SELECT images, productName, productStock,
CASE
    WHEN productStock = 0 THEN 'Out of stock'
    WHEN productStock <= checkStock THEN 'Low stock'
END AS calculated_status
FROM stocks
WHERE productStock <= checkStock
ORDER BY id DESC";
$result = $conn->query($sql);

$notificationCount = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Windale</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <link rel="shortcut icon" href="favicon.ico">
    <script src="<?php echo web_root; ?>admin/assets/plugins/fontawesome/js/all.min.js"></script>
    <link id="theme-style" rel="stylesheet" href="<?php echo web_root; ?>admin/assets/css/portal.css">
    <link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                    role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>


                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-notifications-dropdown dropdown">
                                <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle"
                                    data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"
                                    title="Notifications">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                        <path fill-rule="evenodd"
                                            d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                    </svg>
                                    <span class="icon-badge"><?php echo $notificationCount; ?></span>
                                </a>
                                <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
                                    <div class="dropdown-menu-header p-3">
                                        <h5 class="dropdown-menu-title mb-0">Notifications</h5>
                                    </div>
                                    <div class="dropdown-menu-content">
                                        <div class="item p-3">
                                            <?php
         // Count the number of notifications

            if ($notificationCount > 0) {
                while($row = $result->fetch_assoc()) {
                    $productName = $row['productName'];
                    $productStock = $row['productStock'];
                    $calculatedStatus = $row['calculated_status'];
                    $imagePath = '../stock/upload/' . $row['images']; 

                    echo '<div class="row gx-2 justify-content-between align-items-center">';
                    echo '<div class="col-auto">';
                    echo '<img class="profile-image" src="' . $imagePath . '" alt="Product Image">';
                    echo '</div>';
                    echo '<div class="col">';
                    echo '<div class="info">';
                    echo '<div class="desc">' . $productName . ' - ' . $calculatedStatus . '</div>';
                    echo '<div class="meta">' . $productStock . ' in stock</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No notifications available.</p>';
            }
            ?>
                                            <a class="link-mask"
                                                href="<?php echo web_root; ?>admin/stock/index.php"></a>
                                        </div>
                                    </div>
                                    <div class=" dropdown-menu-footer p-2 text-center">
                                        <a href="<?php echo web_root; ?>admin/stock/index.php">View all</a>
                                    </div>
                                </div>
                            </div>
                            <span><?php echo $_SESSION['U_NAME']; ?><span>
                                    <?php if ($_SESSION['U_ROLE'] == 'Administrator' || $_SESSION['U_ROLE'] == 'Staff') { ?>
                                    <div class=" app-utility-item app-user-dropdown dropdown">
                                        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown"
                                            href="#" role="button" aria-expanded="false">
                                            <img src="<?php echo web_root; ?>img/administrator.png" alt="" width="55"
                                                height="45" class="rounded-circle"
                                                alt="<?php echo $_SESSION['U_NAME']; ?>"></a>
                                        <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                            <li><a class="dropdown-item"
                                                    href="<?php echo web_root; ?>admin/user/index.php?view=account&id=<?php echo $_SESSION['USERID']; ?>">Account</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <?php } ?>
                                            <li><a class="dropdown-item"
                                                    href="<?php echo web_root; ?>admin/logout.php">Log
                                                    Out</a></li>
                                        </ul>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="index.php"><span class="logo-text">Windale</span></a>
                </div>


                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/dashboard/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/dashboard/index.php">
                                <i class="fas fa-home me-2"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/pos/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/pos/index.php">
                                <i class="fas fa-cash-register me-2"></i>
                                <span class="nav-link-text">Point of Sale</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/sales/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/sales/index.php">
                                <i class="fas fa-chart-line me-2"></i>
                                <span class="nav-link-text">Sales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/products/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/products/index.php">
                                <i class="fas fa-box me-2"></i>
                                <span class="nav-link-text">Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/stock/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/stock/index.php">
                                <i class="fas fa-warehouse me-2"></i>
                                <span class="nav-link-text">Stocks</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/orders/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/orders/index.php">
                                <i class="fas fa-shopping-cart me-2"></i>
                                <span class="nav-link-text">Orders</span><?php echo $order; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/category/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/category/index.php">
                                <i class="fas fa-tags me-2"></i>
                                <span class="nav-link-text">Categories</span>
                            </a>
                        </li>
                        <?php if ($_SESSION['U_ROLE'] == 'Administrator') { ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/user/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/user/index.php">
                                <i class="fas fa-users me-2"></i>
                                <span class="nav-link-text">User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/settings/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/settings/index.php">
                                <i class="fas fa-cog me-2"></i>
                                <span class="nav-link-text">Settings</span>
                            </a>
                        </li>
                       
                        <!-- <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/report/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/report/index.php">
                                <i class="fas fa-file-alt me-2"></i>
                                <span class="nav-link-text">Reports</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/salesreport/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/salesreport/index.php">
                                <i class="fas fa-file-alt me-2"></i>
                                <span class="nav-link-text">Sales Report</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo isCurrentPage('/admin/livechat/') ? 'active' : ''; ?>"
                                href="<?php echo web_root; ?>admin/livechat/index.php">
                                <i class="fas fa-envelope me-2" title="Chat with Support"></i>
                                <span class="nav-link-text">Chat</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <?php
                    if ($title <> 'Dashboard') {
                        echo '<p class="breadcrumb" style="margin-top: 8px;">
                        <a href="index.php" title="' . $title . '">' . $title . '</a>
                        ' . (isset($header) ? '  ' . $header : '') . '</p>';
                    } ?>

                <?php check_message(); ?>
                <?php require_once $content; ?>
            </div>
        </div>
    </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?php echo web_root; ?>admin/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="<?php echo web_root; ?>admin/assets/plugins/popper.min.js"></script>
    <script src="<?php echo web_root; ?>admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo web_root; ?>admin/assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.uk.js" charset="UTF-8">
    </script>
    <script type="text/javascript">
    $(document).on("click", ".PROID", function() {
        // var id = $(this).attr('id');
        var proid = $(this).data('id')
        // alert(proid)
        $(".modal-body #proid").val(proid)

    });
    </script>
    <script>
    $('.date_pickerfrom').datetimepicker({
        format: 'mm/dd/yyyy',
        startDate: '01/01/2000',
        language: 'en',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0

    });


    $('.date_pickerto').datetimepicker({
        format: 'mm/dd/yyyy',
        startDate: '01/01/2000',
        language: 'en',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0

    });
    // $(function() {
    //         var dates = $( "#date_pickerfrom, #date_pickerto" ).datepicker({                                   
    //             defaultDate:'',
    //             changeMonth: true,
    //             numberOfMonths: 1,
    //             onSelect: function( selectedDate ) {
    //             var now =Date();
    //                 var option = this.id == "from" ? "minDate" : "maxDate",
    //                     instance = $(this).data("datepicker"),
    //                     date = $.datepicker.parseDate(
    //                         instance.settings.dateFormat ||
    //                         $.datepicker._defaults.dateFormat,
    //                         selectedDate, instance.settings );
    //                 dates.not( this ).datepicker( "option", option, date );
    //             }
    //         });


    $('#date_picker').datetimepicker({
        format: 'mm/dd/yyyy',
        language: 'en',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        changeMonth: true,
        changeYear: true,
        yearRange: '1945:' + (new Date).getFullYear()
    });
    </script>
    
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
</body>

</html>
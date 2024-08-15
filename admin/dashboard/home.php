<?php

if (!isset($_SESSION['USERID'])) {

  redirect(web_root . "admin/index.php");

}

?>

<?php

$query = "SELECT * FROM tblorder";

$mydb->setQuery($query);

$cur = $mydb->executeQuery();

$rowscount = $mydb->num_rows($cur);

$res = isset($rowscount) ? $rowscount : 0;



if ($res > 0) {

  $order = '<span style="color:black;">' . $res . '</span>';

} else {

  $order = '<span> ' . $res . '</span>';

}

?>

<?php

$query = "SELECT * FROM tblcustomer";

$mydb->setQuery($query);

$cur = $mydb->executeQuery();

$rowscount = $mydb->num_rows($cur);

$res = isset($rowscount) ? $rowscount : 0;



if ($res > 0) {

  $customer = '<span style="color:black;">' . $res . '</span>';

} else {

  $customer = '<span> ' . $res . '</span>';

}

?>

<?php

$query = "SELECT * FROM tblproduct";

$mydb->setQuery($query);

$cur = $mydb->executeQuery();

$rowscount = $mydb->num_rows($cur);

$res = isset($rowscount) ? $rowscount : 0;



if ($res > 0) {

  $product = '<span style="color:black;">' . $res . '</span>';

} else {

  $product = '<span> ' . $res . '</span>';

}

?>

<?php

$query = "SELECT * FROM tblsummary WHERE ORDEREDSTATS = 'Delivered Successfully'";

$mydb->setQuery($query);

$cur = $mydb->executeQuery();

$rowscount = $mydb->num_rows($cur);

$res = isset($rowscount) ? $rowscount : 0;



if ($res > 0) {

  $receive = '<span style="color:black;">' . $res . '</span>';

} else {

  $receive = '<span> ' . $res . '</span>';

}

?>


<?php

$user = new User();

$singleuser = $user->single_user($_SESSION['USERID']);



?>

<?php
function getTotalSales() {
    global $mydb;
    
    $query1 = "SELECT SUM(totalPrice) as totalSales FROM orderpos";
    $mydb->setQuery($query1);
    $result1 = $mydb->loadSingleResult();
    $totalSalesOrderpos = isset($result1->totalSales) ? $result1->totalSales : 0;
    
    $query2 = "SELECT SUM(PAYMENT) as totalPayments FROM tblsummary";
    $mydb->setQuery($query2);
    $result2 = $mydb->loadSingleResult();
    $totalPaymentsTblsummary = isset($result2->totalPayments) ? $result2->totalPayments : 0;
    
    $totalSales = $totalSalesOrderpos + $totalPaymentsTblsummary;
    
    return $totalSales;
}
$totalSales = getTotalSales();
?>

<?php
 
$dataPoints = array( 
	array("y" => 7,"label" => "March" ),
	array("y" => 12,"label" => "April" ),
	array("y" => 28,"label" => "May" ),
	array("y" => 18,"label" => "June" ),
	array("y" => 41,"label" => "July" )
);
 
?>

<style>


.border-bottom-red {
    border-bottom: 3px solid #fd2323;
}

</style>
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Sales</h4>
                <div class="stats-figure"> &#8369;<?php echo number_format($totalSales, 2); ?></div>
                <div class="stats-meta text-success">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                    </svg> 
                </div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <!-- <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Number of Customers</h4>
                <div class="stats-figure"><?php echo $customer; ?></div>
            </div>

            <a class="app-card-link-mask" href="<?php echo web_root; ?>admin/customers/index.php"></a>
        </div>
    </div> -->

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Number of Products</h4>
                <div class="stats-figure"><?php echo $product; ?></div>
            </div>

            <a class="app-card-link-mask" href="<?php echo web_root; ?>admin/products/index.php"></a>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Number of Orders</h4>
                <div class="stats-figure"><?php echo $order; ?></div>
            </div>

            <a class="app-card-link-mask" href="<?php echo web_root; ?>admin/orders/index.php"></a>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Received Orders</h4>
                <div class="stats-figure"><?php echo $receive; ?></div>
            </div>

            <a class="app-card-link-mask" href="<?php echo web_root; ?>admin/orders/index.php"></a>
        </div>
    </div>
</div>
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-6">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <!-- <h4 class="stats-type mb-3">Sales Overview</h4> -->
                <div class="text-end mb-3">
                    <select id="monthSelect" onchange="updateChart()" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                        <option value="overall">Overall</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div id="chartContainer" style="height: 250px;"></div>
            </div>
        </div>
        
    </div>

    <div class="col-12 col-lg-6">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-3">Product</h4>
                <div id="doughnutChartContainer" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
    <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
            <h4 class="stats-type mb-3">Top Selling Products</h4>
            <div id="productSalesChartContainer" style="height: 300px;"></div>
        </div>
    </div>
</div>
</div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    
    <script>
function updateChart() {
    var month = document.getElementById('monthSelect').value;
    fetch('get_data.php?month=' + month)
        .then(response => response.json())
        .then(data => {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title:{
                    text: "Orders Sales Overview"
                },
                axisY: {
                    title: "(PHP)",
                    includeZero: true,
                    prefix: "₱",
                    suffix:  "k"
                },
                data: [{
                    type: "bar",
                    yValueFormatString: "₱#,##0K",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    color: "#fd2323",
                    dataPoints: data
                }]
            });
            chart.render();
        })
        .catch(error => console.error('Error fetching data:', error));
}

function fetchStockData() {
    fetch('get_stock.php')
        .then(response => response.json())
        .then(data => {
            updateDoughnutChart(data);
        })
        .catch(error => console.error('Error fetching stock data:', error));
}

function updateDoughnutChart(stockData) {
    var chart = new CanvasJS.Chart("doughnutChartContainer", {
        animationEnabled: true,
        title: {
            text: "Stock Forecasting"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            indexLabelFontSize: 12,
            indexLabel: "{label} - {y}",
            toolTipContent: "<b>{label}:</b> {y} ({percent}%)",
            dataPoints: stockData.map(item => ({
                label: item.productName,
                y: parseInt(item.productStock)
            }))
        }]
    });
    chart.render();
}

function fetchProductSalesData() {
    fetch('get_product_sales.php')
        .then(response => response.json())
        .then(data => {
            updateProductSalesChart(data);
        })
        .catch(error => console.error('Error fetching product sales data:', error));
}

function updateProductSalesChart(salesData) {
    // Create an array of distinct colors
    var colors = [
        "#fd2323", "#2196F3", "#FFC107", "#FF5722", "#9C27B0",
        "#795548", "#3F51B5", "#009688", "#FF9800", "#607D8B"
    ];

    // Assign colors to dataPoints
    salesData.forEach((dataPoint, index) => {
        dataPoint.color = colors[index % colors.length];
    });

    var chart = new CanvasJS.Chart("productSalesChartContainer", {
        animationEnabled: true,
        title: {
            text: "Top 10 Selling Products"
        },
        axisY: {
            title: "Product Sold",
            includeZero: true
        },
        axisX: {
            interval: 1,
            labelFormatter: function() {
                return ""; // This removes the labels on the x-axis
            }
        },
        dataPointWidth: 50,
        toolTip: {
            content: "{label}: {y} total" // This defines what's shown on hover
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0 ",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: salesData
        }]
    });
    chart.render();
}
function initializeCharts() {
    updateChart();
    fetchStockData();
    fetchProductSalesData();
}

window.onload = initializeCharts;
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .checked {
    color: orange;
  }

  .product-tabs .tab-content .tab-pane .product-add-review .review-form label .astk {
    color: #FF0000;
    font-size: 12px;
  }

  .product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title .date span {
    color: maroon;
  }

  .product-tabs .tab-content .tab-pane .product-reviews .reviews .review .author span {
    color: maroon;
  }

  .product-tabs .tab-content .tab-pane .product-reviews .reviews .review .review-title .summary {
    color: #666666;
    font-size: 14px;
    font-weight: 300;
    line-height: 45px;
    margin-right: 10px;
    text-transform: uppercase;
  }
</style>
<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dried');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<?php

if (isset($_POST['submit'])) {
  $qty = $_POST['quality'];
  $name = $_POST['name'];

  $review = $_POST['review'];
  mysqli_query($con, "Insert into productreviews(PROID,quality,name,review) values('$PROID','$qty','$name','$review')");
}

$PROID =   $_GET['id'];
$query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
            WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND p.`PROID`=" . $PROID;
$mydb->setQuery($query);
$cur = $mydb->loadResultList();


foreach ($cur as $result) {

?>

  <!-- Portfolio Item Row -->
  <form method="POST" action="cart/controller.php?action=add">

    <div class="row">

      <div class="col-md-7">
        <div class="row" style="float: right;">
          <div class="col-m-12">
            <div class="col-md-8 responsive">
              <img width="330" class="img-portfolio " height="300" src="<?php echo web_root . 'admin/products/' .  $result->IMAGES; ?>" alt="" style="-webkit-border-radius:5px; -moz-border-radius:5px;">

            </div>
          </div>

        </div>


      </div>


      <div class="col-md-5">
        <input type="hidden" name="PROPRICE" value="<?php echo $result->PRODISPRICE; ?>">
        <input type="hidden" id="PROQTY" name="PROQTY" value="<?php echo $result->PROQTY; ?>">

        <input type="hidden" name="PROID" value="<?php echo $result->PROID; ?>">
        <!-- <h3><?php echo $result->PRONAME; ?></h3> -->
        <p><?php echo   $result->CATEGORIES; ?></p>
        <!-- <h3>Project Details</h3> -->
        <ul>
          <!-- <li>Model - <?php echo $result->PROMODEL; ?></li> -->
          <li>Type - <?php echo $result->PRODESC; ?></li>
          <li>Price - &#8369;<?php echo $result->PROPRICE; ?></li>
          <?php if ($result->PRODISCOUNT > 0) { ?>
            <li>Discount - <?php echo $result->PRODISCOUNT; ?>% </li>

            <li>Discounted Price - &#8369; <?php echo $result->PRODISPRICE; ?> </li>
          <?php } ?>
          <li>Status - <b><?php echo $result->PROSTATS; ?></b></li>

          <?php if ($result->PROSTATS == 'NotAvailable') { ?>
          <?php } ?>
          <?php if ($result->PROSTATS == 'Available') { ?>
            <li>Available Quantity - <?php echo $result->PROQTY; ?></li>
          <?php } ?>
          <?php $rt = mysqli_query($con, "select * from productreviews where PROID='$PROID'");
          $num = mysqli_num_rows($rt); {
          ?>

            <!-- <ul id="product-tabs" class="nav  nav-tab-cell">
              <a data-toggle="tab" href="#review" class="lnk">(<?php echo htmlentities($num); ?> Reviews)</a>
            </ul> -->

          <?php } ?>
        </ul>
        <?php if ($result->PROSTATS == 'NotAvailable') { ?>
          <button type="submit" class="btn btn-pup btn-sm" name="btnorder" disabled>Order Now!</button>
        <?php } ?>
        <?php if ($result->PROSTATS == 'Available') { ?>
          <button type="submit" class="btn btn-pup btn-sm" name="bttnorder">Order Now!</button>
        <?php } ?>
      </div>
    <?php } ?>
    </div>
    <!-- /.row -->
  </form>


  

  </div><!-- /.product-tab -->
  </div><!-- /.tab-pane -->



  </div><!-- /.tab-content -->
  </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.product-tabs -->
  <?php
  $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
            WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND `CATEGORIES`='" . $result->CATEGORIES . "' limit 4";
  $mydb->setQuery($query);
  $cur = $mydb->loadResultList();
  ?>
  <!-- Related Projects Row -->
  <div class="row">

    <div class="col-lg-12">
      <h3 class="page-header">Related Products</h3>
    </div>
    <?php

    foreach ($cur as $result) {

    ?>
      <div class="col-sm-3 col-xs-6">
        <a href="index.php?q=single-item&id=<?php echo $result->PROID; ?>">
          <img class="img-hover img-related" width="135px" height="90px" src="<?php echo web_root . 'admin/products/' . $result->IMAGES; ?>" alt="">
        </a><br />
        <a href="index.php?q=single-item&id=<?php echo $result->PROID; ?>"><b><?php echo  $result->PRODESC; ?></b></a>
      </div>

    <?php } ?>

  </div>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <!-- 
            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
                </a>
            </div> -->
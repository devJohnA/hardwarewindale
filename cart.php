<section id="cart_items">
    <div class="container">

        <?php

// if (!isset($_SESSION['USERID'])){
//     redirect("index.php"); 
check_message();

?>

        <div class="table-responsive">
            <div class="cartLi">

                <table class="table table-default" id="table">
                    <thead>
                        <td width="10%">Product</td>
                        <td width="10%">Description</td>
                        <td width="10%">Price</td>
                        <td width="5%">Available</td>
                        <td width="5%">Quantity</td>
                        <td width="10%" style="text-align:center;">Total</td>
                    </thead>

                    <?php


      if (!empty($_SESSION['gcCart'])) {

        echo '<script>totalprice()</script>';

        $count_cart = count($_SESSION['gcCart']);

        for ($i = 0; $i < $count_cart; $i++) {

          $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                                                 WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  and p.`PROID` = '" . @$_SESSION['gcCart'][$i]['productid'] . "'";
          $mydb->setQuery($query);
          $cur = $mydb->loadResultList();


          foreach ($cur as $result) {

            ?>
                    <tr>
                        <td>
                            <img src="<?php echo web_root . 'admin/products/' . $result->IMAGES; ?>"
                                onload="  totalprice() " width="40px" height="40px" style="border-radius: 10%;">
                            <br />
                            <?php


                if (isset($_SESSION['CUSID'])) {

                  // echo ' <a href="'.web_root. 'customer/controller.php?action=addwish&proid='.$result->PROID.'" title="Add to wishlist">Add to wishlist</a>';
          
                } else {
                  //  echo   '<a href="#" title="Add to wishlist" class="proid"  data-target="#smyModal" data-toggle="modal" data-id="'.  $result->PROID.'">Add to wishlist</a> ';
                }




                ?>




                        </td>
                        <td>
                            <?php echo $result->PRODESC; ?>
                        </td>
                        <td>
                            <input type="hidden" id="PROPRICE<?php echo $result->PROID; ?>"
                                name="PROPRICE<?php echo $result->PROID; ?>"
                                value="<?php echo $result->PRODISPRICE; ?>">

                            &#8369; <?php echo $result->PRODISPRICE; ?>
                        </td>
                        <td width="5%">
                            <span id="quantityLeft<?php echo $result->PROID; ?>">
                                <?php echo $result->PROQTY - $_SESSION['gcCart'][$i]['qty']; ?>
                            </span>
                        </td>

                        <td class="input-group custom-search-form">
                            <div id="error-message" style="color: red; display: none;"></div>
                            <input type="hidden" maxlength="3px" class="form-control input-sm" autocomplete="off"
                                id="ORIGQTY<?php echo $result->PROID; ?>" name="ORIGQTY<?php echo $result->PROID; ?>"
                                value="<?php echo $result->PROQTY; ?>" placeholder="Search for...">

                            <input type="number" maxlength="3px" data-id="<?php echo $result->PROID; ?>"
                                class="QTY form-control input-sm" autocomplete="off"
                                id="QTY<?php echo $result->PROID; ?>" name="QTY<?php echo $result->PROID; ?>"
                                value="<?php echo max(0, $_SESSION['gcCart'][$i]['qty']); ?>" placeholder="0"
                                oninput="handleQuantityChange('QTY<?php echo $result->PROID; ?>')">

                            <span class="input-group-btn">
                                <a title="Remove Item" class="btn btn-del btn-danger" id="btnsearch" name="btnsearch"
                                    href="cart/controller.php?action=delete&id=<?php echo $result->PROID; ?>">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </span>
                        </td>

                        <input type="hidden" id="TOT<?php echo $result->PROID; ?>"
                            name="TOT<?php echo $result->PROID; ?>" value="<?php echo $result->PRODISPRICE; ?>">

                        <td style="text-align:center;"> &#8369; <output
                                id="Osubtot<?php echo $result->PROID ?>"><?php echo $_SESSION['gcCart'][$i]['price']; ?></output>
                        </td>
                    </tr>

                    <?php
          }
        }
      } else {
        echo "<h1>There is no item in the cart.</h1>";
      }
      ?>

                </table>


                <h3 align="right"> Total: &#8369;<span id="sum">0</span></h3>
                </td>

                <!-- 
                <a href="index.php?q=product" class="btn btn-default pull-left btn-sm"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Add New Order</strong></a>
                <a href="index.php?page=7" name="proceed"  class="btn btn-info pull-right btn-sm"   ><strong>Proceed And Checkout</strong> <span class="glyphicon glyphicon-chevron-right"></span></a> 
                -->
            </div>
        </div>
        <form action="index.php?q=orderdetails" method="post">
            <!-- <a href="index.php?q=product" class="btn btn-default check_out pull-left ">
                <i class="fa fa-arrow-left fa-fw"></i>
                Add New Order
            </a> -->

            <?php

  $countcart = isset($_SESSION['gcCart']) ? count($_SESSION['gcCart']) : "0";
  if ($countcart > 0) {

    if (isset($_SESSION['CUSID'])) {

      echo '<button type="submit"  name="proceed" id="proceed" class="btn btn-success pull-right">
                            Proceed And Checkout
                            <i class="fa  fa-arrow-right fa-fw"></i>
                            </button>';

    } else {
      echo '<a data-target="#smyModal" data-toggle="modal" class="btn btn-default check_out signup pull-right" href="" style="background-color: seagreen; color:white; border:none;">
                              Proceed And Checkout
                              <i class="fa  fa-arrow-right fa-fw"></i>
                              </a>';
    }
  }



  ?>
        </form>
    </div>
</section>
<!--reponsive -->


<script>
function handleQuantityChange(inputId) {
    var inputElement = document.getElementById(inputId);
    var currentValue = parseInt(inputElement.value);
    var originalQuantity = parseInt(document.getElementById('ORIGQTY' + inputId.slice(3)).value);
    var maxAllowedQuantity = Math.min(originalQuantity, currentValue);
    inputElement.value = maxAllowedQuantity;

    var quantityLeftElement = document.getElementById('quantityLeft' + inputId.slice(3));
    quantityLeftElement.textContent = originalQuantity - maxAllowedQuantity;

    if (isNaN(currentValue) || currentValue < 0) {
        inputElement.value = 0;
        quantityLeftElement.textContent = originalQuantity;
    }

    totalprice();
}
</script>
<?php include "LogSignModal.php"; ?>
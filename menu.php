<style>
.image-container {
    width: 100%;
    height: 200px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.product-image-wrapper {
    width: 80%; 
    height: 400px; 
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
    margin: 0 auto; 
}

.single-products {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.productinfo {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.productinfo h5,
.productinfo p {
    margin: 10px 0;
}

.productinfo img {
    max-height: 200px; 
    width: auto;
}
    </style>
<section>
    <div class="container">
        <div class="row">

            <!--/category-productsr-->

            <div class="col-sm-12 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Products</h2>
                    <?php
             if(isset($_POST['search'])) { 
                $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                          WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 
                AND ( `CATEGORIES` LIKE '%{$_POST['search']}%' OR `PRODESC` LIKE '%{$_POST['search']}%' or `PROQTY` LIKE '%{$_POST['search']}%' or `PROPRICE` LIKE '%{$_POST['search']}%')";
              }elseif(isset($_GET['category'])){
                $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                          WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 AND CATEGORIES='{$_GET['category']}'";
              }else{
                $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                          WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 ";
              }

           
            $mydb->setQuery($query);
            $res = $mydb->executeQuery();
            $maxrow = $mydb->num_rows($res);

            if ($maxrow > 0) { 
            $cur = $mydb->loadResultList();
           
            foreach ($cur as $result) { 

              ?>
                    <form method="POST" action="cart/controller.php?action=add">
                        <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
                        <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

                        <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" />
                                        <h5>&#8369 <?php  echo $result->PRODISPRICE; ?></h5>
                                        <p style="color: #696763;
    font-family: 'Roboto', sans-serif;
    font-size: 10px;
    text-decoration: none;
    text-transform: uppercase; font-weight:bold;"> Quantity: <em>
                                                <?php  echo $result->PROQTY; ?> </em></p>
                                        <p style="color: #696763;
    font-family: 'Roboto', sans-serif;
    font-size: 10px;
    text-decoration: none;
    text-transform: uppercase; font-weight:bold">Product: <em> <?php  echo    $result->PRODESC; ?> </em></p>
                                        <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                    <!-- <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>&#8369 <?php  echo $result->PRODISPRICE; ?></h2>
                                            <p><?php  echo    $result->PRODESC; ?></p>
                                            <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div> -->
                                </div>

                            </div>
                        </div>
                    </form>
                    <?php  } 


            }else{ 

              echo '<h1>No Products Available</h1>';

            }?>
                </div>
                <!--features_items-->
            </div>
        </div>
    </div>
</section>
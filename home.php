<style>
#about-store {
    background-color: #f8f8f8;
    padding: 30px 0;
    position: relative;
    overflow: hidden;
    height: 20px;
    margin-top: 100px;
}

.section-two {
    margin-top: 79px;
}

.section-three {
    margin-top: 100px;
    /* Adjusted margin-top */
}

.section-four {
    margin-top: 100px;
    /* Adjusted margin-top */
}

#about-store .triangle-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #fd2323;
    z-index: 1;
}

#about-store .container {
    position: relative;
    z-index: 2;
}

#about-store p {
    color: #fff;
    margin-bottom: 30px;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
}

#about-store .about-content {
    font-size: 16px;
    line-height: 1.6;
    text-align: justify;
    padding: 20px;
    border-radius: 5px;
}

#about-store ul {
    margin-top: 20px;
    margin-bottom: 20px;
    padding-left: 20px;
}

#about-store li {
    margin-bottom: 10px;
}

#about-store img {
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

@media (max-width: 767px) {
    #about-store .col-sm-4 {
        text-align: center;
    }
}

#about-store .about-content,
#about-store .about-content ul,
#about-store .about-content li {
    color: #fff;

}

@media (max-width: 767px) {
    #features .card {
        margin-bottom: 20px;

    }

    #features .row {
        justify-content: center;
    }
}

.section-three .card {
    position: relative;
    overflow: hidden;
    padding-bottom: 20px;

}

.section-three .card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 70px;

    height: 2px;

    background-color: #fd2323;
}

.img-responsive {
    margin-left: 10px;
}

.section-three .card {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.section-three .card:hover {
    transform: translateY(-5px);
}

.section-three .card-icon {
    margin: 0 auto;
    padding: 10px;
    width: 80px;
    height: 80px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.section-three .card-icon img {
    max-width: 50px;
    max-height: 50px;
}

.section-three .card-title {
    font-size: 20px;
    margin-bottom: 15px;
}

.section-three .card-text {
    color: #696763;
    font-size: 14px;

}

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
    height: 400px; 
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
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
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span style="color:#fd2323;">Windale Hardware</span> Store</h1>
                                <h2>Buy Now!</h2>
                                <p>Welcome to Windale Hardware, where quality meets craftsmanship! Whether you're a
                                    seasoned DIY enthusiast or just starting out on your home improvement journey, we're
                                    thrilled to have you here. Explore our extensive collection of tools, hardware, and
                                    accessories designed to tackle any project with ease. Welcome aboard! </p>

                            </div>
                            <div class="col-sm-6">
                                <img src="img/windalestore.jpg" class="girl img-responsive" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span style="color:#fd2323;">Welcome</span></h1>
                                <h2> Windale Hardware</h2>
                                <p>Where we offer a wide range of high-quality products
                                    designed to meet your DIY needs with durability and reliability.</p>

                            </div>
                            <div class="col-sm-6">
                                <img src="img/Winsdale.jpg" class=" img-responsive" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php include 'sidebar.php'; ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Features Items</h2>

                    <?php

            $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
            WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 ";
            $mydb->setQuery($query);
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
                                    <!--  -->
                                </div>

                            </div>
                        </div>
                    </form>
                    <?php  } ?>

                </div>
                <!--features_items-->

                <!--  -->
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

<section id="features" class="section-three" data-aos="fade-right">
    <div class="triangle-background"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12" data-aos="fade-right" data-aos-delay="100">
                <div class="card text-center">
                    <div class="card-icon">
                        <img src="img/product-range.png" alt="Feature 1 Icon" class="img-icon" width="80" height="70">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Wide Range of Products</h5>
                        <p class="card-text">Explore our extensive collection of tools, hardware, and accessories designed to tackle any project with ease.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="card text-center">
                    <div class="card-icon">
                        <img src="img/quality-control.png" alt="Feature 2 Icon" class="img-icon" width="80" height="70">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Quality and Durability</h5>
                        <p class="card-text">We pride ourselves on offering high-quality products that are durable and reliable, ensuring your projects are built to last.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12" data-aos="fade-left" data-aos-delay="300">
                <div class="card text-center">
                    <div class="card-icon">
                        <img src="img/influencer.png" alt="Feature 3 Icon" class="img-icon" width="80" height="70">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Expert Customer Support</h5>
                        <p class="card-text">Our knowledgeable staff are here to assist you, whether you're a professional contractor or a DIY enthusiast, ensuring you have the support you need.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="quote-section" class="section-four" data-aos="fade-up-left">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-sm-5" data-aos="fade-right" data-aos-delay="100">
                <img src="img/group.png" class="img-responsive" alt="Quote Image" width="500" height="450">
            </div>
            <div class="col-sm-7" data-aos="fade-left" data-aos-delay="200">
                <div class="quote-message">
                    <blockquote>
                        <p style="text-align:justify;"> Welcome to Windale Hardware, your one-stop shop for all your home improvement needs. With years of experience in the industry, we pride ourselves on offering quality tools, hardware, and expert advice to both professionals and DIY enthusiasts alike.</p>
                    </blockquote>
                    <em class="author">- Windale Hardware Team</em>
                </div>
            </div>
        </div>
    </div>
</section>



<section id="about-store" class="section-three">
    <div class="triangle-background"></div>
    <div class="container">
        <p class=" text-center">&copy; Windale Hardware Inc. All right reserved</p>
        <!-- <div class="row">
            <div class="col-sm-4">
                <img src="img/windalestore.jpg" alt="Windale Hardware Store Front" class="img-responsive">
            </div>
           <div class="col-sm-8">
                <div class="about-content">
                    <h4><span style=font-size:16px;>Windale Hardware </span> is your one-stop shop for all your home
                        improvement needs. With a
                        couple years
                        of
                        experience in the industry, we pride ourselves on offering good tools, hardware, and
                        to both professional contractors and DIY enthusiasts.</h4>
                </div>


            </div> 
        </div> -->
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1600, // Animation duration in milliseconds
            once: true, // Whether animation should happen only once - while scrolling down
            mirror: false, // Whether elements should animate out while scrolling past them
        });
    </script>
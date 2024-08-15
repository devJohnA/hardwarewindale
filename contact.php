<?php 

// $mydb->setQuery("SELECT * 

      // 			FROM  `tblusers` WHERE TYPE != 'Customer'");

$mydb->setQuery("SELECT * 

                  FROM  `tbluseraccount` WHERE U_ROLE='Administrator'");

$cur = $mydb->loadResultList();



foreach ($cur as $result) { ?>
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Contact <strong>Us</strong></h2>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-5">
            <div class="contact-info">
                <!-- <h2 class="title text-center">Contact Info</h2> -->
                <address>
                    <p style="color:#fd2323;">Windale Hardware Store</p>
                    <p>Burgos Street, Mancilang, Madridejos, Cebu</p>
                    <p>Opening and Closing Time: Monday - Saturday: 8:00 AM to 5:00 PM</p>
                    <p>Contact Number : <?php echo $result->U_CON; ?></p>
                    <p>Email: <?php echo $result->U_EMAIL; ?></p>
                </address>

            </div>
        </div>
    </div>
</div>
</div>
<!--/#contact-page-->
<?php   }

?>
<style>
p {
    font-size: 14px;
    color: black;

}
</style>
 <?php
  $customer = New customer;
  $res = $customer->single_customer($_SESSION['CUSID']);
 
  ?>
 <h3>Your Account</h3>
 <form class="form-horizontal span6" action="customer/controller.php?action=edit"
     name="personal" method="POST" enctype="multipart/form-data" id="accountForm" >
     <div class="col-lg-12" style="margin-top:5%;">
         <div class="row">
             <div class="col-lg-6">
                 <div class="form-group">
                     <div class="col-md-12">
                         <label class="col-md-4 control-label" for="FNAME">First Name:</label>
                         <div class="col-md-8">
                             <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder="First Name"
                                 type="text" value="<?php echo $res->FNAME; ?>" required>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-6">
                 <div class="form-group">
                     <div class="col-md-12">
                         <label class="col-md-4 control-label" for="LNAME">Last Name:</label>

                         <div class="col-md-8">
                             <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder="Last Name"
                                 type="text" value="<?php echo $res->LNAME; ?>" required>
                         </div>
                     </div>
                 </div>
             </div>

             <!--  <div class="col-lg-6">
             <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "CUSHOMENUM">Home#:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="CUSHOMENUM" name="CUSHOMENUM" placeholder=
                        "Home Number" type="text" value="<?php echo $res->CUSHOMENUM; ?>">
                  </div>
                </div>
              </div>
           </div>  
            <div class="col-lg-6">
   
               <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "STREETADD">STREET/Village:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="STREETADD" name="STREETADD" placeholder=
                        "STREET / Village" type="text" value="<?php echo $res->STREETADD; ?>">
                  </div>
                </div>
              </div>
           </div>  

            <div class="col-lg-6">
              <div class="form-group">
                <div class="col-md-12"> 
                  <label class="col-md-4 control-label" for=
                  "BRGYADD">Barangay:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="BRGYADD" name="BRGYADD" placeholder=
                        "Barangay" type="text" value="<?php echo $res->BRGYADD; ?>">
                  </div>
                </div>
              </div> 
           </div>   -->
             <div class="col-lg-6">

                 <div class="form-group">
                     <div class="col-md-12">
                         <label class="col-md-4 control-label" for="CITYADD">Del. Address:</label>

                         <div class="col-md-8">
                             <input class="form-control input-sm" id="CITYADD" name="CITYADD"
                                 placeholder="Street/Brgy./Municipality/Province" type="text"
                                 value="<?php echo $res->CITYADD; ?>" required>
                         </div>
                     </div>
                 </div>

             </div>


             <!--    <div class="col-lg-6">
             <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "PROVINCE">Province:</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="PROVINCE" name="PROVINCE" placeholder=
                      "Province" type="text" value="<?php echo $res->PROVINCE; ?>">
                </div>
              </div>
            </div>
           </div>  
            <div class="col-lg-6"> 
              <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "COUNTRY">Country:</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="COUNTRY" name="COUNTRY" placeholder=
                      "Country" type="text" value="<?php echo $res->COUNTRY; ?>">
                </div>
              </div>
            </div>
           </div>    -->



             <div class="col-lg-6">
                 <div class="form-group">
                     <div class="col-md-12">
                         <label class="col-md-4 control-label" for="PHONE">Contact#:</label>

                         <div class="col-md-8">
                             <input class="form-control input-sm" id="PHONE" name="PHONE" placeholder="0900-000-0000"
                                 type="tel" pattern="\d{11}" value="<?php echo $res->PHONE; ?>" required>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- <div class="col-lg-6"> 
                <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "EMAILADD">Email:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="EMAILADD" name="EMAILADD" placeholder=
                        "example@gmail.com" type="email" value="<?php echo $res->EMAILADD; ?>" required>
                  </div>
                </div>
              </div> 
           </div>  -->

             <div class="col-lg-6">
                 <div class="form-group">
                     <div class="col-md-12">
                         <label class="col-md-4 control-label" for="CUSUNAME">Email:</label>

                         <div class="col-md-8">
                             <input class="form-control input-sm" id="CUSUNAME" name="CUSUNAME" placeholder="Email"
                                 type="email" value="<?php echo $res->CUSUNAME; ?>" required>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="form-group">
                     <div class="col-md-12">
                         <label class="col-md-4 control-label" for="GENDER">Gender:</label>

                         <div class="col-md-8">
                             <input id="GENDER" name="GENDER" type="radio"
                                 <?php echo ($res->GENDER=='Male') ? 'CHECKED' : '' ;  ?> value="Male" /><b> Male </b>
                             <input id="GENDER" name="GENDER" type="radio"
                                 <?php echo ($res->GENDER=='Female') ? 'CHECKED' : '' ; ?> value="Female" /> <b> Female
                             </b>
                         </div>
                     </div>
                 </div>
             </div>

             <!--      <div class="col-lg-6">
               <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-4 control-label" for=
                    "CUSPASS">Password:</label>

                    <div class="col-md-8">
                       <input class="form-control input-sm" id="CUSPASS" name="CUSPASS" placeholder=
                          "Password" type="password" value="<?php echo  sha1($res->CUSPASS); ?>"><span></span> -->
             <!--  <p>Note</p>
                          Password must be atleast 8 to 15 characters. Only letter, numeric digits, underscore and first character must be a letter.
                       -->
             <!--        </div>
                  </div>
                </div>
           </div> -->




             <!--         <div class="col-lg-6">
            <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-4 control-label" for=
                    "ZIPCODE">Zip Code:</label>

                    <div class="col-md-8">
                       <input class="form-control input-sm" id="ZIPCODE" name="ZIPCODE" placeholder=
                          "Zip Code" type="number" value="<?php echo $res->ZIPCODE; ?>">
                    </div>
                  </div>
                </div>
           </div>
           </div>  -->




             <div class="col-lg-6">
                 <div class="form-group">
                     <div class="col-md-12">
                         <label class="col-md-4" align="right" for="btn"></label>
                         <div class="col-md-8">
                             <input type="submit" name="save" value="Save" class="submit btn btn-primary" />

                         </div>
                     </div>
                 </div>
             </div>
         </div>
 </form>
 <script>
document.getElementById('accountForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    fetch('customer/controller.php?action=edit', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Server response:', data);  
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Account updated successfully',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo web_root; ?>index.php?q=profile';
                }
            });
        } else if (data.status === 'no_changes') {
            Swal.fire({
                icon: 'info',
                title: 'No Changes',
                text: 'No changes were made to your account',
                confirmButtonText: 'OK'
            });
        } else if (data.status === 'error') {
            throw new Error(data.message || 'Unknown error occurred');
        } else {
            throw new Error('Unexpected server response');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating your account: ' + error.message,
            confirmButtonText: 'OK'
        });
    });
});
</script>
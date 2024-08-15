<?php  
     if (!isset($_SESSION['USERID'])){
      redirect(web_root."admin/index.php");
     }

  @$CUSTOMERID = $_GET['id'];
    if($CUSTOMERID==''){
  redirect("index.php");
}
  $customer = New Customer();
  $singlecustomer = $customer->single_customer($CUSTOMERID);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

          <fieldset>
            <legend> Update User Account</legend>
                   
                    <!-- <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "user_id">User Id:</label> -->

                      <!-- <div class="col-md-8"> -->
                        
                         <input class="form-control input-sm" id="CUSTOMERID" name="CUSTOMERID" placeholder=
                            "Customer Id" type="Hidden" value="<?php echo $singlecustomer->CUSTOMERID; ?>">
                   <!--    </div>
                    </div>
                  </div>      -->      
                  
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "CUSUNAME">Name:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="CUSUNAME" name="CUSUNAME" placeholder=
                            "Customer Name" type="text" value="<?php echo $singlecustomer->CUSUNAME; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "FNAME">First Name:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder=
                            "First Name" type="text" value="<?php echo $singlecustomer->FNAME; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "LNAME">Last Name:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder=
                            "Last Name" type="text" value="<?php echo $singlecustomer->LNAME; ?>">
                      </div>
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "PHONE">Contact Number:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="PHONE" name="PHONE" placeholder=
                            "Contact Number" type="text" value="<?php echo $singlecustomer->PHONE; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "EMAILADD">Email Address:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="EMAILADD" name="EMAILADD" placeholder=
                            "example@gmail.com" type="text" value="<?php echo $singlecustomer->EMAILADD; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "GENDER">Gender:</label>

                      <div class="col-md-8">
                       <select class="form-control input-sm" name="GENDER" id="GENDER">
                          <option value="Male"  <?php echo ($singlecustomer->GENDER=='Male') ? 'selected="true"': '' ; ?>>Male</option>
                          <option value="Female" <?php echo ($singlecustomer->GENDER=='Female') ? 'selected="true"': '' ; ?>>Female</option> 
                          <!-- <option value="Customer">Customer</option> -->
                          
                        </select> 
                      </div>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "CITYADD">Address:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="CITYADD" name="CITYADD" placeholder=
                            "Street/Brgy./Municipality/Province" type="text" value="<?php echo $singlecustomer->CITYADD; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "CUSPASS">Password:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="CUSPASS" name="CUSPASS" placeholder=
                            "Password" type="text" value="<?php echo $singlecustomer->CUSPASS; ?>" readonly>
                      </div>
                    </div>
                  </div>

            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                         <button class="btn btn-primary " name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                          <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span>&nbsp;<strong>List of Users</strong></a> -->
                      </div>
                    </div>
                  </div>

              
          </fieldset> 

        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson"></label>

                    <div class="col-md-6">
                   
                    </div>
                  </div>

                  <div class="col-md-6" align="right">
                   

                   </div>
                  
              </div>
              </div>
          
        </form>
      

        </div><!--End of container-->
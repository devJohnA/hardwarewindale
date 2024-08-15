 <!-- sign up modal -->
 <div class="modal fade" id="smyModal" tabindex="-1">

     <div class="modal-dialog" style="width:80%">
         <div class="modal-content">
             <div class="modal-header">
                 <!--<button class="close" data-dismiss="modal" type=
      "button">×</button> -->
                 <div class="modal-body">

                     <!-- Nav tabs -->

                     <ul class="nav nav-pills">
                         <li class="active"><a href="#home" data-toggle="tab">Login</a>
                         </li>
                         <li><a href="#profile" data-toggle="tab">Sign Up</a>
                         </li>

                     </ul>

                     <!-- Tab panes  login panel-->
                     <div class="tab-content">
                         <div class="tab-pane fade in active" id="home">
                             <!-- <h4>Login Tab</h4>  -->
                             <div class="panel panel-pup">
                                 <div class="panel-heading">
                                     Login Details
                                 </div>
                                 <div class="panel-body">

                                     <form class="form-horizontal span6" name="" action="login.php" method="POST">
                                         <input class="proid" type="hidden" name="proid" id="proid" value="">
                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="U_USERNAME">Email:</label>

                                                 <div class="col-md-8">
                                                     <input id="U_USERNAME" name="U_USERNAME"
                                                         placeholder="Email account" type="email"
                                                         class="form-control input-sm" required>

                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="U_PASS">Password:</label>

                                                 <div class="col-md-8">
                                                     <input name="U_PASS" id="U_PASS" placeholder="Password"
                                                         type="password" class="form-control input-sm" required>

                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="FIRSTNAME"> </label>

                                                 <div class="col-md-8">
                                                     <button type="submit" id="modalLogin" name="modalLogin"
                                                         class=" btn-primary" style="border:none;">Login</button>
                                                     <button class="btn-danger" data-dismiss="modal" type="button"
                                                         style="border:none;">Close</button>
                                                 </div>
                                             </div>
                                         </div>

                                         <!-- <div class="form-group">
                                  <div class="col-md-10">
                                  <label class="col-md-4 control-label"> </label>
                                    <div class="col-md-8">  <a href="forgot-password.php">Forgot password?</a> </div>
                                  </div>
                                </div> -->
                                     </form>

                                 </div>
                                 <!--<div class="panel-footer">
                             <p align="left">&copy; BSIT Students</p>
                        </div>-->
                             </div>
                         </div>
                         <!-- end login panel -->

                         <!-- sign in panel -->
                         <div class="tab-pane fade" id="profile">
                             <!-- <h4>Customer Details</h4>  -->

                             <form class="form-horizontal span6" action="customer/controller.php?action=add"
                                 onsubmit="return personalInfo();" name="personal" method="POST"
                                 enctype="multipart/form-data">
                                 <div class="panel panel-pup">
                                     <div class="panel-heading">
                                         Customer Details
                                     </div>
                                     <div class="panel-body">
                                         <input class="proid" type="hidden" name="proid" id="proid" value="">
                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="FNAME">First Name:</label>
                                                 <!-- <input  id="CUSTOMERID" name="CUSTOMERID"  type="HIDDEN" value="<?php echo $res->AUTO; ?>">  -->
                                                 <div class="col-md-8">
                                                     <input class="form-control input-sm" id="FNAME" name="FNAME"
                                                         placeholder="First Name" type="text" value="" required>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="LNAME">Last Name:</label>

                                                 <div class="col-md-8">
                                                     <input class="form-control input-sm" id="LNAME" name="LNAME"
                                                         placeholder="Last Name" type="text" value="" required>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="GENDER">Gender:</label>

                                                 <div class="col-md-8">
                                                     <input id="GENDER" name="GENDER" placeholder="Gender" type="radio"
                                                         checked="true" value="Male" required><b> Male </b>
                                                     <input id="GENDER" name="GENDER" placeholder="Gender" type="radio"
                                                         value="Female" required> <b> Female </b>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="CITYADD">Delivery
                                                     Address:</label>

                                                 <div class="col-md-8">
                                                     <input class="form-control input-sm" id="CITYADD" name="CITYADD"
                                                         placeholder="Street/Brgy./Municipality/Province" type="text"
                                                         value="" required>
                                                 </div>
                                             </div>
                                         </div>

                                         <!--   <div class="panel panel-primary">
                                    <div class="panel-heading">
                                       Address
                                    </div>
                                        <div class="panel-body">
                                          <div class="form-group">
                                            <div class="col-md-10">
                                              <label class="col-md-4 control-label" for=
                                              "CUSHOMENUM">Home Numnber:</label>

                                              <div class="col-md-8">
                                                 <input class="form-control input-sm" id="CUSHOMENUM" name="CUSHOMENUM" placeholder=
                                                    "Home Number" type="text" value="">
                                              </div>
                                            </div>
                                          </div>

                                           <div class="form-group">
                                            <div class="col-md-10">
                                              <label class="col-md-4 control-label" for=
                                              "STREETADD">STREET / Village:</label>

                                              <div class="col-md-8">
                                                 <input class="form-control input-sm" id="STREETADD" name="STREETADD" placeholder=
                                                    "STREET / Village" type="text" value="">
                                              </div>
                                            </div>
                                          </div>

                                           <div class="form-group">
                                            <div class="col-md-10">


                                              <label class="col-md-4 control-label" for=
                                              "BRGYADD">Barangay:</label>

                                              <div class="col-md-8">
                                                 <input class="form-control input-sm" id="BRGYADD" name="BRGYADD" placeholder=
                                                    "Barangay" type="text" value="">
                                              </div>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <div class="col-md-10">
                                              <label class="col-md-4 control-label" for=
                                              "CITYADD">Municipality/City:</label>

                                              <div class="col-md-8">
                                                 <input class="form-control input-sm" id="CITYADD" name="CITYADD" placeholder=
                                                    "Municipality/City Address" type="text" value="">
                                              </div>
                                            </div>
                                          </div>

                                            <div class="form-group">
                                            <div class="col-md-10">
                                              <label class="col-md-4 control-label" for=
                                              "PROVINCE">Province:</label>

                                              <div class="col-md-8">
                                                 <input class="form-control input-sm" id="PROVINCE" name="PROVINCE" placeholder=
                                                    "Province" type="text" value="">
                                              </div>
                                            </div>
                                          </div>

                                            <div class="form-group">
                                            <div class="col-md-10">
                                              <label class="col-md-4 control-label" for=
                                              "COUNTRY">Country:</label>

                                              <div class="col-md-8">
                                                 <input class="form-control input-sm" id="COUNTRY" name="COUNTRY" placeholder=
                                                    "Country" type="text" value="">
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                      </div> -->

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="CUSUNAME">Email:</label>

                                                 <div class="col-md-8">
                                                     <input class="form-control input-sm" id="CUSUNAME" name="CUSUNAME"
                                                         placeholder="Email" type="email" value="" required>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="CUSPASS">Password:</label>

                                                 <div class="col-md-8">
                                                     <input class="form-control input-sm" id="CUSPASS" name="CUSPASS"
                                                         placeholder="Password" type="password" value=""
                                                         required><span></span>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="PASS"></label>

                                                 <div class="col-md-8">
                                                     <p>Note:</p>
                                                     Password must be atleast 8 to 15 characters. Only letter, numeric
                                                     digits, underscore and first character must be a letter.
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="PHONE">Contact
                                                     Number:</label>

                                                 <div class="col-md-8">
                                                     <input class="form-control input-sm" id="PHONE" name="PHONE"
                                                         placeholder="09000000000" type="tel" value="" pattern="\d{11}"
                                                         required>

                                                 </div>
                                             </div>
                                         </div>

                                         <!-- <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4 control-label" for="EMAILADD">Email
                                                     Address:</label>

                                                 <div class="col-md-8">
                                                     <input class="form-control input-sm" id="EMAILADD" name="EMAILADD"
                                                         placeholder="example@gmail.com" type="email" value="" required>
                                                 </div>
                                             </div>
                                         </div> -->

                                         <!--        <div class="form-group">
                                        <div class="col-md-10">
                                          <label class="col-md-4 control-label" for=
                                          "ZIPCODE">Zip Code:</label>

                                          <div class="col-md-8">
                                             <input class="form-control input-sm" id="ZIPCODE" name="ZIPCODE" placeholder=
                                                "Zip Code" type="number" value="">
                                          </div>
                                        </div>
                                      </div> -->

                                         <!--        <div class="form-group">
                                        <div class="col-md-10">
                                          <label class="col-md-4" align = "right"for=
                                          "image">Upload Image:</label>

                                          <div class="col-md-8">
                                          <input type="file" name="image" value="" id="image"/>
                                          </div>
                                        </div>
                                      </div> -->

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4" align="right" for="image"></label>
                                                 <div class="col-md-8">
                                                     <p><input type="checkbox" id="conditionterms" name="conditionterms"
                                                             value="checkbox" required>
                                                         By <small>clicking this box, you are agreeing the <a
                                                                 class="toggle-modal"
                                                                 onclick=" OpenPopupCenter('customer/terms.php','Terms And Conditions','600','600')"><b>terms
                                                                     and conditions</b></a></small>

                                                 </div>
                                             </div>
                                         </div>

                                         <div class="form-group">
                                             <div class="col-md-10">
                                                 <label class="col-md-4" align="right" for="image"></label>
                                                 <div class="col-md-8">
                                                     <input type="submit" name="submit" value="SignUp"
                                                         class="submit  btn-primary" style="border:none;" />
                                                     <button class="btn-danger" data-dismiss="modal" type="button"
                                                         style="border:none;">Close</button>
                                                 </div>
                                             </div>
                                         </div>



                                     </div>
                                     <!--<div class="panel-footer">
                                        <p align="left">&copy; BSIT Students</p>
                                    </div>-->
                                 </div>
                                 <!-- end panel sign up -->
                             </form>
                         </div>
                     </div>


                 </div> <!-- /.modal-body -->
             </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
     </div>
 </div>
 <!-- end sign up modal -->





 <script language="javascript" type="text/javascript">
function OpenPopupCenter(pageURL, title, w, h) {
    var left = (screen.width - w) / 2;
    var top = (screen.height - h) / 4; // for 25% - devide by 4  |  for 33% - devide by 3
    var targetWin = window.open(pageURL, title,
        'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
        w + ', height=' + h + ', top=' + top + ', left=' + left);
}
 </script>
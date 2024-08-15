<!-- sign up modal -->
<div class="modal fade" id="login" tabindex="-1">

    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button class="close" data-dismiss="modal" type=
      "button">×</button> -->
                <div class="modal-body">
                    <!-- login -->
                    <?php 
if(!isset($_SESSION['CUSID'])){

?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="well well-sm"><b> Login </b> </div>

                            <form class="form-horizontal span6" action="login.php" method="POST">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label" for="U_USERNAME">Username:</label>
                                        <input id="U_USERNAME" name="U_USERNAME" placeholder="Username" type="text"
                                            class="form-control input" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="control-label" for="U_PASS">Password:</label>
                                        <input name="U_PASS" id="U_PASS" placeholder="Password" type="password"
                                            class="form-control input " required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" id="sidebarLogin" name="sidebarLogin"
                                            class="btn btn-pup btn-sm"> Login</button>
                                        <button class="btn btn-default  btn-sm" data-dismiss="modal"
                                            type="button">Close</button>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                  <div class="col-md-12">  <a href="forgot-password.php">Forgot password?</a> </div>
                </div>  -->
                            </form>

                        </div>
                    </div>
                    <?php } ?>



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
<?php

	 if (!isset($_SESSION['USERID'])){

      redirect(web_root."admin/index.php");

     }



?>

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="main__title">

                    <div class="row">

                        <div class="col-lg-12">

                            <h1 class="fs-5">List of Users <a href="index.php?view=add"
                                    class="btn btn-primary btn-sm  "> <i class="fa fa-plus-circle fw-fa"></i> New</a>
                            </h1>

                        </div>

                        <!-- /.col-lg-12 -->

                    </div>

                    <form action="controller.php?action=delete" Method="POST">

                        <div class="table-responsive">

                            <table id="dash-table"
                                class="table table-striped table-bordered table-hover table-responsive"
                                style="font-size:12px" cellspacing="0">



                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>

                                            <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->

                                            Account Name
                                        </th>

                                        <th>Email Account</th>

                                        <th>Contact No.</th>

                                        <th>Address</th>

                                        <th>Role</th>

                                        <th>Action</th>



                                    </tr>

                                </thead>

                                <tbody>

                                    <?php 

				  		// $mydb->setQuery("SELECT * 

								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");

				  		$mydb->setQuery("SELECT * 

											FROM  `tbluseraccount`");

				  		$cur = $mydb->loadResultList();



						foreach ($cur as $result) {

				  		echo '<tr>';

						  echo '<td width="3%" align="center" >' . $result->USERID.'</a></td>';

				  		// echo '<td width="5%" align="center"></td>';

				  		echo '<td>' . $result->U_NAME.'</a></td>';

						  echo '<td>'. $result->U_USERNAME.'</td>';

						  echo '<td>'. $result->U_CON.'</td>';

						  echo '<td>'. $result->U_EMAIL.'</td>';

				  		echo '<td>'. $result->U_ROLE.'</td>';

				  		if($result->USERID==$_SESSION['USERID'] || $result->U_ROLE=='Administrator' || $result->U_ROLE=='Staff') {

				  			$active = "Disabled";



				  		}else{

				  			$active = "";



				  		}



				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->USERID.'"  class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i></span></a>

				  					 <a title="Delete" href="controller.php?action=delete&id='.$result->USERID.'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

				  					 </td>';

				  		echo '</tr>';

				  	} 

				  	?>

                                </tbody>



                            </table>



                            <!-- <div class="btn-group">

				  <a href="index.php?view=add" class="btn btn-default">New</a>

				  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>

				</div>

 -->

                        </div>

                    </form>





                </div>
                <!---End of container-->
            </div>
        </div>
    </div>
</div>
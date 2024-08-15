<?php 

	  if (!isset($_SESSION['USERID'])){

      redirect(web_root."admin/index.php");

     } 

?>
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                    <div class="row">

                        <div class="col-lg-12">

                            <h1 class="fs-5">List of Categories <a href="index.php?view=add"
                                    class="btn btn-primary btn-sm  "> <i class="fa fa-plus-circle fw-fa"></i> New</a>
                            </h1>

                        </div>

                        <!-- /.col-lg-12 -->

                    </div>

                    <form action="controller.php?action=delete" Method="POST">

                        <div class="table-responsive">

                            <table id="dash-table" class="table table-striped table-bordered table-hover"
                                style="font-size:12px;" cellspacing="0">



                                <thead>

                                    <tr>

                                        <!-- <th>No.</th> -->

                                        <th>

                                            <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->

                                            Category
                                        </th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php 

				  		$mydb->setQuery("SELECT * FROM `tblcategory`");

				  		$cur = $mydb->loadResultList();



						foreach ($cur as $result) {

				  		echo '<tr>';

				  		// echo '<td width="5%" align="center"></td>';

				  		// echo '<td>

				  		//      <input type="checkbox" name="selector[]" id="selector[]" value="'.$result->CATEGID. '"/>

				  		// 		' . $result->CATEGORIES.'</a></td>';

				  			echo '<td>' . $result->CATEGORIES.'</td>';

				  		echo '<td align="center"><a title="Edit" href="index.php?view=edit&id='.$result->CATEGID.'" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i></a>

				  		     <a title="Delete" href="controller.php?action=delete&id='.$result->CATEGID.'" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i></a></td>';

				  		// echo '<td></td>';

				  		echo '</tr>';

				  	} 

				  	?>

                                </tbody>



                            </table>

                            <div class="btn-group">

                                <!--  <a href="index.php?view=add" class="btn btn-default">New</a> -->

                                <?php

					if($_SESSION['U_ROLE']=='Administrator'){

					// echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button'

					; }?>

                            </div>
                        </div>

                </div>

            </div>

        </div>

    </div>






    </form>
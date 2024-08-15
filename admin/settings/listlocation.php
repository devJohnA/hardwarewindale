<?php
		check_message(); 
		?>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="main__title">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="fs-5">List of Location <a href="index.php?view=add"
                                    class="btn btn-primary btn-sm  ">
                                    <i class="fa fa-plus-circle fw-fa"></i> New</a>
                            </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                    <form action="controller.php?action=delete" Method="POST">
                        <div class="table-responsive">
                            <table id="dash-table" class="table table-striped table-bordered table-hover "
                                style="font-size:11px" cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>Place</th>
                                        <th>Delivery Fee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
				  		$query = "SELECT * FROM `tblsetting` ";
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) { 
				  		echo '<tr>'; 
				    		
				  		echo '<td>'.$result->BRGY.' '.$result->PLACE.'  </a></td>';  ; 
				  		echo '<td> &#8369;'.  number_format($result->DELPRICE,2).'</td>'; 
				  		echo
				  		 '<td align="left">
							<a href="'.web_root.'admin/settings/index.php?view=edit&id='.$result->SETTINGID.'" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i></a>
                            <a href="'.web_root.'admin/settings/controller.php?action=delete&id='.$result->SETTINGID.'" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i></a>
						 </td>';
				  	} 
				  	?>
                                </tbody>


                            </table>

                            <!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><i class="fa fa-trash fw-fa"></i> Delete Selected</button>
				</div> -->
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
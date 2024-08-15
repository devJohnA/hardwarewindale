<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<?php
		check_message(); 
		?>
<style>
.red-icon {
    color: red;
}
</style>
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body" style="margin: 0 15px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3> <a href="index.php?view=add" class="btn btn-primary btn-sm  "> <i
                                    class="fa fa-plus-circle fw-fa"></i> New</a> </h3>
                    </div>
                </div>
                <form action="controller.php?action=delete" Method="POST">
                    <div class="table-responsive">
                        <table id="myTable" class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">#</th>
                                    <th class="cell">Image</th>
                                    <th class="cell">Category</th>
                                    <th class="cell">ProductName</th>
                                    <th class="cell">Price</th>
                                    <!-- <th class="cell">Discount</th>
                                    <th class="cell">Discounted Price</th> -->
                                    <th class="cell">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
				  		$query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
           					 WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID` ";
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) { 
				  		echo '<tr>';
				  		echo '<td width="1%" align="center"><input type="checkbox" name="selector[]" id="selector[]" value="'.$result->PROID. '"/></td>';
				    echo '<td style="padding:0px;">
							<a class="PROID" href="" data-target="#productmodal"  data-toggle="modal"  data-id="'.$result->PROID.'"> 
							<img  title="'.$result->CATEGORIES.'" style="width:100px;height:50px;padding:0;"  src="'. web_root.'admin/products/'.$result->IMAGES . '">
							</a></td>'; 	
				  		echo '<td><a title="edit" href="'.web_root.'admin/products/index.php?view=edit&id='.$result->PROID.'"><i class="fa fa-pencil "></i>'.$result->CATEGORIES.'</a></td>';
				  		
				  		echo '<td>'. $result->PRODESC.'</td>'; 
				  		echo '<td> &#8369 '.  number_format($result->PROPRICE,2).'</td>';
				  		// echo '<td> &#8369 '.  number_format($result->PRODISCOUNT,0).'</td>';
				  		// echo '<td> &#8369 '.  number_format($result->ORIGINALPRICE,2).'</td>';

				  		echo '<td width="4%">'. $result->PROQTY.'</td>';
                  echo '</tr>';
				  	} 
				  	?>
                            </tbody>
                        </table>
                        <div class="btn-group">

<!-- <a href="index.php?view=add" class="btn btn-default">New</a> -->

<button type="submit" class="btn btn-danger end" name="delete"><i class="fa fa-trash fw-fa"></i> Delete</button>

</div>

                    </div>
                </form>
                <div class="modal fade" id="productmodal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" type="button">X</button>

                                <h4 class="modal-title" id="myModalLabel">Image.</h4>
                            </div>

                            <form action="<?php echo web_root; ?>admin/products/controller.php?action=photos"
                                enctype="multipart/form-data" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="rows">
                                            <div class="col-md-12">
                                                <div class="rows">
                                                    <div class="col-md-8">

                                                        <input class="proid" type="hidden" name="proid" id="proid"
                                                            value="">
                                                        <input name="MAX_FILE_SIZE" type="hidden" value="1000000">
                                                        <input id="photo" name="photo" type="file">
                                                    </div>

                                                    <div class="col-md-4"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                    <button class="btn btn-primary" name="savephoto" type="submit">Upload
                                        Photo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <nav class="app-pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav> -->
    </div>
    <script>$(document).ready( function () {
    $('#myTable').DataTable();
} );</script>
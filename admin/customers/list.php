<?php
	 if (!isset($_SESSION['USERID'])){
      redirect(web_root."admin/index.php");
     }

?>

<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Customers  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		 <th>#</th> 
				  		<th>
				  		 <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
				  		 UserName</th>
				  		<th>FirstName</th>
						<th>LastName</th>
						<th>ContactNo.</th>
						<th>EmailAddress</th>
				  		<th>Gender</th>
						<th>Address</th>
                        <th>DateJoined</th>
				  		<th width="8%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * 
											FROM  `tblcustomer` ORDER BY `DATEJOIN` desc");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  	    echo '<td width="2%" align="center">'. $result->CUSTOMERID.'</td>';
				  		echo '<td>' . $result->CUSUNAME.'</a></td>';
				  		echo '<td>'. $result->FNAME.'</td>';
						echo '<td>'. $result->LNAME.'</td>';
						echo '<td>'. $result->PHONE.'</td>';
						echo '<td>'. $result->EMAILADD.'</td>';
				  		echo '<td>'. $result->GENDER.'</td>';
						echo '<td>'. $result->CITYADD.'</td>';
                        echo '<td>'. date_format(date_create($result->DATEJOIN),'M/d/Y h:i:s ').'</td>';
				  		if($result->CUSTOMERID==$_SESSION['USERID'] || $result->GENDER=='Male' || $result->GENDER=='Female') {
				  			$active = "Disabled";

				  		}else{
				  			$active = "";

				  		}

				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->CUSTOMERID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$result->CUSTOMERID.'" class="btn btn-danger btn-xs"><span class="fa fa-trash-o fw-fa"></span> </a>
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
	

</div> <!---End of container-->
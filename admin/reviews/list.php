<?php
	 if (!isset($_SESSION['USERID'])){
      redirect(web_root."admin/index.php");
     }

?>

<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Reviews and Ratings</h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>ProductID</th> 
						<th>Name</th> 
				  		<th>Rate</th>
				  		
						<th>Review</th>
						<th>Date Review</th>
				  		
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * 
											FROM  `productreviews` ORDER BY `reviewDate` desc ");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  	    echo '<td width="8%" align="center">'. $result->PROID.'</td>';
						  echo '<td>' . $result->name.'</td>';
				  		echo '<td align="center">' . $result->quality.'</td>';
				  	
						echo '<td>'. $result->review.'</td>';
						echo '<td>'. date_format(date_create($result->reviewDate),"M/d/Y h:i:s ").'</td>';
				  		
				  		
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
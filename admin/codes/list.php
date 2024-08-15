<?php
	 if (!isset($_SESSION['USERID'])){
      redirect(web_root."admin/index.php");
     }

?>

<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Requested Codes</h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>#</th> 
						<th>Request Time</th> 
				  		<th>
				  		 <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
				  		 Request To</th>
				  		<th>Request From</th>
						<th>Codes Requested</th>
				  		
				  		
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * 
											FROM  `messagein` ORDER BY `Id` desc ");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  	    echo '<td width="3%" align="center">'. $result->Id.'</td>';
						  echo '<td>' . date_format(date_create($result->ReceiveTime),"M/d/Y h:i:s ").'</td>';
				  		echo '<td>' . $result->MessageFrom.'</td>';
				  		echo '<td>'. $result->MessageTo.'</td>';
						echo '<td>'. $result->MessageText.'</td>';
				  		
				  		
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
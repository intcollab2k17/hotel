<?php include 'header_default.php';?>

<body class="page-md page-header-fixed page-sidebar-closed-hide-logo ">
<?php include 'header_top.php';?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<?php include 'sidebar.php';?>		
	</div>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Reservation <small></small></h1>
				</div>
			</div>			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Pending Reservation
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>								
							</div>
						</div>
						<div class="portlet-body">							
							<table class="table table-striped table-bordered table-hover" id="sample_2">
							<thead>							  
							<tr>								
								<th>Firstname</th>
								<th>Lastname</th>						
								<th>Email</th>						
								<th>Room Number</th>
								<th>Room Number</th>
								<th>Status</th>
							</tr>
							</thead>
							<tbody>
								<?php
						
							$querym=mysqli_query($con,"select * from reservation LEFT JOIN room ON room.room_id = reservation.room_id WHERE reservation_status = 'Pending'")or die(mysqli_error($con));
								while ($row=mysqli_fetch_array($querym)){
								$reservation_id = $row['reservation_id'];							
							?>  	
								<tr class="odd gradeX">
								
								
								<td><?= $row['firstname'];?></td>
								<td><?= $row['lastname'];?></td>									
								<td><?= $row['email'];?></td>		
								<td>Room# <?= $row['room_number'];?></td>							
								<td>Room# <?= $row['room_number'];?></td>							
								<td>
									<form method = "POST" action = "send_email.php">
										<input type = "hidden" name = "firstname" value = "<?=$row['firstname'];?>">
										<a href="#update<?=$row['reservation_id']?>" role="button" class="btn btn-primary" data-target = "#update<?=$row['reservation_id'];?>" data-toggle="modal">
											<i class = "fa fa-pencil"></i>
										</a>
									</form>

									
								</td>
							</tr>

							<div id="update<?=$row['reservation_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">										
											<h4 class="modal-title">Edit Status</h4>
										</div>
										<form method="POST" action = "update_status.php">
										<div class="modal-body">
											<input type = "hidden" name = "reservation_id" value = "<?=$row['reservation_id'];?>">
											<input type = "hidden" name = "firstname" value = "<?=$row['firstname'];?>">
											<input type = "hidden" name = "lastname" value = "<?=$row['lastname'];?>">
											<input type = "hidden" name = "email" value = "<?=$row['email'];?>">
											<input type = "hidden" name = "r_code" value = "<?=$row['r_code'];?>">

											<select class = "form-control" name = "reservation_status">	
												<option selected="true" disabled="disabled">Choose Status</option>    
												<option>Accepted</option>
												<option>Cancel</option>
											</select>

										</div>
										<div class="modal-footer">
											<button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
											<button  name = "update" class="btn yellow">Save</button>
										</div>
										</form>
									</div>
								</div>
							</div>


							<?php } ?>						
							</tbody>
							</table>
						</div>
					</div>
				</div>
				<div
			</div>
				<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<?php include 'script.php';?>
</body>
<!-- END BODY -->
</html>

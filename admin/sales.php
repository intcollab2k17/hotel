<?php include 'header_default.php';?>
<?php  
 $connect = mysqli_connect("localhost", "root", "", "hotel");  
 $query = "SELECT * FROM sales LEFT JOIN reservation ON reservation.reservation_id = sales.reservation_id ORDER BY sales_id desc";  
 $result = mysqli_query($connect, $query);  
 ?>
 <?php
                include('dbcon.php');
                    $query=mysqli_query($con,"select * from reservation LEFT JOIN room ON room.room_id = reservation.room_id WHERE reservation_status = 'Cancel' OR reservation_status = 'Accept' OR reservation_status = 'Finished'")or die(mysqli_error());
                      $row1=mysqli_fetch_array($query);
                       
                        $date_check = new DAteTime($row1['check_in']);                                
                        $date_out = new DAteTime($row1['check_out']);  
                        $diff = $date_out->diff($date_check)->format("%a");                                
              ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
<style type="text/css">
  .col-lg-12.col-md-12.col-sm-12.col-xs-12 {
    position: relative;
    top: 20px;
}
@media print{
  .hasDatepicker{
    border:none;
    width:100%;
  }
.new{
  display: inline-block;
}
  #filter{
    display:none;
  }
  .printer{
    display: none;
  }
}


  
</style>
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
          <h1>Sales Report  <small></small></h1>
        </div>
      </div>      
      <div class="row">
              <div class = "page-content-wrapper">
                  <div class = "form-group">
                     <div class="col-md-3 new">
                               <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                     </div>
                   <div class="col-md-3 new">  
                               <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                      </div>
                      <div class="col-md-3">  
                               <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                      </div> 
                 </div> 
                </div> 
      </div> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
          <div class="portlet box grey-cascade">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-globe"></i>Sales Report
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
            <div id = "order_table">          
              <table class="table table-striped table-bordered table-hover" id="sample_2">
              <thead>               
              <tr>                
                <th>Payment</th>
                <th>Customer Name</th>
                <th>No of days stayed</th>
                <th>Date Payed</th>

              </tr>
              </thead>
              <tbody>
                  <?php  
                     while($row = mysqli_fetch_array($result))                      
                     {  
                     ?>                
                <tr class="odd gradeX">
                <td><?= $row['sales_amount'];?></td> 
                <td><?= $row['firstname']." ".$row['lastname'];?></td>
                <td><?= $diff;?> day/s</td>
                <td><?= $row['payment_date'];?></td>
              </tr>
              <?php } ?>
              </tbody>
              </table>
              </div>
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
<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
<?php include 'script.php';?>
</body>
<!-- END BODY -->
</html>

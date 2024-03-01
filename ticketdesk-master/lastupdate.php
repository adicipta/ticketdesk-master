<?php
include_once('include/connect.php');
$mydb = dbConnect();
?>
<style type="text/css">
  table tr td {
    padding: 5px;
  }
</style>
<div class="modal-dialog" role="document" style="width: 756px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">History of Referred Ticket to the Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-group" method="POST" action="">
      <div class="modal-body"> 

        <table class="table table-bordered table-hover" >
          <thead>
            <th>From</th>
            <th>To</th>
            <th>Notes</th>
            <th>Date</th>
            <th>Prepared User</th> 
          </thead> 

       <?php 
        $ticketid = $_POST['ticketid'];

        $sql = "SELECT *,(select name from groups where id=groupFrom)  as group_From,(select name from groups where id=groupTo) as group_To FROM `tblreferhistory`  WHERE  `ticketid`='$ticketid'";

        $result = $mydb->query($sql);
 
      if ($result->num_rows > 0) { 
        while($row = $result->fetch_array()) {
          
        ?> 
        <tr>
          <td ><?php echo $row['group_From']; ?></td>
           <td ><?php echo $row['group_To']; ?></td>
           <td ><?php echo $row['notes']; ?></td>
           <td ><?php echo $row['daterefer']; ?></td>
           <td ><?php echo $row['username']; ?></td>
        </tr>  

  <?php      }
      }  
      else{
  ?>
  <tr>
          <td colspan="4">None</td>
        </tr>  
  <?php      
      } 
       ?> 
</table>
      	 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
 	 </form>
    </div>
  </div>
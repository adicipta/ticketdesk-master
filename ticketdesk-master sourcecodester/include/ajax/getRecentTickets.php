<?php
include_once('../connect.php');

$mysqli = dbConnect();

$selectvalue =  $_GET['svalue'];

echo '<table class="table"><th>Client#</th><th>Subject</th><th>Category</th><th>Sub Category</th><th>Assigned</th><th>Status</th>';
$sql = "select
	t.id as ticketid,
	t.clientid, 
	t.comments, 
	t.subject,
	(select c.name from categories c where c.id = t.categoryid) as category,
	(select sc.name from subcategories sc where sc.id = t.subcategoryid) as subcategory,
	t.assigneduser,
	(select ts.status 
	 	from ticketstatus ts
	 		where ts.ticketid = t.id
			and ts.statusdate = (select max(ts2.statusdate)
		                            	from ticketstatus ts2
	                            		where ts.ticketid = ts2.ticketid)) as status
		from tickets t";

if ($selectvalue != '') $sql .= " where clientid =" . $selectvalue;
$sql .= " order by opendate desc limit 10";

$result = $mysqli->query($sql);
$mysqli->close();

if ($result->num_rows > 0) {
	// output data of each row
	//echo '<table class="table"><th>Category</th><th>Subcategory</th><th></th>';
	while($row = $result->fetch_assoc()) {
	    #$comments = $row['comments'];
	    #$comments = (strlen($comments) > 340) ? substr($comments, 0, 340) . '...' : $comments;
	    if ($row['status'] == 'Closed') { $class = "btn btn-danger";}
	    elseif ($row['status'] == 'Open') { $class = "btn btn-success";}
	    elseif ($row['status'] == 'Waiting on Client') {$class = "btn btn-info";} 
	    else { $class = "btn btn-warning"; }
       		echo '<tr>
	           			<td>' .$row['clientid'] .'</td>
	           			<td>' . $row['subject']  .'</td>
	           			<td>' . $row['category']  .'</td>
	           			<td>' . $row['subcategory']  .'</td>
	           			<td>' . $row['assigneduser'] . '</td>
	           			<td><form method="POST" action="./tickets.php">
	           				<input name="ticketId" value="' . $row['ticketid'] . '" type="text" hidden />
	           				<button type="submit" class="'.$class .'">'.$row['status'] .'</button></form>
	           			</td>
	           		</tr>';
	}
	//echo '</table>';
} else {
    echo "Enter ClientId to view recent tickets";
}	
echo '</table>'; 


?>

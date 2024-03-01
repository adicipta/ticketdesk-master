<?php
include_once 'include/functions.php';
include_once 'include/connect.php';
sec_session_start();

if(login_check(dbConnect()) == true) {
	include_once('include/navbar.php');

        // Add your protected page content here!
?>
<script>
// set active menu bar
$('#dashboard').addClass("active");

$(document).ready(function($) {

  $('#categoryId').change(function(e) {
    //Grab the chosen value on first select list change
    var selectvalue = $(this).val();

    if (selectvalue == "") {
		//Display initial prompt in target select if blank value selected
	        $('#subCategorySelect').html("");
    } else {
      //Make AJAX request, using the selected value as the GET
      $.ajax({url: './include/ajax/getSubCategoryOption.php?svalue='+selectvalue,
             success: function(output) {
                //alert(output);
                $('#subCategorySelect').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});
        }
    });

  $('#clientId').change(function(e) {
    //Grab the chosen value on first select list change
    var selectvalue = $(this).val();

    $.ajax({url: './include/ajax/getRecentTickets.php?svalue='+selectvalue,
            success: function(output) {
            //alert(output);
                $('#recentTickets').html(output);
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status + " "+ thrownError);
            }});
  });

});
</script>


<body>
<div id="content">

<?php
if (isset($_POST['addTicket'])) {
	$ticket = ticket::withParams($_POST);
	if (!$ticket->addTicket(false)) {
		echo '<br> failed to add ticket: ' . $ticket->getMysqli()->error . '<br>';
	} else {
		echo '<META http-equiv="refresh" content="0;URL=./tickets.php?ticketId=' .$ticket->getId()  . '">';
	}
}

if (isset($_POST['addQuickTicket'])) {
	$ticket = ticket::withParams($_POST);
	if (!$ticket->addTicket(true)) {
		echo '<br> failed to add ticket: ' . $ticket->getMysqli()->error . '<br>';
	} else {
		//echo '<p class="alert alert-info"> Ticket Added! </p>';
	}
}

?>

    <div id="newTicket" class="panel panel-default">
        <div class="panel-heading">New Ticket</div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="user" value="<?php echo '' . $_SESSION['username']; ?>" hidden />
                    <label for="clientId" class="col-sm-2 control-label">Client #</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clientId" name="clientId" placeholder="e.g. 912752">
                    </div>
                </div>

                <div class="form-group">
                    <label for="group" class="col-sm-2 control-label">Assigned group:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="groupId">  
                        <?php department::displayDepartmentsOptionList(); ?> 
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="categoryId" name="categoryId">
                        	<?php category::displayCategoryOptionList(); ?>

                        </select>
                    </div>
                </div>
                <div id="subCategorySelect"></div>
                <div class="form-group">
                    <label for="comments" class="col-sm-2 control-label">Details</label>
                    <div class="col-sm-10">
                        <textarea class="form-control verticalonly" name="comments" placeholder="Detailed info for this ticket..."></textarea>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" name="addTicket" class="btn btn-primary">Create</button>
                    <button type="submit" name="addQuickTicket" class="btn btn-success">Create & Close</button>
                </div>
                <div class="btn-group">
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <div id="recentTickets" class="panel panel-default">
        <div class="panel-heading">Recent Tickets</div>
            <?php ticket::displayRecentTickets(); ?>

    </div>
<div id="totals" class="well welroundl-sm-2" >
Total Tickets: <?php echo ''. ticket::getTicketCount(); ?> <br>  Average Daily: <?php echo ''. ticket::getDailyAverage(); ?>
</div>



</div> <!-- /content-->
</body>

<?php
// end protected content
} else {
        echo 'You are not authorized to access this page redirecting you to the <a href="./index.php">login page</a>.';
        echo '<META http-equiv="refresh" content="2;URL=./index.php">';
}

?>

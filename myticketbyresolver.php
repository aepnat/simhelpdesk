<?php 
require 'core/init.php';
$general->logged_out_protect();
$user = $users->userdata($_SESSION['loginid']);
$tickets = $tickets->get_tickets_by_resolver($user['username']);
$tickets_count = count($tickets);
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>My Tickets</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<style type="text/css">
		body{background-image:url('images/corner.jpg');background-repeat:no-repeat;background-attachment:fixed;}
		.breadcrumb{font-size:12px;color:#0000A0;font-family: Arial, Helvetica, sans-serif;}
	</style>
  	<link rel="stylesheet" type="text/css" href="css/datatable.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.dataTables.js" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('#datatables').dataTable({
			"sScrollY": "400px",
			"sScrollX": "100%",
			"bScrollCollapse": true,
			"bPaginate": false,
			"bJQueryUI": true
		});			
	})
	</script>

</head>
<body>
	<div class="breadcrumb"> >> Home >> My Tickets >> My Resolution</div>
	<hr/>
	<h1>List of tickets that resolved by me</h1>
	<p>Number of tickets: <strong><?php echo $tickets_count; ?></strong> </p>
	<table id="datatables" class="display">
    <thead>
        <tr>
            <th>Ticket No.</th>
			<th>Urgency</th>
            <th>Reported Date</th>
			<th>Reported By</th>
            <th>Problem Summary</th>
			<th>Status</th>
			<th>Assignee</th>		
        </tr>
    </thead>
    <tbody>
		<?php 
        foreach ($tickets as $ticket) {
            $sla = $slas->sla_data($ticket['sla']);
            $user = $users->userdata($ticket['assignee']);
            echo '<tr><td><a href=ticketedit.php?id='.$ticket['id'].'>'.$ticket['ticketnumber'].'</a></td>'.
                 '<td>'.$sla['namasla'].'</td>'.
                 '<td>'.date('d-M-Y', $ticket['reporteddate']).'</td>'.
                 '<td>'.$ticket['reportedby'].'</td>'.
                 '<td>'.$ticket['problemsummary'].'</td>'.
                 '<td>'.$ticket['ticketstatus'].'</td>'.
                 '<td>'.$user['fullname'].'</td></tr>';
        }
        ?>
    </tbody>
	</table>
	<p>&nbsp;</p>
</body>
</html>
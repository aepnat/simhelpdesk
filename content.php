<?php 
require 'core/init.php';
$general->logged_out_protect();
$user = $users->userdata($_SESSION['loginid']);
$ticket1 = $tickets->get_tickets_by_requester($_SESSION['loginid']);
$tickets_requested = count($ticket1);
$ticket2 = $tickets->get_tickets_by_assignee($_SESSION['loginid']);
$tickets_assigned = count($ticket2);
$ticket3 = $tickets->get_tickets_by_resolver($user['username']);
$tickets_resolved = count($ticket3);
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Helpdesk Welcome</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<style type="text/css">
		body{margin:10px;background-image:url('images/corner.jpg');background-repeat:no-repeat;background-attachment:fixed;}
	</style>
</head>
<body>
	<div class="breadcrumb"> >> Home</div>
	<hr/>
	<table>
	<tr>
		<td><img src="images/helpdesk.jpg" alt="Helpdesk Welcome" width="auto" height="173px" align="top" title="Helpdesk Welcome"></td>
		<td><h1 class="content">Selamat datang di Sistem Helpdesk</h1>
		<ul>
		<?php
		if ($user['level'] == 'User') {
			echo "<li><p>Saat ini anda memiliki tiket: $tickets_requested tickets. </p></li>";
		} elseif ($user['level'] == 'Admin') {
			echo "<li><p>Jumlah tiket yang ditugaskan untuk Anda: $tickets_assigned tickets.</p></li> ";
			echo "<li><p>Anda telah menyelesaikan $tickets_resolved tickets.</p></li>";
		}
        ?>
		</ol><br/>
		</td>
	</tr>
	</table>
</body>
</html>
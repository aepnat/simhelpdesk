<?php 
require 'core/init.php';
$general->logged_out_protect();
$user = $users->userdata($_SESSION['loginid']);
?> 
<!DOCTYPE HTML>
<html>
<head>
	<title>Helpdesk System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel=stylesheet type="text/css" href="css/style.css">
</head>
<body bgcolor="#FFF">
<div id="leftmenu">
<div id="headleftmenu">My Tickets</div>
<ul>
	<?php if ($user['level'] == 'User'):?>
		<li><a href="myticketbyrequester.php" target="contentFrame">My Request</a></li>
	<?php endif; ?>
	<?php if ($user['level'] == 'Admin'):?>
		<li><a href="myticketbyassignee.php" target="contentFrame">My Assignment</a></li>
		<li><a href="myticketbyresolver.php" target="contentFrame">My Resolution</a></li>
		<li><a href="myticketwaitforclosed.php" target="contentFrame">Waiting for Close</a></li>
		<li><a href="ticketlistuser.php" target="contentFrame">View All Opened Tickets</a></li>
	<?php endif;?>
</ul>
</div>
</body>
</html>

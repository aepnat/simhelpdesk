<?php 
require 'core/init.php';
$general->logged_out_protect();
?> 
<!DOCTYPE HTML>
<html>
<head>
	<title>Helpdesk System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel=stylesheet type="text/css" href="css/style.css">
</head>
<body bgcolor="#bb2a26">
<div id="leftmenu">
<div id="headleftmenu">Data Master</div>
<ul>
  <li><a href="userlist.php" target="contentFrame">User List</a></li>
</ul>
</div>
<div id="leftmenu">
<div id="headleftmenu">Ticket Admin</div>
<ul>
  <li><a href="ticketlist.php" target="contentFrame">List all Tickets</a></li>
  <li><a href="slalist.php" target="contentFrame">SLA Setting</a></li>
</ul>
</div>
<div id="leftmenu">
<div id="headleftmenu">Laporan</div>
<ul>
  <li><a href="report_all_tickets.php" target="contentFrame">Laporan Semua Tickets</a></li>
  </ul>
</div>
<div id="leftmenu">
<div id="headleftmenu">System</div>
<ul>
  <li><a href="userlog.php" target="contentFrame">User Log</a></li>
  </ul>
</div>
</body>
</html>

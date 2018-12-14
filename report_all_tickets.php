<?php 
require 'core/init.php';
$general->logged_out_protect();
$user = $users->userdata($_SESSION['loginid']);
if ($user['level'] != 'Admin') {
    exit("You don't have permission to access this page!");
}
$logs = $users->get_users_log();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report All Tickets</title>
	<style type="text/css">
		body{font-family: Arial, Helvetica, sans-serif;}
		.breadcrumb{font-size:12px;color:#0000A0;}
		.formtable {text-align:left; font-size:12px;color:#000000; background-color:#f0f0f0;padding:10px;width:600px; }
		.errormsg {font-size:10pt;color:#ff0000;text-align:left;}
	</style>
</head>
<body>
<div class="breadcrumb"> >> Admin >> Laporan >> Laporan Semua Tickets </div>
	<hr/>
	<h1>Laporan Semua Tickets</h1>
    <fieldset>
        <legend>Report All Tickets</legend>
        <form method="get" action="report_all_tickets_print.php" onsubmit="popup_report(this, 'join')" target="report_all_tickets_print.php">
            <table>
                <tr>
                    <td>Periode Awal</td>
                    <td><input type="date" name="periode_awal" id="periode_awal"></td>
                </tr>
                <tr>
                    <td>Periode Akhir</td>
                    <td><input type="date" name="periode_akhir" id="periode_akhir"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Print" /></td>
                </tr>
            </table>
        </form>
    </fieldset>
<script type="text/javascript">
function popup_report(myform, windowname)
{
if (! window.focus)return true;
window.open('', 'print_<?php echo $module?>.php', 'height=650,width=1024,resizable=1,scrollbars=1,addressbars=0,directories=no,location=no');
myform.target='print_<?php echo $module?>.php';
return true;
}
</script>
</body>
</html>
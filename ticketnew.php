<?php 
date_default_timezone_set('Asia/Jakarta');
require 'core/init.php';
$general->logged_out_protect();
$changeby = $_SESSION['loginid'];
$documentedby = $_SESSION['loginid'];
$user = $users->userdata($_SESSION['loginid']);
if (isset($_POST['submit'])) {
    $lastticket = $tickets->get_last_ticket();
    $id = $lastticket['id'] + 1;
    $ticketnumber = $id.'/SR/'.date('M').'/'.date('Y'); //format nomor tiket
    $sla = $_POST['sla'];
    $reporteddate = strtotime($_POST['reporteddate']);
    $reportedby = $_POST['reportedby'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];
    $problemsummary = $_POST['problemsummary'];
    $problemdetail = $_POST['problemdetail'];
    $ticketstatus = 'Assigned'; //ketika pertama kali dibuat, status="Assigned" ke salah satu teknisi
    $assignee = $_POST['idassignee'];
    $pro = $_POST['pro'];
    $changes = 'Create New Ticket';
    $datasla = $slas->sla_data($sla);
    $resolutiontime = $datasla['resolutiontime'];
    $tickets->add_ticket($ticketnumber, $sla, $reporteddate, $reportedby, $telp, $email, $problemsummary, $problemdetail, $ticketstatus, $assignee, $documentedby, $pro);
    $assigneddate = '';
    $pendingby = '';
    $pendingdate = '';
    $resolution = '';
    $resolvedby = '';
    $resolveddate = '';
    $closedby = '';
    $closeddate = '';
    $tickets->log_tickets($id, $sla, $reporteddate, $reportedby, $telp, $email, $problemsummary, $problemdetail, $ticketstatus, $assignee, $assigneddate, $pendingby, $pendingdate, $resolution, $resolvedby, $resolveddate, $closedby, $closeddate, $changes, $changeby);
    header("Location: ticketread.php?id=$id");
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>New Ticket</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<style type="text/css">
		.breadcrumb{font-size:12px;color:#0000A0;}
		.formtable {text-align:left; font-size:12px;color:#000000; background-color:#f0f0f0;padding:10px;width:600px; }
		.errormsg {font-size:10pt;color:#ff0000;text-align:left;}
		button.ui-button-icon-only{margin-left:0.5em;}
	</style>
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script type="text/javascript"> 
		$(document).ready(function(){
			$("#reporteddate").datepicker
			({dateFormat:"dd-M-yy",changeMonth:true,changeYear:true,showOn:'button',
			buttonImage:"images/calendar2.gif",buttonImageOnly:true})
		});
	</script>
	<script type="text/javascript">
	function cekData(ticketform){
		if (ticketform.reportedby.value == "")
		{	alert("Reported By must be filled!");
			ticketform.reportedby.focus();
			return false;
		}
		if (ticketform.idassignee.value == "")
		{	alert("Please choose assign to!");
			ticketform.idassignee.focus();
			return false;
		}
		if (ticketform.sla.value == "")
		{	alert("Please choose SLA Level!");
			ticketform.sla.focus();
			return false;
		}
		if (ticketform.problemsummary.value == "")
		{	alert("Problem summary must be filled!");
			ticketform.problemsummary.focus();
			return false;
		}
		if (ticketform.problemdetail.value == "")
		{	alert("Problem detail must be filled!");
			ticketform.problemdetail.focus();
			return false;
		}
		else
			return true;   
	}
	</script>
</head>
<body>	
	<div class="breadcrumb"> >> Home >> New Ticket</div>
	<hr/>
	<form name="ticketform" id="ticketform" method="post" action="" onsubmit="return cekData(this);">
	<fieldset style="display: inline-block;">
	<legend> New Ticket </legend>
	<div class="breadcrumb">*) Field Required</div>
	<table class="formtable">
		<tr>
			<td>Ticket No:</td><td> : </td>	
			<td>New Ticket Number
			<input type="hidden" size='20' name='ticketnumber' value="">
			</td>
		</tr>
		<tr>
			<td> Reported Date*</td><td> : </td>
			<td><input type="text" id="reporteddate" name="reporteddate" readonly="readonly" value="<?php echo date('d-M-Y', time()); ?>"> </td>
		</tr>
		<tr>
			<td> Reported By* </td><td> : </td>
			<td> <?php echo $user['fullname'];?> <input type='hidden' size='50' name='reportedby' value="<?php echo $user['fullname'];?>" maxlength="50"> </td>
		</tr>
		<tr>
			<td> Urgency (SLA)*</td><td> : </td>
			<td><select name="sla">
				<?php 
                    $sla = $slas->get_sla();
                    echo '<option value="'.$slaval['slaid'].'" selected="selected">'.$slaval['namasla'].'</option>';
                    foreach ($sla as $slaval) {
                        echo '<option value="'.$slaval['slaid'].'">'.$slaval['namasla'].'</option>';
                    }
                ?>
				</select>
			</td>
		</tr>
		<tr>
			<td> Type</td><td> : </td>
			<td><select name="pro">
				<?php 
                    //$pro = $slas->get_sla();
                    echo '<option value=""></option>';
                    echo '<option value="Hardware">Hardware</option>';
                    echo '<option value="Software">Software</option>';
                ?>
				</select>
			</td>
		</tr>
		<tr>
			<td> Problem Summary* </td><td> : </td>
			<td> <input type="text" size="50" name="problemsummary" maxlength="60"> </td>
		</tr>
		<tr>
			<td> Problem Detail* </td><td> : </td>
			<td> <textarea name="problemdetail" rows="3" cols="38"></textarea> </td>
		</tr>
		<tr>
			<td> </td>
			<td> </td>
			<td> <br/>
			<?php $assignee = $users->get_user_random_by_level('Admin');?>
			<input type="hidden" name="idassignee" value="<?php echo $assignee['id'];?>"/>
			<input type='submit' name='submit' value=' Submit '>  &nbsp;&nbsp;&nbsp;
			<input type='reset' name='reset' value=' Reset '> 
			</td>
		</tr>
	</table>
	</fieldset>
	</form>

	<?php 
    if (empty($errors) === false) {
        echo '<p class=errormsg>'.implode('</p><p class=errormsg>', $errors).'</p>';
    }
    ?>
</body>
</html>
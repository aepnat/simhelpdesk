<?php 
require 'core/init.php';
$general->logged_out_protect();
$user = $users->userdata($_SESSION['loginid']);
if ($user['level'] == 'Admin' || $user['level'] == 'Manager') {
    $akses = true;
} else {
    $akses = false;
}
if ($akses = false) {
    exit("You don't have permission to access this page!");
}
$ticket_list = $tickets->get_tickets_by_date($_GET['periode_awal'], $_GET['periode_akhir']);
$tickets_count = count($ticket_list);
$currenttime = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Laporan Semua Tikect</title>

    <style type="text/css">
        .icon {
            font-size: 30px;
            color: #006699;

        }

        @page {
            size: <?=$orientation?>;
        }

        body {
            font-family: tahoma;
            font-size: 11px;

        }

        .h1 {

            font-size: 17px;
            font-weight: bold;
            padding: 4px;
        }

        .h2 {

            font-size: 14px;
            font-weight: bold;
            padding: 0px;
        }

        .h3 {

            font-size: 12px;
            font-weight: bold;
            padding: 2px;
        }


        .h4 {

            font-size: 11px;
            font-weight: bold;
            padding: 4px;
        }

        td {
            vertical-align: top;
            padding: 3px;
        }

        @media print {
            .noprint {
                display: none
            }
        }

        .style1 {
            font-size: large;
            font-weight: bold;
        }

        .fborder {
            border-top: 1px solid black;
            border-left: 1px solid black;
            border-bottom: 1px solid black;
            padding: 6px;

        }

        .iborder {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 6px;

        }

        .lborder {
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            padding: 6px;

        }

        .border {
            padding: 4px;
            border-bottom: 1px solid black;

        }
    </style>
</head>

<body>

    <div class="noprint themeborderleft themeborderright themebordertop themeborderbottom">
        <table width="100%">
            <tr>
                <td width="100%" align="right">
                    <a href="" onclick="javascript:cetak()" title='Print'><span class='icon'><i class='fa fa-print'></i></span>Print</a>
                    &nbsp&nbsp&nbsp&nbsp
                    <a href="javascript:window.close()" title='Close'><span class='icon'><i class='fa fa-close'></i></span>Tutup</a>
                </td>
            </tr>
        </table>
    </div>

    <table width='100%' style="padding-top:10px;">
        <tr>
            <td width='10%'></td>
            <td style="text-align:center;" width='80%'>
                <span class='h1'>Laporan Semua Tickets</span><br><br>
                <span class='h2'>PT.WAHANA KALYANAMITRA MAHARDIKA</span><br>
                <br>Periode :
                <?php echo $_GET['periode_awal']; ?> -
                <?php echo $_GET['periode_akhir']; ?>
            </td>
            <td width='10%'>
                &nbsp
            </td>
        </tr>
    </table>

    <br>

    <table cellpadding="0" border='1' width="100%" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table">
        <thead>
            <tr>
                <th>
                    <h3 style='font-size:12px;'>Ticket No.</h3>
                </th>
                <th>
                    <h3 style='font-size:12px;'>Urgency</h3>
                </th>
                <th>
                    <h3 style='font-size:12px;'>SLA Goal Time</h3>
                </th>
                <th>
                    <h3 style='font-size:12px;'>Reported Date</h3>
                </th>
                <th>
                    <h3 style='font-size:12px;'>Documented Date</h3>
                </th>
                <th>
                    <h3 style='font-size:12px;'>Problem Summary</h3>
                </th>
                <th>
                    <h3 style='font-size:12px;'>Status</h3>
                </th>
                <th>
                    <h3 style='font-size:12px;'>Assignee</h3>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ticket_list as $ticket) :
                $sla = $slas->sla_data($ticket['sla']);
                $documenteddate = $ticket['documenteddate'];
                $resolutiontime = $sla['resolutiontime'];
                $slawarning = $sla['slawarning'];
                $slagoaltime = strtotime("+$resolutiontime hours", $documenteddate);
                $slawarningtime = strtotime("+$slawarning hours", $documenteddate);
                $user = $users->userdata($ticket['assignee']);
            ?>
                <tr>
                    <td>
                        <?php echo $ticket['ticketnumber'];?>
                    </td>
                    <td>
                        <?php echo $sla['namasla'];?>
                    </td>
                    <td>
                        <?php echo date('d-M-Y H:i:s', $slagoaltime);?>
                    </td>
                    <td>
                        <?php echo date('d-M-Y H:i:s', $ticket['reporteddate']);?>
                    </td>
                    <td>
                        <?php echo date('d-M-Y H:i:s', $ticket['documenteddate']);?>
                    </td>
                    <td>
                        <?php echo $ticket['problemsummary'];?>
                    </td>
                    <td>
                        <?php echo $ticket['ticketstatus'];?>
                    </td>
                    <td>
                        <?php echo $user['fullname'];?>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <script language="javascript" type="text/javascript">
        function cetak() {
            window.print();
        }

        function icetak() {
            window.print();
            setTimeout(function () {
                window.close();
            }, 1);
        }
    </script>
</body>

</html>
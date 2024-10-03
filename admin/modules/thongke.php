<?php
require '../../carbon/autoload.php';
include('../config/config.php');
use Carbon\Carbon;
session_start();

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
} else {
    // Default range is the last 365 days
    $start_date = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    $end_date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
}

$sql = "SELECT * FROM metrics WHERE metric_date BETWEEN '$start_date' AND '$end_date' ORDER BY metric_date ASC";
$sql_query = mysqli_query($mysqli, $sql);

$chart_data = []; // Initialize the array to store chart data
while ($val = mysqli_fetch_array($sql_query)) {
    $chart_data[] = array(
        'date' => $val['metric_date'],
        'order' => $val['metric_order'],
        'sales' => $val['metric_sales'],
        'quantity' => $val['metric_quantity']
    );
}
echo $data = json_encode($chart_data);
?>

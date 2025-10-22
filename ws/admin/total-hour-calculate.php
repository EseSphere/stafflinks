<?php
include('dbconnections.php');
$chat_system_result = mysqli_query($conn, "SELECT dateTime_in FROM tbl_schedule_calls ORDER BY userId ASC LIMIT 1");
while ($result_trans_rows = mysqli_fetch_array($chat_system_result)) {
    $varDateTimeIn = $result_trans_rows['dateTime_in'];


    $chat_system_result1 = mysqli_query($conn, "SELECT dateTime_out FROM tbl_schedule_calls ORDER BY userId DESC LIMIT 1");
    while ($result_trans_rows1 = mysqli_fetch_array($chat_system_result1)) {
        $varDateTimeOut = $result_trans_rows1['dateTime_out'];
        echo $varDateTimeOut;

        $chat_system = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls ORDER BY userId ASC ");
        while ($disp_rows = mysqli_fetch_array($chat_system)) {

            echo "
            <table border='1px'>
                <tr>
                    <td>" . $disp_rows['client_name'] . "</td>
                    <td>Start: " . $disp_rows['dateTime_in'] . "</td>
                    <td>End: " . $disp_rows['dateTime_out'] . "</td>
                </tr>
            </table>
            ";
        }
    }
}

$start_date = new DateTime($varDateTimeIn);
$since_start = $start_date->diff(new DateTime($varDateTimeOut));

echo $since_start->h . ':' . $since_start->i;

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body,
    html {
        font-size: 22px;
    }
</style>

<body>

    <?php
    include('dbconnections.php');



    $result = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`timeOut`, `timeIn`)))) AS total_worked_hours, SUM(`payment`) AS total_payment FROM `worker_table`");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $total_hours = $row['total_worked_hours'];
    $total_payment = $row['total_payment'];


    echo $total_hours . "<br>";
    echo $total_payment . "<br><br>";


    //$from_time = strtotime($row['timeIn']);
    //$to_time = strtotime($row['timeOut']);
    //$diff_minutes = round(abs($from_time - $to_time) / 60, 2);

    //$hours = intdiv($diff_minutes, 60) . ':' . ($diff_minutes % 60);

    //echo $hours . "<br><br>";






    ?>
</body>

</html>
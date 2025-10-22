<?php

if (isset($_POST['btnExtraLunchTask'])) {

    $txtClientSocialId = mysqli_real_escape_string($conn, $_REQUEST['txtClientSocialId']);
    $txtTask = mysqli_real_escape_string($conn, $_REQUEST['txtTask']);
    $txtTaskDetails = mysqli_real_escape_string($conn, $_REQUEST['txtTaskDetails']);

    $txtCareCall = mysqli_real_escape_string($conn, $_REQUEST['txtCareCall']);

    $txtMonday = mysqli_real_escape_string($conn, $_REQUEST['txtMonday']);
    $txtTuesday = mysqli_real_escape_string($conn, $_REQUEST['txtTuesday']);
    $txtWednesday = mysqli_real_escape_string($conn, $_REQUEST['txtWednesday']);
    $txtThursday = mysqli_real_escape_string($conn, $_REQUEST['txtThursday']);
    $txtFriday = mysqli_real_escape_string($conn, $_REQUEST['txtFriday']);
    $txtSaturday = mysqli_real_escape_string($conn, $_REQUEST['txtSaturday']);
    $txtSunday = mysqli_real_escape_string($conn, $_REQUEST['txtSunday']);

    $txtAnytimeSession = "Anytime/Session";
    $txtStarts = mysqli_real_escape_string($conn, $_REQUEST['txtStarts']);
    $txtEnd = mysqli_real_escape_string($conn, $_REQUEST['txtEnd']);
    $current_Date = mysqli_real_escape_string($conn, $_REQUEST['current_Date']);
    $current_Time = mysqli_real_escape_string($conn, $_REQUEST['current_Time']);

    $client_task_id = mysqli_real_escape_string($conn, $_REQUEST['client_task_id']);
    $mysocialIdEncrypt = mysqli_real_escape_string($conn, $_REQUEST['mysocialIdEncrypt']);
    $frequency = $txtMorning . " " . $txtLunch . " " . $txtTea . " " . $txtBed;
    $myTaskId = hash('sha256', $client_task_id);

    $task_colours = '#000';
    $task_visibility = 'Not updated';

    $myCheck = "SELECT * FROM tbl_clients_task_records WHERE client_taskName = '$txtTask' AND `extra_call1`= '$txtCareCall' AND uryyToeSS4 = '$txtClientSocialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes) {
        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";
    } else {

        //Check if current client social id is already in the database.
        $Client_special_Id_Check = "SELECT * FROM tbl_clients_task_records WHERE (client_task_Id = '$myTaskId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ";
        $my_Id_Check_res = mysqli_query($conn, $Client_special_Id_Check);
        $count_Id_Res = mysqli_num_rows($my_Id_Check_res);

        if ($count_Id_Res != 0) {
            //If the current client social id is already in the database, then add new client by adding one integer to the current id.
            $myTaskIdentity = $myTaskId . '' . $mysocialIdEncrypt;

            $queryIns = mysqli_query($conn, "INSERT INTO tbl_clients_task_records (uryyToeSS4, client_taskName, client_task_details, monday, tuesday, wednesday, thursday, friday, saturday, sunday, tast_anytimeSession, task_startDate, task_endDate, date_uploaded, time_uploaded, client_task_Id, col_company_Id) VALUES('" . $txtClientSocialId . "', '" . $txtTask . "', '" . $txtTaskDetails . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $txtAnytimeSession . "', '" . $txtStarts . "', '" . $txtEnd . "', '" . $current_Date . "', '" . $current_Time . "', '" . $myTaskIdentity . "', '" . $_SESSION['usr_compId'] . "') ");
            if ($queryIns) {
                $updateMysqlTable1 = mysqli_query($conn, "UPDATE `tbl_clients_task_records` SET `extra_call2`= '$txtCareCall', `task_colours`= '$task_colours', `visibility`= '$task_visibility' WHERE `client_task_Id` = '$myTaskIdentity' ");
                if ($updateMysqlTable1) {
                    header("Location: ./client-extra-lunch-tasks?uryyToeSS4=$txtClientSocialId");
                } else {
                    header("Location: ./not-successful-page");
                }
            } else {
            }

            unset($txtClientSocialId);
            unset($txtTask);
            unset($txtTaskDetails);
            unset($txtCareCall);

            unset($txtTuesday);
            unset($txtWednesday);
            unset($txtThursday);
            unset($txtFriday);
            unset($txtSaturday);

            unset($txtSunday);
            unset($txtAnytimeSession);
            unset($txtStarts);
            unset($txtEnd);
            unset($current_Date);
            unset($current_Time);
        } else {
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_clients_task_records (uryyToeSS4, client_taskName, client_task_details, monday, tuesday, wednesday, thursday, friday, saturday, sunday, tast_anytimeSession, task_startDate, task_endDate, date_uploaded, time_uploaded, client_task_Id, col_company_Id) VALUES('" . $txtClientSocialId . "', '" . $txtTask . "', '" . $txtTaskDetails . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $txtAnytimeSession . "', '" . $txtStarts . "', '" . $txtEnd . "', '" . $current_Date . "', '" . $current_Time . "', '" . $client_task_id . "', '" . $_SESSION['usr_compId'] . "') ");
            if ($queryIns) {
                $updateMysqlTable1 = mysqli_query($conn, "UPDATE `tbl_clients_task_records` SET `extra_call2`= '$txtCareCall', `task_colours`= '$task_colours', `visibility`= '$task_visibility' WHERE `client_task_Id` = '$client_task_id' ");
                if ($updateMysqlTable1) {
                    header("Location: ./client-extra-lunch-tasks?uryyToeSS4=$txtClientSocialId");
                } else {
                    header("Location: ./not-successful-page");
                }
            } else {
            }
        }
    }
}


  //$myCheck = "SELECT * FROM tbl_clients_task_records WHERE client_taskName = '" . $txtTask . "' AND uryyToeSS4 = '$txtClientSocialId' ";
    //$myCheckres = mysqli_query($conn, $myCheck);
    //$countRes = mysqli_num_rows($myCheckres);

    //if ($countRes != 0) {

    // echo "
    //<script type='text/javascript'>
    //$(document).ready(function() {
    //  $('#popupAlert').show();
    // });
    //</script>";
//}

<?php

include('dbconnections.php');

if (isset($_POST['btnSendChat'])) {

    //Get user and client latitude and longitude which result to comparison in disatnce to know if Admin point A is closer to 
    //client point B

    $txtCarerEmail = mysqli_real_escape_string($conn, $_POST['txtCarerEmail']);
    $txtCarerSpecialId = mysqli_real_escape_string($conn, $_POST['txtCarerSpecialId']);

    $txtAdminEmail = mysqli_real_escape_string($conn, $_POST['txtAdminEmail']);
    $txtAdminName = mysqli_real_escape_string($conn, $_POST['txtAdminName']);
    $txtChatMessage = mysqli_real_escape_string($conn, $_POST['txtChatMessage']);
    $txtAdminSpecialId = mysqli_real_escape_string($conn, $_POST['txtAdminSpecialId']);
    $txtAdminTimeSent = mysqli_real_escape_string($conn, $_POST['txtAdminTimeSent']);
    $txtAdminDateSent = mysqli_real_escape_string($conn, $_POST['txtAdminDateSent']);
    $txtChatColor = "rgba(22, 160, 133,1.0)";
    $txtChatStatus = "Not pending";

    //Check if care call already started
    $myCheck = "SELECT * FROM tbl_chat_system WHERE carer_specialId = '" . $txtCarerSpecialId . "' AND admin_specialId = '' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    //if it is true then execute queries and proceed to tasks
    if ($countRes) {
        $sql = mysqli_query($conn, "UPDATE `tbl_chat_system` SET `admin_email` = '$txtAdminEmail', `admin_name` = '$txtAdminName', `admin_chat` = '$txtChatMessage', `admin_specialId` = '$txtAdminSpecialId', `adTime_sent` = '$txtAdminTimeSent', `adDate_sent` = '$txtAdminDateSent', `adChat_color` = '$txtChatColor', `adChat_color` = '$txtChatColor' WHERE chat_status = '$txtChatStatus' ");
        if ($sql) {
            header("Location: ./chat-system?user_special_Id=$txtCarerSpecialId");
        }
    } else {
        $queryIns = mysqli_query($conn, "INSERT INTO tbl_chat_system (carer_email, admin_email, admin_name, admin_specialId, admin_chat, adTime_sent, adDate_sent, adChat_color) VALUES('" . $txtCarerEmail . "', '" . $txtAdminEmail . "', '" . $txtAdminName . "', '" . $txtAdminSpecialId . "', '" . $txtChatMessage . "', '" . $txtAdminTimeSent . "', '" . $txtAdminDateSent . "', '" . $txtChatColor . "') ");
        if ($queryIns) {
            header("Location: ./chat-system?user_special_Id=$txtCarerSpecialId");
        }
    }
    //Below code insert the data into database if distance agreed is stated in the map

} else {
}

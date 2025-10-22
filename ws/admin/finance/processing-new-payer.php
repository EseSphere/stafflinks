<?php

if (isset($_POST['btnAddNewPayerData'])) {

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtfive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);
    $txtsix = "Active";

    $mySpecialId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myRateId = hash('sha256', $mySpecialId);

    $myCheck = mysqli_query($conn, "SELECT * FROM tbl_payer WHERE (col_name = '$txtone' AND col_email = '$txttwo' AND col_phone_number = '$txtthree')");
    $row_payer = mysqli_fetch_array($myCheck);
    $varSpecialId = $row_payer['col_special_Id'];
    $countRes = mysqli_num_rows($myCheck);
    if ($countRes != 0) {
        echo "
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#popupAlert').show();
            });
        </script>";
    } else {
        $sql_get_payer_Id = mysqli_query($conn, "SELECT * FROM tbl_payer ORDER BY userId DESC LIMIT 1");
        $row_get_payer_Id = mysqli_fetch_array($sql_get_payer_Id);
        $varSpecialId = $row_get_payer_Id['col_special_Id'];
        if ($row_get_payer_Id == 0) {
            $varSpecialIdNumb = 78571;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_payer (col_name, col_email, col_phone_number, col_invoice_pref, col_address, col_status, col_special_Id, col_company_Id, col_date) 
            VALUES('" . $txtone . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtfour . "', '" . $txtfive . "', '" . $txtsix . "', '" . $varSpecialIdNumb . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");
            if ($queryIns) {
                header("Location: ./new-payer");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        } else {
            $varIncrementSpecialId = $varSpecialId + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_payer (col_name, col_email, col_phone_number, col_invoice_pref, col_address, col_status, col_special_Id, col_company_Id, col_date) 
            VALUES('" . $txtone . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtfour . "', '" . $txtfive . "', '" . $txtsix . "', '" . $varIncrementSpecialId . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");
            if ($queryIns) {
                header("Location: ./new-payer");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        }
    }
}

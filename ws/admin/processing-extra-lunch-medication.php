<?php

if (isset($_POST['btnSubmitExtraLunchMeds'])) {

    include('dbconnections.php');

    $txtClientSocialId = mysqli_real_escape_string($conn, $_REQUEST['txtClientSocialId']);
    $txtMedName = mysqli_real_escape_string($conn, $_REQUEST['txtMedName']);
    $txtMedDosage = mysqli_real_escape_string($conn, $_REQUEST['txtMedDosage']);

    $txtCareCall = mysqli_real_escape_string($conn, $_REQUEST['txtCareCall']);

    $txtMonday = mysqli_real_escape_string($conn, $_REQUEST['txtMonday']);
    $txtTuesday = mysqli_real_escape_string($conn, $_REQUEST['txtTuesday']);
    $txtWednesday = mysqli_real_escape_string($conn, $_REQUEST['txtWednesday']);
    $txtThursday = mysqli_real_escape_string($conn, $_REQUEST['txtThursday']);
    $txtFriday = mysqli_real_escape_string($conn, $_REQUEST['txtFriday']);
    $txtSaturday = mysqli_real_escape_string($conn, $_REQUEST['txtSaturday']);
    $txtSunday = mysqli_real_escape_string($conn, $_REQUEST['txtSunday']);
    $txtStartMed = mysqli_real_escape_string($conn, $_REQUEST['txtStartMed']);
    $txtEndMed = mysqli_real_escape_string($conn, $_REQUEST['txtEndMed']);
    $txtMedPopupDate = mysqli_real_escape_string($conn, $_REQUEST['txtMedPopupDate']);

    $txtMedType = mysqli_real_escape_string($conn, $_REQUEST['txtMedType']);
    $txtMedicineSupport = mysqli_real_escape_string($conn, $_REQUEST['txtMedicineSupport']);
    $txtMedPackage = mysqli_real_escape_string($conn, $_REQUEST['txtMedPackage']);
    $txtMedkDetails = mysqli_real_escape_string($conn, $_REQUEST['txtMedkDetails']);

    $current_Date = mysqli_real_escape_string($conn, $_REQUEST['current_Date']);
    $current_Time = mysqli_real_escape_string($conn, $_REQUEST['current_Time']);

    $client_med_id = mysqli_real_escape_string($conn, $_REQUEST['client_med_id']);
    $mysocialIdEncrypt = mysqli_real_escape_string($conn, $_REQUEST['mysocialIdEncrypt']);

    $myMedskId = hash('sha256', $client_med_id);

    $med_colours = '#000';
    $med_visibility = 'Not updated';

    $myCheck = "SELECT * FROM tbl_clients_medication_records WHERE med_name = '$txtMedName' AND uryyToeSS4 = '$txtClientSocialId' AND extra_call1 = '$txtCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
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
        //
        //Check if current client social id is already in the database.
        $Client_special_Id_Check = "SELECT * FROM tbl_clients_medication_records WHERE (client_med_Id = '$myMedskId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ";
        $my_Id_Check_res = mysqli_query($conn, $Client_special_Id_Check);
        $count_Id_Res = mysqli_num_rows($my_Id_Check_res);

        if ($count_Id_Res != 0) {
            //If the current client social id is already in the database, then add new client by adding one integer to the current id.
            $myMedsIdentity = $myMedskId . '' . $mysocialIdEncrypt;

            $queryIns = mysqli_query($conn, "INSERT INTO tbl_clients_medication_records (uryyToeSS4, med_name, med_dosage, med_type, med_support_required, med_package, med_details, date_uploaded, time_uploaded, monday, tuesday, wednesday, thursday, friday, saturday, sunday, client_startMed, client_endMed, col_occurence, client_med_Id, col_company_Id) 
            VALUES('" . $txtClientSocialId . "', '" . $txtMedName . "', '" . $txtMedDosage . "', '" . $txtMedType . "', '" . $txtMedicineSupport . "', '" . $txtMedPackage . "', '" . $txtMedkDetails . "', '" . $current_Date . "', '" . $current_Time . "', '" . $txtMonday . "',  '" . $txtTuesday . "',  '" . $txtWednesday . "',  '" . $txtThursday . "',  '" . $txtFriday . "',  '" . $txtSaturday . "',  '" . $txtSunday . "', '" . $txtStartMed . "', '" . $txtEndMed . "', '" . $txtMedPopupDate . "', '" . $myMedsIdentity . "', '" . $_SESSION['usr_compId'] . "')");
            if ($queryIns) {
                $updateMysqlTable1 = mysqli_query($conn, "UPDATE `tbl_clients_medication_records` SET `extra_call2`= '$txtCareCall', `med_colours`= '$med_colours', `visibility`= '$med_visibility' WHERE `client_med_Id` = '$myMedsIdentity' ");
                if ($updateMysqlTable1) {
                    header("Location: ./client-extra-lunch-medication?uryyToeSS4=$txtClientSocialId");
                } else {
                    header("Location: ./not-successful-page");
                }
            } else {
            }

            unset($txtClientSocialId);
            unset($txtMedName);
            unset($txtMedDosage);
            unset($txtMedFrequency);

            unset($txtMedType);
            unset($txtMedicineSupport);
            unset($txtMedPackage);
            unset($txtMedkDetails);
            unset($current_Date);
            unset($current_Time);
        } else {
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_clients_medication_records (uryyToeSS4, med_name, med_dosage, med_type, med_support_required, med_package, med_details, date_uploaded, time_uploaded, monday, tuesday, wednesday, thursday, friday, saturday, sunday, client_startMed, client_endMed, col_occurence, client_med_Id, col_company_Id) 
            VALUES('" . $txtClientSocialId . "', '" . $txtMedName . "', '" . $txtMedDosage . "', '" . $txtMedType . "', '" . $txtMedicineSupport . "', '" . $txtMedPackage . "', '" . $txtMedkDetails . "', '" . $current_Date . "', '" . $current_Time . "', '" . $txtMonday . "',  '" . $txtTuesday . "',  '" . $txtWednesday . "',  '" . $txtThursday . "',  '" . $txtFriday . "',  '" . $txtSaturday . "',  '" . $txtSunday . "', '" . $txtStartMed . "', '" . $txtEndMed . "', '" . $txtMedPopupDate . "', '" . $myMedskId . "', '" . $_SESSION['usr_compId'] . "')");
            if ($queryIns) {
                $updateMysqlTable1 = mysqli_query($conn, "UPDATE `tbl_clients_medication_records` SET `extra_call2`= '$txtCareCall', `med_colours`= '$med_colours', `visibility`= '$med_visibility' WHERE `client_med_Id` = '$myMedskId' ");
                if ($updateMysqlTable1) {
                    header("Location: ./client-extra-lunch-medication?uryyToeSS4=$txtClientSocialId");
                } else {
                    header("Location: ./not-successful-page");
                }
            } else {
                echo "Could not execute" . mysqli_error($conn);
            }
        }
    }
}

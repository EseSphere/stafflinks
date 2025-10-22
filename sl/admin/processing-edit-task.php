<?php

if (isset($_POST['btnEditClientMedicine'])) {

    $txtClientSocialId =  mysqli_real_escape_string($conn, $_POST['txtClientSocialId']);
    $uryyToeSS4 =  mysqli_real_escape_string($conn, $_POST['uryyToeSS4']);
    $txtMedName =  mysqli_real_escape_string($conn, $_POST['txtMedName']);
    $txtMedDosage =  mysqli_real_escape_string($conn, $_POST['txtMedDosage']);
    $txtMedType =  mysqli_real_escape_string($conn, $_POST['txtMedType']);
    $txtMedFrequency =  mysqli_real_escape_string($conn, $_POST['txtMedFrequency']);
    $txtMedicineSupport =  mysqli_real_escape_string($conn, $_POST['txtMedicineSupport']);
    $txtMedPackage =  mysqli_real_escape_string($conn, $_POST['txtMedPackage']);
    $txtMedkDetails =  mysqli_real_escape_string($conn, $_POST['txtMedkDetails']);

    $sql = mysqli_query($conn, "UPDATE `tbl_clients_medication_records` SET `med_name` = '$txtMedName', `med_dosage` = '$txtMedDosage', `med_type` = '$txtMedType', `med_frequency` = '$txtMedFrequency', `med_support_required` = '$txtMedicineSupport', `med_package` = '$txtMedPackage', `med_details` = '$txtMedkDetails' WHERE med_Id = '$_$txtClientSocialId' ");

    if ($sql) {
        header("Location: ./client-medication?uryyToeSS4=$uryyToeSS4");
    } else {
    }
}

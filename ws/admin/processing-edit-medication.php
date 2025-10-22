<?php
// processing-edit-medication.php
if (isset($_POST['btnEditClientMedicine'])) {

	include('dbconnections.php');

	// Collect inputs
	$txtMed_Id          = $_POST['txtMed_Id']          ?? '';
	$txturyyToeSS4      = $_POST['uryyToeSS4']         ?? '';
	$txtMedName         = $_POST['txtMedName']         ?? '';
	$txtMedDosage       = $_POST['txtMedDosage']       ?? '';
	$txtMedType         = $_POST['txtMedType']         ?? '';
	$txtMedicineSupport = $_POST['txtMedicineSupport'] ?? '';
	$txtMedPackage      = $_POST['txtMedPackage']      ?? '';
	$txtMedkDetails     = $_POST['txtMedkDetails']     ?? '';

	$txtMorning = $_POST['txtMorning'] ?? '';
	$txtLunch   = $_POST['txtLunch']   ?? '';
	$txtTea     = $_POST['txtTea']     ?? '';
	$txtBed     = $_POST['txtBed']     ?? '';

	$txtExM = $_POST['txtEM'] ?? '';
	$txtExL = $_POST['txtEL'] ?? '';
	$txtExT = $_POST['txtET'] ?? '';
	$txtExB = $_POST['txtEB'] ?? '';

	$txtMonday    = $_POST['txtMonday']    ?? '';
	$txtTuesday   = $_POST['txtTuesday']   ?? '';
	$txtWednesday = $_POST['txtWednesday'] ?? '';
	$txtThursday  = $_POST['txtThursday']  ?? '';
	$txtFriday    = $_POST['txtFriday']    ?? '';
	$txtSaturday  = $_POST['txtSaturday']  ?? '';
	$txtSunday    = $_POST['txtSunday']    ?? '';
	$txtStartMed  = $_POST['txtStartMed']  ?? '';
	$txtEndMed    = $_POST['txtEndMed']    ?? '';
	$txtStop      = $_POST['txtStop']      ?? '';

	$txtPeriod         = $_POST['txtPeriod']         ?? '';
	$txtPeriodCategory = $_POST['txtPeriodCategory'] ?? '';

	$clickDisplayDaily   = $_POST['clickDisplayDaily']   ?? '';
	$clickDisplayOneTime = $_POST['clickDisplayOneTime'] ?? '';
	$clickDisplayCustom  = $_POST['clickDisplayCustom']  ?? '';

	// Determine end date and period
	$client_endMed = ($txtStop === "Stop") ? $txtStop : $txtEndMed;

	if ($clickDisplayDaily) {
		$col_period_two = 'Daily';
		$col_period_one = null;
	} elseif ($clickDisplayOneTime) {
		$col_period_two = 'Monthly';
		$col_period_one = null;
	} elseif ($clickDisplayCustom) {
		$col_period_two = $txtPeriodCategory;
		$col_period_one = $txtPeriod;
	} else {
		$col_period_two = null;
		$col_period_one = null;
	}

	// Prepared statement to update record
	$stmt = $conn->prepare("
        UPDATE tbl_clients_medication_records SET
            med_name = ?, med_dosage = ?, med_type = ?, med_support_required = ?, med_package = ?, med_details = ?,
            care_call1 = ?, care_call2 = ?, care_call3 = ?, care_call4 = ?,
            extra_call1 = ?, extra_call2 = ?, extra_call3 = ?, extra_call4 = ?,
            monday = ?, tuesday = ?, wednesday = ?, thursday = ?, friday = ?, saturday = ?, sunday = ?,
            client_startMed = ?, client_endMed = ?, col_occurence = ?, col_period_one = ?, col_period_two = ?
        WHERE med_Id = ?
    ");

	$stmt->bind_param(
		"sssssssssssssssssssssssssss",
		$txtMedName,
		$txtMedDosage,
		$txtMedType,
		$txtMedicineSupport,
		$txtMedPackage,
		$txtMedkDetails,
		$txtMorning,
		$txtLunch,
		$txtTea,
		$txtBed,
		$txtExM,
		$txtExL,
		$txtExT,
		$txtExB,
		$txtMonday,
		$txtTuesday,
		$txtWednesday,
		$txtThursday,
		$txtFriday,
		$txtSaturday,
		$txtSunday,
		$txtStartMed,
		$txtEndMed,
		$client_endMed,
		$col_period_one,
		$col_period_two,
		$txtMed_Id
	);

	if ($stmt->execute()) {
		header("Location: ./client-medication?uryyToeSS4=$txturyyToeSS4");
		exit();
	} else {
		echo "Error updating medication record: " . $stmt->error;
	}
}

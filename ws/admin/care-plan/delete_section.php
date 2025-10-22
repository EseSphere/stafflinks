<?php
include 'dbconnections.php'; // Your DB connection file

if (!isset($_POST['userId'])) {
    echo json_encode(['success' => false, 'message' => 'No section ID provided.']);
    exit;
}

$sectionId = intval($_POST['userId']);
$companyId = $_SESSION['usr_compId'] ?? 0;

$sql = "DELETE FROM tbl_care_plan_section WHERE userId = ? AND company_Id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => $conn->error]);
    exit;
}

$stmt->bind_param('is', $sectionId, $companyId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

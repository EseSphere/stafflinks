<?php
if (isset($_POST['action']) && !empty($_POST['selected_ids'])) {
    include_once 'dbconnections.php';
    $selected_ids = array_map('intval', $_POST['selected_ids']);
    $ids = implode(',', $selected_ids);

    if ($_POST['action'] === 'delete') {
        $stmt = $conn->prepare("DELETE FROM tbl_invoices WHERE userId IN($ids) AND col_company_Id = ?");
        $stmt->bind_param("s", $_SESSION['usr_compId']);
        if ($stmt->execute()) {
            header("Location: ./invoice-546535-049909-488464-77333");
        } else {
            echo "Error deleting invoices: " . $stmt->error;
        }
        $stmt->close();
        exit;
    }

    if ($_POST['action'] === 'export') {
        $sql_get_selected_data = $conn->query("
            SELECT 
                col_client_Id,
                col_payer,
                col_care_recipient,
                col_invoice_start_date,
                col_invoice_end_date,
                col_invoice_Id
            FROM tbl_invoices
            WHERE userId IN($ids) 
              AND col_company_Id = '" . $conn->real_escape_string($_SESSION['usr_compId']) . "'
            GROUP BY col_client_Id
        ");

        if ($sql_get_selected_data->num_rows > 0) {
            $delimiter = ",";
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename=Invoices_' . date('Y-m-d') . '.csv');
            header('Pragma: no-cache');
            header('Expires: 0');

            $output = fopen('php://output', 'w');
            echo "\xEF\xBB\xBF";

            $fields = array('INVOICE#', 'PAYER NAME', 'PERIOD START', 'PERIOD END', 'CARE RECIPIENT', 'EXPENSES', 'CARE DELIVERY', 'FEES', 'TOTAL');
            fputcsv($output, $fields, $delimiter);

            while ($row_selected_data = $sql_get_selected_data->fetch_assoc()) {
                $varStartDate = $row_selected_data['col_invoice_start_date'];
                $varEndDate = $row_selected_data['col_invoice_end_date'];
                $varClientId = $row_selected_data['col_client_Id'];
                $varInvoicenumb = $row_selected_data['col_invoice_Id'];
                $varInvoiceId = '' . $varInvoicenumb;
                $varExpenses = 0.00;
                $varFees = 0.00;

                $sql_total_balance = $conn->query("
                    SELECT SUM(CAST(col_payer_rate AS DECIMAL(10,2))) AS total_payment
                    FROM tbl_invoices
                    WHERE col_client_Id = '$varClientId'
                      AND col_company_Id = '" . $conn->real_escape_string($_SESSION['usr_compId']) . "'
                      AND col_invoice_start_date >= '$varStartDate'
                      AND col_invoice_end_date <= '$varEndDate'
                ");
                $row_total_balance = $sql_total_balance->fetch_assoc();
                $varTotalCareDelivery = number_format((float)$row_total_balance['total_payment'], 2, '.', '');
                $varTotal = number_format($varTotalCareDelivery + $varExpenses + $varFees, 2, '.', '');

                $lineData = array(
                    $varInvoiceId . "#",
                    $row_selected_data['col_payer'],
                    $varStartDate,
                    $varEndDate,
                    $row_selected_data['col_care_recipient'],
                    '£' . number_format($varExpenses, 2, '.', ''),
                    '£' . $varTotalCareDelivery,
                    '£' . number_format($varFees, 2, '.', ''),
                    '£' . $varTotal
                );
                fputcsv($output, $lineData, $delimiter);
            }
            fclose($output);
        }
    }
} else {
    echo "No rows selected.";
}

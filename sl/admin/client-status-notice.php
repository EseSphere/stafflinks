<?php
$sql = "
    SELECT * 
    FROM tbl_client_status_records 
    WHERE 
        (
            (CURDATE() BETWEEN DATE(col_start_date) AND DATE(col_end_date))
            OR col_end_date = 'TFN'
        )
        AND col_client_Id = '" . $conn->real_escape_string($uryyToeSS4) . "'
        AND col_company_Id = '" . $conn->real_escape_string($_SESSION['usr_compId']) . "'
ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row23 = $result->fetch_assoc();
?>
    <div class="alert alert-danger" role="alert">
        <div class="row">
            <div class="col-md-8">
                <i class="fas fa-info-circle"></i>
                <?= htmlspecialchars($row23['col_reason']) ?>
                <strong>
                    <?= htmlspecialchars($row23['col_start_date']) ?> &rarr; <?= htmlspecialchars($row23['col_end_date']) ?>
                </strong>
            </div>
            <div class="col-md-4" style="text-align:right;">
                <a href="./status-history?uryyToeSS4=<?= urlencode($uryyToeSS4) ?>" style="text-decoration: none;" class="btn btn-sm btn-danger">
                    Status History <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
<?php
}
?>
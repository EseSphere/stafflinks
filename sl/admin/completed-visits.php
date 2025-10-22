<?php
include('client-header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = trim(($row['client_first_name'] ?? '') . ' ' . ($row['client_last_name'] ?? ''));
$_SESSION['clientId'] = $row['uryyToeSS4'] ?? '';
$stmt->close();
?>

<link rel="stylesheet" type="text/css" href="./css/daily_visits.css" />
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="container-fluid">
            <?php require_once('visit-sub-header.php'); ?>
            <hr class="mb-3">
            <div class="row">
                <div class="col-md-9">
                    <div id="visitsBox" class="mt-4">
                        <h5 id="dayTitle"></h5>

                        <!-- Main Completed Visits Table -->
                        <table id="mainCompletedVisitsTable" class="table table-bordered shadow-sm mb-4">
                            <thead>
                                <tr>
                                    <th>Morning</th>
                                    <th>Lunch</th>
                                    <th>Tea</th>
                                    <th>Bed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="Morning"></td>
                                    <td id="Lunch"></td>
                                    <td id="Tea"></td>
                                    <td id="Bed"></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Extra Completed Calls Table -->
                        <table id="extraCompletedCallsTable" class="table table-bordered shadow-sm" style="display:none;">
                            <thead>
                                <tr id="extraCompletedHeaderRow"></tr>
                            </thead>
                            <tbody>
                                <tr id="extraCompletedBodyRow"></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="sticky-filter" style="position: sticky; top: 20px;">
                        <div class="card text-center shadow-lg mt-5 w-100" style="max-width: 500px; margin: 0 auto; border-radius: 15px; background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="color: #343a40;">Download Visit Records</h5>
                                <p class="card-text text-muted">
                                    Easily generate, print, and download completed visit records for any date range.
                                    <hr>
                                    This tool allows you to efficiently manage, review, and archive completed visit information.
                                </p>
                                <a href="./download-visits?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="btn btn-gradient" style="background: linear-gradient(90deg, #007bff, #6610f2); border: none; color: #fff; padding: 10px 20px; border-radius: 50px; transition: 0.3s;">
                                    Download Visits
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const datePicker = document.getElementById('datePicker');
        const dayTitle = document.getElementById('dayTitle');
        const prevDateBtn = document.getElementById('prevDate');
        const nextDateBtn = document.getElementById('nextDate');
        const printBtn = document.getElementById('printBtn');
        const clientId = <?= json_encode($_SESSION['clientId'] ?? '') ?>;

        function formatDateDisplay(date) {
            return date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }

        function formatDateValue(date) {
            return date.toISOString().split('T')[0];
        }

        let currentDate = new Date();

        function setDate(date) {
            currentDate = date;
            datePicker.value = formatDateDisplay(date);
            loadCompletedVisits(formatDateValue(date));
        }

        function changeDate(days) {
            const newDate = new Date(currentDate);
            newDate.setDate(newDate.getDate() + days);
            setDate(newDate);
        }

        async function loadCompletedVisits(date) {
            try {
                const response = await fetch(`get_completed_visits.php?date=${encodeURIComponent(date)}&clientId=${encodeURIComponent(clientId)}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                const day = new Date(date).toLocaleDateString('en-GB', {
                    weekday: 'long'
                });
                dayTitle.textContent = day;

                const visitsForDay = data[day] || {};

                // Clear main table cells
                const mainSlots = ['Morning', 'Lunch', 'Tea', 'Bed'];
                const mainTableCells = mainSlots.reduce((acc, slot) => {
                    const cell = document.getElementById(slot);
                    cell.innerHTML = '';
                    acc[slot] = cell;
                    return acc;
                }, {});

                // Extra calls
                const extraTable = document.getElementById('extraCompletedCallsTable');
                const extraHeaderRow = document.getElementById('extraCompletedHeaderRow');
                const extraBodyRow = document.getElementById('extraCompletedBodyRow');
                extraHeaderRow.innerHTML = '';
                extraBodyRow.innerHTML = '';
                let hasExtra = false;

                for (const slot in visitsForDay) {
                    const visits = visitsForDay[slot];

                    if (mainSlots.includes(slot)) {
                        visits.forEach((visit, index) => {
                            const div = document.createElement('div');
                            div.className = 'visit-box';
                            div.style.animationDelay = `${index * 150}ms`;
                            div.innerHTML = `
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 text-left"><strong>Client:</strong></div>
                                    <div class="col-8 text-left">${visit.client_name}</div>
                                    <div class="col-4 text-left"><strong>Carer:</strong></div>
                                    <div class="col-8 text-left">${visit.carer_name}</div>
                                    <div class="col-4 text-left"><strong>Planned:</strong></div>
                                    <div class="col-8 text-left">${visit.visit_time_in} - ${visit.visit_time_out}</div>
                                </div>
                                <div class="visit-status completed">${visit.visit_status}</div>
                            </div>
                        `;
                            div.addEventListener('click', () => {
                                window.location.href = `visit-details.php?userId=${visit.visit_id}&spec=${visit.client_specId}`;
                            });
                            mainTableCells[slot].appendChild(div);
                        });
                    } else {
                        // Extra call
                        hasExtra = true;
                        const th = document.createElement('th');
                        th.textContent = slot;
                        th.style.maxWidth = '200px';
                        th.style.wordWrap = 'break-word';
                        th.style.whiteSpace = 'normal';
                        extraHeaderRow.appendChild(th);

                        const td = document.createElement('td');
                        td.style.maxWidth = '200px';
                        td.style.wordWrap = 'break-word';
                        td.style.whiteSpace = 'normal';

                        visits.forEach((visit, index) => {
                            const div = document.createElement('div');
                            div.className = 'visit-box';
                            div.style.animationDelay = `${index * 150}ms`;
                            div.innerHTML = `
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 text-left"><strong>Client:</strong></div>
                                    <div class="col-8 text-left">${visit.client_name}</div>
                                    <div class="col-4 text-left"><strong>Carer:</strong></div>
                                    <div class="col-8 text-left">${visit.carer_name}</div>
                                    <div class="col-4 text-left"><strong>Planned:</strong></div>
                                    <div class="col-8 text-left">${visit.visit_time_in} - ${visit.visit_time_out}</div>
                                </div>
                                <div class="visit-status completed">${visit.visit_status}</div>
                            </div>
                        `;
                            div.addEventListener('click', () => {
                                window.location.href = `visit-details.php?userId=${visit.visit_id}&spec=${visit.client_specId}`;
                            });
                            td.appendChild(div);
                        });

                        extraBodyRow.appendChild(td);
                    }
                }

                // Show extra table only if there are extra calls
                extraTable.style.display = hasExtra ? '' : 'none';

            } catch (error) {
                console.error('Error loading completed visits:', error);
            }
        }

        prevDateBtn.addEventListener('click', () => changeDate(-1));
        nextDateBtn.addEventListener('click', () => changeDate(1));

        printBtn.addEventListener('click', () => {
            const content = document.querySelector('.container-fluid').innerHTML;
            const printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Print Completed Visits</title>');
            printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>');
            printWindow.document.write(`
            <style>
                body { margin: 0 !important; padding: 0 !important; }
                .visit-box { padding: 8px; margin: 5px 0; border: 1px solid #ddd; border-radius: 6px; background-color: #f9f9f9; }
                table th, table td { text-align: left !important; vertical-align: top; padding: 8px; max-width: 200px; word-wrap: break-word; white-space: normal; }
                .completed { background-color: #d4edda; color: #155724; padding: 3px 8px; border-radius: 4px; display: inline-block; }
                button, input, a { display: none !important; }
                table { width: 100% !important; border-collapse: collapse !important; }
            </style>
        `);
            printWindow.document.write('</head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        });

        setDate(currentDate);
    });
</script>

<?php include('footer-contents.php'); ?>
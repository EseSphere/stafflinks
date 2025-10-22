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
                <div class="col-md-8">
                    <div id="visitsBox" class="mt-4">
                        <h5 id="dayTitle"></h5>

                        <!-- Normal Visits Table -->
                        <table class="table table-bordered shadow-sm">
                            <thead class="table-light">
                                <tr>
                                    <th style="max-width:200px;">Morning</th>
                                    <th style="max-width:200px;">Lunch</th>
                                    <th style="max-width:200px;">Tea</th>
                                    <th style="max-width:200px;">Bed</th>
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

                        <!-- Extra Calls Table -->
                        <table class="table table-bordered shadow-sm mt-3" id="extraCallsTable" style="display:none;">
                            <thead class="table-light">
                                <tr>
                                    <th style="max-width:200px;">Extra Morning</th>
                                    <th style="max-width:200px;">Extra Lunch</th>
                                    <th style="max-width:200px;">Extra Tea</th>
                                    <th style="max-width:200px;">Extra Bed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="EMorning" class="extra-col"></td>
                                    <td id="ELunch" class="extra-col"></td>
                                    <td id="ETea" class="extra-col"></td>
                                    <td id="EBed" class="extra-col"></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="sticky-filter" style="position: sticky; top: 20px;">
                        <div class="card text-center shadow-lg mt-5 w-100" style="max-width: 500px; margin: 0 auto; border-radius: 15px; background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="color: #343a40;">Download Visit Records</h5>
                                <p class="card-text text-muted">
                                    Easily generate, print, and download visit records for any date range. Select the dates that are relevant to your needs, and access a comprehensive record of all visits within that period.
                                    <hr>
                                    This tool allows you to efficiently manage, review, and archive visit information. Click the button below to securely download your visit records in a convenient format for your records or reporting purposes.
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

        let currentDate = new Date();

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

        function setDate(date) {
            currentDate = date;
            datePicker.value = formatDateDisplay(date);
            loadVisits(formatDateValue(date));
        }

        function changeDate(days) {
            const newDate = new Date(currentDate);
            newDate.setDate(newDate.getDate() + days);
            setDate(newDate);
        }

        async function loadVisits(date) {
            try {
                const response = await fetch(`get_schedulled_visits.php?date=${encodeURIComponent(date)}&clientId=${encodeURIComponent(clientId)}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                // Clear normal and extra cells
                ['Morning', 'Lunch', 'Tea', 'Bed', 'EMorning', 'ELunch', 'ETea', 'EBed'].forEach(id => {
                    const cell = document.getElementById(id);
                    if (cell) cell.innerHTML = '';
                });

                document.getElementById('extraCallsTable').style.display = 'none';

                const day = new Date(date).toLocaleDateString('en-GB', {
                    weekday: 'long'
                });
                dayTitle.textContent = day;

                const visitsForDay = data[day] || {};

                let hasExtra = false;

                for (const timeSlot in visitsForDay) {
                    const visits = visitsForDay[timeSlot];
                    let cellId = timeSlot.replace(' ', ''); // e.g., "Extra Morning" -> "EMorning"
                    if (timeSlot.startsWith('Extra')) hasExtra = true;

                    const cell = document.getElementById(cellId) || document.getElementById(timeSlot);
                    if (!cell) continue;

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
                            <div class="visit-status ${visit.visit_status.toLowerCase() === 'completed' ? 'completed' : 'not-completed'}">
                                ${visit.visit_status}
                            </div>
                        </div>
                    `;
                        div.addEventListener('click', () => {
                            window.location.href = `visit-details.php?userId=${visit.visit_id}&spec=${visit.client_specId}`;
                        });
                        cell.appendChild(div);
                    });
                }

                if (hasExtra) document.getElementById('extraCallsTable').style.display = '';

            } catch (error) {
                console.error('Error loading visits:', error);
            }
        }

        prevDateBtn.addEventListener('click', () => changeDate(-1));
        nextDateBtn.addEventListener('click', () => changeDate(1));

        printBtn.addEventListener('click', () => {
            const content = document.querySelector('.container-fluid').innerHTML;
            const printWindow = window.open('', '', 'height=800,width=1200');

            printWindow.document.write('<html><head><title>Print Visits</title>');
            printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>');
            printWindow.document.write(`
            <style>
                body { margin:0!important; padding:0!important; }
                .visit-box { padding:8px;margin:5px 0;border:1px solid #ddd;border-radius:6px;background-color:#f9f9f9; }
                table th, table td { text-align:left!important; vertical-align:top; padding:8px; max-width:200px; }
                .completed { background-color:#d4edda; color:#155724; padding:3px 8px; border-radius:4px; display:inline-block; }
                .not-completed { background-color:#f8d7da; color:#721c24; padding:3px 8px; border-radius:4px; display:inline-block; }
                button, input, a { display:none!important; }
                table { width:100%!important; border-collapse:collapse!important; }
                th, td { border:1px solid #ddd!important; }
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
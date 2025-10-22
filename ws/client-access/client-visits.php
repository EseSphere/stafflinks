<?php
include('client-header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("s", $uryyToeSS4);
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
                        <!-- Make table horizontally scrollable -->
                        <div class="table-responsive">
                            <table class="table table-bordered shadow-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th id="table-structure">Morning</th>
                                        <th id="table-structure" class="extra-col extra-morning">Extra Morning</th>
                                        <th id="table-structure">Lunch</th>
                                        <th id="table-structure" class="extra-col extra-lunch">Extra Lunch</th>
                                        <th id="table-structure">Tea</th>
                                        <th id="table-structure" class="extra-col extra-tea">Extra Tea</th>
                                        <th id="table-structure">Bed</th>
                                        <th id="table-structure" class="extra-col extra-bed">Extra Bed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="Morning"></td>
                                        <td id="Extra Morning" class="extra-col extra-morning"></td>
                                        <td id="Lunch"></td>
                                        <td id="Extra Lunch" class="extra-col extra-lunch"></td>
                                        <td id="Tea"></td>
                                        <td id="Extra Tea" class="extra-col extra-tea"></td>
                                        <td id="Bed"></td>
                                        <td id="Extra Bed" class="extra-col extra-bed"></td>
                                    </tr>
                                </tbody>
                            </table>
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
            loadVisits(formatDateValue(date));
        }

        function changeDate(days) {
            const newDate = new Date(currentDate);
            newDate.setDate(newDate.getDate() + days);
            setDate(newDate);
        }

        async function loadVisits(date) {
            try {
                const response = await fetch(`get_daily_visits.php?date=${encodeURIComponent(date)}&clientId=${encodeURIComponent(clientId)}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                document.querySelectorAll('.extra-col').forEach(col => col.style.display = 'none');
                ['Morning', 'Extra Morning', 'Lunch', 'Extra Lunch', 'Tea', 'Extra Tea', 'Bed', 'Extra Bed'].forEach(slot => {
                    const cell = document.getElementById(slot);
                    if (cell) cell.innerHTML = '';
                });

                const day = new Date(date).toLocaleDateString('en-GB', {
                    weekday: 'long'
                });
                dayTitle.textContent = day;

                const visitsForDay = data[day] || {};

                for (const timeSlot in visitsForDay) {
                    const visits = visitsForDay[timeSlot];
                    const cell = document.getElementById(timeSlot);
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

                    if (timeSlot.startsWith('Extra')) {
                        const extraType = timeSlot.split(' ')[1].toLowerCase();
                        document.querySelectorAll(`.extra-${extraType}`).forEach(col => col.style.display = '');
                    }
                }
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
                    body { margin: 0 !important; padding: 0 !important; }
                    .visit-box { padding: 8px;margin: 5px 0;border: 1px solid #ddd;border-radius: 6px;background-color: #f9f9f9; }
                    table th, table td { text-align: left !important; vertical-align: top; padding: 8px; }
                    .completed { background-color: #d4edda; color: #155724; padding: 3px 8px; border-radius: 4px; display: inline-block; }
                    .not-completed { background-color: #f8d7da; color: #721c24; padding: 3px 8px; border-radius: 4px; display: inline-block; }
                    /* Hide buttons, inputs, and links in print */
                    button, input, a { display: none !important; }
                    table {
                    width: 100% !important;
                    border-collapse: collapse !important;
                }
                th, td {
                    padding: 8px !important;
                    border: 1px solid #ddd !important;
                    text-align: left !important;
                }
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
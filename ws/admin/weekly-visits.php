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
                    <div id="visitsBox" class="mt-4"></div>
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
        const visitsBox = document.getElementById('visitsBox');
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
            loadWeeklyVisits(date);
        }

        function changeDate(days) {
            const newDate = new Date(currentDate);
            newDate.setDate(newDate.getDate() + days);
            setDate(newDate);
        }

        async function loadWeeklyVisits(startDate) {
            try {
                const start = formatDateValue(startDate);
                const response = await fetch(
                    `get_weekly_visits.php?startDate=${encodeURIComponent(start)}&clientId=${encodeURIComponent(clientId)}`
                );
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                visitsBox.innerHTML = ''; // Clear previous content

                let hasAnyVisits = false;

                for (let i = 0; i < 7; i++) {
                    const date = new Date(startDate);
                    date.setDate(date.getDate() + i);
                    const dayName = date.toLocaleDateString('en-GB', {
                        weekday: 'long'
                    });
                    const dayStr = formatDateValue(date);

                    const dayVisits = data[dayStr];
                    if (!dayVisits) continue; // Skip day if no visits

                    hasAnyVisits = true;

                    // Day container
                    const dayContainer = document.createElement('div');
                    dayContainer.className = 'mb-4';

                    const dayTitle = document.createElement('h5');
                    dayTitle.textContent = `${dayName} (${formatDateDisplay(date)})`;
                    dayContainer.appendChild(dayTitle);

                    // Table
                    const table = document.createElement('table');
                    table.className = 'table table-bordered shadow-sm';
                    table.innerHTML = `
                <thead class="table-light">
                    <tr>
                        <th>Morning</th>
                        <th class="extra-col extra-morning">Extra Morning</th>
                        <th>Lunch</th>
                        <th class="extra-col extra-lunch">Extra Lunch</th>
                        <th>Tea</th>
                        <th class="extra-col extra-tea">Extra Tea</th>
                        <th>Bed</th>
                        <th class="extra-col extra-bed">Extra Bed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="Morning"></td>
                        <td class="Extra Morning extra-col extra-morning"></td>
                        <td class="Lunch"></td>
                        <td class="Extra Lunch extra-col extra-lunch"></td>
                        <td class="Tea"></td>
                        <td class="Extra Tea extra-col extra-tea"></td>
                        <td class="Bed"></td>
                        <td class="Extra Bed extra-col extra-bed"></td>
                    </tr>
                </tbody>
                `;

                    // Fill visits
                    ['Morning', 'Extra Morning', 'Lunch', 'Extra Lunch', 'Tea', 'Extra Tea', 'Bed', 'Extra Bed']
                    .forEach(slot => {
                        const cell = table.querySelector(`.${slot.replace(' ', '.')}`);
                        const visits = dayVisits[slot] || [];
                        if (!cell || visits.length === 0) return;

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
                                window.location.href =
                                    `visit-details.php?userId=${visit.visit_id}&logs=${visit.client_specId}`;
                            });
                            cell.appendChild(div);
                        });

                        if (slot.startsWith('Extra')) {
                            const extraType = slot.split(' ')[1].toLowerCase();
                            table.querySelectorAll(`.extra-${extraType}`).forEach(col => col.style
                                .display = '');
                        }
                    });

                    dayContainer.appendChild(table);
                    visitsBox.appendChild(dayContainer);
                }

                if (!hasAnyVisits) {
                    visitsBox.innerHTML = '<p>No visits available for this week.</p>';
                }

            } catch (error) {
                console.error('Error loading visits:', error);
            }
        }

        prevDateBtn.addEventListener('click', () => changeDate(-1));
        nextDateBtn.addEventListener('click', () => changeDate(1));

        printBtn.addEventListener('click', () => {
            // Clone the container-fluid div
            const container = document.querySelector('.container-fluid');
            const clonedContainer = container.cloneNode(true);

            // Remove all buttons inside the cloned container
            clonedContainer.querySelectorAll('button').forEach(btn => btn.remove());

            // Remove empty tables or empty columns
            clonedContainer.querySelectorAll('table').forEach(table => {
                const headerCells = Array.from(table.querySelectorAll('thead th'));
                const bodyRow = table.querySelector('tbody tr');

                // Remove empty columns
                for (let i = headerCells.length - 1; i >= 0; i--) {
                    const td = bodyRow.children[i];
                    if (!td.querySelector('.visit-box')) {
                        td.remove();
                        headerCells[i].remove();
                    }
                }

                if (table.querySelectorAll('tbody td').length === 0) {
                    table.parentElement.remove(); // remove the whole day container
                }
            });

            if (!clonedContainer.querySelector('table')) {
                clonedContainer.innerHTML = '<p>No visits available for this week.</p>';
            }

            // Wrap day divs for page break (2 per page)
            clonedContainer.querySelectorAll('div.mb-4').forEach(div => div.classList.add('day-container'));

            // Open print window
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print Visits</title>');
            printWindow.document.write(
                '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>'
            );
            printWindow.document.write(`
        <style>
            @media print {
                body {
                    margin: 0 !important;
                    padding: 0 !important;
                    width: 100% !important;
                }
                table {
                    width: 100% !important;
                    border-collapse: collapse !important;
                }
                th, td {
                    padding: 8px !important;
                    border: 1px solid #ddd !important;
                    text-align: left !important;
                }
                .day-container {
                    page-break-inside: avoid;
                    margin-bottom: 20px;
                }
                .day-container:nth-child(2n) {
                    page-break-after: always;
                }
                button,a,input {
                    display: none !important;
                }
            }
            .visit-box {
                padding: 8px;
                margin: 5px 0;
                border: 1px solid #ddd;
                border-radius: 6px;
                background-color: #f9f9f9;
            }
            .completed {
                background-color: #d4edda;
                color: #155724;
                padding: 3px 8px;
                border-radius: 4px;
                display: inline-block;
            }
            .not-completed {
                background-color: #f8d7da;
                color: #721c24;
                padding: 3px 8px;
                border-radius: 4px;
                display: inline-block;
            }
        </style>
    `);
            printWindow.document.write('</head><body>');
            printWindow.document.write(clonedContainer.innerHTML);
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
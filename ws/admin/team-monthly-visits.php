<?php
include('team-header-contents.php');

// Get team details
$stmt = $conn->prepare("SELECT * FROM tbl_general_team_form
WHERE uryyTteamoeSS4 = ? AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyTteamoeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$teamName = trim(($row['team_first_name'] ?? '') . ' ' . ($row['team_last_name'] ?? ''));
$_SESSION['userId'] = $row['uryyTteamoeSS4'] ?? '';
$stmt->close();
?>

<link rel="stylesheet" type="text/css" href="./css/daily_visits.css" />
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="container-fluid">
            <?php require_once('team-visit-sub-header.php'); ?>
            <hr class="mb-3">
            <div class="row">
                <div class="col-md-9">
                    <div id="visitsBox" class="mt-4"></div>
                </div>
                <div class="col-md-3"></div>
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
        const teamId = <?= json_encode($_SESSION['teamId'] ?? '') ?>;

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
            datePicker.value = date.toLocaleDateString('en-GB', {
                month: 'long',
                year: 'numeric'
            });
            loadMonthlyVisits(date);
        }

        function changeMonth(offset) {
            const newDate = new Date(currentDate);
            newDate.setMonth(newDate.getMonth() + offset);
            setDate(newDate);
        }

        async function loadMonthlyVisits(monthDate) {
            try {
                const start = new Date(monthDate.getFullYear(), monthDate.getMonth(), 1);
                const end = new Date(monthDate.getFullYear(), monthDate.getMonth() + 1, 0);

                const response = await fetch(
                    `get_team_monthly_visits.php?startDate=${formatDateValue(start)}&endDate=${formatDateValue(end)}&userId=${encodeURIComponent(teamId)}`
                );
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                visitsBox.innerHTML = '';
                let hasAnyVisits = false;

                for (let d = new Date(start); d <= end; d.setDate(d.getDate() + 1)) {
                    const dayName = d.toLocaleDateString('en-GB', {
                        weekday: 'long'
                    });
                    const dayStr = formatDateValue(d);
                    const dayVisits = data[dayStr];
                    if (!dayVisits) continue;

                    hasAnyVisits = true;

                    const dayContainer = document.createElement('div');
                    dayContainer.className = 'mb-4';

                    const dayTitle = document.createElement('h5');
                    dayTitle.textContent = `${dayName} (${formatDateDisplay(d)})`;
                    dayContainer.appendChild(dayTitle);

                    const table = document.createElement('table');
                    table.className = 'table table-bordered shadow-sm';
                    table.innerHTML = `
                    <thead class="table-light">
                        <tr>
                            <th>Morning</th>
                            <th>Extra Morning</th>
                            <th>Lunch</th>
                            <th>Extra Lunch</th>
                            <th>Tea</th>
                            <th>Extra Tea</th>
                            <th>Bed</th>
                            <th>Extra Bed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="Morning"></td>
                            <td class="Extra.Morning"></td>
                            <td class="Lunch"></td>
                            <td class="Extra.Lunch"></td>
                            <td class="Tea"></td>
                            <td class="Extra.Tea"></td>
                            <td class="Bed"></td>
                            <td class="Extra.Bed"></td>
                        </tr>
                    </tbody>
                `;

                    ['Morning', 'Extra Morning', 'Lunch', 'Extra Lunch', 'Tea', 'Extra Tea', 'Bed', 'Extra Bed']
                    .forEach(slot => {
                        const cell = table.querySelector(`.${slot.replace(' ', '.')}`);
                        const visits = dayVisits[slot] || [];
                        if (!cell || visits.length === 0) return;

                        visits.forEach((visit, index) => {
                            const div = document.createElement('div');
                            div.className = 'visit-box';
                            div.style.animationDelay = `${index*150}ms`;
                            div.innerHTML = `
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 text-left"><strong>Team:</strong></div>
                                    <div class="col-8 text-left">${visit.team_name}</div>
                                    <div class="col-4 text-left"><strong>Carer:</strong></div>
                                    <div class="col-8 text-left">${visit.carer_name}</div>
                                    <div class="col-4 text-left"><strong>Planned:</strong></div>
                                    <div class="col-8 text-left">${visit.visit_time_in} - ${visit.visit_time_out}</div>
                                </div>
                                <div class="visit-status ${visit.visit_status.toLowerCase()==='completed'?'completed':'not-completed'}">
                                    ${visit.visit_status}
                                </div>
                            </div>
                        `;
                            div.addEventListener('click', () => {
                                window.location.href =
                                    `visit-details.php?userId=${visit.visit_id}&spec=${visit.team_specId}`;
                            });
                            cell.appendChild(div);
                        });
                    });

                    dayContainer.appendChild(table);
                    visitsBox.appendChild(dayContainer);
                }

                if (!hasAnyVisits) visitsBox.innerHTML = '<p>No team visits available for this month.</p>';

            } catch (error) {
                console.error('Error loading visits:', error);
            }
        }

        prevDateBtn.addEventListener('click', () => changeMonth(-1));
        nextDateBtn.addEventListener('click', () => changeMonth(1));

        // ✅ Print button
        printBtn.addEventListener('click', () => {
            const content = visitsBox.innerHTML;
            const printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Print Team Visits</title>');
            printWindow.document.write(
                '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>'
            );
            printWindow.document.write(`
            <style>
                body { margin: 20px; font-family: Arial, sans-serif; }
                .visit-box { padding:8px; margin:5px 0; border:1px solid #ddd; border-radius:6px; background:#f9f9f9; }
                table th, table td { text-align:left !important; vertical-align:top; padding:8px; }
                .completed { background:#d4edda; color:#155724; padding:3px 8px; border-radius:4px; display:inline-block; }
                .not-completed { background:#f8d7da; color:#721c24; padding:3px 8px; border-radius:4px; display:inline-block; }
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
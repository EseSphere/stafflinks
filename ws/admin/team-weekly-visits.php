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
                `get_team_weekly_visits.php?startDate=${encodeURIComponent(start)}&userId=${encodeURIComponent(teamId)}`
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
                if (!dayVisits) continue;

                hasAnyVisits = true;

                const dayContainer = document.createElement('div');
                dayContainer.className = 'mb-4';

                const dayTitle = document.createElement('h5');
                dayTitle.textContent = `${dayName} (${formatDateDisplay(date)})`;
                dayContainer.appendChild(dayTitle);

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
                                    <div class="col-4 text-left"><strong>Team:</strong></div>
                                    <div class="col-8 text-left">${visit.team_name}</div>
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
                                `visit-details.php?userId=${visit.visit_id}&spec=${visit.team_specId}`;
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
                visitsBox.innerHTML = '<p>No team visits available for this week.</p>';
            }

        } catch (error) {
            console.error('Error loading visits:', error);
        }
    }

    prevDateBtn.addEventListener('click', () => changeDate(-1));
    nextDateBtn.addEventListener('click', () => changeDate(1));

    // ✅ Print button functionality
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
                .visit-box { padding: 8px;margin: 5px 0;border: 1px solid #ddd;border-radius: 6px;background-color: #f9f9f9; }
                table th, table td { text-align: left !important; vertical-align: top; padding: 8px; }
                .completed { background-color: #d4edda; color: #155724; padding: 3px 8px; border-radius: 4px; display: inline-block; }
                .not-completed { background-color: #f8d7da; color: #721c24; padding: 3px 8px; border-radius: 4px; display: inline-block; }
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
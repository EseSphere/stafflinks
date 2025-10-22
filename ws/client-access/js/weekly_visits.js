async function loadVisits() {
    try {
        const response = await fetch('get_weekly_visits.php');
        if (!response.ok) throw new Error('Network response was not ok');
        const data = await response.json();
        const allCells = document.querySelectorAll('td[id]');
        allCells.forEach(cell => cell.innerHTML = '');
        const extraRowsWithVisits = new Set();
        const extraTimeSlotsMap = {
            'Extra Morning': 'Extra Morning',
            'Extra Lunch': 'Extra Lunch',
            'Extra Tea': 'Extra Tea',
            'Extra Bed': 'Extra Bed'
        };

        Object.entries(data).forEach(([day, timeSlots]) => {
            Object.entries(timeSlots).forEach(([timeSlot, visits]) => {
                const cellId = `${day}-${timeSlot}`;
                const cell = document.getElementById(cellId);
                if (!cell) return;

                visits.forEach((visit, index) => {
                    const div = document.createElement('div');
                    div.className = 'visit-box';
                    div.style.animationDelay = `${index * 150}ms`;

                    div.innerHTML = `
                                <div><strong>Client:</strong> ${visit.client_name}</div>
                                <div><strong>Carer:</strong> ${visit.carer_name}</div>
                                <div class="${visit.visit_status.toLowerCase() === 'completed' ? 'completed' : 'not-completed'}">
                                    ${visit.visit_status}
                                </div>
                            `;

                    cell.appendChild(div);
                });
                if (timeSlot.startsWith('Extra') && visits.length > 0) {
                    const rowHeaderText = extraTimeSlotsMap[timeSlot];
                    if (rowHeaderText) {
                        extraRowsWithVisits.add(rowHeaderText);
                    }
                }
            });
        });
        document.querySelectorAll('.extra-row').forEach(row => row.style.display = 'none');
        extraRowsWithVisits.forEach(timeSlot => {
            document.querySelectorAll('tbody tr').forEach(row => {
                const th = row.querySelector('th.time-label');
                if (th && th.textContent.trim() === timeSlot) {
                    row.style.display = '';
                }
            });
        });

    } catch (error) {
        console.error('Error loading visits:', error);
    }
}

window.onload = loadVisits;
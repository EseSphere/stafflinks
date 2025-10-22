const dbName = 'CompTaskDB';
const storeName = 'CompTaskResults';

function openDB() {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(dbName, 1);
        request.onerror = () => reject(new Error('DB failed'));
        request.onsuccess = () => resolve(request.result);
        request.onupgradeneeded = (e) => {
            const db = e.target.result;
            if (!db.objectStoreNames.contains(storeName)) {
                db.createObjectStore(storeName, { keyPath: 'id' });
            }
        };
    });
}

function saveToDB(data) {
    return openDB().then(db => {
        return new Promise((resolve, reject) => {
            const tx = db.transaction([storeName], 'readwrite');
            const store = tx.objectStore(storeName);
            store.put({ id: 1, data });
            tx.oncomplete = () => resolve();
            tx.onerror = () => reject(new Error('Save failed'));
        });
    });
}

function getFromDB() {
    return openDB().then(db => {
        return new Promise((resolve, reject) => {
            const tx = db.transaction([storeName], 'readonly');
            const store = tx.objectStore(storeName);
            const request = store.get(1);
            request.onsuccess = () => resolve(request.result?.data || null);
            request.onerror = () => reject(new Error('Read failed'));
        });
    });
}

function getOrdinalSuffix(day) {
    if (day >= 11 && day <= 13) return "th";
    switch (day % 10) {
        case 1: return "st";
        case 2: return "nd";
        case 3: return "rd";
        default: return "th";
    }
}

function formatDate(date) {
    const options = { month: 'short', day: 'numeric' };
    const day = date.getDate();
    const suffix = getOrdinalSuffix(day);
    return `${date.toLocaleDateString('en-US', options)}${suffix}`;
}

let chartInstance = null;

document.getElementById('trendForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const start = new Date(document.getElementById('start_date').value);
    const end = new Date(document.getElementById('end_date').value);
    const trend = document.getElementById('trend').value;
    const period = parseInt(document.getElementById('period').value);

    const totalDays = (end - start) / (1000 * 60 * 60 * 24) + 1;
    const rangeSize = trend === 'weeks' ? 7 : 1;
    const intervalSize = Math.floor(rangeSize * (totalDays / (rangeSize * period)));

    const ranges = [];
    let currentStart = new Date(start);

    for (let i = 0; i < period; i++) {
        const currentEnd = new Date(currentStart);
        currentEnd.setDate(currentEnd.getDate() + intervalSize - 1);
        if (currentEnd > end) currentEnd.setTime(end.getTime());

        ranges.push({
            label: `${formatDate(currentStart)} to ${formatDate(currentEnd)}`,
            start: currentStart.toISOString().slice(0, 10),
            end: currentEnd.toISOString().slice(0, 10)
        });

        currentStart = new Date(currentEnd);
        currentStart.setDate(currentStart.getDate() + 1);
    }

    try {
        const response = await fetch('processing-completed-task.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ranges })
        });

        const data = await response.json();

        if (data.error) throw new Error(data.error);

        await saveToDB(data);
        renderChart(data.labels, data.counts);
        renderBreakdown(data.records); //New function call to update breakdown
    } catch (error) {
        console.error('Error during fetch or DB save:', error);
    }
});

function renderChart(labels, counts) {
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded.');
        return;
    }

    const canvas = document.getElementById('barChartCompTask');
    if (!canvas) {
        console.error('Canvas element with ID "barChartCompTask" not found.');
        return;
    }

    const ctx = canvas.getContext('2d');

    if (chartInstance) {
        chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '% of completed tasks',
                data: counts,
                backgroundColor: 'rgba(192, 57, 43,1.0)',
                borderColor: 'rgba(192, 57, 43,1.0)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function renderBreakdown(records) {
    const container = document.getElementById('breakdownContainer');
    if (!container) return;

    container.innerHTML = ''; // Clear old entries

    const chunks = [];
    for (let i = 0; i < records.length; i += 10) {
        chunks.push(records.slice(i, i + 10));
    }

    chunks.forEach(chunk => {
        const col = document.createElement('div');
        col.className = 'col-md-4 col-lg-4 col-sm-4 col-xl-4 mt-4';

        const card = document.createElement('div');
        card.className = 'card card-dark p-3';

        const title = document.createElement('h5');
        title.innerHTML = '<strong style="color:white;">Column result</strong>';
        card.appendChild(title);

        chunk.forEach(item => {
            const div = document.createElement('div');
            div.className = 'd-flex justify-content-between border-bottom py-2';
            div.innerHTML = `<strong>${item.name}</strong><span>${item.count} • ${item.percent}% • ${item.volume}</span>`;
            card.appendChild(div);
        });

        col.appendChild(card);
        container.appendChild(col);
    });
}

// Load saved data on page load
window.addEventListener('DOMContentLoaded', async () => {
    try {
        const saved = await getFromDB();
        if (saved) {
            renderChart(saved.labels, saved.counts);
            renderBreakdown(saved.records); // Show breakdown from cached data
        }
    } catch (error) {
        console.error('Failed to load saved data:', error);
    }
});

// Download chart as image
document.getElementById('downloadChart').addEventListener('click', function () {
    const canvas = document.getElementById('barChartCompTask');
    if (!canvas) {
        console.error('Canvas element not found for download.');
        return;
    }

    const image = canvas.toDataURL("image/png", 1.0);

    const link = document.createElement('a');
    link.href = image;
    link.download = 'care-plan-chart.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});

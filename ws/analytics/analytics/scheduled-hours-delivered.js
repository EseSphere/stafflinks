const dbName = 'SchheduledHourDeliveredDB';;
const storeName = 'ScheduledHourDeliveredResults';

function openDB() {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(dbName, 1);
        request.onerror = () => reject('DB failed');
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
            tx.onerror = () => reject('Save failed');
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
            request.onerror = () => reject('Read failed');
        });
    });
}

function formatDate(date) {
    const options = { month: 'short', day: 'numeric' };
    const day = date.getDate();
    const suffixes = ["st", "nd", "rd"];
    const suffix = (day > 3 && day < 21) || (day % 10 > 3) ? "th" : suffixes[(day % 10) - 1];
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
    let rangeSize = trend === 'weeks' ? 7 : 1;
    let intervalSize = rangeSize * (totalDays / (rangeSize * period));

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

    const response = await fetch('processing-scheduled-hour-delivered.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ranges })
    });

    const data = await response.json();
    await saveToDB(data);
    renderChart(data.labels, data.counts);
});

function renderChart(labels, counts) {
    const ctx = document.getElementById('barChartCareTask').getContext('2d');

    if (chartInstance) {
        chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'AVG scheduled hour visit updated',
                data: counts,
                backgroundColor: 'rgba(41, 128, 185,1.0)',
                borderColor: 'rgba(41, 128, 185,1.0)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Optional: Load from cache on page load
window.addEventListener('DOMContentLoaded', async () => {
    const saved = await getFromDB();
    if (saved) {
        renderChart(saved.labels, saved.counts);
    }
});

document.getElementById('downloadChart').addEventListener('click', function () {
    const canvas = document.getElementById('barChartCareTask');
    const image = canvas.toDataURL("image/png", 1.0);
    
    const link = document.createElement('a');
    link.href = image;
    link.download = 'care-plan-chart.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});


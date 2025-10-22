const dbName = 'CareTaskDB';
const storeName = 'CareTaskResults';

let chartInstance = null; // Ensure this is declared globally

// Open IndexedDB
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

// Retrieve data from IndexedDB
function getFromDB() {
    return openDB().then(db => {
        return new Promise((resolve, reject) => {
            const tx = db.transaction([storeName], 'readonly');
            const store = tx.objectStore(storeName);
            const request = store.get(1); // Get data with id 1

            request.onsuccess = () => {
                const data = request.result?.data || null;
                console.log("Data fetched from IndexedDB: ", data); // Detailed log
                if (data) {
                    resolve(data);
                } else {
                    reject('No data found');
                }
            };

            request.onerror = () => reject('Failed to fetch data');
        });
    });
}

// Render the CareTask chart using Chart.js
function renderChart(labels, counts) {
    const ctx = document.getElementById('barChartCareTask').getContext('2d');

    if (chartInstance) {
        chartInstance.destroy(); // Destroy existing chart if needed
    }

    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'AVG Care task scheduled updated',
                data: counts,
                backgroundColor: 'rgba(22, 160, 133,1.0)',
                borderColor: 'rgba(22, 160, 133,1.0)',
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

// Load data and render the chart on page load
window.addEventListener('DOMContentLoaded', async () => {
    try {
        const savedCareTask = await getFromDB(); // Fetch CareTask data
        console.log("CareTask data fetched successfully:", savedCareTask);

        if (savedCareTask) {
            console.log("Rendering chart with data:", savedCareTask);
            renderChart(savedCareTask.labels, savedCareTask.counts); // Render chart
        } else {
            console.error("No data found for CareTask in IndexedDB.");
        }
    } catch (err) {
        console.error("Error loading data or rendering the chart:", err);
    }
});

const dbName = 'CarePlanDB';
const storeName = 'CarePlanResults';

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

function formatDateRange(startDate, endDate) {
    const options = { month: 'short', day: 'numeric' };
    const startStr = startDate.toLocaleDateString('en-US', options);
    const endStr = endDate.toLocaleDateString('en-US', options);
    return `${startStr} - ${endStr}`;
}

function generateWeeklyLabels(start, numberOfWeeks) {
    const labels = [];
    let currentDate = new Date(start);

    for (let i = 0; i < numberOfWeeks; i++) {
        const startDate = new Date(currentDate);
        const endDate = new Date(currentDate);
        endDate.setDate(endDate.getDate() + 6); // 7-day range

        labels.push(formatDateRange(startDate, endDate));
        currentDate.setDate(currentDate.getDate() + 7);
    }

    return labels;
}

let chartInstance = null;

function renderChart(labels, counts) {
    const ctx = document.getElementById('barChartCarePlan').getContext('2d');

    if (chartInstance) {
        chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Completed care plans',
                data: counts,
                backgroundColor: 'rgba(192, 57, 43,1.0)',
                borderColor: 'rgba(192, 57, 43,1.0)',
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

// Display both charts simultaneously on page load
window.addEventListener('DOMContentLoaded', async () => {
    try {
        const savedCarePlan = await getFromDB(); // Get CarePlan data
        if (savedCarePlan) {
            const startingDate = new Date('2025-04-01');
            const dynamicLabels = generateWeeklyLabels(startingDate, savedCarePlan.counts.length);
            renderChart(dynamicLabels, savedCarePlan.counts);
        } else {
            console.warn("No cached data found in IndexedDB for CarePlan.");
        }
    } catch (error) {
        console.error("Error loading CarePlan data:", error);
    }
});

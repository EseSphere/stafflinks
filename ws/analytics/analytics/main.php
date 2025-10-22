<?php include_once('header.php'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-4">
            <h2>Care Plans Completed</h2>
            <canvas id="barChartCarePlan" width="400" height="200"></canvas>
        </div>
        <div class="col-md-6 mb-4">
            <h2>Care Tasks Scheduled</h2>
            <canvas id="barChartCareTask" width="400" height="200"></canvas>
        </div>
    </div>
</div>


<script>
    // ---------------------------
    // Shared Utility Functions
    // ---------------------------
    function formatDateRange(startDate, endDate) {
        const options = {
            month: 'short',
            day: 'numeric'
        };
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
            endDate.setDate(endDate.getDate() + 6);
            labels.push(formatDateRange(startDate, endDate));
            currentDate.setDate(currentDate.getDate() + 7);
        }
        return labels;
    }

    // ---------------------------
    // CarePlan IndexedDB Functions
    // ---------------------------
    const carePlanDBName = 'CarePlanDB';
    const carePlanStoreName = 'CarePlanResults';

    function openCarePlanDB() {
        return new Promise((resolve, reject) => {
            const request = indexedDB.open(carePlanDBName, 1);
            request.onerror = () => reject('CarePlan DB failed');
            request.onsuccess = () => resolve(request.result);
            request.onupgradeneeded = (e) => {
                const db = e.target.result;
                if (!db.objectStoreNames.contains(carePlanStoreName)) {
                    db.createObjectStore(carePlanStoreName, {
                        keyPath: 'id'
                    });
                }
            };
        });
    }

    function getCarePlanFromDB() {
        return openCarePlanDB().then(db => {
            return new Promise((resolve, reject) => {
                const tx = db.transaction([carePlanStoreName], 'readonly');
                const store = tx.objectStore(carePlanStoreName);
                const request = store.get(1);
                request.onsuccess = () => resolve(request.result?.data || null);
                request.onerror = () => reject('Read failed');
            });
        });
    }

    // ---------------------------
    // CareTask IndexedDB Functions
    // ---------------------------
    const careTaskDBName = 'CareTaskDB';
    const careTaskStoreName = 'CareTaskResults';

    function openCareTaskDB() {
        return new Promise((resolve, reject) => {
            const request = indexedDB.open(careTaskDBName, 1);
            request.onerror = () => reject('CareTask DB failed');
            request.onsuccess = () => resolve(request.result);
            request.onupgradeneeded = (e) => {
                const db = e.target.result;
                if (!db.objectStoreNames.contains(careTaskStoreName)) {
                    db.createObjectStore(careTaskStoreName, {
                        keyPath: 'id'
                    });
                }
            };
        });
    }

    function getCareTaskFromDB() {
        return openCareTaskDB().then(db => {
            return new Promise((resolve, reject) => {
                const tx = db.transaction([careTaskStoreName], 'readonly');
                const store = tx.objectStore(careTaskStoreName);
                const request = store.get(1);
                request.onsuccess = () => resolve(request.result?.data || null);
                request.onerror = () => reject('Failed to fetch data');
            });
        });
    }

    // ---------------------------
    // Chart Rendering
    // ---------------------------
    let carePlanChartInstance = null;
    let careTaskChartInstance = null;

    function renderCarePlanChart(labels, counts) {
        const ctx = document.getElementById('barChartCarePlan').getContext('2d');
        if (carePlanChartInstance) carePlanChartInstance.destroy();
        carePlanChartInstance = new Chart(ctx, {
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

    function renderCareTaskChart(labels, counts) {
        const ctx = document.getElementById('barChartCareTask').getContext('2d');
        if (careTaskChartInstance) careTaskChartInstance.destroy();
        careTaskChartInstance = new Chart(ctx, {
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

    // ---------------------------
    // Page Load Logic
    // ---------------------------
    window.addEventListener('DOMContentLoaded', async () => {
        try {
            // Load and render CarePlan
            const savedCarePlan = await getCarePlanFromDB();
            if (savedCarePlan) {
                const startingDate = new Date('2025-04-01');
                const labels = generateWeeklyLabels(startingDate, savedCarePlan.counts.length);
                renderCarePlanChart(labels, savedCarePlan.counts);
            } else {
                console.warn("No cached data found in IndexedDB for CarePlan.");
            }

            // Load and render CareTask
            const savedCareTask = await getCareTaskFromDB();
            if (savedCareTask) {
                renderCareTaskChart(savedCareTask.labels, savedCareTask.counts);
            } else {
                console.warn("No cached data found in IndexedDB for CareTask.");
            }

        } catch (error) {
            console.error("Error loading chart data:", error);
        }
    });
</script>

<?php include_once('footer.php'); ?>
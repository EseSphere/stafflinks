<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Care Plan Charts Grid</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .chart-card {
            position: relative;
        }

        .download-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
    </style>
</head>

<body class="p-4 bg-light">

    <div class="container">
        <h3 class="mb-4">Care Plan Charts</h3>
        <div id="chartsGrid" class="row g-4"></div>
    </div>

    <script>
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
                        db.createObjectStore(storeName, {
                            keyPath: 'id',
                            autoIncrement: true
                        });
                    }
                };
            });
        }

        function saveToDB(data) {
            return openDB().then(db => {
                return new Promise((resolve, reject) => {
                    const tx = db.transaction([storeName], 'readwrite');
                    const store = tx.objectStore(storeName);
                    store.add({
                        data
                    }); // autoIncrement id
                    tx.oncomplete = () => resolve();
                    tx.onerror = () => reject('Save failed');
                });
            });
        }

        function getAllFromDB() {
            return openDB().then(db => {
                return new Promise((resolve, reject) => {
                    const tx = db.transaction([storeName], 'readonly');
                    const store = tx.objectStore(storeName);
                    const request = store.getAll();
                    request.onsuccess = () => resolve(request.result || []);
                    request.onerror = () => reject('Read failed');
                });
            });
        }

        function renderAllCharts(charts) {
            const container = document.getElementById('chartsGrid');
            container.innerHTML = ''; // clear first
            charts.forEach((entry, index) => {
                const chartId = `chart${index}`;
                const col = document.createElement('div');
                col.className = 'col-md-6';

                col.innerHTML = `
          <div class="card p-3 chart-card">
            <button class="btn btn-sm btn-outline-secondary download-btn" title="Download Chart" data-chart="${chartId}">
              <i class="fa fa-download"></i>
            </button>
            <canvas id="${chartId}" height="300"></canvas>
          </div>
        `;
                container.appendChild(col);
                renderChart(chartId, entry.data.labels, entry.data.counts);
            });

            // Set up download buttons
            document.querySelectorAll('.download-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const chartId = button.getAttribute('data-chart');
                    const canvas = document.getElementById(chartId);
                    const image = canvas.toDataURL("image/png", 1.0);
                    const link = document.createElement('a');
                    link.href = image;
                    link.download = `${chartId}.png`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
            });
        }

        function renderChart(canvasId, labels, counts) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: 'Records Count',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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

        window.addEventListener('DOMContentLoaded', async () => {
            // Example data to populate IndexedDB (only once for demo)
            const demoData = [{
                    labels: ["Week 1", "Week 2"],
                    counts: [5, 10]
                },
                {
                    labels: ["Week 3", "Week 4"],
                    counts: [7, 3]
                },
                {
                    labels: ["Week 5", "Week 6"],
                    counts: [11, 4]
                }
            ];

            const existing = await getAllFromDB();
            if (existing.length === 0) {
                for (const item of demoData) {
                    await saveToDB(item);
                }
            }

            const charts = await getAllFromDB();
            renderAllCharts(charts);
        });
    </script>
</body>

</html>
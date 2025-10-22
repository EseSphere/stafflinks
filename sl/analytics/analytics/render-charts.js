
        // Configuration for each DB
        const dbConfigs = [{
                dbName: "CarePlanDB",
                storeName: "CarePlanResults",
                chartType: "bar",
                backgroundColor: "rgba(255, 99, 132, 0.6)",
                borderColor: "rgba(255, 99, 132, 1)"
            },
            {
                dbName: "CareTaskDB",
                storeName: "CareTaskResults",
                chartType: "line",
                backgroundColor: "rgba(54, 162, 235, 0.6)",
                borderColor: "rgba(54, 162, 235, 1)"
            },
            {
                dbName: "CareMedsDB",
                storeName: "CareMedsResults",
                chartType: "bar",
                backgroundColor: "rgba(255, 206, 86, 0.6)",
                borderColor: "rgba(255, 206, 86, 1)"
            },
            {
                dbName: "ReportedVisitDB",
                storeName: "ReportedVisitResults",
                chartType: "line",
                backgroundColor: "rgba(75, 192, 192, 0.6)",
                borderColor: "rgba(75, 192, 192, 1)"
            },
            {
                dbName: "ScheduledVisitDB",
                storeName: "ScheduledVisitResults",
                chartType: "bar",
                backgroundColor: "rgba(153, 102, 255, 0.6)",
                borderColor: "rgba(153, 102, 255, 1)"
            },
            {
                dbName: "ScheduledHoursDelDB",
                storeName: "ScheduledHoursDelResults",
                chartType: "line",
                backgroundColor: "rgba(255, 159, 64, 0.6)",
                borderColor: "rgba(255, 159, 64, 1)"
            },
            {
                dbName: "VisitFullfiledDB",
                storeName: "VisitFullfiledResults",
                chartType: "bar",
                backgroundColor: "rgba(201, 203, 207, 0.6)",
                borderColor: "rgba(201, 203, 207, 1)"
            },
            {
                dbName: "ForceCheckInDB",
                storeName: "ForceCheckInResults",
                chartType: "line",
                backgroundColor: "rgba(255, 99, 71, 0.6)",
                borderColor: "rgba(255, 99, 71, 1)"
            },
            {
                dbName: "CompTaskDB",
                storeName: "CompTaskResults",
                chartType: "bar",
                backgroundColor: "rgba(60, 179, 113, 0.6)",
                borderColor: "rgba(60, 179, 113, 1)"
            },
            {
                dbName: "CompletedMedicationDB",
                storeName: "CompletedMedicationResults",
                chartType: "line",
                backgroundColor: "rgba(106, 90, 205, 0.6)",
                borderColor: "rgba(106, 90, 205, 1)"
            }
        ];

        async function openDB(dbName) {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open(dbName);
                request.onerror = () => reject('Failed to open DB');
                request.onsuccess = () => resolve(request.result);
            });
        }

        async function getAllRecords(db, storeName) {
            return new Promise((resolve, reject) => {
                const transaction = db.transaction(storeName, 'readonly');
                const store = transaction.objectStore(storeName);
                const request = store.getAll();
                request.onerror = () => reject('Failed to get records');
                request.onsuccess = () => resolve(request.result);
            });
        }

        async function createCharts() {
            const chartsContainer = document.getElementById('charts-container');
            let row;

            for (let i = 0; i < dbConfigs.length; i++) {
                const {
                    dbName,
                    storeName,
                    chartType,
                    backgroundColor,
                    borderColor
                } = dbConfigs[i];
                try {
                    const db = await openDB(dbName);
                    const records = await getAllRecords(db, storeName);

                    if (!records.length) continue; // Skip if no data

                    if (i % 2 === 0) {
                        row = document.createElement('div');
                        row.className = 'row';
                        chartsContainer.appendChild(row);
                    }

                    const col = document.createElement('div');
                    col.className = 'col-md-6 chart-container';

                    const canvas = document.createElement('canvas');
                    canvas.id = `chart-${dbName}`;
                    col.appendChild(canvas);
                    row.appendChild(col);

                    const {
                        counts,
                        labels
                    } = records[0].data;

                    new Chart(canvas.getContext('2d'), {
                        type: chartType,
                        data: {
                            labels: labels,
                            datasets: [{
                                label: dbName,
                                data: counts,
                                backgroundColor: backgroundColor,
                                borderColor: borderColor,
                                borderWidth: 1,
                                fill: chartType === 'line' ? true : false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: `${dbName} Chart`
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    db.close();
                } catch (error) {
                    console.error(`Error with DB ${dbName}:`, error);
                }
            }
        }

        window.onload = createCharts;

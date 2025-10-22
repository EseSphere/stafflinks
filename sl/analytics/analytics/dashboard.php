<?php include_once("header.php"); ?>
<style>
  .chart-container {
    margin-bottom: 2rem;
  }

  canvas {
    width: 100% !important;
    height: 300px !important;
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Analytics Chart</h5>
            </div>
            <div>
              <!-- Placeholder for additional controls, if any -->
            </div>
          </div>
          <div id="chart"></div>
        </div>
      </div>
    </div>
  </div>

  <button id="print-btn" class="btn btn-primary mb-4">
    <i class="fas fa-print"></i> Print
  </button>
  <div class="container mt-5" id="charts-container">
    <!-- Charts will be injected here -->
  </div>
  <div class="py-6 px-6 text-center"></div>
</div>

<script>
  // Configuration for each DB
  const dbConfigs = [{
      dbName: "CarePlanDB",
      storeName: "CarePlanResults",
      displayName: "Care Plan Overview",
      chartType: "bar",
      backgroundColor: "rgba(231, 76, 60,1.0)",
      borderColor: "rgba(192, 57, 43,1.0)"
    },
    {
      dbName: "CareTaskDB",
      storeName: "CareTaskResults",
      displayName: "Care Task Progress",
      chartType: "bar",
      backgroundColor: "rgba(26, 188, 156,1.0)",
      borderColor: "rgba(22, 160, 133,1.0)"
    },
    {
      dbName: "CareMedsDB",
      storeName: "CareMedsResults",
      displayName: "Medication Administration",
      chartType: "bar",
      backgroundColor: "rgba(155, 89, 182,1.0)",
      borderColor: "rgba(142, 68, 173,1.0)"
    },
    {
      dbName: "ReportedVisitDB",
      storeName: "ReportedVisitResults",
      displayName: "Reported Visits",
      chartType: "pie",
      backgroundColor: "rgba(75, 192, 192, 0.6)",
      borderColor: "rgba(245, 246, 250,1.0)"
    },
    {
      dbName: "ScheduledVisitDB",
      storeName: "ScheduledVisitResults",
      displayName: "Scheduled Visits",
      chartType: "bar",
      backgroundColor: "rgba(241, 196, 15,1.0)",
      borderColor: "rgba(243, 156, 18,1.0)"
    },
    {
      dbName: "ScheduledHoursDelDB",
      storeName: "ScheduledHoursDelResults",
      displayName: "Delivered Scheduled Hours",
      chartType: "line",
      backgroundColor: "rgba(52, 152, 219,1.0)",
      borderColor: "rgba(41, 128, 185,1.0)"
    },
    {
      dbName: "VisitFullfiledDB",
      storeName: "VisitFullfiledResults",
      displayName: "Visits Fulfilled",
      chartType: "bar",
      backgroundColor: "rgba(39, 60, 117,1.0)",
      borderColor: "rgba(25, 42, 86,1.0)"
    },
    {
      dbName: "ForceCheckInDB",
      storeName: "ForceCheckInResults",
      displayName: "Force Check-Ins",
      chartType: "pie",
      backgroundColor: "rgba(211, 84, 0,1.0)",
      borderColor: "rgba(245, 246, 250,1.0)"
    },
    {
      dbName: "CompTaskDB",
      storeName: "CompTaskResults",
      displayName: "Completed Tasks",
      chartType: "bar",
      backgroundColor: "rgba(52, 73, 94,1.0)",
      borderColor: "rgba(44, 62, 80,1.0)"
    },
    {
      dbName: "CompletedMedicationDB",
      storeName: "CompletedMedicationResults",
      displayName: "Completed Medications",
      chartType: "line",
      backgroundColor: "rgba(39, 60, 117,1.0)",
      borderColor: "rgba(25, 42, 86,1.0)"
    }
  ];

  async function openDB(dbName) {
    const databases = await indexedDB.databases();
    const exists = databases.some(db => db.name === dbName);
    if (!exists) {
      throw new Error(`Database ${dbName} does not exist`);
    }

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
        displayName,
        chartType,
        backgroundColor,
        borderColor
      } = dbConfigs[i];

      try {
        const db = await openDB(dbName);
        const records = await getAllRecords(db, storeName);

        if (!records.length) {
          db.close();
          continue;
        }

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
              label: displayName,
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
                text: displayName
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
        console.warn(`Skipping ${dbName}: ${error.message}`);
      }
    }
  }


  // Print functionality - FIXED
  document.getElementById('print-btn').addEventListener('click', async function() {
    const chartsContainer = document.getElementById('charts-container');
    const canvases = chartsContainer.querySelectorAll('canvas');

    const newWindow = window.open('', '', 'width=800,height=600');
    newWindow.document.write('<html><head><title>Care Mangement Trends</title>');
    newWindow.document.write('<style>body { font-family: Arial, sans-serif; margin: 0; padding: 0; }');
    newWindow.document.write('.container { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin: 20px; }');
    newWindow.document.write('.container img { width: 100%; height: auto; display: block; }');
    newWindow.document.write('@media print { .container { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; } }');
    newWindow.document.write('@media print { .page-break { page-break-before: always; } }</style>');
    newWindow.document.write('</head><body>');

    let chartCount = 0;
    let chartLimit = 8;

    // Create the first container
    newWindow.document.write('<div class="container">');
    newWindow.document.write('<h4>Care Management Trends</h4><br />');

    for (let canvas of canvases) {
      if (chartCount >= chartLimit) {
        // Add page break and start a new container for the next page
        newWindow.document.write('</div><div class="page-break"></div><div class="container">');
        chartCount = 0; // Reset chart count for new page
      }

      const imgData = canvas.toDataURL('image/png');
      newWindow.document.write('<div><img src="' + imgData + '"></div>');
      chartCount++;
    }

    // Close the last container
    newWindow.document.write('</div></body></html>');
    newWindow.document.close();

    newWindow.onload = function() {
      setTimeout(function() {
        newWindow.print();
      }, 500);
    };
  });

  window.onload = createCharts
</script>

<?php include_once("footer.php"); ?>
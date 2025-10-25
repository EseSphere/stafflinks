<!-- QR Scanner Library -->
<script src="https://unpkg.com/html5-qrcode"></script>

<style>
    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
        background: #000;
        font-family: "Inter", system-ui, sans-serif;
        color: #fff;
    }

    /* Fullscreen camera feed */
    #qr-reader {
        width: 100vw !important;
        height: 100vh !important;
        position: absolute;
        top: 0;
        left: 0;
        background: #000;
        object-fit: cover !important;
        z-index: 1;
    }

    /* Transparent overlay for the scanner frame */
    .overlay {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 5;
    }

    /* Perfect square scanner frame */
    .scanner-frame {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 3px solid rgba(56, 189, 248, 0.9);
        border-radius: 16px;
        box-shadow: 0 0 35px rgba(56, 189, 248, 0.4);
        animation: pulse 2.5s infinite ease-in-out;
        aspect-ratio: 1 / 1;
        width: 60vmin;
        /* scales smoothly with screen size */
    }

    /* Adjust the frame size for mobile */
    @media (max-width: 768px) {
        .scanner-frame {
            width: 80vmin;
            /* slightly larger on smaller screens */
        }
    }

    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 0 25px rgba(56, 189, 248, 0.3);
        }

        50% {
            box-shadow: 0 0 45px rgba(56, 189, 248, 0.7);
        }
    }

    /* Header / instructions */
    .scanner-header {
        position: absolute;
        top: 24px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        z-index: 10;
    }

    .scanner-header h2 {
        font-size: 3.5rem;
        margin: 0;
    }

    .scanner-header p {
        font-size: 2.5rem;
        color: #e2e8f0;
        margin-top: 8px;
    }

    /* Scan result display */
    #qr-reader-results {
        position: absolute;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.55);
        padding: 10px 16px;
        border-radius: 10px;
        color: #10b981;
        font-size: 1rem;
        font-weight: 600;
        z-index: 10;
        display: none;
    }

    /* Loading animation */
    .loading {
        position: absolute;
        bottom: 80px;
        left: 50%;
        transform: translateX(-50%);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 15;
    }

    .loading span {
        width: 8px;
        height: 8px;
        margin: 0 3px;
        background: #38bdf8;
        border-radius: 50%;
        animation: bounce 1.2s infinite ease-in-out both;
    }

    .loading span:nth-child(1) {
        animation-delay: -0.24s;
    }

    .loading span:nth-child(2) {
        animation-delay: -0.12s;
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1.0);
        }
    }
</style>

<div class="scanner-header">
    <h2>QR Code Check-In</h2>
    <p>Align the QR code within the square to check in</p>
</div>

<div id="qr-reader"></div>

<div class="overlay">
    <div class="scanner-frame"></div>
</div>

<div id="qr-reader-results"></div>

<div id="loading-indicator" class="loading">
    <span></span><span></span><span></span>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    // -----------------------------
    // IndexedDB Helper
    // -----------------------------
    function openDB() {
        return new Promise((resolve, reject) => {
            const request = indexedDB.open('stafflinks');
            request.onupgradeneeded = e => {
                const db = e.target.result;
                if (!db.objectStoreNames.contains('tbl_daily_shift_records')) {
                    const store = db.createObjectStore('tbl_daily_shift_records', {
                        keyPath: 'id'
                    });
                    const columns = [
                        'shift_status', 'shift_date', 'planned_timeIn', 'planned_timeOut', 'shift_start_time',
                        'client_name', 'uryyToeSS4', 'col_care_call', 'client_group', 'carer_Name', 'col_carer_Id',
                        'col_area_Id', 'col_company_Id', 'col_call_status', 'col_miles', 'col_mileage',
                        'col_visit_status', 'col_visit_confirmation', 'col_care_call_Id', 'col_postcode', 'dateTime'
                    ];
                    columns.forEach(col => store.createIndex(col, col, {
                        unique: false
                    }));
                }
            };
            request.onsuccess = e => resolve(e.target.result);
            request.onerror = e => reject(e.target.error);
        });
    }

    async function getRecordById(storeName, key) {
        const db = await openDB();
        return new Promise((resolve, reject) => {
            const tx = db.transaction(storeName, 'readonly');
            const store = tx.objectStore(storeName);
            const req = store.getAll();
            req.onsuccess = e => {
                const record = e.target.result.find(r =>
                    r.id == key || r.uryyToeSS4 == key || r.uryyTteamoeSS4 == key
                );
                resolve(record || null);
            };
            req.onerror = e => reject(e.target.error);
        });
    }

    async function updateCallStatus(id, status) {
        const db = await openDB();
        return new Promise((resolve, reject) => {
            const tx = db.transaction('tbl_schedule_calls', 'readwrite');
            const store = tx.objectStore('tbl_schedule_calls');
            const getAllReq = store.getAll();
            getAllReq.onsuccess = e => {
                const rec = (e.target.result || []).find(r =>
                    r.id == id || r.uryyToeSS4 == id || r.uryyTteamoeSS4 == id
                );
                if (rec) {
                    rec.call_status = status;
                    rec.col_call_status = status;
                    store.put(rec);
                }
            };
            tx.oncomplete = () => resolve(true);
            tx.onerror = e => reject(e.target.error);
        });
    }

    function getDistanceMiles(lat1, lon1, lat2, lon2) {
        const R = 3958.8;
        const toRad = deg => deg * Math.PI / 180;
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);
        const a = Math.sin(dLat / 2) ** 2 +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * Math.sin(dLon / 2) ** 2;
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    function getWorkedHours(start, end) {
        const s = new Date(start),
            e = new Date(end);
        if (isNaN(s.getTime()) || isNaN(e.getTime())) return 0;
        return Math.max((e - s) / (1000 * 60 * 60), 0);
    }

    async function copyShiftRecord(id) {
        const visit = await getRecordById('tbl_schedule_calls', id);
        if (!visit) throw new Error('Visit not found.');
        const client = await getRecordById('tbl_general_client_form', visit.uryyToeSS4);
        const carer = await getRecordById('tbl_general_team_form', visit.first_carer_Id);

        const position = await new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(resolve, reject, {
                enableHighAccuracy: true
            });
        });

        const miles = getDistanceMiles(
            position.coords.latitude,
            position.coords.longitude,
            parseFloat(client.client_latitude || 0),
            parseFloat(client.client_longitude || 0)
        );

        const totalMileage = (parseFloat(carer.col_mileage || 0) * parseFloat(miles.toFixed(2))).toFixed(2);
        const now = new Date();
        const shiftStartTime = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
        const workedHours = getWorkedHours(visit.dateTime_in, visit.dateTime_out);
        const careCallRate = Math.round(workedHours * (parseFloat(visit.pay_rate) || 0) * 100) / 100;
        const clientRate = Math.round(workedHours * (parseFloat(visit.client_rate) || 0) * 100) / 100;

        const shiftRecord = {
            id: visit.id,
            shift_status: 'Checked in',
            shift_date: visit.Clientshift_Date,
            planned_timeIn: visit.dateTime_in,
            planned_timeOut: visit.dateTime_out,
            shift_start_time: shiftStartTime,
            shift_end_time: null,
            client_name: visit.client_name,
            uryyToeSS4: visit.uryyToeSS4,
            col_care_call: visit.care_calls,
            client_group: visit.client_area,
            carer_Name: visit.first_carer,
            task_note: null,
            col_carer_Id: visit.first_carer_Id,
            col_area_Id: visit.col_area_Id,
            col_company_Id: visit.col_company_Id,
            col_call_status: 'in-progress',
            col_carecall_rate: careCallRate.toFixed(2),
            col_miles: miles.toFixed(2),
            col_mileage: totalMileage,
            col_worked_time: workedHours.toFixed(2),
            col_client_rate: clientRate.toFixed(2),
            col_visit_status: 'True',
            col_visit_confirmation: 'Unconfirmed',
            col_care_call_Id: visit.id,
            col_postcode: client.client_poster_code,
            dateTime: new Date().toISOString()
        };

        const db = await openDB();
        const tx = db.transaction('tbl_daily_shift_records', 'readwrite');
        tx.objectStore('tbl_daily_shift_records').put(shiftRecord);

        return new Promise((resolve, reject) => {
            tx.oncomplete = async () => {
                try {
                    await updateCallStatus(id, 'in-progress');
                } catch (err) {
                    console.warn('Call status update failed', err);
                }
                resolve(shiftRecord);
            };
            tx.onerror = e => reject(e.target.error);
        });
    }

    // -----------------------------
    // QR Scanner Setup
    // -----------------------------
    async function startQRScanner() {
        const html5QrCode = new Html5Qrcode("qr-reader");
        const resultBox = document.getElementById("qr-reader-results");
        const loader = document.getElementById("loading-indicator");

        const qrCodeSuccessCallback = async (decodedText) => {
            html5QrCode.stop();
            resultBox.style.display = "block";
            resultBox.innerText = "Scanned: " + decodedText;
            loader.style.display = "flex";

            try {
                // Insert record like checkin-geolocation.php
                const shiftRecord = await copyShiftRecord(decodedText);
                loader.style.display = "none";

                window.location.href =
                    'activities.php?uryyToeSS4=' + encodeURIComponent(shiftRecord.uryyToeSS4) +
                    '&Clientshift_Date=' + encodeURIComponent(shiftRecord.shift_date) +
                    '&care_calls=' + encodeURIComponent(shiftRecord.col_care_call) +
                    '&id=' + encodeURIComponent(shiftRecord.id) +
                    '&carerId=' + encodeURIComponent(shiftRecord.col_carer_Id);
            } catch (err) {
                loader.style.display = "none";
                resultBox.innerText = "Error: " + err.message;
                console.error('QR check-in failed:', err);
            }
        };

        const aspectRatio = window.innerWidth / window.innerHeight;
        const qrBoxSize = Math.min(window.innerWidth, window.innerHeight) * 0.6;

        const config = {
            fps: 10,
            qrbox: {
                width: qrBoxSize,
                height: qrBoxSize
            },
            aspectRatio: aspectRatio
        };

        try {
            await html5QrCode.start({
                facingMode: "environment"
            }, config, qrCodeSuccessCallback);
        } catch (err) {
            console.error("Camera start failed:", err);
        }
    }

    window.addEventListener("load", startQRScanner);
</script>
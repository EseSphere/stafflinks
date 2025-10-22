<div class="row text-decoration-none align-items-center mb-3">
    <div class="col-md-4">
        <div class="mb-3">
            <h5><?= htmlspecialchars($clientName); ?> Visit Schedule</h5>
            <p class="text-muted">View, manage, and print scheduled client visits for the selected day.</p>
        </div>
    </div>
    <div class="col-md-2 d-flex justify-content-center align-items-center">
        <button id="prevDate" class="btn btn-sm btn-outline-secondary me-2">&larr;</button>
        <input type="text" id="datePicker" class="form-control text-center" style="max-width: 200px" readonly />
        <button id="nextDate" class="btn btn-sm btn-outline-secondary ms-2">&rarr;</button>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <div class="btn-group">
            <a type="button" href="./client-visits?uryyToeSS4=<?= $uryyToeSS4 ?>" class="btn btn-info">Daily</a>
            <a type="button" href="./weekly-visits?uryyToeSS4=<?= $uryyToeSS4 ?>" class="btn btn-info">Week</a>
            <a type="button" href="./monthly-visits?uryyToeSS4=<?= $uryyToeSS4 ?>" class="btn btn-info">Monthly</a>
            <button type="button" id="printBtn" class="btn btn-success">Print</button>
        </div>
    </div>
</div>
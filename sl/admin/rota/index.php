<?php include_once('header-content.php'); ?>

<form id="dwnForm" style="position: absolute; top:12px; right:20px;" method="get" action="./download-pro-trial"></form>
<div class="top-bar m-0 p-0">
  <div class="controls-container m-0 p-0">
    <div class="container-fluid m-0">
      <div class="row text-decoration-none">
        <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
          <a href="https://stafflinks.co.uk">
            <img src="../assets/images/logo.png" style="width: 100%; height:80px;" alt="">
          </a>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2 text-left flex justify-start align-items-start">
          <div class="search-bar mt-3">
            <input type="text" placeholder="Search staff..." id="staff-search" />
            <span class="clear-search-btn" id="clear-search-btn" title="Clear search">&times;</span>
          </div>
        </div>
        <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 justify-left">
          <div class="dropdown mt-3" id="city-dropdown-container">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="cityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              Group
            </button>
            <ul class="dropdown-menu p-2" aria-labelledby="cityDropdown" id="city-checkbox-list" style="max-height:200px; font-size:17px; overflow-y:auto;"></ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2 mt-2">
          <div class="zoom-controls mt-3">
            <input id="zoom-range" type="range" min="30" max="120" value="100" step="1" title="Zoom timeline hours width" />
            <span class="zoom-value" id="zoom-value">60</span>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2 mt-2">
          <div style="display: flex; align-items: center; gap: 5px; margin-top: 10px;">
            <button class="btn btn-sm btn-outline-secondary" id="date-prev" style="cursor:pointer; border:none; font-size:18px;">&#8592;</button>
            <input type="date" style="width: 150px;" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date-picker" />
            <button class="btn btn-sm btn-outline-secondary" id="date-next" style="cursor:pointer; border:none; font-size:18px;">&#8594;</button>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 flex justify-end items-end">
          <div class="btn-group mt-3 flex justify-end items-end bg-dark w-100" role="group" aria-label="Group of buttons">
            <button style="height: 40px; background-color:#E3C5B2; border:none;" type="button" id="update-event" class="btn btn-dark text-decoration-none">
              <i class="fas fa-list"></i> Publish
            </button>
            <a href="../dashboard" style="height: 40px; background-color:#EB6F46; border:none;" type="button" class="btn btn-primary text-decoration-none">
              <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="#" style="height: 40px; background-color:#A72218; border:none;" id="schedule-link" type="button" class="btn btn-danger text-decoration-none"><i class="fas fa-users"></i> Plan Rota</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="timeline-wrapper">
  <!-- Sticky top-left "Team" label -->
  <div id="team-label">Team</div>

  <!-- Staff labels vertical scroll only -->
  <div id="staff-labels-container">
    <div id="staff-labels"></div>
  </div>

  <!-- Timeline header horizontal scroll only -->
  <div id="timeline-header-container">
    <div id="timeline-header"></div>
  </div>

  <!-- Timeline events scroll both -->
  <div id="timeline-scroll-container">
    <div id="vertical-grid-lines"></div>
    <div id="timeline-rows"></div>
    <div id="current-time-line"></div>
  </div>
</div>

<div id="popup"></div>
<div id="tooltip"></div>

<script>
  const datePicker = document.getElementById('date-picker');
  const scheduleLink = document.getElementById('schedule-link');
  scheduleLink.addEventListener('click', (e) => {
    e.preventDefault();
    const selectedDate = datePicker.value;
    window.location.href = `./schedule-visits?txtDate=${selectedDate}`;
  });
</script>
<?php include_once('footer-contents.php'); ?>
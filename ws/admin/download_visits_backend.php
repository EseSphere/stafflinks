 <?php
    // Get unique ID from URL
    $uryyToeSS4 = isset($_GET['uryyToeSS4']) ? $_GET['uryyToeSS4'] : '';

    // Get start and end dates from form
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $end_date   = isset($_GET['end_date']) ? $_GET['end_date'] : '';

    // Helper functions
    function formatTime($time)
    {
        return date("g:i A", strtotime($time));
    }

    function timeSpent($start, $end)
    {
        $diff = strtotime($end) - strtotime($start);
        $hours = floor($diff / 3600);
        $minutes = floor(($diff % 3600) / 60);
        return ($hours > 0 ? $hours . "h " : "") . ($minutes > 0 ? $minutes . "m" : ($hours == 0 ? "0m" : ""));
    }

    if ($uryyToeSS4 != '') {
        // Base SQL queries
        $visits_sql = "SELECT * FROM tbl_daily_shift_records WHERE uryyToeSS4 = ?";
        $tasks_sql  = "SELECT * FROM tbl_finished_tasks WHERE uryyToeSS4 = ?";
        $med_sql    = "SELECT * FROM tbl_finished_meds WHERE uryyToeSS4 = ?";

        $params = [$uryyToeSS4];

        if ($start_date && $end_date) {
            $visits_sql .= " AND shift_date BETWEEN ? AND ?";
            $tasks_sql  .= " AND task_date BETWEEN ? AND ?";
            $med_sql    .= " AND med_date BETWEEN ? AND ?";
            $params = [$uryyToeSS4, $start_date, $end_date];
        }

        $visits_sql .= " ORDER BY shift_date ASC, planned_timeIn ASC";
        $tasks_sql  .= " ORDER BY task_date ASC";
        $med_sql    .= " ORDER BY med_date ASC";

        // Prepare and execute visits
        $stmt_visits = $conn->prepare($visits_sql);
        if ($start_date && $end_date) {
            $stmt_visits->bind_param("sss", ...$params);
        } else {
            $stmt_visits->bind_param("s", $uryyToeSS4);
        }
        $stmt_visits->execute();
        $visits_result = $stmt_visits->get_result();

        // Prepare and execute tasks
        $stmt_tasks = $conn->prepare($tasks_sql);
        if ($start_date && $end_date) {
            $stmt_tasks->bind_param("sss", ...$params);
        } else {
            $stmt_tasks->bind_param("s", $uryyToeSS4);
        }
        $stmt_tasks->execute();
        $tasks_result = $stmt_tasks->get_result();

        // Prepare and execute medications
        $stmt_med = $conn->prepare($med_sql);
        if ($start_date && $end_date) {
            $stmt_med->bind_param("sss", ...$params);
        } else {
            $stmt_med->bind_param("s", $uryyToeSS4);
        }
        $stmt_med->execute();
        $med_result = $stmt_med->get_result();

        // Group visits by date and col_care_call
        $visits_by_date = [];
        while ($visit = $visits_result->fetch_assoc()) {
            $key = $visit['shift_date'] . '|' . $visit['col_care_call'];
            $visits_by_date[$key][] = $visit;
        }

        // Group tasks by date and care_calls
        $tasks_by_date = [];
        while ($task = $tasks_result->fetch_assoc()) {
            $key = $task['task_date'] . '|' . $task['care_calls'];
            $tasks_by_date[$key][] = $task;
        }

        // Group medications by date and care_calls
        $med_by_date = [];
        while ($med = $med_result->fetch_assoc()) {
            $key = $med['med_date'] . '|' . $med['care_calls'];
            $med_by_date[$key][] = $med;
        }
    }

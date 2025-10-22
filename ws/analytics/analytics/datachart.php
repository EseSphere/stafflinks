<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Schedule Trends</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h2>Schedule Filter</h2>

    <form id="trendForm">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>

        <label for="trend">Trend:</label>
        <select id="trend" name="trend">
            <option value="days">Days</option>
            <option value="weeks">Weeks</option>
        </select><br><br>

        <label for="period">Period:</label>
        <select id="period" name="period">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>

    <canvas id="barChart" width="800" height="400"></canvas>

    <script>
        // Helper to format date as "April 1st"
        function formatDate(date) {
            const options = {
                month: 'long',
                day: 'numeric'
            };
            const day = date.getDate();
            const suffixes = ["st", "nd", "rd"];
            const suffix = (day > 3 && day < 21) || (day % 10 > 3) ? "th" : suffixes[(day % 10) - 1];
            return `${date.toLocaleDateString('en-US', options)}${suffix}`;
        }

        document.getElementById('trendForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const start = new Date(document.getElementById('start_date').value);
            const end = new Date(document.getElementById('end_date').value);
            const trend = document.getElementById('trend').value;
            const period = parseInt(document.getElementById('period').value);

            const totalDays = (end - start) / (1000 * 60 * 60 * 24) + 1;

            let rangeSize = trend === 'weeks' ? 7 : 1;
            let intervalSize = rangeSize * (totalDays / (rangeSize * period));

            const ranges = [];
            let currentStart = new Date(start);

            for (let i = 0; i < period; i++) {
                const currentEnd = new Date(currentStart);
                currentEnd.setDate(currentEnd.getDate() + intervalSize - 1);
                if (currentEnd > end) currentEnd.setTime(end.getTime());

                ranges.push({
                    label: `${formatDate(currentStart)} to ${formatDate(currentEnd)}`,
                    start: currentStart.toISOString().slice(0, 10),
                    end: currentEnd.toISOString().slice(0, 10)
                });

                currentStart = new Date(currentEnd);
                currentStart.setDate(currentStart.getDate() + 1);
            }

            // Send the ranges to backend for processing
            const response = await fetch('process.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    ranges
                })
            });

            const data = await response.json();
            renderChart(data.labels, data.counts);
        });

        function renderChart(labels, counts) {
            const ctx = document.getElementById('barChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Records Count',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
    </script>
</body>

</html>
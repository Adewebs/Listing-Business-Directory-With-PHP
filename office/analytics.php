<?php
$page_title = "Office | Site Analytics";
include 'head.php';
$activePage = 'analytics.php';
// Handle the time filter selection
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'last_7_days';

// Define the date range based on user selection
switch ($filter) {
    case 'last_7_days':
        $start_date = date('Y-m-d', strtotime('-7 days'));
        $end_date = date('Y-m-d');
        break;
    case 'last_31_days':
        $start_date = date('Y-m-d', strtotime('-31 days'));
        $end_date = date('Y-m-d');
        break;
    case 'last_month':
        $start_date = date('Y-m-01', strtotime('first day of last month'));
        $end_date = date('Y-m-t', strtotime('last day of last month'));
        break;
    case 'last_year':
        $start_date = date('Y-01-01', strtotime('last year'));
        $end_date = date('Y-12-31', strtotime('last year'));
        break;
    case 'lifetime':
        $start_date = '1970-01-01';  // Earliest possible date
        $end_date = date('Y-m-d');
        break;
    default:
        $start_date = date('Y-m-d', strtotime('-7 days'));
        $end_date = date('Y-m-d');
}

// Query for distinct links visited within the selected date range and their visit counts
$sql = "SELECT page_url, COUNT(page_url) as visit_count 
        FROM traffic_logs 
        WHERE DATE(visit_time) BETWEEN ? AND ?
        GROUP BY page_url 
        ORDER BY visit_count DESC 
        LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

// Prepare arrays for chart data
$page_urls = [];
$visit_counts = [];
while ($row = $result->fetch_assoc()) {
    $page_urls[] = $row['page_url'];
    $visit_counts[] = $row['visit_count'];
}

// Query for the daily visit count in the selected month
$sql_daily = "SELECT DATE(visit_time) as visit_date, COUNT(*) as visit_count 
              FROM traffic_logs 
              WHERE DATE(visit_time) BETWEEN ? AND ?
              GROUP BY visit_date";
$stmt_daily = $conn->prepare($sql_daily);
$stmt_daily->bind_param("ss", $start_date, $end_date);
$stmt_daily->execute();
$result_daily = $stmt_daily->get_result();

$daily_dates = [];
$daily_counts = [];
while ($row = $result_daily->fetch_assoc()) {
    $daily_dates[] = $row['visit_date'];
    $daily_counts[] = $row['visit_count'];
}

// Traffic overview queries
// Today's traffic
$sql_today = "SELECT COUNT(*) as visit_count FROM traffic_logs WHERE DATE(visit_time) = CURDATE()";
$result_today = $conn->query($sql_today);
$today_traffic = $result_today->fetch_assoc()['visit_count'];

// This week's traffic
$sql_this_week = "SELECT COUNT(*) as visit_count FROM traffic_logs 
                  WHERE YEARWEEK(visit_time, 1) = YEARWEEK(CURDATE(), 1)";
$result_this_week = $conn->query($sql_this_week);
$this_week_traffic = $result_this_week->fetch_assoc()['visit_count'];

// This month's traffic
$sql_this_month = "SELECT COUNT(*) as visit_count FROM traffic_logs 
                   WHERE MONTH(visit_time) = MONTH(CURDATE()) AND YEAR(visit_time) = YEAR(CURDATE())";
$result_this_month = $conn->query($sql_this_month);
$this_month_traffic = $result_this_month->fetch_assoc()['visit_count'];

// Total traffic over time
$sql_overtime = "SELECT COUNT(*) as visit_count FROM traffic_logs";
$result_overtime = $conn->query($sql_overtime);
$overtime_traffic = $result_overtime->fetch_assoc()['visit_count'];
?>

<body class="bg-light">
  <div class="db-wrapper">
    <div class="db-header">
      <!-- navigation start -->
      <?php include 'nav.php'; ?>
      <!-- navigation close -->
    </div>
    <!-- content start -->
    <div class="db-content py-lg-15 py-11">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <?php include 'sidenav.php'; ?>
          </div>
          <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="row">
              <div class="col-xl-12">
                <h2 class="h3 mb-0">Traffic Board</h2>
                <p>Traffic Analysis</p>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card mb-4">
                  <div class="card-body">
                    <h3 class="h6 mb-4">Today</h3>
                    <div class="d-flex justify-content-between align-items-center">
                      <h3 class="mb-0"> <?php echo $today_traffic; ?>  </h3>
                      <span class="db-overview-widget-body-icon">
                        <i class="fas fa-list icon-shape icon-shape icon-lg text-primary bg-light rounded-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card mb-4">
                  <div class="card-body">
                    <h3 class="h6 mb-4">Last 7Days</h3>
                    <div class="d-flex justify-content-between align-items-center">
                      <h3 class="mb-0"> <?php echo $this_week_traffic; ?> </h3>
                      <span class="db-overview-widget-body-icon">
                        <i class="fas fa-star icon-shape icon-lg text-primary bg-light rounded-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card mb-4">
                  <div class="card-body">
                    <h3 class="h6 mb-4">This Month</h3>
                    <div class="d-flex justify-content-between align-items-center">
                      <h3 class="mb-0"> <?php echo $this_month_traffic; ?> </h3>
                      <span class="db-overview-widget-body-icon">
                        <i class="fas fa-file-invoice icon-shape icon-lg text-primary bg-light rounded-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card mb-4">
                  <div class="card-body">
                    <h3 class="h6 mb-4">Overtime</h3>
                    <div class="d-flex justify-content-between align-items-center">
                      <h3 class="mb-0"><?php echo $overtime_traffic; ?></h3>
                      <span class="db-overview-widget-body-icon">
                        <i class="fas fa-paper-plane icon-shape icon-lg text-primary bg-light rounded-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Filter Options -->
            <div class="row mb-4">
              <div class="col-md-12">
                <form method="GET" action="">
                  <label for="filter">Select Traffic Range:</label>
                  <select id="filter" name="filter" class="form-control w-25 d-inline-block">
                    <option value="last_7_days" <?php if($filter == 'last_7_days') echo 'selected'; ?>>Last 7 Days</option>
                    <option value="last_31_days" <?php if($filter == 'last_31_days') echo 'selected'; ?>>Last 31 Days</option>
                    <option value="last_month" <?php if($filter == 'last_month') echo 'selected'; ?>>Last Month</option>
                    <option value="last_year" <?php if($filter == 'last_year') echo 'selected'; ?>>Last Year</option>
                    <option value="lifetime" <?php if($filter == 'lifetime') echo 'selected'; ?>>Lifetime</option>
                  </select>
                  <button type="submit" class="btn btn-primary">Apply</button>
                </form>
              </div>
            </div>
            
            <!-- Bar Chart and Pie Chart section -->
            <div class="row">
              <div class="col-xl-6">
                <canvas id="barChart"></canvas>
              </div>
              <div class="col-xl-6">
                <canvas id="pieChart"></canvas>
              </div>
            </div>
            
            <!-- Recent Visits Section -->
            <div class="row mt-4">
              <div class="col-xl-12">
                <div class="card mb-4">
                  <div class="card-body">
                    <h3 class="h6 mb-4">Top 10 Most Visited Pages</h3>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Page URL</th>
                          <th>Visit Count</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (!empty($page_urls)) {
                            foreach ($page_urls as $index => $page_url) {
                                echo "<tr>
                                        <td>{$page_url}</td>
                                        <td>{$visit_counts[$index]}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No visits in the selected range</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content close -->
  </div>
  
  <!-- JavaScript for Charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const barChart = document.getElementById('barChart');
    const pieChart = document.getElementById('pieChart');

    const barData = {
        labels: <?php echo json_encode($daily_dates); ?>,
        datasets: [{
            label: 'Visits Per Day',
            data: <?php echo json_encode($daily_counts); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    const pieData = {
        labels: <?php echo json_encode($page_urls); ?>,
        datasets: [{
            label: 'Top 10 Most Visited Pages',
            data: <?php echo json_encode($visit_counts); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };

    new Chart(barChart, {
        type: 'bar',
        data: barData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(pieChart, {
        type: 'pie',
        data: pieData,
    });
  </script>
</body>

<?php include 'foot.php'; ?>

<?php
// Include the database configuration file
include('config.php');

function getTotalResponses($conn) {
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) AS total_responses FROM surveyresponse");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_responses'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return 0;
}

function getSurveyResponses($conn) {
    try {
        $stmt = $conn->prepare("
            SELECT 
                r.respondent_name, r.respondent_department, r.respondent_designation, 
                sr.*, s.survey_date
            FROM 
                surveyresponse sr
            JOIN 
                survey s ON sr.survey_id = s.survey_id
            JOIN 
                respondent r ON s.respondent_id = r.respondent_id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return [];
}

function getAverageScores($conn) {
    try {
        $stmt = $conn->prepare("
            SELECT 
                AVG(q1_company_satisfaction) AS avg_q1, 
                AVG(q2_rec_company) AS avg_q2, 
                AVG(q6_department_satisfaction) AS avg_q6,
                AVG(q10_basicsalary) AS avgq10_basicsalary,
                AVG(q10_benefit) AS avgq10_benefit,
                AVG(q10_career_progression) AS avgq10_career_progression,
                AVG(q10_med_insurance) AS avgq10_med_insurance,
                AVG(q10_annual_raise) AS avgq10_annual_raise,
                AVG(q10_promotion_process) AS avgq10_promotion_process,
                AVG(q11_superior_job) AS avgq11_superior_job,
                AVG(q11_superior_listens) AS avgq11_superior_listens,
                AVG(q11_management) AS avgq11_management,
                AVG(q11_superior_enable) AS avgq11_superior_enable,
                AVG(q11_superior_expectation) AS avgq11_superior_expectation,
                AVG(q11_superior_suggestion) AS avgq11_superior_suggestion,
                AVG(q11_address_concern) AS avgq11_address_concern,
                AVG(q11_evaluate_works) AS avgq11_evaluate_works,
                AVG(q11_jobscope) AS avgq11_jobscope,
                AVG(q11_management_invest) AS avgq11_management_invest

            FROM 
                surveyresponse
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return [];
}

$averageScores = getAverageScores($conn);
$avgQ1 = $averageScores['avg_q1'];
$avgQ2 = $averageScores['avg_q2'];
$avgQ6 = $averageScores['avg_q6'];

$avgQ10_basicsalary = $averageScores['avgq10_basicsalary'];
$avgQ10_benefit = $averageScores['avgq10_benefit'];
$avgQ10_career_progression = $averageScores['avgq10_career_progression'];
$avgQ10_med_insurance = $averageScores['avgq10_med_insurance'];
$avgQ10_annual_raise = $averageScores['avgq10_annual_raise'];
$avgQ10_promotion_process = $averageScores['avgq10_promotion_process'];
$avgQ11_superior_job = $averageScores['avgq11_superior_job'];
$avgQ11_superior_listens = $averageScores['avgq11_superior_listens'];
$avgQ11_management = $averageScores['avgq11_management'];
$avgQ11_superior_enable = $averageScores['avgq11_superior_enable'];
$avgQ11_superior_expectation = $averageScores['avgq11_superior_expectation'];
$avgQ11_superior_suggestion = $averageScores['avgq11_superior_suggestion'];
$avgQ11_address_concern = $averageScores['avgq11_address_concern'];
$avgQ11_evaluate_works = $averageScores['avgq11_evaluate_works'];
$avgQ11_jobscope = $averageScores['avgq11_jobscope'];
$avgQ11_management_invest = $averageScores['avgq11_management_invest'];

$overallAverage = ($avgQ1 + $avgQ2 + $avgQ6) / 3;
$totalResponses = getTotalResponses($conn);
$responses = getSurveyResponses($conn);

$overallAverageq10q11 = (
    $avgQ10_basicsalary + $avgQ10_benefit + $avgQ10_career_progression + $avgQ10_med_insurance +
    $avgQ10_annual_raise + $avgQ10_promotion_process +
    $avgQ11_superior_job + $avgQ11_superior_listens + $avgQ11_management +
    $avgQ11_superior_enable + $avgQ11_superior_expectation + $avgQ11_superior_suggestion +
    $avgQ11_address_concern + $avgQ11_evaluate_works + $avgQ11_jobscope + $avgQ11_management_invest
) / 16;

function getScoreCounts($conn, $question) {
    try {
        $stmt = $conn->prepare("
            SELECT $question, COUNT(*) as count
            FROM surveyresponse
            GROUP BY $question
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return [];
}

$scoreCountsQ1 = getScoreCounts($conn, 'q1_company_satisfaction');
$scoreCountsQ2 = getScoreCounts($conn, 'q2_rec_company');
$scoreCountsQ3 = getScoreCounts($conn, 'q6_department_satisfaction');

function formatDataForChart($scoreCounts, $question) {
    $labels = [];
    $data = [];
    foreach ($scoreCounts as $row) {
        $labels[] = $row[$question];
        $data[] = $row['count'];
    }
    return ['labels' => $labels, 'data' => $data];
}

$chartDataQ1 = formatDataForChart($scoreCountsQ1, 'q1_company_satisfaction');
$chartDataQ2 = formatDataForChart($scoreCountsQ2, 'q2_rec_company');
$chartDataQ3 = formatDataForChart($scoreCountsQ3, 'q6_department_satisfaction');

function getScoreCountsYesNoDontKnow($conn, $question) {
  try {
      $stmt = $conn->prepare("
          SELECT $question, COUNT(*) as count
          FROM surveyresponse
          GROUP BY $question
      ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  return [];
}

$scoreCountsQ12 = getScoreCountsYesNoDontKnow($conn, 'q12_recfriend'); 
$scoreCountsQ13 = getScoreCountsYesNoDontKnow($conn, 'q13_jobsecurity'); 
$chartDataQ12 = formatDataForChart($scoreCountsQ12, 'q12_recfriend');
$chartDataQ13 = formatDataForChart($scoreCountsQ13, 'q13_jobsecurity'); 


?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Analysis Report</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
  <script src="jstry.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link rel="stylesheet" href="bootstrap/4/css/bootstrap.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Lato', sans-serif;
    }
    /* Hide the 000webhost branding */
a[href*="000webhost.com"] {
    display: none;
}

    body {
      font-family: 'Lato', sans-serif;
      background-color: white;
    }

    .headercontainer {
      background: #D3F3FC;
      margin-top: 5px;
      margin-bottom: 100px;
    }

    .headercontainer h1 {
      font-size: 36px;
      font-weight: 700;
      padding-bottom: 35px;
      padding-top: 45px;
      padding-left: 140px;
    }

    .headercontainer p {
      font-size: 22px;
      font-weight: 400;
      padding-bottom: 15px;
      padding-left: 140px;
    }

    .headercontainer #totalresponse {
      font-size: 18px;
      font-weight: 300;
      padding-bottom: 70px;
      padding-left: 140px;
    }

    .headercontainer img {
      max-height: 90px;
    }

    .detailscontainer {
    margin: auto;
    background: #D4EAD8;
    width: fit-content;
    height: auto;
    padding: 30px 50px;
    border-radius: 13px;
    margin-bottom: 60px;
    text-align: center; /* Center text inside the container */
}

    .detailscontainer h1 {
      font-size: 18px;
      color: #13538A;
      font-weight: bolder;
      line-height: 25px;
    }

    .form {
        padding: auto;
        background: red;
        margin: auto;
        width: 92%;
        height: auto;
        margin-bottom: 60px;
        border: 0.08px #808080;
        align-content: center;
    }

      .chart-item h3{
        font-size: 18px;
      }

    .question {
      padding-bottom: 20px;
    }

    .question p {
      padding-bottom: 10px;
      font-size: 16px;
      color: grey;
      font-weight: 400;
    }

    .question h1 {
    padding-bottom: 10px;
      font-size: 22px;
      color: #37C9EF;
      font-weight: 800;
    }

    .question .radiobtn {
      padding-bottom: 10px;
      font-size: 18px;
    }

    .form input[type="text"],
    .form input[type="submit"] {
      flex: 1;
      height: 40px;
      width: 100%;
      padding: 8px 20px;
      border-radius: 10px;
      border: 2px solid #ccc;
      outline: none;
      font-size: 16px;
      transition: all 0.2s ease;
    }

    @media (max-width: 768px) {
        .headercontainer h1 {
        font-size: 20px;
        padding-bottom: 10px;
        padding-left: 40px;
      }
      .chart-item h3{
        font-size: 14px;
      }
   
        .headercontainer p {
        font-size: 16px;
        padding-bottom: 0px;
        padding-top: 10px;
        padding-left: 40px;

      }
      .headercontainer #totalresponse {
      font-size: 14px;
      font-weight: 300;
      padding-bottom: 70px;
      padding-left: 40px;
    }

    .detailscontainer {
        padding: 20px 30px;
        margin: 20px auto; /* Center on smaller screens */
        text-align: center; /* Ensure text is centered on smaller screens */
    }

    .detailscontainer h1 {
        font-size: 16px;
        line-height: 22px;
    }

      .form {
        padding: 1px;
        width: 94%;
      }
 
      .form input {
        width: 100%;
      }

      .rate {
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 2px;
      }

      .rate label {
        flex: 1 0 5%;
      }
      
.logo img {
  max-height: 18px;
}
.chart-container {
    width: 100%; /* Adjusted width for smaller media queries */

}
.question p {
    font-size: 12px;
    }
    .question h1 {
    font-size: 14px;
    }
    }
    @media (max-width: 380px) {
        .question p {
    font-size: 12px;
    }
    .question h1 {
    font-size: 16px;
    }
        .headercontainer h1 {
        font-size: 24px;
        padding-bottom: 10px;
        padding-left: 60px;
      }

        .headercontainer p {
        font-size: 20px;
        padding-bottom: 0px;
        padding-top: 10px;
        padding-left: 60px;

      }
      .headercontainer #totalresponse {
      font-size: 16px;
      font-weight: 300;
      padding-bottom: 70px;
      padding-left: 60px;
    }
    .detailscontainer {
        padding: 30px 25px;
        margin: 20px auto; /* Center on smaller screens */
        text-align: center; /* Ensure text is centered on smaller screens */
    }

      .form {
        padding: 1px;
        width: 94%;
      }


      .detailscontainer h1 {
        font-size: 14px;
        line-height: 20px;
      }


      
.logo img {
  max-height: 28px;
}
.chart-container {
    width: 80%; /* Adjusted width for smaller media queries */

}
    }


    
    .space {
      margin-top: 50px;
    }

    .space4 {
      margin-top: 160px;
    }
    .space3 {
      margin-top: 100px;
    }


.form .button input {
  display: flex;
  width: 100%;
  height: 40px;
  justify-content: center;
  border: none;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
  letter-spacing: 1px;
  border-radius: 6px;
  background-color: #0F75BD;
  cursor: pointer;
  transition: all 0.3s ease;
}

.button input:hover {
  background-color: #fff;
  color: #0F75BD;
  border: 2px solid #0F75BD;
}

.red-text {
  color: red;
}


.reason {
  padding-left: 25px;
  padding-top: 10px;
}

nav {
  padding: 40px 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo a {
  font-size: 28px;
  text-decoration: none;
  font-family: cookie;
  font-weight: bold;
  color: #433e58;
  padding-left: 20px;
}

.logo img {
  max-height: 58px;
}

nav ul {
  display: flex;
  align-items: center;
  justify-content: space-between;
  list-style: none;
}

nav ul li {
  margin: 0 15px;
}

nav ul li a {
  text-decoration: none;
  color: #433e58;
  transition: 0.5s;
  padding-right: 20px;
}

nav ul li a:hover {
  color: #92278F;
}

.hamburger {
  display: none;
  flex-direction: column;
  cursor: pointer;
}

.hamburger div {
  width: 25px;
  height: 3px;
  background-color: #433e58;
  margin: 4px;
  transition: 0.4s;
}

@media (max-width: 768px) {
    nav {
  padding: 20px 20px 20px 20px;
    }
  nav ul {
    display: none;
    flex-direction: column;
    width: 100%;
    position: absolute;
    top: 60px;
    left: 0;
    background-color: white;
    text-align: center;
  }

  nav ul li {
    margin: 10px 0;
  }

  .hamburger {
    display: flex;
  }
}

.hamburger.active div:nth-child(1) {
  transform: rotate(-45deg) translate(-5px, 6px);
}

.hamburger.active div:nth-child(2) {
  opacity: 0;
}

.hamburger.active div:nth-child(3) {
  transform: rotate(45deg) translate(-5px, -6px);
}

nav ul.active {
  display: flex;
}
th, td {
    font-size: 14px; /* Adjust the size as needed */
  }
  .chart-container {
    width: 84%; /* Adjusted width for normal screens */
    height: auto;
    margin: 0 auto; /* Center the chart horizontally */
    text-align: center; /* Center the chart */
    margin-bottom: 20px; /* Add margin bottom for spacing */
}

.piecharts-container {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
}

.chart-item {
    width: 30%;
    text-align: center;
}
.chart-item h3 {
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: bold;
}

.chart-item p {
    margin-top: 10px;
    font-size: 16px;
    font-weight: 500;
    color: #333;
}
</style>
</head>

<body>
<div class="navbarcontainer">
<nav>
  <div class="logo">
    <a href="#">
      </a>
  </div>
  <div class="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
  </div>
  <ul>
    <li><a href="satisfaction-surveyEN.php">Go to survey</a></li>
    <li><a href="responsesreport.php">Survey Responses</a></li>
    <li><a href="index.php">Analysis Report</a></li>
  </ul>
  <div class="buttons">
    <a href="adminlogin.php" class="btn">Log in as Admin</a>
    <?php
    if (isset($_POST['Log out'])) {
      session_destroy();
      unset($_SESSION['admin_id']);
    }
    ?>
  </div>
</nav>
</div>

<div class="headercontainer">
<br>
<h1>Employees Satisfaction Survey</h1>
<p>Analysis Report & Charts</p>
<p id="totalresponse">
  <?php echo "$totalResponses responses"; ?>
</p>
</div>

<div class="chart-container" >
    <div class="question">
        <h1>Overall Working Environment Satisfaction</h1>
        <p>Q1, Q2, Q6, from Employee Satisfaction Survey</p><br>
    </div>
    <canvas id="averageScoresChart"></canvas>
</div><br>
<div class="space"></div>

<div class="detailscontainer">
        <h1>
            Overall Working Environment Satisfaction : <br><br>
            <span style="font-size:18px; font-weight:800;"><?php echo number_format($overallAverage, 2); ?></span>
        </h1>
    </div>
    <div class="space3"></div>

<div class="piecharts-container">
    <div class="chart-item">
    <h3>Company Satisfaction</h3>
    </div>
    <div class="chart-item">
    <h3>Recommend Company</h3>
    </div>
    <div class="chart-item">
    <h3>Department Satisfaction</h3>
    </div>
</div>
    
<div class="piecharts-container">
    <div class="chart-item">
        <canvas id="pieChartQ1"></canvas>
    </div>
    <div class="chart-item">
        <canvas id="pieChartQ2"></canvas>
    </div>
    <div class="chart-item">
        <canvas id="pieChartQ3"></canvas>
    </div>
</div>
<div class="piecharts-container">
    <div class="chart-item">
    <p>Average Score: <?php echo number_format($avgQ1, 2); ?></p>
    </div>
    <div class="chart-item">
    <p>Average Score: <?php echo number_format($avgQ2, 2); ?></p>
    </div>
    <div class="chart-item">
    <p>Average Score: <?php echo number_format($avgQ6, 2); ?></p>
    </div>
</div>

<div class="space4"></div>

<div class="chart-container">
    <div class="question">
        <h1>Overall Satisfaction Summary</h1>
        <p>Q10 and Q11 from Employee Satisfaction Survey</p><br>
    </div>
    <canvas id="averageScoresChart2"></canvas>
</div><br>
<div class="space"></div>

<div class="detailscontainer">
    <h1>
        Your Overall Satisfaction Scores: <br><br>
        <span style="font-size:18px; font-weight:800;" id="overallAveragenew"></span>
    </h1>
</div>
<div class="space4"></div>
<div class="piecharts-container">
    <div class="chart-item">
    <h3>Will you recommend this Company to your friend to work with us?</h3>
    </div>
    <div class="chart-item">
    <h3>Does the Company provide job security?</h3>
    </div>
</div>
<div class="piecharts-container">
    <div class="chart-item">
        <canvas id="pieChartQ12"></canvas>
    </div>
    <div class="chart-item">
        <canvas id="pieChartQ13"></canvas>
    </div>
</div>
<div class="piecharts-container">
    <div class="chart-item">
    <?php foreach ($chartDataQ12['labels'] as $index => $label): ?>
            <?php
                $percentage = ($chartDataQ12['data'][$index] / $totalResponses) * 100;
            ?>
            <p><?php echo $label . ": " . number_format($percentage, 2) . "%"; ?></p>
        <?php endforeach; ?>
    </div>
    <div class="chart-item">
    <?php foreach ($chartDataQ13['labels'] as $index => $label): ?>
            <?php
                $percentage = ($chartDataQ13['data'][$index] / $totalResponses) * 100;
            ?>
            <p><?php echo $label . ": " . number_format($percentage, 2) . "%"; ?></p>
        <?php endforeach; ?>
    </div>
</div>



    <div class="space3"></div>
<script>
function toggleMenu() {
  const nav = document.querySelector('nav ul');
  const hamburger = document.querySelector('.hamburger');
  nav.classList.toggle('active');
  hamburger.classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('averageScoresChart').getContext('2d');
    var averageScoresChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Company Satisfaction', 'Recommend Company', 'Department Satisfaction'],
            datasets: [{
                label: 'Average Scores',
                data: [<?php echo $avgQ1; ?>, <?php echo $avgQ2; ?>, <?php echo $avgQ6; ?>],
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', 
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    function createPieChart(ctx, labels, data) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
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
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    var ctxQ1 = document.getElementById('pieChartQ1').getContext('2d');
    var ctxQ2 = document.getElementById('pieChartQ2').getContext('2d');
    var ctxQ3 = document.getElementById('pieChartQ3').getContext('2d');

    var chartDataQ1 = <?php echo json_encode($chartDataQ1); ?>;
    var chartDataQ2 = <?php echo json_encode($chartDataQ2); ?>;
    var chartDataQ3 = <?php echo json_encode($chartDataQ3); ?>;

    createPieChart(ctxQ1, chartDataQ1.labels, chartDataQ1.data);
    createPieChart(ctxQ2, chartDataQ2.labels, chartDataQ2.data);
    createPieChart(ctxQ3, chartDataQ3.labels, chartDataQ3.data);
});

document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('averageScoresChart2').getContext('2d');
    var averageScoresChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Basic Salary', 'Benefits', 'Career Progression', 'Medical Insurance', 'Annual Raise', 'Promotion Process', 'Superior Job', 'Superior Listens', 'Management', 'Superior Enablement', 'Superior Expectation', 'Superior Suggestions', 'Address Concerns', 'Evaluate Works', 'Job Scope', 'Management Investment'],
            datasets: [{
                label: 'Average Scores',
                data: [
                    <?php
                    echo $avgQ10_basicsalary . ', ' . $avgQ10_benefit . ', ' . $avgQ10_career_progression . ', ' . $avgQ10_med_insurance . ', ' . $avgQ10_annual_raise . ', ' . $avgQ10_promotion_process . ', ' . $avgQ11_superior_job . ', ' . $avgQ11_superior_listens . ', ' . $avgQ11_management . ', ' . $avgQ11_superior_enable . ', ' . $avgQ11_superior_expectation . ', ' . $avgQ11_superior_suggestion . ', ' . $avgQ11_address_concern . ', ' . $avgQ11_evaluate_works . ', ' . $avgQ11_jobscope . ', ' . $avgQ11_management_invest;
                    ?>
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });

    var overallAveragenew = <?php echo $overallAverageq10q11; ?>;
    document.getElementById('overallAveragenew').textContent = overallAveragenew.toFixed(2);
});

document.addEventListener("DOMContentLoaded", function() {
    function createPieChart(ctx, labels, data) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
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
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    var ctxQ12 = document.getElementById('pieChartQ12').getContext('2d');
    var ctxQ13 = document.getElementById('pieChartQ13').getContext('2d');

    var chartDataQ12 = <?php echo json_encode($chartDataQ12); ?>;
    var chartDataQ13 = <?php echo json_encode($chartDataQ13); ?>;

    createPieChart(ctxQ12, chartDataQ12.labels, chartDataQ12.data);
    createPieChart(ctxQ13, chartDataQ13.labels, chartDataQ13.data);
});


</script>
</body>

</html>



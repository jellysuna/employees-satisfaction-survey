<?php
$sName = "localhost";
$uName = "root";
$pass = "";
$dbname = "satisfactionsurvey";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$dbname", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

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
            ORDER BY 
                s.survey_date DESC  -- Change to ASC for oldest first
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return [];
}



$totalResponses = getTotalResponses($conn);
$responses = getSurveyResponses($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Survey Responses</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
  <script src="jstry.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

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
      margin-bottom: 80px;
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
      background: #D3F3FC;
      width: fit-content;
      height: auto;
      padding: 50px 80px 50px 60px;
      border-radius: 13px;
      margin-bottom: 60px;
    }

    .detailscontainer p {
      font-size: 18px;
      line-height: 25px;
    }

    .form {
        padding: auto;
        background: white;
        margin: auto;
        width: 92%;
        height: auto;
        padding: 10px 5px 10px 0px;
        margin-bottom: 60px;
        border: 0.08px #808080;
        overflow-x: auto;
      overflow-y: auto;
    }



    .form table {
      border-collapse: collapse;
    margin: auto;
      background: #fff;
      width: 90%;
      height: auto;
      border: 0.08px #808080;


    }


    .form table, .form th, .form td {
      border: 1px solid #ccc;
      padding: 10px;
    }

    .form th {
      background-color: #f2f2f2;
    }

    .question {
      padding-bottom: 20px;
    }

    .question p {
      padding-bottom: 10px;
      font-size: 18px;
    }

    .question h1 {
      padding-top: 50px;
      font-size: 24px;
      font-weight: bold;
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
        padding: 40px 30px;
        margin: 20px;
      }

      .detailscontainer p {
        font-size: 16px;
        line-height: 22px;
      }

      .form {
        padding: 1px;
        margin: auto;
        width: 94%;
      }
      .form table {
    padding: auto; /* Adjust padding for smaller screens */
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
    }

    @media (max-width: 380px) {
      .headercontainer p {
        font-size: 20px;
      }

      .detailscontainer {
        padding: 30px 25px;
      }

      .form {
        padding: 1px;
        margin: auto;
        width: 94%;
      }

      .form input {
        width: 100%;
      }

      .detailscontainer p {
        font-size: 14px;
        line-height: 20px;
      }

      .form {
        padding: 50px 60px 50px 60px;
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
  max-height: 28px;
}
    }

    .space {
      margin-top: 50px;
    }

    .space2 {
      margin-top: 30
    }

.rate {
  display: flex;
  justify-content: left;
  gap: 25px;
  padding: 20px 25px;
}

.rate input[type="radio"] {
  display: none;
}

.rate label {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.rate label div {
  width: 30px;
  height: 30px;
  border: 2px solid #ccc;
  border-radius: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 5px;
  transition: background 0.3s, border 0.3s;
}

.rate input[type="radio"]:checked+label div {
  background: #808080;
  border: 2px solid #808080;
}

.form .btn{
  display: flex;
  height: 40px;
  justify-content: center;
  border: none;
  padding-top: 10px;
  padding-left: 20px;
  padding-right: 20px;
  color: #fff;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 1px;
  border-radius: 6px;
  background-color: #0F75BD;
  cursor: pointer;
  transition: all 0.3s ease;
}

.form .btn:hover {
  background-color: #fff;
  color: #0F75BD;
  border: 2px solid #0F75BD;
}

.red-text {
  color: red;
}

.verticalrate {
  display: flex;
  flex-direction: column;
  justify-content: left;
  gap: 10px;
  padding: 10px 25px;
}

.verticalrate input[type="radio"] {
  display: none;
}

.verticalrate label {
  display: flex;
  align-items: center;
  gap: 10px;
}

.verticalrate label div {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 20px;
  height: 20px;
  border: 2px solid #ccc;
  border-radius: 13px;
  transition: background 0.3s, border 0.3s;
}

.verticalrate label p {
  font-size: 16px;
  display: inline-block;
  margin-top: 10px;
}

.verticalrate input[type="radio"]:checked+label div {
  background: #808080;
  border: 2px solid #808080;
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
      unset($_SESSION['acc_id']);
    }
    ?>
  </div>
</nav>
</div>

<div class="headercontainer">
<br>
<h1>Employees Satisfaction Survey</h1>
<p>Survey Responses</p>
<p id="totalresponse">
  <?php echo "$totalResponses responses"; ?>
</p>
</div>

<div class="form">
<button id="exportButton" class="btn btn-primary">Export to Excel</button>
<br><br>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Date Submitted</th>
        <th>Name</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Overall, how satisfied are you working for the Company?</th>
        <th>To what extend do you agree: I would recommend this company as a good place to work</th>
        <th>What I like the best about working for the Company is</th>
        <th>Things that the Company should do to make it a better workplace are</th>
        <th>Do you enjoy our company’s culture?</th>
        <th>Overall, how satisfied are you working in your department?</th>
        <th>Which of the above factors most strongly affects your satisfaction with your work? Why?</th>
        <th>How many years have you been with the Company?</th>
        <th>What else about your superior affects your job satisfaction?</th>
        <th>Satisfaction: Your basic salary</th>
        <th>Satisfaction: Benefitt entitlement</th>
        <th>Satisfaction: Your career progression at the Company thus far</th>
        <th>Satisfaction: Your medical insurance</th>
        <th>Satisfaction: The process used to determine the annual raise</th>
        <th>Satisfaction: The process used to determine employee's promotion</th>
        <th>Extent to which you agree: Overall, my superior does a good job</th>
        <th>Extent to which you agree: My superior actively listens to my suggestions</th>
        <th>Extent to which you agree: How transparent do you feel the management is?</th>
        <th>Extent to which you agree: My superior enables me to perform at my best</th>
        <th>Extent to which you agree: It is clear to me what my superior expects of me regarding my job performance</th>
        <th>Extent to which you agree: My superior provides me with actionable suggestions on what I can do to improve</th>
        <th>Extent to which you agree: When I have questions or concerns, my superior is able to address them</th>
        <th>Extent to which you agree: My superior evaluates my work performance on a regular basis</th>
        <th>Extent to which you agree: Do you feel as though your job responsibilities are clearly defined?</th>
        <th>Extent to which you agree: Does management seem invested in the success of the team?</th>
        <th>Will you recommend this Company to your friend to work with us?</th>
        <th>State the reason if No or Don't know</th>
        <th>Does the Company provide you job security?</th>
        <th>State the reason if No or Don't know</th>
        <th>How open to changes are we as an organization?</th>
        <th>Any other suggestion for Company improvements?</th>



        <!-- Add more headers as needed -->
      </tr>
    </thead>
    <tbody>
      <?php 
      $counter = 1; // Initialize counter
      foreach ($responses as $response): ?>
      <tr>
        <td><?php echo $counter++; ?></td>
        <td><?php echo htmlspecialchars($response['survey_date']); ?></td>
        <td><?php echo htmlspecialchars($response['respondent_name']); ?></td>
        <td><?php echo htmlspecialchars($response['respondent_department']); ?></td>
        <td><?php echo htmlspecialchars($response['respondent_designation']); ?></td>
        <td><?php echo htmlspecialchars($response['q1_company_satisfaction']); ?></td>
        <td><?php echo htmlspecialchars($response['q2_rec_company']); ?></td>
        <td><?php echo htmlspecialchars($response['q3_likes']); ?></td>
        <td><?php echo htmlspecialchars($response['q4_improvement']); ?></td>
        <td><?php echo htmlspecialchars($response['q5_company_culture']); ?></td>
        <td><?php echo htmlspecialchars($response['q6_department_satisfaction']); ?></td>
        <td><?php echo htmlspecialchars($response['q7_satisfaction_factors']); ?></td>
        <td><?php echo htmlspecialchars($response['q8_years_working']); ?></td>
        <td><?php echo htmlspecialchars($response['q9_superior_impact']); ?></td>
        <td><?php echo htmlspecialchars($response['q10_basicsalary']); ?></td>
        <td><?php echo htmlspecialchars($response['q10_benefit']); ?></td>
        <td><?php echo htmlspecialchars($response['q10_career_progression']); ?></td>
        <td><?php echo htmlspecialchars($response['q10_med_insurance']); ?></td>
        <td><?php echo htmlspecialchars($response['q10_annual_raise']); ?></td>
        <td><?php echo htmlspecialchars($response['q10_promotion_process']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_superior_job']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_superior_listens']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_management']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_superior_enable']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_superior_expectation']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_superior_suggestion']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_address_concern']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_evaluate_works']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_jobscope']); ?></td>
        <td><?php echo htmlspecialchars($response['q11_management_invest']); ?></td>
        <td><?php echo htmlspecialchars($response['q12_recfriend']); ?></td>
        <td>
                        <?php 
                        if (!empty($response['q12_recfriend_reasonNo'])) {
                            echo htmlspecialchars($response['q12_recfriend_reasonNo']);
                        } elseif (!empty($response['q12_recfriend_reasonDK'])) {
                            echo htmlspecialchars($response['q12_recfriend_reasonDK']);
                        } else {
                            echo ''; // No reason provided
                        }
                        ?>
        </td>
        <td><?php echo htmlspecialchars($response['q13_jobsecurity']); ?></td>
        <td>
                        <?php 
                        if (!empty($response['q13_jobsecurity_reasonNo'])) {
                            echo htmlspecialchars($response['q13_jobsecurity_reasonNo']);
                        } elseif (!empty($response['q13_jobsecurity_reasonDK'])) {
                            echo htmlspecialchars($response['q13_jobsecurity_reasonDK']);
                        } else {
                            echo ''; // No reason provided
                        }
                        ?>
        </td>
        <td><?php echo htmlspecialchars($response['q14_changes_openness']); ?></td>
        <td><?php echo htmlspecialchars($response['q15_suggestions']); ?></td>

        <!-- Add more columns as needed -->
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</div>
<div class="space"></div>

<script>
function toggleMenu() {
  const nav = document.querySelector('nav ul');
  const hamburger = document.querySelector('.hamburger');
  nav.classList.toggle('active');
  hamburger.classList.toggle('active');
}

document.getElementById('exportButton').addEventListener('click', function() {
      var wb = XLSX.utils.book_new();
      var ws = XLSX.utils.table_to_sheet(document.querySelector('.table-responsive table'));
      XLSX.utils.book_append_sheet(wb, ws, 'Survey Responses');
      XLSX.writeFile(wb, 'survey_responses.xlsx');
  });
</script>
</body>

</html>



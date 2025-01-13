<?php
$sName = "localhost";
$uName = "root";
$pass = "";
$dbname = "satisfactionsurvey";

date_default_timezone_set('Asia/Kuala_Lumpur');

try {
    $conn = new PDO("mysql:host=$sName;dbname=$dbname", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respondent_name = $_POST['respondent_name'];
    $respondent_department = $_POST['respondent_department'];
    $respondent_designation = $_POST['respondent_designation'];
    $q1_company_satisfaction = $_POST['q1_company_satisfaction'];
    $q2_rec_company = $_POST['q2_rec_company'];
    $q3_likes = $_POST['q3_likes'];
    $q4_improvement = $_POST['q4_improvement'];
    $q5_company_culture = $_POST['q5_company_culture'];
    $q6_department_satisfaction = $_POST['q6_department_satisfaction'];
    $q7_satisfaction_factors = $_POST['q7_satisfaction_factors'];
    $q8_years_working = $_POST['q8_years_working'];
    $q9_superior_impact = $_POST['q9_superior_impact'];
    $q10_basicsalary = $_POST['q10_basicsalary'];
    $q10_benefit = $_POST['q10_benefit'];
    $q10_career_progression = $_POST['q10_career_progression'];
    $q10_med_insurance = $_POST['q10_med_insurance'];
    $q10_annual_raise = $_POST['q10_annual_raise'];
    $q10_promotion_process = $_POST['q10_promotion_process'];
    $q11_superior_job = $_POST['q11_superior_job'];
    $q11_superior_listens = $_POST['q11_superior_listens'];
    $q11_management = $_POST['q11_management'];
    $q11_superior_enable = $_POST['q11_superior_enable'];
    $q11_superior_expectation = $_POST['q11_superior_expectation'];
    $q11_superior_suggestion = $_POST['q11_superior_suggestion'];
    $q11_address_concern = $_POST['q11_address_concern'];
    $q11_evaluate_works = $_POST['q11_evaluate_works'];
    $q11_jobscope = $_POST['q11_jobscope'];
    $q11_management_invest = $_POST['q11_management_invest'];
    $q12_recfriend = $_POST['q12_recfriend'];
    $q12_recfriend_reasonNo = $_POST['q12_recfriend_reasonNo'] ?? '';
    $q12_recfriend_reasonDK = $_POST['q12_recfriend_reasonDK'] ?? '';
    $q13_jobsecurity = $_POST['q13_jobsecurity'];
    $q13_jobsecurity_reasonNo = $_POST['q13_jobsecurity_reasonNo'] ?? '';
    $q13_jobsecurity_reasonDK = $_POST['q13_jobsecurity_reasonDK'] ?? '';
    $q14_changes_openness = $_POST['q14_changes_openness'];
    $q15_suggestions = $_POST['q15_suggestions'];


    //define default language
    $language = $_POST['language'] ?? 'en';

    try {
        // Start transaction
        $conn->beginTransaction();

        // Insert into respondent table
        $stmt = $conn->prepare("INSERT INTO respondent (respondent_name, respondent_department, respondent_designation) VALUES (:name, :department, :designation)");
        $stmt->bindParam(':name', $respondent_name);
        $stmt->bindParam(':department', $respondent_department);
        $stmt->bindParam(':designation', $respondent_designation);
        $stmt->execute();
        $respondent_id = $conn->lastInsertId();

        // Insert into survey table
        $stmt = $conn->prepare("INSERT INTO survey (respondent_id) VALUES (:respondent_id)");
        $stmt->bindParam(':respondent_id', $respondent_id);
        $stmt->execute();
        $survey_id = $conn->lastInsertId();

        // Insert into surveyresponse table
        $stmt = $conn->prepare("INSERT INTO surveyresponse (survey_id, q1_company_satisfaction, q2_rec_company, q3_likes, q4_improvement, q5_company_culture, q6_department_satisfaction, q7_satisfaction_factors, q8_years_working, q9_superior_impact, q10_basicsalary, q10_benefit, q10_career_progression, q10_med_insurance, q10_annual_raise, q10_promotion_process,
        q11_superior_job, q11_superior_listens, q11_management, q11_superior_enable, q11_superior_expectation, q11_superior_suggestion, q11_address_concern, q11_evaluate_works, q11_jobscope, q11_management_invest, q12_recfriend, q12_recfriend_reasonNo, q12_recfriend_reasonDK, q13_jobsecurity, q13_jobsecurity_reasonNo, q13_jobsecurity_reasonDK, q14_changes_openness, q15_suggestions) 
        VALUES (:survey_id, :q1_company_satisfaction, :q2_rec_company, :q3_likes, :q4_improvement, :q5_company_culture, :q6_department_satisfaction, :q7_satisfaction_factors, :q8_years_working, :q9_superior_impact, :q10_basicsalary, :q10_benefit, :q10_career_progression, :q10_med_insurance, :q10_annual_raise, :q10_promotion_process,
        :q11_superior_job, :q11_superior_listens, :q11_management, :q11_superior_enable, :q11_superior_expectation, :q11_superior_suggestion, :q11_address_concern, :q11_evaluate_works, :q11_jobscope, :q11_management_invest, :q12_recfriend, :q12_recfriend_reasonNo, :q12_recfriend_reasonDK, :q13_jobsecurity, :q13_jobsecurity_reasonNo, :q13_jobsecurity_reasonDK, :q14_changes_openness, :q15_suggestions)");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->bindParam(':q1_company_satisfaction', $q1_company_satisfaction);
        $stmt->bindParam(':q2_rec_company', $q2_rec_company);
        $stmt->bindParam(':q3_likes', $q3_likes);
        $stmt->bindParam(':q4_improvement', $q4_improvement);
        $stmt->bindParam(':q5_company_culture', $q5_company_culture);
        $stmt->bindParam(':q6_department_satisfaction', $q6_department_satisfaction);
        $stmt->bindParam(':q7_satisfaction_factors', $q7_satisfaction_factors);
        $stmt->bindParam(':q8_years_working', $q8_years_working);
        $stmt->bindParam(':q9_superior_impact', $q9_superior_impact);
        $stmt->bindParam(':q10_basicsalary', $q10_basicsalary);
        $stmt->bindParam(':q10_benefit', $q10_benefit); 
        $stmt->bindParam(':q10_career_progression', $q10_career_progression); 
        $stmt->bindParam(':q10_med_insurance', $q10_med_insurance); 
        $stmt->bindParam(':q10_annual_raise', $q10_annual_raise); 
        $stmt->bindParam(':q10_promotion_process', $q10_promotion_process); 
        $stmt->bindParam(':q11_superior_job', $q11_superior_job); 
        $stmt->bindParam(':q11_superior_listens', $q11_superior_listens); 
        $stmt->bindParam(':q11_management', $q11_management); 
        $stmt->bindParam(':q11_superior_enable', $q11_superior_enable); 
        $stmt->bindParam(':q11_superior_expectation', $q11_superior_expectation); 
        $stmt->bindParam(':q11_superior_suggestion', $q11_superior_suggestion); 
        $stmt->bindParam(':q11_address_concern', $q11_address_concern); 
        $stmt->bindParam(':q11_evaluate_works', $q11_evaluate_works); 
        $stmt->bindParam(':q11_jobscope', $q11_jobscope); 
        $stmt->bindParam(':q11_management_invest', $q11_management_invest); 
        $stmt->bindParam(':q12_recfriend', $q12_recfriend);
        $stmt->bindParam(':q12_recfriend_reasonNo', $q12_recfriend_reasonNo);
        $stmt->bindParam(':q12_recfriend_reasonDK', $q12_recfriend_reasonDK);
        $stmt->bindParam(':q13_jobsecurity', $q13_jobsecurity);
        $stmt->bindParam(':q13_jobsecurity_reasonNo', $q13_jobsecurity_reasonNo);
        $stmt->bindParam(':q13_jobsecurity_reasonDK', $q13_jobsecurity_reasonDK);
        $stmt->bindParam(':q14_changes_openness', $q14_changes_openness);
        $stmt->bindParam(':q15_suggestions', $q15_suggestions); 

        $stmt->execute();

        // Commit transaction
        $conn->commit();

        //header('Location: surveysubmitted.php');
         // Redirect based on language
         if ($language == 'en') {
            header('Location: surveysubmitted.php');
        } elseif ($language == 'bm') {
            header('Location: surveysubmitted_bm.php');
        } elseif ($language == 'cn') {
            header('Location: surveysubmitted_cn.php');
        } else {
            header('Location: surveysubmitted.php'); // Default to English
        }
        exit();
        } catch (PDOException $e) {
        // Rollback transaction in case of error
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>

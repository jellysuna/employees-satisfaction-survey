<?php
include("surveyresponse-serv.php");
?>
<!DOCTYPE html>
<html lang="bm">

<head>
<title>Kajian Kepuasan Pekerja</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
  <script src="jstry.js"></script> 
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
        margin-top: 80px;
        text-align: center;
    }
    .headercontainer p {
        font-size: 36px;
        font-weight: 700;
        padding-bottom: 60px;
        padding-top: 20px;
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
        margin: auto;
        background: #fff;
        width: fit-content;
        height: auto;
        padding: 50px 80px 50px 60px;
        border-radius: 13px;
        margin-bottom: 60px;
        box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.15);
        border: 0.08px #808080;
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
    .form input[type="text"], .form input[type="submit"] {
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
        .headercontainer p {
            font-size: 20px;
            padding-bottom: 10px;
            padding-top: 10px;
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
            padding: 40px 30px;
            margin: auto;
            width: 94%;
        }
        .form input {
            width: 100%;
        }
        .rate{
          justify-content: space-between; /* Adds space between items */
          flex-wrap: wrap; /* Allows items to wrap to the next line */
          gap:2px;
        }
        .verticalrate label {
            font-size:14px;
        }
        .rate label {
            font-size:14px;
        flex: 1 0 5%; /* Adjusts width of each radio button label to 45% */
    }
    .question p {
            font-size: 16px;
        }
        .question h1 {
            font-size: 22px;
        }
    .question .radiobtn {
        font-size: 16px;
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
            padding: 30px 25px;
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
        .rate{
          justify-content: space-between; /* Adds space between items */
          flex-wrap: wrap; /* Allows items to wrap to the next line */
          gap:2px;
        }
        .rate label {
        flex: 1 0 5%; /* Adjusts width of each radio button label to 45% */
    }
    }
    .space {
        margin-top: 50px;
    }
    .space2 {
        margin-top: 30px;
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
    gap: 10px; /* Adjust the gap between radio button and label text */
}

.verticalrate label div {
    display: flex;
    flex-direction: column; /* Set the direction to column to stack text vertically */
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border: 2px solid #ccc;
    border-radius: 13px;
    transition: background 0.3s, border 0.3s;
}
    .verticalrate label p{
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

  </style>
</head>

<body>
    <div class="headercontainer">
        <br><br>
        <p>Kajian Kepuasan Pekerja</p>
    </div>

    <div class="detailscontainer">
        <p>Kami ingin mendengar pendapat anda! <br>Penyelidikan ini akan dijalankan sampai 0/0/2024</p>
        <br>
        <p>Matlamat untuk mempunyai kajian ini adalah seperti di bawah: <br>
        1. Menilai situasi tempat kerja<br>
        2. Meningkatkan tahap komunikasi<br>
        3. Untuk mengumpulkan pendapat pekerja demi kemajuan</p>
        <p><br>Kami berharap untuk melihat jawapan anda dan berharap anda memberi 100% sokongan dan penyertaan.
        <br>Semua maklum balas akan dianggapkan sebagai rahsia dan sulit.</p>

        <div class="language-dropdown"><br>
        <label for="language-select">Tukar Bahasa:</label>
        <select id="language-select" onchange="changeLanguage(this)">
            <option value="bm">Bahasa Malaysia</option>
            <option value="en">English</option>
            <option value="cn">Chinese</option>
        </select>
</div>
    </div>
    <div class="space"></div>
    
    <form method="POST" action="" class="form" onsubmit="return validateForm()">
    <input type="hidden" name="language" id="language" value="bm">
        <div class="question">
            <p>Nama</p>
            <input type="text" placeholder="Optional" id="respondent_name" name="respondent_name"><br><br>
        </div>
        <div class="question">
            <p>Jabatan <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="respondent_department" name="respondent_department"><br><br>
        </div>
        <div class="question">
            <p>Jawatan <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="respondent_designation" name="respondent_designation"><br><br>
        </div>
        <div class="question">
            <h1>Soalan Penyelidikan:</h1> 
        </div>
        <div class="space2"></div>
        <div class="question">
      <p class="radiobtn">1. Seberapa berpuas hati anda bekerja untuk Syarikat ini secara keseluruhan? <span style="color:red;">*</span>
      </p>
      <div class="rate">
        <input type="radio" id="q1_rate1" name="q1_company_satisfaction" value="1" required>
        <label for="q1_rate1">
          <div></div>1</label>
        <input type="radio" id="q1_rate2" name="q1_company_satisfaction" value="2" required>
        <label for="q1_rate2">
          <div></div>2</label>
        <input type="radio" id="q1_rate3" name="q1_company_satisfaction" value="3" required>
        <label for="q1_rate3">
          <div></div>3</label>
        <input type="radio" id="q1_rate4" name="q1_company_satisfaction" value="4" required>
        <label for="q1_rate4">
          <div></div>4</label>
        <input type="radio" id="q1_rate5" name="q1_company_satisfaction" value="5" required>
        <label for="q1_rate5">
          <div></div>5</label>
        <input type="radio" id="q1_rate6" name="q1_company_satisfaction" value="6" required>
        <label for="q1_rate6">
          <div></div>6</label>
        <input type="radio" id="q1_rate7" name="q1_company_satisfaction" value="7" required>
        <label for="q1_rate7">
          <div></div>7</label>
        <input type="radio" id="q1_rate8" name="q1_company_satisfaction" value="8" required>
        <label for="q1_rate8">
          <div></div>8</label>
        <input type="radio" id="q1_rate9" name="q1_company_satisfaction" value="9" required>
        <label for="q1_rate9">
          <div></div>9</label>
        <input type="radio" id="q1_rate10" name="q1_company_satisfaction" value="10" required>
        <label for="q1_rate10">
          <div></div>10</label>
      </div>
    </div>
    <div class="question">
      <p class="radiobtn">2. Sejauh mana anda bersetuju dengan kenyataan berikut:<br>Saya akan memperkenalkan syarikat ini sebagai tempat yang baik untuk bekerja kepada rakan saya. <span style="color:red;">*</span></p>
      <div class="rate">
        <input type="radio" id="q2_rate1" name="q2_rec_company" value="1" required>
        <label for="q2_rate1">
          <div></div>1</label>
        <input type="radio" id="q2_rate2" name="q2_rec_company" value="2" required>
        <label for="q2_rate2">
          <div></div>2</label>
        <input type="radio" id="q2_rate3" name="q2_rec_company" value="3" required>
        <label for="q2_rate3">
          <div></div>3</label>
        <input type="radio" id="q2_rate4" name="q2_rec_company" value="4" required>
        <label for="q2_rate4">
          <div></div>4</label>
        <input type="radio" id="q2_rate5" name="q2_rec_company" value="5" required>
        <label for="q2_rate5">
          <div></div>5</label>
        <input type="radio" id="q2_rate6" name="q2_rec_company" value="6" required>
        <label for="q2_rate6">
          <div></div>6</label>
        <input type="radio" id="q2_rate7" name="q2_rec_company" value="7" required>
        <label for="q2_rate7">
          <div></div>7</label>
        <input type="radio" id="q2_rate8" name="q2_rec_company" value="8" required>
        <label for="q2_rate8">
          <div></div>8</label>
        <input type="radio" id="q2_rate9" name="q2_rec_company" value="9" required>
        <label for="q2_rate9">
          <div></div>9</label>
        <input type="radio" id="q2_rate10" name="q2_rec_company" value="10" required>
        <label for="q2_rate10">
          <div></div>10</label>
      </div>
    </div>
    <div class="question">
            <p>3. Apakah yang paling saya sukai apabila bekerja di syarikat, adalah <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q3_likes" name="q3_likes"><br><br>
    </div>
    <div class="question">
            <p>4. Perkara-perkara yang Syarikat perlu lakukan untuk menjadikannya sebagai tempat kerja yang lebih baik ialah, <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q4_improvement" name="q4_improvement"><br><br>
    </div>
    <div class="question">
            <p>5. Adakah anda menikmati budaya syarikat kami? <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q5_company_culture" name="q5_company_culture"><br><br>
    </div>
    <div class="question">
      <p class="radiobtn">6. Secara keseluruhan, sejauh mana anda berpuas hati dengan kerja di jabatan anda? <span style="color:red;">*</span></p>
      <div class="rate">
        <input type="radio" id="q6_rate1" name="q6_department_satisfaction" value="1" required>
        <label for="q6_rate1">
          <div></div>1</label>
        <input type="radio" id="q6_rate2" name="q6_department_satisfaction" value="2" required>
        <label for="q6_rate2">
          <div></div>2</label>
        <input type="radio" id="q6_rate3" name="q6_department_satisfaction" value="3" required>
        <label for="q6_rate3">
          <div></div>3</label>
        <input type="radio" id="q6_rate4" name="q6_department_satisfaction" value="4" required>
        <label for="q6_rate4">
          <div></div>4</label>
        <input type="radio" id="q6_rate5" name="q6_department_satisfaction" value="5" required>
        <label for="q6_rate5">
          <div></div>5</label>
        <input type="radio" id="q6_rate6" name="q6_department_satisfaction" value="6" required>
        <label for="q6_rate6">
          <div></div>6</label>
        <input type="radio" id="q6_rate7" name="q6_department_satisfaction" value="7" required>
        <label for="q6_rate7">
          <div></div>7</label>
        <input type="radio" id="q6_rate8" name="q6_department_satisfaction" value="8" required>
        <label for="q6_rate8">
          <div></div>8</label>
        <input type="radio" id="q6_rate9" name="q6_department_satisfaction" value="9" required>
        <label for="q6_rate9">
          <div></div>9</label>
        <input type="radio" id="q6_rate10" name="q6_department_satisfaction" value="10" required>
        <label for="q6_rate10">
          <div></div>10</label>
      </div>
    </div>
    <div class="question">
            <p>7. Apakah faktor di atas yang paling mempengaruhi kepuasan anda dengan kerja anda? Mengapa? <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q7_satisfaction_factors" name="q7_satisfaction_factors"><br><br>
    </div>
    <div class="question">
            <p>8. Berapa tahun anda telah bekerja di syarikat ini? <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q8_years_working" name="q8_years_working"><br><br>
    </div>
    <div class="question">
            <p>9. Apakah faktor lain yang dipengaruhi oleh ketua anda terhadap kepuasan kerja anda? <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q9_superior_impact" name="q9_superior_impact"><br><br>
    </div>

    <div class="question">
        <p>10. Sila nyatakan tahap kepuasan hati anda terhadap perkara berikut.</p>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Gaji anda </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q10_rate1" name="q10_basicsalary" value="1" required>
        <label for="q10_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q10_rate2" name="q10_basicsalary" value="2" required>
        <label for="q10_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q10_rate3" name="q10_basicsalary" value="3" required>
        <label for="q10_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q10_rate4" name="q10_basicsalary" value="4" required>
        <label for="q10_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q10_rate5" name="q10_basicsalary" value="5" required>
        <label for="q10_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Manfaat yang diperoleh </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q101_rate1" name="q10_benefit" value="1" required>
        <label for="q101_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q101_rate2" name="q10_benefit" value="2" required>
        <label for="q101_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q101_rate3" name="q10_benefit" value="3" required>
        <label for="q101_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q101_rate4" name="q10_benefit" value="4" required>
        <label for="q101_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q101_rate5" name="q10_benefit" value="5" required>
        <label for="q101_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Kemajuan kerjaya anda di Syarikat sejauh ini </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q102_rate1" name="q10_career_progression" value="1" required>
        <label for="q102_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q102_rate2" name="q10_career_progression" value="2" required>
        <label for="q102_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q102_rate3" name="q10_career_progression" value="3" required>
        <label for="q102_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q102_rate4" name="q10_career_progression" value="4" required>
        <label for="q102_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q102_rate5" name="q10_career_progression" value="5" required>
        <label for="q102_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Insurans perubatan diberikan kepada anda </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q103_rate1" name="q10_med_insurance" value="1" required>
        <label for="q103_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q103_rate2" name="q10_med_insurance" value="2" required>
        <label for="q103_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q103_rate3" name="q10_med_insurance" value="3" required>
        <label for="q103_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q103_rate4" name="q10_med_insurance" value="4" required>
        <label for="q103_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q103_rate5" name="q10_med_insurance" value="5" required>
        <label for="q103_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Proses yang digunakan untuk menentukan kenaikan gaji tahunan </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q104_rate1" name="q10_annual_raise" value="1" required>
        <label for="q104_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q104_rate2" name="q10_annual_raise" value="2" required>
        <label for="q104_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q104_rate3" name="q10_annual_raise" value="3" required>
        <label for="q104_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q104_rate4" name="q10_annual_raise" value="4" required>
        <label for="q104_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q104_rate5" name="q10_annual_raise" value="5" required>
        <label for="q104_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Proses yang digunakan untuk menentukan promosi pekerja </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q105_rate1" name="q10_promotion_process" value="1" required>
        <label for="q105_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q105_rate2" name="q10_promotion_process" value="2" required>
        <label for="q105_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q105_rate3" name="q10_promotion_process" value="3" required>
        <label for="q105_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q105_rate4" name="q10_promotion_process" value="4" required>
        <label for="q105_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q105_rate5" name="q10_promotion_process" value="5" required>
        <label for="q105_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>

    <div class="question">
        <p>11. Sila nyatakan sejauh mana anda bersetuju dengan pernyataan berikut: </p>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Secara keseluruhan, ketua saya melakukan kerja dengan baik. </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q11_rate1" name="q11_superior_job" value="1" required>
        <label for="q11_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q11_rate2" name="q11_superior_job" value="2" required>
        <label for="q11_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q11_rate3" name="q11_superior_job" value="3" required>
        <label for="q11_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q11_rate4" name="q11_superior_job" value="4" required>
        <label for="q11_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q11_rate5" name="q11_superior_job" value="5" required>
        <label for="q11_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Pemimpin saya sudi  mendengar cadangan saya. </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q111_rate1" name="q11_superior_listens" value="1" required>
        <label for="q111_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q111_rate2" name="q11_superior_listens" value="2" required>
        <label for="q111_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q111_rate3" name="q11_superior_listens" value="3" required>
        <label for="q111_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q111_rate4" name="q11_superior_listens" value="4" required>
        <label for="q111_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q111_rate5" name="q11_superior_listens" value="5" required>
        <label for="q111_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Pada pendapat anda, seberapa transparan pentadbiran anda? </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q112_rate1" name="q11_management" value="1" required>
        <label for="q112_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q112_rate2" name="q11_management" value="2" required>
        <label for="q112_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q112_rate3" name="q11_management" value="3" required>
        <label for="q112_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q112_rate4" name="q11_management" value="4" required>
        <label for="q112_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q112_rate5" name="q11_management" value="5" required>
        <label for="q112_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Pemimpin saya membolehkan saya melakukan yang terbaik. </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q113_rate1" name="q11_superior_enable" value="1" required>
        <label for="q113_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q113_rate2" name="q11_superior_enable" value="2" required>
        <label for="q113_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q113_rate3" name="q11_superior_enable" value="3" required>
        <label for="q113_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q113_rate4" name="q11_superior_enable" value="4" required>
        <label for="q113_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q113_rate5" name="q11_superior_enable" value="5" required>
        <label for="q113_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Pengetua saya memberi penjelasan mengenai prestasi kerja saya. </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q114_rate1" name="q11_superior_expectation" value="1" required>
        <label for="q114_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q114_rate2" name="q11_superior_expectation" value="2" required>
        <label for="q114_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q114_rate3" name="q11_superior_expectation" value="3" required>
        <label for="q114_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q114_rate4" name="q11_superior_expectation" value="4" required>
        <label for="q114_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q114_rate5" name="q11_superior_expectation" value="5" required>
        <label for="q114_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Pemimpin saya sering memberi saya cadangan yang saya boleh lakukan demi kemajuan saya. </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q115_rate1" name="q11_superior_suggestion" value="1" required>
        <label for="q115_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q115_rate2" name="q11_superior_suggestion" value="2" required>
        <label for="q115_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q115_rate3" name="q11_superior_suggestion" value="3" required>
        <label for="q115_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q115_rate4" name="q11_superior_suggestion" value="4" required>
        <label for="q115_rate4">
            <div></div>Sangat Berpuas Hati
        </label>
        <input type="radio" id="q115_rate5" name="q11_superior_suggestion" value="5" required>
        <label for="q115_rate5">
            <div></div>Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Apabila saya mempunyai soalan atau kebimbangan, pemimpin saya akan membantu saya menyelesai kebimbangan tersebut. </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q116_rate1" name="q11_address_concern" value="1" required>
        <label for="q116_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q116_rate2" name="q11_address_concern" value="2" required>
        <label for="q116_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q116_rate3" name="q11_address_concern" value="3" required>
        <label for="q116_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q116_rate4" name="q11_address_concern" value="4" required>
        <label for="q116_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q116_rate5" name="q11_address_concern" value="5" required>
        <label for="q116_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Pemimpin saya menilai prestasi kerja saya secara berkala. </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q117_rate1" name="q11_evaluate_works" value="1" required>
        <label for="q117_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q117_rate2" name="q11_evaluate_works" value="2" required>
        <label for="q117_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q117_rate3" name="q11_evaluate_works" value="3" required>
        <label for="q117_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q117_rate4" name="q11_evaluate_works" value="4" required>
        <label for="q117_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q117_rate5" name="q11_evaluate_works" value="5" required>
        <label for="q117_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Adakah anda merasa bahawa tanggungjawab kerja anda telah ditakrifkan dengan jelas? </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q118_rate1" name="q11_jobscope" value="1" required>
        <label for="q118_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q118_rate2" name="q11_jobscope" value="2" required>
        <label for="q118_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q118_rate3" name="q11_jobscope" value="3" required>
        <label for="q118_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q118_rate4" name="q11_jobscope" value="4" required>
        <label for="q118_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q118_rate5" name="q11_jobscope" value="5" required>
        <label for="q118_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn"><span style="padding-left:20px;"></span>Adakah pengurusan seolah-olah melabur dalam kejayaan pasukan? </span><span style="color:red;">*</span></p>
        <div class="verticalrate">
        <input type="radio" id="q119_rate1" name="q11_management_invest" value="1" required>
        <label for="q119_rate1">
            <div></div>Sangat Tidak Berpuas Hati
        </label>
        <input type="radio" id="q119_rate2" name="q11_management_invest" value="2" required>
        <label for="q119_rate2">
            <div></div>Tidak Berpuas Hati
        </label>
        <input type="radio" id="q119_rate3" name="q11_management_invest" value="3" required>
        <label for="q119_rate3">
            <div></div>Sederhana
        </label>
        <input type="radio" id="q119_rate4" name="q11_management_invest" value="4" required>
        <label for="q119_rate4">
            <div></div>Berpuas Hati
        </label>
        <input type="radio" id="q119_rate5" name="q11_management_invest" value="5" required>
        <label for="q119_rate5">
            <div></div>Sangat Berpuas Hati
        </label>
        </div><br>
    </div>
    <div class="question">
        <p class="radiobtn">12. Adakah anda akan mengesyorkan Syarikat ini kepada rakan anda untuk bekerja dengan kami? <span style="color:red;">*</span></p>
        <div class="verticalrate">
            <input type="radio" id="q12_rate1" name="q12_recfriend" value="1" required>
            <label for="q12_rate1">
                <div></div>Ya
            </label>
            <input type="radio" id="q12_rate2" name="q12_recfriend" value="2" required>
            <label for="q12_rate2">
                <div></div>Tidak
            </label>
            <input type="radio" id="q12_rate3" name="q12_recfriend" value="3" required>
            <label for="q12_rate3">
                <div></div>Tidak tahu
            </label>
        </div><br>
        <div id="q12_reasonNo" class="reason" style="display:none;">
            <label for="q12_reasonNoInput">Sila berikan penjelasan:</label>
            <input type="text" id="q12_reasonNoInput" name="q12_recfriend_reasonNo">
        </div>
        <div id="q12_reasonDK" class="reason" style="display:none;">
            <label for="q12_reasonDKInput">Sila berikan penjelasan:</label>
            <input type="text" id="q12_reasonDKInput" name="q12_recfriend_reasonDK">
        </div>
    </div>
    <div class="question">
        <p class="radiobtn">13. Adakah Syarikat menyediakan anda keselamatan kerja? <span style="color:red;">*</span></p>
        <div class="verticalrate">
            <input type="radio" id="q13_rate1" name="q13_jobsecurity" value="1" required>
            <label for="q13_rate1">
                <div></div>Ya
            </label>
            <input type="radio" id="q13_rate2" name="q13_jobsecurity" value="2" required>
            <label for="q13_rate2">
                <div></div>Tidak
            </label>
            <input type="radio" id="q13_rate3" name="q13_jobsecurity" value="3" required>
            <label for="q13_rate3">
                <div></div>Tidak tahu
            </label>
        </div><br>
        <div id="q13_reasonNo" class="reason" style="display:none;">
            <label for="q13_reasonNoInput">Sila berikan penjelasan:</label>
            <input type="text" id="q13_reasonNoInput" name="q13_jobsecurity_reasonNo">
        </div>
        <div id="q13_reasonDK" class="reason" style="display:none;">
            <label for="q13_reasonDKInput">Sila berikan penjelasan:</label>
            <input type="text" id="q13_reasonDKInput" name="q13_jobsecurity_reasonDK">
        </div>
    </div>
    <div class="question">
            <p>14. Seberapa terbuka kepada perubahan kita sebagai sebuah organisasi? <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q14_changes_openness" name="q14_changes_openness"><br><br>
    </div>
    <div class="question">
            <p>15. Sila nyatakan cadangan anda demi peningkatan dan kemajuan syarikat. <span style="color:red;">*</span></p>
            <input type="text" required placeholder=" " id="q15_suggestions" name="q15_suggestions"><br><br>
    </div>

        <div class="space"></div>
        <div class="input-field button">
            <input type="submit" name="submit" value="Hantar" onclick="validateForm()">
        </div>
    </form>
    <div class="space"></div>
    <br><br>


    <script>
        function validateForm() {
          var field1 = document.querySelector('input[name="q1_company_satisfaction"]:checked');
          var field2 = document.querySelector('input[name="q2_rec_company"]:checked');
          var department = document.getElementById('respondent_department');
          var designation = document.getElementById('respondent_designation');
          var likes = document.getElementById('q3_likes');
          var improvement = document.getElementById('q4_improvement');
          var company_culture = document.getElementById('q5_company_culture');
          var field3 = document.querySelector('input[name="q6_department_satisfaction"]:checked');
          var satisfaction_factors = document.getElementById('q7_satisfaction_factors');
          var years_working = document.getElementById('q8_years_working');
          var superior_impact = document.getElementById('q9_superior_impact');
          var field4 = document.querySelector('input[name="q10_basicsalary"]:checked');
          var field5 = document.querySelector('input[name="q10_benefit"]:checked');  
          var field6 = document.querySelector('input[name="q10_career_progression"]:checked');
          var field7 = document.querySelector('input[name="q10_med_insurance"]:checked');
          var field8 = document.querySelector('input[name="q10_annual_raise"]:checked');
          var field9 = document.querySelector('input[name="q10_promotion_process"]:checked'); 
          var field10 = document.querySelector('input[name="q11_superior_job"]:checked'); 
          var field11 = document.querySelector('input[name="q11_superior_listens"]:checked'); 
          var field12 = document.querySelector('input[name="q11_management"]:checked'); 
          var field13 = document.querySelector('input[name="q11_superior_enable"]:checked'); 
          var field14 = document.querySelector('input[name="q11_superior_expectation"]:checked'); 
          var field15 = document.querySelector('input[name="q11_superior_suggestion"]:checked'); 
          var field16 = document.querySelector('input[name="q11_address_concern"]:checked'); 
          var field17 = document.querySelector('input[name="q11_evaluate_works"]:checked'); 
          var field18 = document.querySelector('input[name="q11_jobscope"]:checked'); 
          var field19 = document.querySelector('input[name="q11_management_invest"]:checked'); 
          var field20 = document.querySelector('input[name="q12_recfriend"]:checked');
          var reasonNo = document.getElementById('q12_reasonNoInput');
          var reasonDK = document.getElementById('q12_reasonDKInput');
          var field21 = document.querySelector('input[name="q13_jobsecurity"]:checked');
          var reasonJobNo = document.getElementById('q13_reasonNoInput');
          var reasonJobDK = document.getElementById('q13_reasonDKInput');
          var changes_openness = document.getElementById('q14_changes_openness');
          var q15_suggestions = document.getElementById('q15_suggestions');

          var radiobtns = document.querySelectorAll('.radiobtn');
          radiobtns.forEach(function(radiobtn) {
            radiobtn.classList.remove('red-text');
          });

          // Check if any required field is empty
          if (!field1 || !field2 || isEmpty(department) || isEmpty(designation) || isEmpty(likes) || isEmpty(improvement) || isEmpty(company_culture) || !field3 || isEmpty(satisfaction_factors) || isEmpty(years_working) || isEmpty(superior_impact) || !field4 || 
          !field5 || !field6 || !field7 || !field8 || !field9 || !field10 || !field11 || !field12 || !field13 || !field14 || !field15 || !field16 || !field17 || !field18 || !field19 || !field20 ||
        (field20.value == "2" && isEmpty(reasonNo)) || (field20.value == "3" && isEmpty(reasonDK)) || (field21.value == "2" && isEmpty(reasonJobNo)) || (field21.value == "3" && isEmpty(reasonJobDK))
        || isEmpty(changes_openness) || isEmpty(q15_suggestions)) {
            alert('Please fill in all required fields.');
            if (!field1) radiobtns[0].classList.add('red-text');
            if (!field2) radiobtns[1].classList.add('red-text');
            if (!field3) radiobtns[2].classList.add('red-text');
            if (!field4) radiobtns[3].classList.add('red-text');
            if (!field5) radiobtns[4].classList.add('red-text');
            if (!field6) radiobtns[5].classList.add('red-text');
            if (!field7) radiobtns[6].classList.add('red-text');
            if (!field8) radiobtns[7].classList.add('red-text');
            if (!field9) radiobtns[8].classList.add('red-text');
            if (!field10) radiobtns[9].classList.add('red-text');
            if (!field11) radiobtns[10].classList.add('red-text');
            if (!field12) radiobtns[11].classList.add('red-text');
            if (!field13) radiobtns[12].classList.add('red-text');
            if (!field14) radiobtns[13].classList.add('red-text');
            if (!field15) radiobtns[14].classList.add('red-text');
            if (!field16) radiobtns[15].classList.add('red-text');
            if (!field17) radiobtns[16].classList.add('red-text');
            if (!field18) radiobtns[17].classList.add('red-text');
            if (!field19) radiobtns[18].classList.add('red-text');
            if (!field20) radiobtns[19].classList.add('red-text');
            if (!field21) radiobtns[20].classList.add('red-text');

            if (isEmpty(department)) {
              department.previousElementSibling.classList.add('red-text');
            } else {
              department.previousElementSibling.classList.remove('red-text');
            }

            if (isEmpty(designation)) {
              designation.previousElementSibling.classList.add('red-text');
            } else {
              designation.previousElementSibling.classList.remove('red-text');
            }

            if (isEmpty(likes)) {
              likes.previousElementSibling.classList.add('red-text');
            } else {
              likes.previousElementSibling.classList.remove('red-text');
            }

            if (isEmpty(improvement)) {
              improvement.previousElementSibling.classList.add('red-text');
            } else {
              improvement.previousElementSibling.classList.remove('red-text');
            }

            if (isEmpty(company_culture)) {
              company_culture.previousElementSibling.classList.add('red-text');
            } else {
              company_culture.previousElementSibling.classList.remove('red-text');
            }

            if (isEmpty(satisfaction_factors)) {
              satisfaction_factors.previousElementSibling.classList.add('red-text');
            } else {
              satisfaction_factors.previousElementSibling.classList.remove('red-text');
            }

            if (isEmpty(years_working)) {
              years_working.previousElementSibling.classList.add('red-text');
            } else {
              years_working.previousElementSibling.classList.remove('red-text');
            }
            
            if (isEmpty(superior_impact)) {
              superior_impact.previousElementSibling.classList.add('red-text');
            } else {
              superior_impact.previousElementSibling.classList.remove('red-text');
            }

            if (field20 && field20.value == "2" && isEmpty(reasonNo)) {
            reasonNo.previousElementSibling.classList.add('red-text');
            } else {
                reasonNo.previousElementSibling.classList.remove('red-text');
            }

            if (field20 && field20.value == "3" && isEmpty(reasonDK)) {
                reasonDK.previousElementSibling.classList.add('red-text');
            } else {
                reasonDK.previousElementSibling.classList.remove('red-text');
            }
            if (field21 && field21.value == "2" && isEmpty(reasonJobNo)) {
            reasonJobNo.previousElementSibling.classList.add('red-text');
            } else {
                reasonJobNo.previousElementSibling.classList.remove('red-text');
            }

            if (field21 && field21.value == "3" && isEmpty(reasonJobDK)) {
                reasonJobDK.previousElementSibling.classList.add('red-text');
            } else {
                reasonJobDK.previousElementSibling.classList.remove('red-text');
            }
            if (isEmpty(changes_openness)) {
              changes_openness.previousElementSibling.classList.add('red-text');
            } else {
              changes_openness.previousElementSibling.classList.remove('red-text');
            }
            if (isEmpty(q15_suggestions)) {
              q15_suggestions.previousElementSibling.classList.add('red-text');
            } else {
              q15_suggestions.previousElementSibling.classList.remove('red-text');
            }

            return false; // Prevent form submission
          }

            // If all required fields are filled, allow form submission
            return true;
        }

        function isEmpty(element) {
            return element.value.trim() === '';
        }

        document.addEventListener('DOMContentLoaded', function() {
    const recFriendRadios = document.getElementsByName('q12_recfriend');
    recFriendRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('q12_reasonNo').style.display = 'none';
            document.getElementById('q12_reasonDK').style.display = 'none';
            // Clear the reason text fields when the radio button options are changed
            document.getElementById('q12_reasonNoInput').value = '';
            document.getElementById('q12_reasonDKInput').value = '';
            if (this.value == 2) {
                document.getElementById('q12_reasonNo').style.display = 'block';
            } else if (this.value == 3) {
                document.getElementById('q12_reasonDK').style.display = 'block';
            }
        });
    });

    const jobSecurityRadios = document.getElementsByName('q13_jobsecurity');
    jobSecurityRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('q13_reasonNo').style.display = 'none';
            document.getElementById('q13_reasonDK').style.display = 'none';
            // Clear the reason text fields when the radio button options are changed
            document.getElementById('q13_reasonNoInput').value = '';
            document.getElementById('q13_reasonDKInput').value = '';
            if (this.value == 2) {
                document.getElementById('q13_reasonNo').style.display = 'block';
            } else if (this.value == 3) {
                document.getElementById('q13_reasonDK').style.display = 'block';
            }
        });
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});

function changeLanguage(select) {
    // Get the selected language option value
    var selectedLanguage = select.value;

    // Define the URLs for different language versions of your page
    var languageUrls = {
        en: 'satisfaction-surveyEN.php',
        bm: 'satisfaction-surveyBM.php',
        cn: 'satisfaction-surveyCN.php'
    };

    console.log("Language URLs:", languageUrls); // Debugging


    // Redirect the user to the selected language version of the page
    window.location.href = languageUrls[selectedLanguage];
}

    </script>

</body>
</html>  

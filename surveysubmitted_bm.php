<!DOCTYPE html>
<html lang="bm">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
  <title>Terima Kasih!</title>

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
    .thankyou {
        margin: auto;
        width: fit-content;
        height: auto;
        border-radius: 13px;
        margin-bottom: 60px;
    }
    .thankyou p {
        font-size: 24px;
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
        .thankyou {
            margin:auto;
            align-items: center;
            text-align: center;

        }
        .thankyou p {
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
    }
    @media (max-width: 380px) {
        .headercontainer p {
            font-size: 20px;
        }
        .thankyou {
            margin:auto;
            align-items: center;
            text-align: center;

        }
        .form {
            padding: 30px 25px;
        }
        .form input {
            width: 100%;
        }
        .thankyou p {
            font-size: 14px;
            line-height: 20px;
        }
        .form {
            padding: 50px 60px 50px 60px;
        }
    }
    .space {
        margin-top: 50px;
    }
    .space2 {
        margin-top: 30px;
    }
    .space3 {
        margin-top: 100px;
    }
  </style>
</head>

<body>
    <div class="headercontainer">
       <br><br>
        <p>Kajian Kepuasan Pekerja</p>
        <div class="space"></div>
        <img src="img/checked.png">
    </div>
    <div class="space"></div>
    <div class="thankyou">
        <p>Jawapan dihantar! Terima kasih atas kerjasama anda!</p><br><br>
        <p><span style="font-size:16px; color: blue; cursor: pointer; text-decoration:underline;" ><a href="satisfaction-surveyBM.php">Kembali ke kajian</a></span></p>
    </div>
    <div class="space"></div>

</body>

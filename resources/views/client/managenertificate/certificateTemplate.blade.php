<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8;
        }
        .certificate {
            height: 650px;
            background: white;
            border: 5px solid #000;
            padding: 10px;
            position: relative;
            text-align: center;
            font-family: Arial, sans-serif;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.2);
        }
        .certificate img.logo {
            width: 60px;
            position: absolute;
        }
        .logo-top {
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
        }
        .logo-left {
            top: 250px;
            left: 60px;
        }
        .logo-bottom {
            bottom: 70px;
            left: 30%;
            transform: translateX(-50%);
        }
        .title {
            font-size: 32px;
            font-weight: 800;
            margin-top: 100px;
            color: gray;
        }
        .subtitle {
            font-size: 18px;
            font-weight: bold;
            color: gray;
        }
        .certificate-award {
            background: gray;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 18px;
            font-weight: 800;
        }
        .recipient {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
        .content {
            font-size: 11px;
            margin: 0px 40px;
            line-height: 1.5;
        }
        .footer {
            margin-top: 40px;
            padding: 10px;
        }

        .footer .left {
            text-align: left;
        }

        .footer img {
            width: 80px;
            height: 40px;
            margin-left: 90px;
        }

        .footer .left-line {
            border: 2px solid gray;
            width: 200px;
            margin-left: 30px;
        }

        .principal1 {
            margin-left: 25px;
        }
        .principal2 {
            margin-left: 80px;
            margin-top: -10px;
        }

        .footer .right {
            text-align: right; /* Align text to the right for the right section */
        }

        .right-line {
            border: 2px solid gray;
            width: 200px;
            margin-left: 770px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="certificate">
        <img src="{{ $logo }}" class="logo logo-top" alt="logo">
        <h2 style="font-size: 18px; font-weight: 600;">{{$office_name}}</h2>
        <span style="margin-left: 450px; font-size: 15px;">{{$serial_number}}</span>
        <img src="{{ $stamp }}" class="logo logo-left" alt="stamp">
        <h1 class="title">CERTIFICATE</h1>
        <h3 class="subtitle">OF ACHIEVEMENT</h3>
        <button class="certificate-award">THIS CERTIFICATE IS AWARDED TO</button>
        <p class="recipient">{{ $name }} [{{ $id_card_number }}]<</p>
        <hr style="border: 3px solid gray; margin: 20px 20px;">
        <p class="content"> {{ $body_text }}</p>
        
        <!-- Footer Section -->
        <div class="footer">
            <div class="left">
                <img src="{{ $signature }}" alt="signature">
                <hr class="left-line">
                <p class="principal1">{{ $authorize_person }}</p>
                <p class="principal2">{{ $designation }}</p>
            </div>
            <div class="right">
                <p class="date" style="margin-top: -120px; margin-right: 30px;">{{ $date }}</p>
                <hr class="right-line">
                <p style="margin-right: 80px;">DATE</p>
            </div>
        </div>
        
    </div>
</body>
</html>
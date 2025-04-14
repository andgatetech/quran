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
            background-image: url('{{ url('/')."assets/img/cert-bg.jpg" }}');
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
        

        .principal1 {
            margin-left: 25px;
        }
        .principal2 {
            margin-left: 80px;
            margin-top: -10px;
        }

        
        .right-line {
            border: 2px solid gray;
            width: 200px;
            margin-left: 770px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .footer-box {
            text-align: center;
            width: 30%;
        }

        .footer-box img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .footer-line {
            border-top: 2px solid gray;
            width: 80%;
            margin: 10px auto;
        }

        .footer-text {
            font-size: 14px;
            font-weight: bold;
        }


    </style>
</head>
<body>
    <div class="certificate">
        <img src="{{ storage_path('app/public/'.$logo) }}" class="logo logo-top" alt="logo">
        <h2 style="font-size: 18px; font-weight: 600;">{{$office_name}}</h2>
        <span style="margin-left: 450px; font-size: 15px;">{{$serial_number}}</span>
        <img src="{{ storage_path('app/public/'.$stamp) }}" class="logo logo-left" alt="stamp">
        <h1 class="title">CERTIFICATE</h1>
        <h3 class="subtitle">OF ACHIEVEMENT</h3>
        <button class="certificate-award">THIS CERTIFICATE IS AWARDED TO</button>
        <p class="recipient">{{ $name }} [{{ $id_card_number }}]<</p>
        <hr style="border: 3px solid gray; margin: 20px 20px;">
        <p class="content"> {{ $body_text }}</p>
        
        <!-- Footer Section -->
        <div class="footer">
            {{-- Authorized Person 1 --}}
            <div class="footer-box">
                <img src="{{ public_path('storage/'.$signature) }}" alt="Signature 1">
                <div class="footer-line"></div>
                <div class="footer-text">{{ $authorize_person }}</div>
                <div class="footer-text">{{ $designation }}</div>
            </div>

            {{-- Authorized Person 2 (Optional) --}}
            @if ($authorize_person2)
            <div class="footer-box">
                <img src="{{ public_path('storage/'.$signature2) }}" alt="Signature 2">
                <div class="footer-line"></div>
                <div class="footer-text">{{ $authorize_person2 }}</div>
                <div class="footer-text">{{ $designation2 }}</div>
            </div>
            @else
            <div class="footer-box">
                {{-- Empty to keep layout balanced --}}
            </div>
            @endif

            {{-- Date --}}
            <div class="footer-box">
                <div class="footer-text" style="margin-bottom: 20px;">{{ $date }}</div>
                <div class="footer-line"></div>
                <div class="footer-text">DATE</div>
            </div>
        </div>

        
    </div>
</body>
</html>
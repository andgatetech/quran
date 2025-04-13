<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    <style>
        @page {
            margin: 0cm;
        }
        body {
            margin: 0cm;
            font-family: DejaVu Sans, sans-serif;
            background: #fff;
        }

        .wrapper {
            padding: 30px 50px;
            position: relative;
            box-sizing: border-box;
            border: 10px solid #000;
            height: 100%;
        }

        .logo-top {
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
        }

        .stamp {
            position: absolute;
            top: 160px;
            left: 50px;
            width: 80px;
        }

        .serial-number {
            position: absolute;
            top: 30px;
            right: 50px;
            font-size: 14px;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-top: 130px;
        }

        .office-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .certificate-title {
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .award {
            background-color: #444;
            color: #fff;
            display: inline-block;
            padding: 8px 20px;
            font-weight: bold;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .recipient {
            font-size: 22px;
            font-weight: bold;
            margin: 10px 0 20px;
        }

        .body-text {
            font-size: 14px;
            text-align: center;
            line-height: 1.8;
            width: 80%;
            margin: 0 auto 40px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
        }

        .footer-col {
            width: 30%;
            text-align: center;
        }

        .footer-col img {
            width: 80px;
            height: auto;
        }

        .line {
            border-top: 2px solid gray;
            margin: 10px auto;
            width: 80%;
        }

        .footer-text {
            font-size: 14px;
            font-weight: bold;
        }

        .date-col {
            width: 30%;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Top Elements -->
        <img src="{{ storage_path('app/public/'.$logo)  }}" alt="Logo" class="logo-top">
        <img src="{{ storage_path('app/public/'.$stamp) }}" alt="Stamp" class="stamp">
        <div class="serial-number">Serial No: {{ $serial_number }}</div>

        <!-- Header -->
        <div class="header">
            <div class="office-name">{{ $office_name }}</div>
            <div class="certificate-title">CERTIFICATE</div>
            <div class="subtitle">OF ACHIEVEMENT</div>
            <div class="award">THIS CERTIFICATE IS AWARDED TO</div>
            <div class="recipient">{{ $name }} [{{ $id_card_number }}]</div>
        </div>

        <!-- Body -->
        <div class="body-text">
            {!! nl2br(e($body_text)) !!}
        </div>

        <!-- Footer -->
        <div class="footer">
            <!-- Left Signature -->
            <div class="footer-col">
                <img src="{{ storage_path('app/public/'.$signature) }}" alt="Signature 1">
                <div class="line"></div>
                <div class="footer-text">{{ $authorize_person }}</div>
                <div class="footer-text">{{ $designation }}</div>
            </div>

            <!-- Right Signature -->
            <div class="footer-col">
                <img src="{{ storage_path('app/public/'.$signature2) }}" alt="Signature 2">
                <div class="line"></div>
                <div class="footer-text">{{ $authorize_person2 }}</div>
                <div class="footer-text">{{ $designation2 }}</div>
            </div>

            <!-- Date Section -->
            <div class="date-col">
                <div class="footer-text" style="margin-top: 50px;">{{ $date }}</div>
                <div class="line"></div>
                <div class="footer-text">DATE</div>
            </div>
        </div>
    </div>
</body>
</html>

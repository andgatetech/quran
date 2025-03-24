<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 0; size: A4 landscape; }
        body { 
            margin: 0;
            background: linear-gradient(45deg, #f3f4f6 25%, transparent 25%),
                        linear-gradient(-45deg, #f3f4f6 25%, transparent 25%);
            background-size: 60px 60px;
            font-family: 'Arial', sans-serif;
        }
        .container {
            width: 297mm;
            height: 210mm;
            position: relative;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .watermark {
            position: absolute;
            opacity: 0.1;
            font-size: 80px;
            transform: rotate(-45deg);
            top: 40%;
            left: 20%;
        }
        .header {
            text-align: center;
            padding: 40px 0;
        }
        .logo {
            width: 100px;
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .stamp {
            width: 100px;
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .content {
            text-align: center;
            padding: 0 50px;
            margin-top: 60px;
        }
        .signature-section {
            position: absolute;
            bottom: 60px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 60px;
        }
        .signature {
            width: 150px;
            height: 80px;
            object-fit: contain;
        }
        .serial-number {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ $logo }}" class="logo">
        <img src="{{ $stamp }}" class="stamp">
        
        <div class="header">
            <h1 style="color: #2c5282; font-size: 36px; margin-bottom: 10px;">
                {{ $office_name }}
            </h1>
            <h2 style="color: #1a365d; font-size: 28px; margin: 20px 0;">CERTIFICATE</h2>
            <h3 style="color: #4299e1; font-size: 22px; margin-bottom: 30px;">OF ACHIEVEMENT</h3>
        </div>

        <div class="content">
            <p style="font-size: 18px; margin: 20px 0;">THIS CERTIFICATE IS AWARDED TO</p>
            <h2 style="font-size: 28px; color: #2b6cb0; margin: 15px 0;">
                {{ $name }} <span style="font-size: 20px;">[{{ $id_card_number }}]</span>
            </h2>
            
            <div style="border-top: 3px solid #cbd5e0; margin: 30px auto; width: 200px;"></div>
            
            <p style="font-size: 16px; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                {!! nl2br($body_text) !!}
            </p>
        </div>

        <div class="signature-section">
            <div>
                <img src="{{ $signature }}" class="signature">
                <p style="margin-top: 10px; font-weight: bold;">{{ $authorize_person }}</p>
                <p style="color: #4a5568;">{{ $designation }}</p>
            </div>
            <div>
                <p style="font-size: 16px; font-weight: bold;">Date of Issue:</p>
                <p style="font-size: 16px;">{{ date('F j, Y', strtotime($date)) }}</p>
            </div>
        </div>

        <div class="serial-number">Serial Number: {{ $serial_number }}</div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Competition Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h1>Participant Report</h1>

    <h3>Competitions:</h3>
    <ul>
        @foreach($competition as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>

    <h3>Age Categories:</h3>
    <ul>
        @foreach($ageCategory as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>

    <h3>Perform Option:</h3>
    <ul>
        @foreach($recitationPiece as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>

    <h3>Method Of Perform:</h3>
    <ul>
        @foreach($recitationMethod as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>
</body>
</html>

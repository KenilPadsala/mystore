<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mail Notification' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #f8f9fa;
            margin: 0;
            padding: 0;
            background-color: #121212;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #1e1e1e;
            border: 1px solid #333;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.5);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #00bcd4;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th,
        table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            color: #f8f9fa;
        }
        table th {
            background-color: #333;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        a {
            color: #00bcd4;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ $title ?? 'Notification' }}</h1>
        </div>
        {{ $slot }}
        <div class="footer">
            <p>&copy; {{ date('Y') }} MyStore. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
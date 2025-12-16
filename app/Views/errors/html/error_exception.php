<!DOCTYPE html>
<html>
<head>
    <title>Exception Occurred</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial; background: #f8f8f8; padding: 20px; }
        .error-box { background: #fff; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        h1 { color: #c00; }
    </style>
</head>
<body>
    <div class="error-box">
        <h1>An error occurred</h1>
        <p><?= esc($message ?? 'Unknown error') ?></p>
    </div>
</body>
</html>

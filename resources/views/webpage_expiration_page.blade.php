<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session Expired</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .session-container {
      max-width: 400px;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .session-title {
      font-size: 24px;
      font-weight: bold;
      color: #dc3545;
      margin-bottom: 10px;
    }
    .session-message {
      font-size: 16px;
      color: #6c757d;
      margin-bottom: 20px;
    }
    .btn-primary {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <div class="session-container">
    <div class="session-title">Session Expired</div>
    @if(session('error'))
    {{ session('error') }}
  @else
  {{-- <p class="session-message">Your session has expired. Please log in again to continue.</p> --}}
  <p class="session-message">This link has already been used</p>
  @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

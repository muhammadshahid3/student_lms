<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student LMS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #10b981;
            --danger-color: #ef4444;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
        }

        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 40px;
        }

        .auth-card .card-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #667eea 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }

        .text-center a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-section i {
            font-size: 48px;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

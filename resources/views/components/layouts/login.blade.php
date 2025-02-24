<div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            max-width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgb(150, 234, 255);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header img {
            max-width: 150px; /* Gambar akan mengisi maksimal 150px */
            height: auto;     /* Tinggi gambar akan disesuaikan agar proporsional */
            object-fit: contain;
            margin-bottom: 10px;
        }

        .login-header h2 {
            margin-bottom: 0;
            font-weight: bold;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 50px;
        }

        .btn-login {
            width: 100%;
            border-radius: 50px;
            padding: 10px;
        }

        .text-center {
            margin-top: 20px;
        }

        .text-center a {
            color: #007bff;
        }
    </style>
</head>

<body>
    {{ $slot }}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
</body>

</html>
</div>

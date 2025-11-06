<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angola Tourism Insight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f7f4ff 0%, #e6e0ff 100%);
            color: #4b3f72;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .navbar-brand {
            font-weight: 600;
            color: #5c4b9d !important;
        }

        .btn-primary {
            background-color: #7f6df2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #6b5de0;
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
            background: linear-gradient(135deg, #ffffff 0%, #edeaff 100%);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #4a3d94;
        }

        .hero p {
            font-size: 1.2rem;
            color: #6b5ca6;
            max-width: 700px;
            margin: 20px auto;
        }

        .features {
            padding: 80px 0;
            background-color: #fff;
        }

        .feature-box {
            background: #f8f6ff;
            border-radius: 15px;
            padding: 30px;
            transition: all 0.3s ease-in-out;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            background: #f0edff;
        }

        .footer {
            background-color: #6c5ce7;
            color: #fff;
            text-align: center;
            padding: 30px 10px;
        }

        .footer a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

  
    @include('app.partials.header')
   
    @yield('content')
    <!-- FOOTER -->
    @include('app.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

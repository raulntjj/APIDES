<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/stretch-pro" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', 'sans-serif';
            color: white;
            background-color: #171419;
            overflow-y: hidden;
        }

        .borderContainer{
            position: relative;
            background: linear-gradient(to right, rgb(151, 29, 185), rgb(15, 117, 206));
            padding: 2px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .container {
            max-width: 500px;
            padding: 50px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .heading {
            font-family: 'Stretch Pro', 'sans-serif';
            text-align: start;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .subheading {
            text-align: justify;
            font-size: 18px;
            margin-bottom: 20px;
            color: #999;
        }

        .code-container{
            display: flex;
            justify-content: center;
            padding: 20px;
            border-radius: 10px;
            background: linear-gradient(to right, rgb(151, 29, 185), rgb(15, 117, 206));
            color: #fff;
            font-size: 1.5rem;
            font-weight: 900;
            letter-spacing: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            transition: background-color 0.3s;
        }

        .code-container:hover{
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .row-container{
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 768px) {
            .container {
                max-width: 500px;
            }
        }
    </style>

</head>
<body>
    <div class="row-container">
        <div class="borderContainer">
            <div class="container">
                {{ $slot }}

                <div class="footer">
                    &copy; 2024 DES
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function copyCode() {
            var content = document.getElementById('code').innerHTML;
            navigator.clipboard.writeText(content)
        }
    </script>
</body>
</html>

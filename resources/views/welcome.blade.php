<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DES API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/stretch-pro" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        * {
            font-family: 'Outfit';
            font-size: 1rem;
            color: white;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1e1e1e;
            width: 100%;
            height: 100vh;
        }

        .gradient{
            position: absolute;
            top: -20%;
            left: -5%;
            height: 60%;
            width: 30%;
            border-radius: 50%;
            background-image: linear-gradient(to left, rgba(151, 29, 185, 0.12), rgba(15, 117, 206, 0.12));
            filter: blur(1000px);
        }

        .gradient-bottom{
            position: absolute;
            bottom: -20%;
            right: -5%;
            height: 60%;
            width: 30%;
            border-radius: 50%;
            background-image: linear-gradient(to left, rgba(151, 29, 185, 0.12), rgba(15, 117, 206, 0.12));
            filter: blur(1000px);
        }

        .logo-background{
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-image: url('/img/DES.svg');
            background-position: center;
            background-repeat: no-repeat;
        }

        .content{
        }

        .teste{
            background-color: white;
        }

        .title{
            font-family: 'Stretch Pro', 'sans-serif';
            font-size: 4rem;
        }

        @media (max-width: 768px) {
            .title{
                font-family: 'Stretch Pro', 'sans-serif';
                font-size: 3rem;
            }
        }

        .welcome-content {
            max-width: 600px;
        }

        .welcome-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-description {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .purple{
            font-size: 1.125rem;
            padding: 0.75rem 1.5rem;
            background-image: linear-gradient(#981DB9, #981DB9);
            border: none;
        }

        .purple:hover{
            background-image: linear-gradient(#C632EE, #C632EE);
            border: none;
            color: white;
        }

        .additional-info {
            margin-top: 2rem;
        }

        .additional-info a {
            color: #2492F0;
        }

        .additional-info p {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .list-style{
            text-decoration: none;
            color: #C632EE;
        }
    </style>
</head>
<body>
    <div class="gradient"></div>
    <div class="gradient-bottom"></div>
    <div class="logo-background"></div>
    <div class="content">
        <div class="welcome-content">
            <h1 class="title">DEES<br>REST API</h1>
            <p class="welcome-description">O projeto Gestão de Desempenho Esportivo visa desenvolver um aplicativo mobile que auxilie escolas esportivas, responsáveis, profissionais esporte, esportistas de diversas modalidades no acompanhamento e aprimoramento de seu desempenho.</p>
            <div class="d-flex align-items-center">
                <a href="{{ url('/api/documentation') }}" class="btn btn-primary purple">Acesse a documentação</a>
                <a href="{{ url('/api/database') }}" class="list-style" style="margin-left: 10px">Ou acesse o diagrama do banco de dados &rarr;</a>
            </div>
            <div class="additional-info">
                <p><strong>Suporte:</strong> <a href="mailto:raulntjj@gmail.com">raulntjj@gmail.com</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

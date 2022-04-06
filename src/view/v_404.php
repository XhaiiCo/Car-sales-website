<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <title>404</title>
</head>

<body>
    <div class="card">
        <h1>404</h1>
        <h2>PAGE NOT FOUND</h2>
        <a class="btn btn-outline-light" href="<?= $router->generate('home') ?>">Revenir à l'accueil</a>
    </div>

</body>

</html>


<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Roboto Condensed', sans-serif;
    }

    body {
        background-image: url("./assets/img/site_elements/background/404.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .card {
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 20px;
        width: 27%;
        min-width: 350px;
        height: 400px;

    }

    h1 {
        font-size: 130px;
        color: white;
        text-transform: uppercase;
        margin-top: 20px;
        text-align: center;
    }

    h2 {
        font-size: 20px;
        color: silver;
        text-transform: uppercase;
        margin-top: 5px;
        text-align: center;
        margin-bottom: 50px;
    }

    .btn {
        width: 40%;
        margin: 0 auto;
    }
</style>
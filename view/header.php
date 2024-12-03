<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>3cket Desafio</title>
        <link rel="icon" type="image/x-icon" href="media/assets/favicon.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="media/css/styles.css" rel="stylesheet" />
        <link href="media/css/custom.css" rel="stylesheet" />
        <link href="media/css/bootstrap.min.css" rel="stylesheet">


    </head>
    <div class="service-container" data-service="<?= htmlspecialchars(json_encode($categoriesNames)) ?>">

    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-3cket fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="#page-top"><span class="blue3cket">3cket</span> Desafio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#images">Imagens</a></li>
                        <li class="nav-item"><a class="nav-link" href="#categories">Categorias</a></li>
                    </ul>
                </div>
            </div>
        </nav>
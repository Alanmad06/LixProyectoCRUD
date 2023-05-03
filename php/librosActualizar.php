<?php

    include("conexion.php");

    $id = $_POST['id'];
    $conex = new conexion;

    if (is_null($conex->buscaridlibro($id))) {

        echo "<script> alert('Libro no encontrado');</script>";

    } else {

        $idlibro = $conex->selectIDLibro($id);
        $autores = $conex->selectAutores();

        foreach ($autores as $autor) {

            if ($autor['id'] == $idlibro['autor_id']) {

                ?>

                <html lang="es">

                <head>

                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>LIX: Inicio</title>

                    <link rel="icon" type="image/x-icon" href="../img/logo.png">
                    <link rel="stylesheet" href="../css/bootstrap.min.css">
                    <script src="../js/bootstrap.bundle.min.js"></script>
                    <style>
                        .navbar {
                            background-image: url('../img/libros1.jpg');
                            background-position: 50% 30%;
                            height: 80px;
                        }
                    </style>

                </head>

                <body>

                    <nav class="navbar navbar-expand-lg bg-body-tertiary">

                        <div class="container-fluid">

                            <a class="navbar-brand" href="../index.html">LIX</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="../src/inicio.html">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../src/contacto.html">Contacto</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Libros
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../src/librosInsertar.html">Ingresar Libros</a></li>
                                            <li><a class="dropdown-item" href="../src/librosActualizar.html">Actualizar Libros</a></li>
                                            <li><a class="dropdown-item" href="librosVer.php">Ver Libros</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../src/sobrenosotros.html">Sobre nosotros</a>
                                    </li>

                                </ul>

                                <input class="btn btn-success d-flex" type="button" value="Registrarse"
                                    onclick="location.href='src/registro.html'">

                            </div>

                        </div>

                    </nav>

                    <div class="container my-5">

                        <div class="row-justify-md-center">

                            <div class="col-md-6">


                                <form method="POST">

                                    <div class="form-group">

                                        <label>ID </label>
                                        <input class="form-control my-2" id="id " name="id" value="<?php echo "" . $id . "" ?>"
                                            type="text">
                                        <label>Titulo </label>
                                        <input class="form-control my-2" id="titulo " name="titulo" type="text"
                                            value="<?php echo "" . $idlibro['titulo'] . "" ?>">
                                        <label>Año </label>
                                        <input class="form-control my-2" id="año " name="año"
                                            value="<?php echo "" . $idlibro['año'] . "" ?>" type="number">
                                        <label>Autor </label>
                                        <input class="form-control my-2" id="autor " name="autor"
                                            value="<?php echo "" . $autor['nombre'] . "" ?>" type="text">
                                        <label>Nacionalidad del Autor </label>
                                        <input class="form-control my-2" id="nautor " name="nautor"
                                            value="<?php echo "" . $autor['nacionalidad'] . "" ?>" type="text">



                                        <button class="btn btn-success my-2" name="submit" type="submit">Actualizar</button>
                                        <button class="btn btn-dark my-2" type="reset">Reset</button>
                                        <button class="btn btn-dark my-2" name="delete" type="submit">Delete</button>

                                    </div>

                                </form>

                                <?php
                                // Verificar si se ha enviado el formulario
                                if (isset($_POST['submit'])) {
                                    // Recuperar el nombre ingresado
                                    $autor = $_POST['autor'];
                                    $titulo = $_POST['titulo'];
                                    $año = $_POST['año'];
                                    $nacio = $_POST['nautor'];



                                    $i = $conex->buscarAutor($autor, $nacio);
                                    if ($i == 1) {
                                        $conex->updateLibro($id, $titulo, $año, $conex->buscaridAutor($autor));
                                    } else {
                                        $conex->insertAutor($autor, $nacio);
                                        $conex->updateLibro($id, $titulo, $año, $conex->buscaridAutor($autor));



                                    }

                                } else if (isset($_POST['delete'])) {

                                    $conex->deleteLibro($id);
                                }
                                ?>

                            </div>

                        </div>

                    </div>

                    <footer class="bg-dark text-light py-3 fixed-bottom">

                        <div class="container">

                            <div class="row">

                                <div class="col-md-6">
                                    <p>©Lix</p>
                                </div>

                                <div class="col-md-6 text-md-end">
                                    <p>Derechos de autor © 2023 Todos los derechos reservados</p>
                                </div>

                            </div>

                        </div>

                    </footer>

                </body>

                </html>
                <?php

            }

        }

    }

    $conex->cerrar();

?>
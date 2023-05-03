<?php

  include("conexion.php");

  $conex = new conexion;
  $libros = $conex->selectLibros();
  $autores = $conex->selectAutores();

?>

<!DOCTYPE html>
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            onclick="location.href='../src/registro.html'">

        </div>

      </div>

    </nav>

    <div class="container my-4 ">
      <h1>Libros </h1>

      <div class="row ">

        <div class="col-md-6 ">

          <form action="../php/libros.php" method="POST">

            <div class="form-group my-5">

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Año</th>
                    <th scope="col">Autor</th>
                  </tr>
                </thead>

                <?php

                  foreach ($libros as $libro) {

                    foreach ($autores as $autor) {

                      if ($autor['id'] == $libro['autor_id']) {
                        echo "<tbody>
                              <tr>
                              <th scope='row'>" . $libro['id'] . "</th>
                              <td>" . $libro['titulo'] . "</td>
                              <td>" . $libro['año'] . "</td>
                              <td>" . $autor['nombre'] . "</td>
                              </tr>
                              </tbody>";
                      }

                    }
                    
                  }

                ?>

              </table>
              
            </div>

          </form>

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

  $conex->cerrar();

?>
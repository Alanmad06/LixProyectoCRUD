<?php
class conexion {

    private $conexion;
    private $userServer = "root";
    private $passwordServer = "";
    private $server = "localhost";
    private $db = "db_biblioteca";
    private $user;
    private $password;
    private $userRegistrer;
    private $passwordRegistrer;
    private $passwordRegistrer1;
    private $nombreRegistrer;
    private $apellidoRegistrer;





    public function __construct()
    {

        $this->conexion = new mysqli($this->server, $this->userServer, $this->passwordServer, $this->db);

        if ($this->conexion->connect_errno) {

            die("Fallo al conectar a la base de datos" . $this->conexion->connect_errno . ")");

        }
        session_start();
    }

    public function cerrar()
    {

        $this->conexion->close();

    }

    public function login($user, $password)
    {

        $this->user = $user;
        $this->password = $password;

        $query = "SELECT id, nombre, apellido, `user`, `password` FROM usuario WHERE user ='" . $this->user . "' and password ='" . $this->password . "'";

        $consulta = $this->conexion->query($query);

        if ($row = mysqli_fetch_array($consulta)) {

            

            echo "<script> alert('Haz iniciado sesion');</script>";

        } else {

            echo "<script> alert('Usuario o Contraseña Incorrectas');</script>";

        }

    }

    public function registrer($userRegistrer, $passwordRegistrer, $nombreRegistrer, $apellidoRegistrer)
    {


        $query = "INSERT INTO usuarios VALUES (null,'". $nombreRegistrer ."','". $apellidoRegistrer ."','". $userRegistrer ."','". $passwordRegistrer ."')";

        $consulta = $this->conexion->query($query);

        if (mysqli_affected_rows($this->conexion) > 0) {
            echo "<script> alert('Usuario insertado correctamente');</script>";
        } else {
            echo "<script> alert('Error al insertar el usuario');</script>";
        }

    }

    public function deleteUsuario($id)
    {

        $query = "DELETE FROM usuarios WHERE id = " . $id . "";
        $consulta = $this->conexion->query($query);

        if (mysqli_affected_rows($this->conexion) > 0) {
            echo "<script> alert('Libro insertado correctamente');</script>";
        } else {
            echo "<script> alert('Error al insertar el libro');</script>";
        }

    }

    public function deleteLibro($id)
    {

        $query = "DELETE FROM libros WHERE id = " . $id . "";
        $consulta = $this->conexion->query($query);

        if (mysqli_affected_rows($this->conexion) > 0) {
            echo "<script> alert('Libro eliminado correctamente');</script>";
        } else {
            echo "<script> alert('Error al eliminar el libro');</script>";
        }

    }
    public function insertAutor($nombre, $nacio)
    {

        $query = "SELECT * FROM autores";
        $consulta = $this->conexion->query($query);

        while ($row = mysqli_fetch_array($consulta)) {

            if ($nombre == $row['nombre'] && $nacio == $row['nacionalidad']) {

                echo "<script> alert('Este Autor ya esta en la base de datos');</script>";

                break;

            }
        }


        if (!isset($row)) {
            $query = "INSERT INTO autores VALUES (null,'" . $nombre . "','" . $nacio . "')";
            $consulta = $this->conexion->query($query);

            if (mysqli_affected_rows($this->conexion) > 0) {
                echo "<script> alert('Autor insertado correctamente');</script>";

            } else {
                echo "<script> alert('Error al insertar el autor');</script>";
            }
        }



    }
    public function insertLibro($titulo, $ano, $autor, $nacio)
    {

        $query = "SELECT * FROM autores";
        $consulta = $this->conexion->query($query);

        while ($row = mysqli_fetch_array($consulta)) {

            if ($autor == $row['nombre'] && $nacio == $row['nacionalidad']) {
                $query = "INSERT INTO libros VALUES (null,'" . $titulo . "'," . $ano . "," . $row['id'] . ")";
                $consulta = $this->conexion->query($query);

                if (mysqli_affected_rows($this->conexion) > 0) {
                    echo "<script> alert('Libro insertado correctamente');</script>";
                } else {
                    echo "<script> alert('Error al insertar el libro');</script>";
                }


                break;
            }
        }


        if (!isset($row)) {
            $query = "INSERT INTO autores VALUES (null,'" . $autor . "','" . $nacio . "')";
            $consulta = $this->conexion->query($query);

            if (mysqli_affected_rows($this->conexion) > 0) {
                echo "<script> alert('Autor insertado correctamente');</script>";

                $this->insertLibro($titulo, $ano, $autor, $nacio);
            } else {
                echo "<script> alert('Error al insertar el autor');</script>";
            }
        }

    }
    public function selectIDLibro($id)
    {

        $query = "SELECT * FROM libros WHERE id =".$id."";
        $consulta = $this->conexion->query($query);

        if ($row = mysqli_fetch_array($consulta)) {
            $libros = $row;

            return $libros;
        } else {

            return array();
        }

    }
    public function buscaridAutor($autor)
    {

        $query = "SELECT id FROM autores WHERE nombre ='" . $autor . "'";
        $consulta = $this->conexion->query($query);

        if ($fila = mysqli_fetch_assoc($consulta)) {
            $id = $fila['id'];
            return $id;
        } else {
            return;

        }


    }

    public function buscaridLibro($id)
    {

        $query = "SELECT * FROM libros WHERE id =" . $id . "";
        $consulta = $this->conexion->query($query);

        if ($fila = mysqli_fetch_assoc($consulta)) {
            
            return $id;
        } else {
            return null;

        }


    }


    public function updateLibro($id, $titulo, $ano, $autor_id)
    {

        $query = "UPDATE libros SET titulo = '" . $titulo . "',año = " . $ano . ",autor_id = '" . $autor_id . "'  WHERE id = " . $id . "";
        $consulta = $this->conexion->query($query);

        if (mysqli_affected_rows($this->conexion) > 0) {
            echo "<script> alert('Libro actualizado correctamente');</script>";

        } else {
            echo "<script> alert('Error al actualizar el libro');</script>";
        }



    }
    public function buscarAutor($autor,$nacio) {

        $query = "SELECT * FROM autores";
        $consulta = $this->conexion->query($query);

        while ($row = mysqli_fetch_array($consulta)) {

            if ($autor == $row['nombre'] && $nacio ==$row['nacionalidad']) {


                return 1;

            }
        }

        return 0;

    }

    public function updateAutor($id, $autor, $nacio) {

        $query = "UPDATE autores SET nombre = '" . $autor . "',nacionalidad = '" . $nacio . "' WHERE id = " . $id . "";
        $consulta = $this->conexion->query($query);

        if (mysqli_affected_rows($this->conexion) > 0) {
            
            echo "<script> alert('Libro actualizado correctamente');</script>";

        } else {

            echo "<script> alert('Error al actualizar el libro');</script>";

        }

    }
    public function updateUsuario($id, $nombre, $apellido, $user, $password) {

        $query = "UPDATE usuarios SET nombre = '" . $nombre . "',apellido = '" . $apellido . "',user = '" . $user . "',password = '" . $password . "' WHERE id = " . $id . "";
        $consulta = $this->conexion->query($query);

        if (mysqli_affected_rows($this->conexion) > 0) {

            echo "<script> alert('Usuario actualizado correctamente');</script>";

        } else {

            echo "<script> alert('Error al actualizar el Usuario');</script>";

        }

    }
    public function selectLibros() {

        $query = "SELECT * FROM libros";
        $consulta = $this->conexion->query($query);

        if ($consulta->num_rows > 0) {

            $libros = array();

            while ($row = $consulta->fetch_assoc()) {
                $libros[] = $row;
            }

            return $libros;

        } else {

            return ;

        }

    }

    public function selectAutores() {

        $query = "SELECT * FROM autores";
        $consulta = $this->conexion->query($query);

        if ($consulta->num_rows > 0) {

            $libros = array();

            while ($row = $consulta->fetch_assoc()) {
                $libros[] = $row;
            }

            return $libros;

        } else {

            return array();

        }

    }
    public function selectUsuarios() {

        $query = "SELECT * FROM usuarios";
        $consulta = $this->conexion->query($query);

        if ($consulta->num_rows > 0) {

            $libros = array();

            while ($row = $consulta->fetch_assoc()) {
                $libros[] = $row;
            }

            return $libros;

        } else {

            return array();

        }

    }

}
?>
<?php
    session_start();

    include "conection.php";

    $user = $_POST["usuario"];
    $pass = $_POST["password"];

    $con = new Conection();
    $con->conectarDB();

    $result = $con->consulta("SELECT usuario, tipo FROM usuarios WHERE usuario = '$user' AND password = '$pass';");

    if($result->num_rows > 0){
        $row = mysqli_fetch_array($result);

        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['tipo']    = $row['tipo'];
        
        mysqli_free_result($result);

        if(strcmp($_SESSION['tipo'],'profesor') == 0)
            header("Location: ../profesores");
        else if(strcmp($_SESSION['tipo'],'estudiante') == 0)
            header("Location: ../estudiantes");
    }
    else
        header("Location: ../entrar.php");

   $con->desconectarDB();
?>

<?php
include_once("funciones.php");

if($_POST){
    session_start();

    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    
    $conexion = abrirBBDD();
    $sql = "SELECT usuario, contraseña FROM administradores WHERE id=$id";

    $result = $conexion->query($sql);
    $row = $result->fetch_assoc();
    if ($usuario == $row['usuario'] && $contraseña == $row['contraseña']) {
        // Almacenar los datos en la sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['contraseña'] = $contraseña;
        ?>
        <meta http-equiv="REFRESH" content="0;url=menuadmin.php">
    <?php
    } else {
        ?>  
            <script>
                alert("El usuario no está registrado o alguno de los datos no es correcto");
            </script>              
            <meta http-equiv="REFRESH" content="0;url=admin.php">
        <?php
    }
} else {
    ?>
        <meta http-equiv="REFRESH" content="0;url=admin.php">
    <?php
}
?>
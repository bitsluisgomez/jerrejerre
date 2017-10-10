<!-- vim: sw=4 ts=4 expandtab -->
<html>
    <head>
    <title> Datos de los usuarios</title>
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="lib/css/tablas.css">
        <a href="formulario.html"> &#60;&#60; volver </a>
        <?php
            include("gestionar_datos.php");
            $gestionar_datos = new Gestionar_datos($_FILES);
        ?>
        <h3> Usuarios activo</h3>
        <?php
            $gestionar_datos->create_table(1);
        ?>
        <h3>Usuario inactivo</h3>
        <?php
            $gestionar_datos->create_table(2);
        ?>
        <h3> Usuario en espera </h3>
        <?php
            $gestionar_datos->create_table(3);
        ?>
    </body>
</html>

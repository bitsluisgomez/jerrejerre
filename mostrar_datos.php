<!-- vim: sw=4 ts=4 expandtab -->
<?php
include("config.php");
include("gestionar_db.php");
//guardar_archivo($_FILES["archivo_usuario"]);  
$usuarios = convertir_a_arreglo($_FILES["archivo_usuario"]["tmp_name"]);
$db = new Gestionar_db($G_HOST_NAME,$G_USER_NAME,$G_PASSWORD,$G_DATABASE_NAME);
insertar_datos_usuarios($usuarios,$db);


function insertar_datos_usuarios($usuarios,$db){
    for($i = 0; $i< count($usuarios);$i++){
        $usuario = $usuarios[$i];
        $db->insertar_datos($usuario["email"],$usuarios["nombre"],$usuario["apellido"],$usuario["codigo"]);
    }
}

function convertir_a_arreglo($name_file){
    $usuarios = Array();
    $fp = fopen($name_file, "r");
    while (!feof($fp)){
        $usuario = Array();
        $linea = fgets($fp);
        $datos_usuario = explode(",",$linea);;
        $usuario["email"] = $datos_usuario[0];
        $usuario["nombre"] = $datos_usuario[1];
        $usuario["apellido"] = $datos_usuario[2];
        $usuario["codigo"] = $datos_usuario[3];
        array_push($usuarios,$usuario);
    }
    fclose($fp);
    return $usuarios;
}

<!-- vim: sw=4 ts=4 expandtab -->
<?php
include("config.php");
include("gestionar_db.php");
class Gestionar_datos{
    private $usuarios = Array();
    function __construct($files){
        if(!empty($files["archivo_usuario"]["name"])){
            $file_user = $files["archivo_usuario"];
            global $G_HOST_NAME;
            global $G_USER_NAME;
            global $G_PASSWORD;
            global $G_DATABASE_NAME;
            $this->usuarios = $this->convertir_a_arreglo($file_user["tmp_name"]);
            $db = new Gestionar_db($G_HOST_NAME,$G_USER_NAME,$G_PASSWORD,$G_DATABASE_NAME);
            $this->insertar_datos_usuarios($this->usuarios,$db);
        }else{
            echo "<p class='error'>Por favor sube un archivo txt<p>";
            exit;
        }
    }
    function create_table($codigo){
        $table = "<table> 
            <tr class='encabezado_tabla'>
                <td>
                    <p>Email</p>
                </td>    
                <td>
                    <p>Nombre</p>
                </td>    
                <td>
                    <p>Apellido</p>
                </td>    
            </tr>";
        for($i = 0; $i<count($this->usuarios);$i++){
            $usuario = $this->usuarios[$i];
            if($usuario["codigo"] == $codigo){
                $table .= $this->create_row($usuario);
            }
       }
       $table .= "</table>";
       echo $table;
    }

    function insertar_datos_usuarios($usuarios,$db){
        for($i = 0; $i< count($usuarios);$i++){
            $usuario = $usuarios[$i];
            if($usuario["codigo"] < 4 && $usuario["codigo"] > 0 ){
                $db->insertar_datos($usuario["email"],$usuarios["nombre"],$usuario["apellido"],$usuario["codigo"]);
            }
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

    function create_row($usuario){
        $row = "<tr>";
        foreach($usuario as $key => $value ){
            if($key !== "codigo"){
                $row .= "<td> <p>".$value."</p></td>";
            }
        }
        $row .= "</tr>";
        return $row;
    }

}

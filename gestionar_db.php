<!-- vim: sw=4 ts=4 expandtab -->
<?php
class Gestionar_db{ 
    private $con;
    function __construct($host_name,$user_name,$password,$database_name){
        $this->con = mysqli_connect($host_name,$user_name,$password,$database_name);
        if(!$this->con){
            die("Conexion fallida".mysqli_connect_error());
        }
    }
    function insertar_datos($email,$name_user,$apellido,$codigo){
        $sql = "INSERT INTO usuarios VALUES (NULL, '".$email."', '".$name_user."', '".$apellido."', '".$codigo."')";
        if(mysqli_query($this->con,$sql)){
        }else{
            echo "Error al ingresar un nuevo usuario";
        }
    }
}

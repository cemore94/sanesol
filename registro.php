<?php
include("conexion.php");
$v1=$_POST['nombres'];
$v2=$_POST['apellidos'];
$v3=$_POST['cbmasculino'];
$v4=$_POST['cbfememino'];
$v5=$_POST['cbintereses'];

insertar($v1,$v2,$v3,$v4,$v5);
function insertar($v1,$v2,$v3,$v4,$v5,$v6){
  global $conex;
  if(!mysqli_querry($conex,"INSERT INTO usuario(idalumno,nombres,apellidos,sexo,celular,interes)VALUES ('".$v1."',''".$v2."',''".$v3."',''".$v4."',''".$v5."'',''".$v4."')"))
  echo "ERROR!";
  else{
      echo"Acción exitosa";
  }
}
?>































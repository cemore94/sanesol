<html>
<head>
<title> Mostrando informacion de mysql  CON ALUMNO</title>
<head>
<body>
<h2> Mostrando mis registros</h2>
<?php
include ("conexion.php");
global $conex;
echo "table width=840>";
echo "<tbody>";
echo "tbody>";
echo "tr>";
echo "<th witdh='100>idalumno</th>";
echo "<th width='100'>Nombres</th>";
echo "<th width='100'>Apellidos</th>";
echo "<th width='100'>celular</th>";
echo "<th width='100>sexo</th>";
echo "<th width='100' interes";
echo "<th width='100'>  </th>";
echo "</tr>";

$sql=mysqli_query($conex,"SELECT* FROM alumnos");
while($row=mysqli_fetch_array($sql)){
    echo "<tr>";
    echo "td align='center'>".$row['idalumno']."</td>";
    echo "td align='center'>".$row['nombre']."</td>";
    echo "td align='center'>".$row['celular']."</td>";
    echo "td align='center'>".$row['cbmasculino']."</td>"; 
    echo "td align='center'>".$row['cbfemenino']."</td>";
    echo "td align='center'>".$row['cbinteres']."</td>";
    echo '<td><a href="eliminar.php?id='.$row['id'].'">Eliminar alumno</a></td>';
    echo "</tr";
 
}

echo "</tbody";
echo "</table";
?>
</body>
</html>





















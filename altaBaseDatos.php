<?php
// primero incluimos el documento donde se encuetran nuestras funciones para poder llamarlas
require_once("biblioteca.php");

//conectamos con la base de datos usando la funcion de la biblioteca
$con =conbd();
$haydatos="";
$haydatos=(count($_POST)>0);
if(!$haydatos)
{
         //

         //
    echo "<form name='frm' method='post' action='altaBaseDatos.php'>";
   //  echo "<a href=./altaBaseDatos.php>hacer un alta </a>";
    echo "<table     >";
    echo br(1);
     echo "<tr >";
         echo "<td  >";
             echo "<span style='color:red'>*</span>Nombre: ";
         echo "</td>";
         echo "<td style=\"padding-right:5px;\" >";
             echo caja("nombre");
         echo "</td>";
         echo "<td  >";
             echo "Apellido 1: ";
         echo "</td>";
         echo "<td>";
             echo caja("ape");
         echo "</td>";
     echo "</tr>";

     echo "<tr >";
        echo "<td  >";
         echo "edad";
        echo "</td>";
        echo "<td  >";
         echo caja("edad");
        echo "</td>";

     echo "</tr>";

   echo "</table>";
   echo boton("alta","realizar alta");
   echo "</form>";
}else
{   
     $nom="";
     $ape="";
     $edad=0;
     if (isset($_POST['nombre']))
     {
         $nom= $_POST['nombre'];
     }
     if (isset($_POST['ape']))
     {
         $ape= $_POST['ape'];
     }
    if (isset($_POST['edad']))
     {
         $edad= $_POST['edad'];
     }
    
      if($nom == "")
      {
            echo "<form name='frm' method='post' action='altaBaseDatos.php'>";
           //  echo "<a href=./altaBaseDatos.php>hacer un alta </a>";
            echo "<span style='color:red'>INTRODUCE EL NOMBRE!!!</span>";
            echo "<table     >";
             echo "<tr >";
                 echo "<td  >";
                     echo "<span style='color:red'>*</span>Nombre: ";
                 echo "</td>";
                 echo "<td style=\"padding-right:5px;\" >";
                     echo caja("nombre");
                 echo "</td>";
                 echo "<td  >";
                     echo "Apellido 1: ";
                 echo "</td>";
                 echo "<td>";
                     echo caja("ape",$ape);
                 echo "</td>";
             echo "</tr>";

             echo "<tr >";
                echo "<td  >";
                 echo "edad";
                echo "</td>";
                echo "<td  >";
                 echo caja("edad",$edad);
                echo "</td>";

             echo "</tr>";

           echo "</table>";
           echo boton("alta","realizar alta");
           echo "</form>";
      }
 else {
         //aqui realizamos la consulta de SQL
         // se usa sprintf porque guarda la cadena  en la variable $sql 
         $sql=sprintf("INSERT into ejemplo (Nombre,Apellido,edad) VALUES ('%s','%s','%d')",$nom,$ape,$edad);
         
         //aqui se ejecuta la consulta SQL por lo que añade la persona en este momento
        mysql_query($sql);
  
        //comprobamos que realiza la conslta mirando si affecta a alguna fila
        $num=mysql_affected_rows();
        if ($num<1)
            echo "<label class=\"nom\">Error en la consulta, o no se ha podido hacer el alta</label>";
        else 
        {
           echo  "<label class=\"nom\">la persona se a&ntilde;adio correctamente</label>";
         }
      
      //ahora vamos a ver por pantalla  la tabla con las personas añadidas
      
       //hacemos la consulta para que nos muestre todo lo que tiene la tabla ejemplo
      //podeis probar para que lo muestre ordenado de alguna manera con la consulta 
      //por ejemplo  podriais poner que aparezcan primero las altas mas recientes...
         $sql="SELECT * FROM ejemplo ORDER BY idpersona desc";
         
         //ahora la consulta devuelve la tabala y la guarda en $res
         // ahora $res es un array con las filas de la tabla
         $res=mysql_query($sql);
         //aquie se guarda el numero de filas de la tabla
         $num=mysql_num_rows($res);
         //si no hay filas no hay ninguna persona que mostrar
           if($num<1)
               echo "<label class=\"nom\">No hay datos que mostrar de personas <br /></label>";
           
           //recorremos el array  de $res y vemos lo que tiene cada fila y lo mostramos en una tabla
           
         echo "<table  cellpadding='5'border='1'>";
         
         //vamos a poner el nombre de cada columna
         echo "<tr>";
                echo "<th>Nombre</th><th>apellido</th><th>edad</th>";
         echo "</tr>";  
       
         while($fila=mysql_fetch_array($res))
         {
             //hacemos la fila por cada iteracion
             echo "<tr>"; 
                //mostramos lo que hay en cada fila de la tabala accediendo al contenido de cada campo
                printf("<td>%s</td><td>%s</td><td>%s</td>",$fila['nombre'],$fila['apellido'],$fila['edad']);
             echo "</tr>";  
         } 
        echo "</table>";
        echo "<a href=./bajaBaseDatos.php>eliminar de la base de datos </a>";
    }
}

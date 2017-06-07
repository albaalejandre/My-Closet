<?php
require_once("biblioteca.php");
 session_start();
  $sesion="";
  $idUsu="";
  $sesion=$_SESSION['id'];
  if($sesion=="")
  {
      header("Location: index.php");
  }
  echo cabecera($sesion,"Lista Compra",2);
  $con =conbd();
  echo "<h1  class='col-md-10 ' > <img    src='images/armarioad.png' width='40'/>Administrar mi armario</h1>";
  echo "<div class='col-md-2 ' style='color:#444;padding-top:28px'><a href='nuevaPrenda.php' data-toggle='tooltip'   data-placement='top' title='Añadir producto' style='color:#444'  ><img    src='images/add.png' width='23'/> Nueva prenda   </a></div>";
  
        $sql="SELECT * From listacompra where idUsu='".$sesion."'order by nombre ";
       // echo $sql;
       // echo "sesion id usu = ".$sesion;
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)echo ("No hay datos que mostrar");
        echo "<table  class= 'table table-hover'>";
         echo "<tr> 
                          <td   class='lista' > </td>
                          <th   class='lista' >Nombre de la prenda </th>
                          <th     class='lista' >Marca</th>
                          <th     class='lista' >Cantidad</th>
                          <th     class='lista '  >Precio</th>
                          <th     class='lista '  ></th>
                          <th     class='lista '  ></th>
                          <th     class='lista '  ></th>
                       
             </tr>";
            while($fila=mysqli_fetch_array($res))
             {
               
               
                 echo "<tr>"; 
                 
                printf("<td   class='lista'  width='35'><img src='imgUsu/%s' class='foto' width='35' /></td>
                        <td   class='lista' >%s </td>
                         <td   class='lista' >%s</td>
                          <td   class='lista' >%s%s</td>
                          <td   class='lista' >%0.2f€</td>
                          <td   class='lista ' >%s</td>
                        <td  class='lista' width='35'><a href='editPrenda.php?id=%d'><img   data-toggle='tooltip' data-placement='top' title='Modificar Prenda' src='images/edit.png' width='20'/></a></td> 
                        <td  class='lista' width='35'><a href='eliminarPrenda.php?id=%d'><img   data-toggle='tooltip' data-placement='top' title='ELIMINAR PRENDA !' src='images/delete.png ' width='20'/></a></td>                    
                        
                        ",$fila['imagen'],$fila['nombre'],$fila['marca'],$fila['cantidad'],$fila['medida'],$fila['precio'],$fila['comentarios'],$fila['idLista'],$fila['idLista']);
            
            
                echo "</tr>";  
            }
        echo "</table>";
  
  echo finpag();
?>

<?php
require_once("biblioteca.php");
session_start();
 if (isset($_SESSION['id']))
{
    $sesion=$_SESSION['id'];
}
if($sesion==0)
{
    header("Location: index.php");
}

$con=  conbd();
       $sql="select * from escandallo where idLista='".$_GET['id']."' GROUP BY idReceta ";
      // echo $sql;
                     $res=mysqli_query($con, $sql);
                     $num=mysqli_num_rows($res);
                    
                     if($num>0)
                     {
                          echo cabecera($sesion,"Lista Compra",2);
                     $sql1="select nombre,marca from listacompra where idLista='".$_GET['id']."' ";
                      
                     $res1=mysqli_query($con, $sql1);
                     
                     $fila1=mysqli_fetch_array($res1);
                         echo "<br/><p class='bg-danger'>No se puede eliminar el ingrediente: <b>".$fila1["nombre"]." (".$fila1["marca"].")</b>";
                         echo "<br/>Esta siendo usado por: ";
                         while ( $fila=mysqli_fetch_array($res))
                         {
                              
                             $sql2="select nombre from receta where idReceta='".$fila["idReceta"]."'  ";                       
                             $res2=mysqli_query($con, $sql2);
                             $fila2=mysqli_fetch_array($res2);
                             echo "<br>&nbsp;&nbsp;&nbsp;- <b>".$fila2["nombre"]."</b> <a href='modEscandallo.php?id=".$fila['idReceta']."'><img    img style='margin-right:4px' data-toggle='tooltip' data-placement='top' title='Modificar escandallo' src='images/edit.png' width='20'/></a>";
                            
                             
                            
                         }
                         echo "</p>";
                          echo finpag();
                     }
                     else 
                     {
                          // echo " <br/> se elimina";
                        $sql="Delete From listacompra WHERE idLista='".$_GET['id']."'";
                        $res=mysqli_query($con, $sql);
                        header("Location: armario.php");
                     }
               

?>

<?php
require_once("biblioteca.php");
 session_start();
 $altaReceta=0;
   $sesion=$_SESSION['id'];
  if($sesion=="")
  {
      header("Location: index.php");
  }
//conectamos con la base de datos usando la funcion de la biblioteca
$con =conbd();
$haydatos="";
$haydatos=(count($_POST)>0);

$idLote="";
if (isset($_GET['id']))
{
    $idLote= $_GET['id'];
}

 if($haydatos)
    {
  
           $sql="SELECT idListaCompra,idProductoLote From productoslote where idLote='".$idLote."' ";
         //  echo $sql;
         $res=mysqli_query($con, $sql);  
        while ($fila=mysqli_fetch_array($res))
        {
            //echo "<br/>lote=".$_FILES["imagen".$fila["idListaCompra"]]["name"]."<br />";
                $nombreImagen="";
              if(!$_FILES["imagen".$fila["idListaCompra"]]["name"]=="" )
               {
                    $uploaddir="./imgUsu/";   //carpeta destino 
                    $uploadfile=$uploaddir.basename($_FILES["imagen".$fila["idListaCompra"]]["name"]); //nom fich 
                     if (move_uploaded_file($_FILES["imagen".$fila["idListaCompra"]]["tmp_name"], $uploadfile)) 
                     {
                        $nombreImagen.= $_FILES["imagen".$fila["idListaCompra"]]["name"];
                       
                     }
                     else 
                     {   
                           echo "<pre>";  //modo preformateado 
                           echo "Error al subir el fichero\n"; 
                           echo "Para poder depurar mostraremos toda la información disponible: "; 
                           print_r($_FILES); 
                           echo "</pre>";
                       }
                  }  
            
            $sql1= sprintf("UPDATE productoslote set numeroLote='%s', fechaCaducidad='%s',imagen='%s',nombre='%s',marca='%s'
                                                           WHERE idProductoLote='%s'",$_POST["lote".$fila["idListaCompra"]],$_POST["f".$fila["idListaCompra"]],$nombreImagen,$_POST["nombre".$fila["idListaCompra"]],$_POST["marca".$fila["idListaCompra"]],$_POST["idProductoLote".$fila["idProductoLote"]]);
            //echo $sql.br(1).$sql1;
             mysqli_query($con, $sql1);
             header("Location: temporada.php");
            
        }  
    }  else {
        


 echo cabecera($sesion,"Reg. Sanitario",4);
 //echo "id lote ".$idLote;
        $sql="SELECT receta From lote where idLote='".$idLote."' ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        $fila=mysqli_fetch_array($res);
       // echo $sql.br(1);
      
        
        $nombreReceta=$fila["receta"];
        
       echo "<form name='frm' method='post' class='form-horizontal' action='prendasTemporada.php?id=".$idLote."'  class='form-group '  enctype='multipart/form-data' >";
        echo "<h1  class='col-sm-12 ' style='margin-bottom:24px'> <img    src='images/lotes.png' width='40'/>Registro de ".$nombreReceta."</h1>Introduzca el numero de colección o una foto y la fecha de adquisición de cada prenda:<br/><br/>";
         $sql="SELECT idListaCompra,idProductoLote From productoslote where idLote='".$idLote."' ";
         $res=mysqli_query($con, $sql);  
        // echo $sql;
        while ($fila=mysqli_fetch_array($res))
        {
           $sql1="SELECT nombre,marca,imagen From listacompra where idLista='".$fila["idListaCompra"]."' ";
         $res1=mysqli_query($con, $sql1);  
         $fila1=mysqli_fetch_array($res1);
          echo "<div class='form-group  ' >";
             echo "<div class='col-sm-4'  style='margin-top:14px'>"; 
                echo " <img src='imgUsu/".$fila1["imagen"]."' class='foto' width='35' /> ";
                echo $fila1["nombre"]." - ".$fila1["marca"];
             echo "</div  >";
             echo "<div class='col-sm-4'>";
             echo "<div style='font-size:15px;'>";
                echo adjuntar("imagen".$fila["idListaCompra"]);
             echo "</div>";
                echo caja("lote".$fila["idListaCompra"],"nº de lote");
             echo "</div  >";
             echo "<div class='col-sm-4' style='margin-top:14px'>";   
                 echo "<input type='date' name='f".$fila["idListaCompra"]."' class='form-control' id='dp' />";
             echo "</div  >";
         echo "</div  >";
         echo hidden("idProductoLote".$fila["idProductoLote"], $fila["idProductoLote"]);
         echo hidden("nombre".$fila["idListaCompra"], $fila1["nombre"]);
          echo hidden("marca".$fila["idListaCompra"], $fila1["marca"]);
        }
           echo "<div class='form-group '  >";;
                        echo "<div class='col-sm-12 col-sm-offset-4 '>";
                            echo boton("Aceptar","Aceptar");
                        echo "</div>";
                echo "</div>";
        
      
       ?>
    <script>
     $( "#dp" ).datepicker({
		changeMonth: true,
		changeYear: true
	});
    </script> 
  <?php  
 echo finpag();
 }
?>

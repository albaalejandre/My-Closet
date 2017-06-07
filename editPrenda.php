<?php
// primero incluimos el documento donde se encuetran nuestras funciones para poder llamarlas
require_once("biblioteca.php");
 session_start();
 
   $sesion=$_SESSION['id'];
  if($sesion=="")
  {
      header("Location: index.php");
  }
//conectamos con la base de datos usando la funcion de la biblioteca
$con =conbd();
$haydatos="";
$haydatos=(count($_POST)>0);
 $id="";
if (isset($_GET['id']))
{
    $id= $_GET['id'];
}

if(!$haydatos)
{
      $sql="SELECT * From listacompra where idLista='".$id."'";
      $res=mysqli_query($con, $sql);
      $num=mysqli_num_rows($res);
      if($num<1)die("No hay datos que mostrar");
      $fila=mysqli_fetch_array($res);
    echo cabecera($sesion,"Lista Compra",2);
    echo "<form name='frm' method='post' class='form-horizontal' action='editPrenda.php'  class='form-group '  enctype='multipart/form-data'>";
   
    //  echo "<a href=./altaBaseDatos.php>hacer un alta </a>";
    //  imagen, nombre,marca',cantidad,medida',precio,comentarios
  
     echo "<div class='form-group'>";  
      echo "<h1  class='col-md-10 ' > <img    src='images/adLista.png' width='40'/>Nuevo producto</h1></br>";
         echo "</div>";
    echo "<div class='form-group'>";  
        echo "<div class='col-sm-1'>";
        echo "Nombre: ";
        echo "</div>";
		
        echo "<div class='col-sm-5'>";
        echo caja("nombre","",$fila["nombre"]);
        echo "</div>";

        echo "<div class='col-sm-1'>";
        echo "Marca: ";
        echo "</div>";
		
        echo "<div class='col-sm-5'>";
        echo caja("marca","",$fila["marca"]);
        echo "</div>";
    echo "</div>";
	
    echo "<div class='form-group'>";
        echo "<div class='col-sm-1'>";
        echo "Cantidad: ";
        echo "</div>";
		
        echo "<div class='col-sm-5'>";
        echo caja("cantidad","",$fila["cantidad"]);
        echo "</div>";

        echo "<div class='col-sm-1'>";
		 echo "Precio: ";
        echo "</div>";
		
		echo "<div class='col-sm-5'>";
        echo caja("precio","",$fila["precio"]);
        echo "</div>";
		
      //  echo "Medida: ";
      //  echo "</div>";
      //  echo "<div class='col-sm-5'>";
      //  $medidas=array("--","Kg","g","Ud");
        
       // echo combo("medida", $medidas, $medidas,$fila["medida"]);
        echo "</div>";  
     
    
    echo "<div class='form-group'>";
        echo "<div class='col-sm-1'>";
       
       
      
       
       
        echo "Imagen: ";
        echo "</div>";
       
        echo "<div class='col-sm-5'>";
         echo "<img class='foto' style='margin-bottom:5px;' src='imgUsu/".$fila["imagen"]."' width='45'>";
         echo hidden("img", $fila["imagen"]);
          echo hidden("idLista",$id);
        echo adjuntar();
        echo "</div>";
   echo "</div>";
    echo "<div class='form-group'>";	
            echo "<div class='col-sm-offset-1 col-sm-1'>";

                   echo boton("alta","modificar");
            echo "</div>";
          
    echo "</div>";
    
    
    
    echo   br(1);
    
    echo "</form>";
 
}else
{   
     $nombre="";
     $marca="";
     $cantidad="";
     $medida="";
     $precio="";
     $comentario="";
     $imagen="";
     $nombreImagen="";
     $img=$_POST["img"];
     $boton= $_POST["alta"];
     $idLista= $_POST["idLista"];
    if (isset($_POST['nombre']))
        {
         $nombre= $_POST['nombre'];
        }
    if (isset($_POST['marca']))
        {
         $marca= $_POST['marca'];
        }
  if (isset($_POST['cantidad']))
        {
         $cantidad= str_replace ( "," , "." , $_POST['cantidad']  ) ;
        }
    if (isset($_POST['medida']))
        {
         $medida=str_replace ( "," , "." , $_POST['medida']  ) ;
        }
    if (isset($_POST['precio']))
        {
         $precio=str_replace ( "," , "." , $_POST['precio']  ) ;
        }
      
    if (isset($_POST['imagen']))
        {
         $imagen= $_POST['imagen'];
        }   
        $error=0;
        $mensajeError="";
        if($medida=="--")
        {
            $error=1;
            $mensajeError.="Introduzca un tipo de medida<br/>";
        }
         if($nombre=="")
        {
            $error=1;
            $mensajeError.="Introduzca el nombre del producto <br/>";
        }
          if($cantidad=="")
        {
            $error=1;
            $mensajeError.="Introduzca la cantidad del producto <br/>";
        }
         if(!is_numeric($cantidad))
        {
            $error=1;
            $mensajeError.="La cantidad tiene que ser un valor numerico . <br/>";
        }
          if($precio=="")
        {
            $error=1;
            $mensajeError.="Introduzca el precio del producto <br/>";
        }   
        if(!is_numeric($precio))
        {
            $error=1;
            $mensajeError.="El precio tiene que ser un valor numerico. <br/>";
        }
        if($error == 1)
        {
            echo cabecera($sesion,"Lista Compra",2);
            echo br(1);
           
             echo "<p class='bg-danger'><b>".$mensajeError."</b></a></p>";
             echo "<form name='frm' method='post' class='form-horizontal' action='editPrenda.php'  class='form-group '  enctype='multipart/form-data'>";
   
            //  echo "<a href=./altaBaseDatos.php>hacer un alta </a>";
            //  imagen, nombre,marca',cantidad,medida',precio,comentarios

             echo "<div class='form-group'>";  
              echo "<h1  class='col-md-10 ' > <img    src='images/adLista.png' width='40'/>Nuevo producto</h1></br>";
                 echo "</div>";
            echo "<div class='form-group'>";  
                echo "<div class='col-sm-1'>";
                echo "Nombre: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                echo caja("nombre","",$nombre);
                echo "</div>";

                echo "<div class='col-sm-1'>";
                echo "Marca: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                echo caja("marca","",$marca);
                echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<div class='col-sm-1'>";
                echo "Cantidad: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                echo caja("cantidad","",$cantidad);
                echo "</div>";

                echo "<div class='col-sm-1'>";
                echo "Medida: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                $medidas=array("--","Kg","g","Ud");
                echo combo("medida", $medidas,$medidas, $medida);
                
                echo "</div>";  
             echo "</div>";

            echo "<div class='form-group'>";
                echo "<div class='col-sm-1'>";
                echo "Precio: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                echo caja("precio","",$precio);
                echo "</div>";
                echo "<div class='col-sm-1'>";
                echo "Imagen: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                  echo "<img class='foto' style='margin-bottom:5px;' src='imgUsu/".$img."' width='45'>";
                echo adjuntar();
                echo "</div>";
           echo "</div>";
            echo "<div class='form-group'>";	
                echo "<div class='col-sm-offset-1 col-sm-1'>";
                     echo boton("alta","modificar");
                echo "</div>";
            echo "</div>";



            echo   br(1);

            echo "</form>";
             
        }
        else{
          
            $uploaddir="./imgUsu/";   //carpeta destino 
            $uploadfile=$uploaddir.basename($_FILES["fichero"]["name"]); //nom fich 

            if(($_FILES["fichero"]["tmp_name"])=="")
            {
                $nombreImagen.= $img;
            }else
            {

                if (move_uploaded_file($_FILES["fichero"]["tmp_name"], $uploadfile)) 

                 $nombreImagen.= $_FILES["fichero"]["name"];
                else 
                {   

                    echo "<pre>";  //modo preformateado 

                    echo "Error al subir el fichero\n"; 
                    echo "Para poder depurar mostraremos toda la información disponible: "; 
                    print_r($_FILES); 
                    echo "</pre>";
                }
            }
             $sql= sprintf("UPDATE listacompra set nombre='%s',cantidad='%s',
                                                    precio='%s',marca='%s',
                                                    medida='%s',imagen='%s'
                                                    WHERE idLista='%s'",$nombre,$cantidad,$precio,$marca,$medida,$nombreImagen,$idLista);
        mysqli_query($con, $sql); 
        $num=mysqli_affected_rows();
            
        
                    $sql="select * from escandallo where idLista='".$idLista."' ";
    
                     $res=mysqli_query($con, $sql);
                     $num=mysqli_num_rows($res);
                     
                      while ($fila=mysqli_fetch_array($res))
                      {
                            
                         $precioCalculado=0;
                        $precioCalculado=$fila["cantidadReceta"]*$precio/$cantidad;
                        $sql1=sprintf("UPDATE  escandallo set precioCalculado='%s' where idEscandallo='%s'",$precioCalculado,$fila["idEscandallo"]);
                       // echo $sql;
                        mysqli_query($con, $sql1); 
                      }
                   
                     
                     
                     
                    $sql="select idReceta from escandallo where idLista='".$idLista."' GROUP BY idReceta ";
                     $res=mysqli_query($con, $sql);
                         while ($fila=mysqli_fetch_array($res))
                      {
                                $sql1="SELECT SUM(precioCalculado) FROM escandallo WHERE idreceta='".$fila["idReceta"]."'";
                                $res1=mysqli_query($con, $sql1);
                                $num1=mysqli_num_rows($res1);
                                $fila1=mysqli_fetch_array($res1);
                                
                                 $sql4="SELECT * FROM receta WHERE idReceta='".$fila["idReceta"]."'";
                                
                                $res4=mysqli_query($con, $sql4);
                               
                                $fila4=mysqli_fetch_array($res4);
                                
                                $SUMprecioCalculado= $fila1["SUM(precioCalculado)"];
                                $raciones=$fila4["raciones"];
                                $beneficio=$fila4["beneficio"];
                          if($raciones<1)
                              $raciones=1;
                          $costeRacion=$SUMprecioCalculado/$raciones;
                          $porcentaje=$costeRacion*$beneficio/100;
                          $pvp=$costeRacion+$porcentaje;
                          
                           $sql2= sprintf("UPDATE receta set costeTotal='%s',costeRacion='%s',pvp='%s'
                                                                           WHERE idReceta='%s'",$SUMprecioCalculado,$costeRacion,$pvp,$fila["idReceta"]);
                          // echo $sql2;
                            mysqli_query($con, $sql2); 
                          
                        
                      }
                     
                             
          header("Location: armario.php");
          
        
        }     
    
}
 echo finpag();
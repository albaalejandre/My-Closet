<?php
// primero incluimos el documento donde se encuetran nuestras funciones para poder llamarlas
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

$id="";
if (isset($_GET['id']))
{
    $id= $_GET['id'];
}
 
if(!$haydatos)
{
    
     $sql0="SELECT * From receta where idReceta='".$id."' ";
        $res0=mysqli_query($con, $sql0);
        $num0=mysqli_num_rows($res0);
       $fila0=mysqli_fetch_array($res0);
    
    
       
        
        
    echo cabecera($sesion,"Recetas",3);
    echo "<form name='frm' method='post' class='form-horizontal' action='modOutfit.php'  class='form-group '  enctype='multipart/form-data'>";
    echo hidden("idReceta",$id);
    //  echo "<a href=./altaBaseDatos.php>hacer un alta </a>";
    //  imagen, nombre,marca',cantidad,medida',precio,comentarios
  
     echo "<div class='form-group'>";  
      echo "<h1  class='col-md-10 ' > <img    src='images/adReceta.png' width='40'/>Modificar Outfit</h1></br>";
         echo "</div>";
       echo "<div class='form-group'>";  
         echo "<div class='col-sm-6'>";
            echo "<div class='form-group'>";
                  echo "<div class='col-sm-3'>";
                      echo "Nombre: ";
                  echo "</div>";
                  echo "<div class='col-sm-8'>";
                      echo caja("nombre","",$fila0["nombre"],"Nombre de la receta");
                  echo "</div>";
              echo "</div>";
              echo "<div class='form-group'>"; 
                  echo "<div class='col-sm-3'>";
                      echo "Nº de prendas: ";
                  echo "</div>";
                  echo "<div class='col-sm-8'>";
                      echo caja("raciones","",$fila0["raciones"],"nº raciones ");
                  echo "</div>";
              echo "</div>";
              
              
               echo "<div class='form-group'>";         
                    echo "<div class='col-sm-3'>";
                      echo "Aceptación: ";
                    echo "</div>";
                    echo "<div class='col-xs-5'>";
                        echo caja("beneficio","",$fila0["beneficio"],"Por racion y para calcular el PVP ");
                    echo "</div>";
                    echo "<div class='col-xs-1'>";
                        echo "<b style='margin-left:-20px;'>%</b>";
                    echo "</div>";
               echo "</div>";                
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "Imagen: ";
        echo "</div>";
        echo "<div class='col-md-5'>";
             echo "<img class='foto' style='margin-bottom:5px;' src='imgUsu/".$fila0["imagen"]."' width='355'>";
             echo adjuntar();
            
        echo "</div>";
    echo "</div>";
    
    
         
     echo "<div class='form-group row well ' style='background-color:#DAEFF8' data-toggle='tooltip'  data-placement='top' title='Introduzca las Prendas' >";  
     
        echo "<div class='col-sm-4 col-md-offset-3'>";
          
        $sql="SELECT * From listacompra where idUsu='".$sesion."'order by nombre ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
         $conta=1;
            $prod=array();
            $idProd=array();

            $prod[0]="-- Selecciona prendas -- ";
            $idProd[0]="";
            while ($fila=mysqli_fetch_array($res))
            {
                $prod[$conta]=$fila["nombre"]." - ". $fila["marca"];

                $idProd[$conta]=$fila["idLista"];
                $conta++;
            }
            echo combo("productos", $prod, $idProd,"",1);
            echo hidden("alta","Añadir");

        echo "</div>";
        echo"<div class=visible-xs style='margin-top:-15px'> <br />  </div>";
        echo "<div class='col-sm-1'>";
         //   echo boton("alta","Añadir");
        echo "</div>";
    echo "</div>";
    
    
   
        $sql="SELECT * From escandallo where idReceta='".$fila0["idReceta"]."'order by idEscandallo ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num>0)
        {
            echo "<table  class= 'table table-hover'>";
             echo "<tr> 
                          
                          <th   class='lista' >Cantidad </th>
                          <th     class='lista' ></th>
                          <th     class='lista' >Nombre</th>
                          <th     class='lista '  >Marca</th>
                          <th     class='lista '  >Coste</th>
                          <th     class='lista '  ></th>
                         
                       
               </tr>";
                while ($fila=mysqli_fetch_array($res))
                {
                     $sql1="SELECT * From listacompra where idLista='".$fila["idLista"]."' ";
                     $res1=mysqli_query($con, $sql1);
                     $num1=mysqli_num_rows($res1);
                     $fila1=mysqli_fetch_array($res1);
                     
                      printf ( "<tr type='image' data-toggle='tooltip' data-placement='top' title='Coste compra %s%s = %0.2f€ '>",$fila1["cantidad"],$fila1["medida"],$fila1["precio"]);
                     printf(" <td   class='lista' >%s%s </td>
                              <td   class='lista' ><img src='imgUsu/%s' class='foto' width='35' /> </td>
                              <td   class='lista' >%s</td>
                              <td   class='lista' >%s</td>
                              <td   class='lista' >%0.2f€</td>           
                              <td  class='lista' ><input type='image' data-toggle='tooltip' data-placement='top' title='ELIMINAR INGREDIENTE !' src='images/delete.png' name='borra' value='%s'  width='30'>  </td>         
                            ",$fila["cantidadReceta"],$fila1["medida"],$fila1["imagen"],$fila1["nombre"],$fila1["marca"],$fila["precioCalculado"],$fila["idEscandallo"],$fila["idEscandallo"]);
                     echo "<tr>";
                     // <td  class='lista' width='35'><a href='eliminaIngre.php?id=%d'><img   data-toggle='tooltip' data-placement='top' title='ELIMINAR INGREDIENTE !' src='images/delete.png ' width='20'/></a></td>               
                }
                //echo hidden("alta",$boton);
                      $sql1="SELECT * From receta where idReceta='".$fila0["idReceta"]."' ";
                     $res1=mysqli_query($con, $sql1);
                     $num1=mysqli_num_rows($res1);
                     $fila1=mysqli_fetch_array($res1);
                echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista' ><b>Precio total:</b></td>
                              <td   class='lista' >%0.2f€</td>           
                              <td  class='lista' width='35'></td>                           
                            ",$fila1["costeTotal"]);
                     echo "<tr>";
                      echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista' ><b>Precio medio por prenda:</b></td>
                              <td   class='lista' >%0.2f€</td>           
                              <td  class='lista' width='35'></td>                           
                            ",$fila1["costeRacion"]);
                     echo "<tr>";
                      echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista'  ><b data-toggle='tooltip' data-placement='top' title='PVP por racion'>Aceptación:</b></td>
                              <td   class='lista' >%0.0f</td>           
                              <td  class='lista' width='35'></td>                           
                            ",$fila1["pvp"]);
                     echo "<tr>";
            echo "</table>";
        }
   
    
    
  
    
    echo "<div class='form-group'>";
        echo "<div class='col-sm-1'>";
        echo "Descripción: ";
        echo "</div>";
        echo "<div class='col-sm-11'>";
        echo "<textarea data-toggle='tooltip' name='pasos' data-placement='top' title='Pasos para la creación del Outfit'  class='form-control' rows='4'>". preg_replace("<br />", " ", $fila0["descripcion"])."</textarea>";
        echo "</div>";

        
     echo "</div>";
    
    
    echo "<div class='form-group'>";	
            
            echo "<div class='col-sm-offset-1 col-sm-4'>";

                   echo boton("alta","Terminar");
            echo "</div>";
            
        if($fila0["publico"]==1)
        {
            echo "</div>";
            echo" <div class='checkbox'>";
           echo "<label>";
           echo "  <input type='checkbox' name='publico' checked='checked'> Hacer público el Outfit para que los demas usuarios lo vean";
            echo "</label>";
          echo "</div>";
        }  else {
            echo "</div>";
            echo" <div class='checkbox'>";
           echo "<label>";
           echo "  <input type='checkbox' name='publico' > Hacer público el Outfit para que los demas usuarios lo vean";
            echo "</label>";
          echo "</div>";
        }
    
    
    echo   br(1);
    
    echo "</form>";
 
}else
{   
    $sql="SELECT * From listacompra where idUsu='".$sesion."'order by nombre ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)die ("No hay productos en la lista de la compra");
     $nombre="";
     $altaReceta=0;
     $borra=0;
     $imagen="";
     $nombreImagen="";
     $idProducto="";
     $cantidadR="";
     $idReceta=$_POST["idReceta"];
     
     $raciones=$_POST["raciones"];
      $beneficio=$_POST["beneficio"];
     $boton="Calcular";
     $pasos=$_POST["pasos"];
        if (isset($_POST['alta']))
        {
         $boton= $_POST['alta'];
        }
    if (isset($_POST['nombre']))
        {
         $nombre= $_POST['nombre'];
        }
      if (isset($_POST['borra']))
        {
         $borra= $_POST['borra'];
        }   
     if (isset($_POST['productos']))
        {
         $idProducto= $_POST['productos'];
        }  
    if (isset($_POST['altaReceta']))
        {
         $altaReceta= $_POST['altaReceta'];
        }
    if (isset($_POST['cantidadR']))
        {
         $cantidadR= str_replace ( "," , "." , $_POST['cantidadR']  ) ;
        }  
    if (isset($_POST['imagen']))
        {
         $imagen= $_POST['imagen'];
        } 
   
     
        $mensajeError="";
        $continuar=0;
        
       // echo "borra ".$borra;-------------------------------------------SOLUCIONAR ESTO-------------
         if( $borra > 0)
        {
            $continuar =5;
            $boton="Calcular";
        }
        if( $boton == "Añadir")
        {
            $continuar =2;
        }
         if( $boton == "Calcular")
        {
            $continuar =3;
        }
        if($nombre=="")
        {
            $nombre="SIN NOMBRE";
        }
//         if($nombre=="")
//        {
//             $continuar=1;
//            $altaReceta=1;
//            $mensajeError.="Introduzca el nombre de la receta <br/> ";
//        }
     
         
        if($continuar > 0)
        {
            echo cabecera($sesion,"Recetas",3);
            echo br(1);
           // echo "eliminar = ".$borra;
             if($continuar ==1)echo "<p class='bg-danger'><b>".$mensajeError."</b></a></p>";
            echo "<form name='frm' method='post' class='form-horizontal' action='modOutfit.php'  class='form-group '  enctype='multipart/form-data'>";
            echo hidden("idReceta", $idReceta);
   
    //  echo "<a href=./altaBaseDatos.php>hacer un alta </a>";
    //  imagen, nombre,marca',cantidad,medida',precio,comentarios
          if($altaReceta==0)
        {
            $sql= sprintf("UPDATE receta set nombre='%s',idUsuario='%s',descripcion='%s',raciones='%s',beneficio='%s'
                                                           WHERE idReceta='%s'",$nombre,$sesion,$pasos,$raciones,$beneficio,$idReceta);
               mysqli_query($con, $sql); 
               $num=mysqli_affected_rows($con); 
           
        }
       
            
            
           
            
      if($continuar>=0)
        {   
              
            $sql= sprintf("UPDATE receta set nombre='%s',idUsuario='%s',descripcion='%s',raciones='%s',beneficio='%s'
                                                           WHERE idReceta='%s'",$nombre,$sesion,$pasos,$raciones,$beneficio,$idReceta);
               mysqli_query($con, $sql); 
               $num=mysqli_affected_rows($con); 
        }  
        
        
            
     echo "<div class='form-group'>";  
         echo "<h1  class='col-md-10 ' > <img    src='images/adReceta.png' width='40'/>Nuevo Outfit</h1></br>";
     echo "</div>";
     echo "<div class='form-group'>";
        echo "<div class='col-sm-6'>";
        echo "<div class='form-group'>";
            echo "<div class='col-sm-3'>";
                echo "Nombre: ";
            echo "</div>";
            echo "<div class='col-sm-8'>"; 
                echo caja("nombre","",$nombre,"Nombre de la receta");
            echo "</div>";
            echo "</div>";
              echo "<div class='form-group'>"; 
                  echo "<div class='col-sm-3'>";
                      echo "Nº de prendas: ";
                  echo "</div>";
                  echo "<div class='col-sm-8'>";
                      echo caja("raciones","",$raciones,"nº raciones ");
                  echo "</div>";
              echo "</div>";
              
              
               echo "<div class='form-group'>";         
                    echo "<div class='col-sm-3'>";
                      echo "Aceptación: ";
                    echo "</div>";
                    echo "<div class='col-xs-5'>";
                        echo caja("beneficio","",$beneficio,"Por racion y para calcular el PVP ");
                    echo "</div>";
                    echo "<div class='col-xs-1'>";
                        echo "<b style='margin-left:-20px;'>%</b>";
                    echo "</div>";
               echo "</div>";    
        echo "</div>";       
      

        echo "<div class='col-md-1'>";
             echo "Imagen: ";
        echo "</div>";
        echo "<div class='col-md-5'>";
        //compruebo si ya tiene imagen
         $sql="SELECT imagen FROM receta where idReceta='".$idReceta."'";
         $res=mysqli_query($con, $sql);
          $fila=mysqli_fetch_array($res);
           
            if(isset($_FILES["fichero"]["name"]))
            {
                if(!$_FILES["fichero"]["name"]=="" && $continuar>1)
               {
                    $uploaddir="./imgUsu/";   //carpeta destino 
                    $uploadfile=$uploaddir.basename($_FILES["fichero"]["name"]); //nom fich 
                     if (move_uploaded_file($_FILES["fichero"]["tmp_name"], $uploadfile)) 
                     {
                        $nombreImagen.= $_FILES["fichero"]["name"];
                        $sql= sprintf("UPDATE receta set imagen='%s'
                                                           WHERE idReceta='%s'",$nombreImagen,$idReceta);
                        mysqli_query($con, $sql); 
                        $num=mysqli_affected_rows($con ); 
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
            }
        
          $sql="SELECT imagen FROM receta where idReceta='".$idReceta."'";
          $res=mysqli_query($con, $sql);
          $fila=mysqli_fetch_array($res);
          if($fila["imagen"]=="" || $continuar==1)
          {
                          echo adjuntar();

          }
            else {
                echo "<img class='foto' style='margin-bottom:5px;' src='imgUsu/".$fila["imagen"]."' width='355'>";
            }
         
        echo "</div>";
    echo "</div>";
    

        
       //damos de alta cuando se introduce el nombre    
        if($continuar >1)
        {
          //  echo "alta Receta = ".$altaReceta;
            $altaReceta++;
            echo hidden("altaReceta", $altaReceta);
            
        }
       
        //echo $idProducto;
            
        //indicamos los productos del escandallo en la base de datos
	
        //si es boton añair indicamos el producto y el tipo de medida y el coste
        
        $sql4="SELECT * FROM listacompra where idLista='".$idProducto."'";
        $res4=mysqli_query($con, $sql4);
        $fila4=mysqli_fetch_array($res4);
          
        if($continuar==1)
        {
            $sql="SELECT * From listacompra where idUsu='".$sesion."'order by nombre ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
             echo "<div class='form-group'>";  
        echo "<div class='col-sm-3'>";
            $conta=0;
            $prod=array();
            $idProd=array();


            while ($fila=mysqli_fetch_array($res))
            {
                $prod[$conta]=$fila["nombre"]." - ". $fila["marca"];

                $idProd[$conta]=$fila["idLista"];
                $conta++;
            }
            echo combo("productos", $prod, $idProd,"",1);
            echo hidden("alta","Añadir");

       echo "</div>";
       echo"<div class=visible-xs style='margin-top:-15px'> <br />  </div>";
       echo "<div class='col-sm-9'>";
         echo boton("alta","Añadir");
       echo "</div>";
    echo "</div>";
        }
        
        
        if($boton=="Añadir" && $continuar>1)
        {
            if($borra>0)
         {
            $sql=sprintf("DELETE FROM escandallo WHERE idEscandallo='%s'",$borra);
            
            mysqli_query($con, $sql); 
            $sql="SELECT SUM(precioCalculado) FROM escandallo WHERE idReceta='".$idReceta."'";
          $res=mysqli_query($con, $sql);
          $num=mysqli_num_rows($res);
          $fila=mysqli_fetch_array($res);
          $SUMprecioCalculado= $fila["SUM(precioCalculado)"];
          if($raciones<1)
              $raciones=1;
          $costeRacion=$SUMprecioCalculado/$raciones;
          $porcentaje=$costeRacion*$beneficio/100;
          $pvp=$costeRacion+$porcentaje;
           $sql= sprintf("UPDATE receta set costeTotal='%s',costeRacion='%s',pvp='%s'
                                                           WHERE idReceta='%s'",$SUMprecioCalculado,$costeRacion,$pvp,$idReceta);
            mysqli_query($con, $sql); 
            $num=mysqli_affected_rows($con);
            
         }
              echo "<div class='form-group row well ' style='background-color:#DAEFF8' >";  
                echo "<div class='col-sm-12 col-md-offset-3'>";  
                    echo "<div class='col-md-3'  >".$fila4["nombre"]." (".$fila4["marca"].") </div>";
                    echo "<div class='col-xs-1'>".caja("cantidadR"," "," ","Cantidad en ".$fila4["medida"])." </div>";
                    echo "<div class='col-xs-1' style='margin-left:-27px'>".$fila4["medida"]." </div>";
                    echo "<div class='col-md-1'>";
                        echo boton("alta","Calcular");
                    echo "</div>";

                echo "</div>";
        echo "</div>";
        
        
        
           
            
            
       
        echo hidden("productos", $idProducto);
       }
        
        
        if($boton=="Calcular")
        {
             
            
          $sql="SELECT * From listacompra where idUsu='".$sesion."'order by nombre ";
          $res=mysqli_query($con, $sql);
          $num=mysqli_num_rows($res);
             echo "<div class='form-group row well ' style='background-color:#DAEFF8' data-toggle='tooltip'  data-placement='top' title='Introduzca las Prendass' >";  
     
        echo "<div class='col-sm-4 col-md-offset-3'>";
             $conta=1;
            $prod=array();
            $idProd=array();

            $prod[0]="-- Selecciona prendas -- ";
            $idProd[0]="";
            while ($fila=mysqli_fetch_array($res))
            {
                $prod[$conta]=$fila["nombre"]." - ". $fila["marca"];

                $idProd[$conta]=$fila["idLista"];
                $conta++;
            }
            echo combo("productos", $prod, $idProd,"",1);
            echo hidden("alta","Añadir");

        echo "</div>";
        echo"<div class=visible-xs style='margin-top:-15px'> <br />  </div>";
        echo "<div class='col-sm-1'>";
        //    echo boton("alta","Añadir");
        echo "</div>";
         echo "</div>";
         if($borra>0)
         {
            $sql=sprintf("DELETE FROM escandallo WHERE idEscandallo='%s'",$borra);
            mysqli_query($con, $sql); 
         }else{
          $precioCalculado=0;
          $precioCalculado=$cantidadR*$fila4["precio"]/$fila4["cantidad"];
          $sql=sprintf("INSERT into escandallo (idReceta,idLista,cantidadReceta,precioCalculado ) VALUES ('%s','%s','%s','%s')",$idReceta,$idProducto,$cantidadR,$precioCalculado);
          mysqli_query($con, $sql);  
         }
          
          
          //el coste total
          $sql="SELECT SUM(precioCalculado) FROM escandallo WHERE idreceta='".$idReceta."'";
          $res=mysqli_query($con, $sql);
          $num=mysqli_num_rows($res);
          $fila=mysqli_fetch_array($res);
          $SUMprecioCalculado= $fila["SUM(precioCalculado)"];
          if($raciones<1)
              $raciones=1;
          $costeRacion=$SUMprecioCalculado/$raciones;
          $porcentaje=$costeRacion*$beneficio/100;
          $pvp=$costeRacion+$porcentaje;
           $sql= sprintf("UPDATE receta set costeTotal='%s',costeRacion='%s',pvp='%s'
                                                           WHERE idReceta='%s'",$SUMprecioCalculado,$costeRacion,$pvp,$idReceta);
            mysqli_query($con, $sql); 
            $num=mysqli_affected_rows($con);
                    
         
       }
       
       
        echo "<div class='form-group'>";  
            echo "<div class='col-sm-3'>";
                echo "Prendas: ";
            echo "</div>";
            echo "<div class='col-sm-9'>";
                //nada
            echo "</div>";
        echo "</div>";
       
         //mostramos la lista de productos agregados
        $sql="SELECT * From escandallo where idReceta='".$idReceta."'order by idEscandallo ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num>0)
        {
            echo "<table  class= 'table table-hover'>";
             echo "<tr> 
                          
                          <th   class='lista' >Cantidad </th>
                          <th     class='lista' ></th>
                          <th     class='lista' >Nombre</th>
                          <th     class='lista '  >Marca</th>
                          <th     class='lista '  >Coste</th>
                          <th     class='lista '  ></th>
                         
                       
               </tr>";
                while ($fila=mysqli_fetch_array($res))
                {
                     $sql1="SELECT * From listacompra where idLista='".$fila["idLista"]."' ";
                     $res1=mysqli_query($con, $sql1);
                     $num1=mysqli_num_rows($res1);
                     $fila1=mysqli_fetch_array($res1);
                     
                      printf ( "<tr type='image' data-toggle='tooltip' data-placement='top' title='Coste compra %s%s = %0.2f€ '>",$fila1["cantidad"],$fila1["medida"],$fila1["precio"]);
                     printf(" <td   class='lista' >%s%s </td>
                              <td   class='lista' ><img src='imgUsu/%s' class='foto' width='35' /> </td>
                              <td   class='lista' >%s</td>
                              <td   class='lista' >%s</td>
                              <td   class='lista' >%0.2f€</td>           
                              <td  class='lista' ><input type='image' data-toggle='tooltip' data-placement='top' title='ELIMINAR INGREDIENTE !' src='images/delete.png' name='borra' value='%s'  width='30'>  </td>         
                            ",$fila["cantidadReceta"],$fila1["medida"],$fila1["imagen"],$fila1["nombre"],$fila1["marca"],$fila["precioCalculado"],$fila["idEscandallo"],$fila["idEscandallo"]);
                     echo "<tr>";
                     // <td  class='lista' width='35'><a href='eliminaIngre.php?id=%d'><img   data-toggle='tooltip' data-placement='top' title='ELIMINAR INGREDIENTE !' src='images/delete.png ' width='20'/></a></td>               
                }
                //echo hidden("alta",$boton);
                      $sql1="SELECT * From receta where idReceta='".$idReceta."' ";
                     $res1=mysqli_query($con, $sql1);
                     $num1=mysqli_num_rows($res1);
                     $fila1=mysqli_fetch_array($res1);
                echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista' ><b>Precio Total:</b></td>
                              <td   class='lista' >%0.2f€</td>           
                              <td  class='lista' width='35'></td>                           
                            ",$fila1["costeTotal"]);
                     echo "<tr>";
                      echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista' ><b>Precio medio por prenda:</b></td>
                              <td   class='lista' >%0.2f€</td>           
                              <td  class='lista' width='35'></td>                           
                            ",$fila1["costeRacion"]);
                     echo "<tr>";
                      echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista'  ><b data-toggle='tooltip' data-placement='top' title='PVP por racion'>Aceptación:</b></td>
                              <td   class='lista' >%0.0f</td>           
                              <td  class='lista' width='35'></td>                           
                            ",$fila1["pvp"]);
                     echo "<tr>";
            echo "</table>";
        }
       
        //si el boton es calcular agregamos el producto a la base de datos 
        
   
    
    
    echo "<div class='form-group'>";
        echo "<div class='col-sm-1'>";
        echo "Descripción ";
        echo "</div>";
        echo "<div class='col-sm-11'>";
        echo "<textarea data-toggle='tooltip' name='pasos' data-placement='top' title='Pasos para la elaboracion'  class='form-control' rows='4'>".$pasos."</textarea>";
        echo "</div>";     
    echo "</div>";   
    echo "<div class='form-group'>";	
            echo "<div class='col-sm-offset-1 col-sm-4'>";
                   echo boton("alta","Terminar");
            echo "</div>";
    echo "</div>";
    
     if(isset($_POST["publico"]))
    {
           echo" <div class='checkbox'>";
            echo "<label>";
            echo "  <input type='checkbox' name='publico' checked='checked'> Hacer público el Outfit para que los demas usuarios lo vean";
             echo "</label>";
             echo "</div>";
    }else
    {
        echo" <div class='checkbox'>";
       echo "<label>";
       echo "  <input type='checkbox' name='publico'> Hacer público el Outfit para que los demas usuarios lo vean";
        echo "</label>";
        echo "</div>";
    
    }
    echo   br(1);  
   
    echo "</form>";        
   }         
  if($boton=="Terminar")
   {
      
       $sql="SELECT imagen FROM receta where idReceta='".$idReceta."'";
         $res=mysqli_query($con, $sql);
          $fila=mysqli_fetch_array($res);
           
       
                if(!$_FILES["fichero"]["name"]=="" )
               {
                    $uploaddir="./imgUsu/";   //carpeta destino 
                    $uploadfile=$uploaddir.basename($_FILES["fichero"]["name"]); //nom fich 
                     if (move_uploaded_file($_FILES["fichero"]["tmp_name"], $uploadfile)) 
                     {
                        $nombreImagen.= $_FILES["fichero"]["name"];
                        $sql= sprintf("UPDATE receta set imagen='%s'
                                                           WHERE idReceta='%s'",$nombreImagen,$idReceta);
                        mysqli_query($con, $sql); 
                        $num=mysqli_affected_rows($con); 
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
      
      
      
      
      $sql= sprintf("UPDATE receta set nombre='%s',idUsuario='%s',descripcion='%s',raciones='%s',beneficio='%s'
                                                           WHERE idReceta='%s'",$nombre,$sesion,$pasos,$raciones,$beneficio,$idReceta);
               mysqli_query($con, $sql); 
               $num=mysqli_affected_rows($con); 
      
       $publico=0;
       if(isset($_POST["publico"]))
       {
           $publico=1;
       }
       
         
       $sql= sprintf("UPDATE receta set descripcion='".nl2br($pasos)."', publico='%s'
                                                           WHERE idReceta='%s'",$publico,$idReceta);
               mysqli_query($con, $sql); 
               
          $sql=sprintf("SELECT imagen from receta where idReceta='%s'",$idReceta);
          $res=mysqli_query($con, $sql);
          $fila=mysqli_fetch_array($res); 
          if($fila["imagen"]=="")
          {
              $sql= sprintf("UPDATE receta set imagen='receta.jpg'
                                                           WHERE idReceta='%s'",$idReceta);
               mysqli_query($con, $sql);
          }
      header("Location: outfits.php");
   }
}
 echo finpag();
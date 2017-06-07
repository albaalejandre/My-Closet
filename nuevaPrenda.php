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
 
if(!$haydatos)
{
    echo cabecera($sesion,"Lista Compra",2);
    echo "<form name='frm' method='post' class='form-horizontal' action='nuevaPrenda.php'  class='form-group '  enctype='multipart/form-data'>";
   
    //  echo "<a href=./altaBaseDatos.php>hacer un alta </a>";
    //  imagen, nombre,marca',cantidad,medida',precio,comentarios
  
		echo "<div class='form-group'>";  
		echo "<h1  class='col-md-10 ' > <img    src='images/adLista.png' width='40'/>Nueva Prenda</h1></br>";
        echo "</div>";
		echo "<div class='form-group'>";  
			echo "<div class='col-sm-1'>";
			echo "Nombre: ";
			echo "</div>";
		
			echo "<div class='col-sm-5'>";
			echo caja("nombre");
			echo "</div>";

			echo "<div class='col-sm-1'>";
			echo "Marca: ";
			echo "</div>";
		
			echo "<div class='col-sm-5'>";
			echo caja("marca");
			echo "</div>";
			
		echo "</div>";
		
		echo "<div class='form-group'>";
			echo "<div class='col-sm-1'>";
			echo "Cantidad: ";
			echo "</div>";
			
			echo "<div class='col-sm-5'>";
			echo caja("cantidad","","","cantidad adquirida");
			echo "</div>";

			echo "<div class='col-sm-1'>";
			echo "Precio: ";
			echo "</div>";
			
			echo "<div class='col-sm-5'>";
			echo caja("precio");
			echo "</div>";
		echo "</div>";
		
			
			
			
		//  echo "<div class='col-sm-1'>";
		// echo "Medida: ";
		// echo "</div>";
		//  echo "<div class='col-sm-5'>";
		//  $medidas=array("--","Kg","g","Ud");
        
		// echo combo("medida", $medidas, $medidas,"--");
		// echo "</div>";  
		// echo "</div>";
    
		echo "<div class='form-group'>";
			echo "<div class='col-sm-1'>";
			echo "Imagen: ";
			echo "</div>";
			
			echo "<div class='col-sm-5'>";
			echo adjuntar();
			echo "</div>";
		echo "</div>";
		
		
		echo "<div class='form-group'>";	
            echo "<div class='col-sm-offset-1 col-sm-1'>";

                   echo boton("alta","Añadir otra");
            echo "</div>";
           echo"<div class=visible-xs> <br />  </div>";
            echo "<div class='col-sm-offset-1 col-sm-4'>";

                   echo boton("alta","Terminar");
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
     $boton= $_POST["alta"];
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
            $mensajeError.="Introduzca el nombre de la prenda <br/>";
        }
          if($cantidad=="")
        {
            $error=1;
            $mensajeError.="Introduzca la cantidad del producto <br/>";
        }
         if(!is_numeric($cantidad))
        {
            $error=1;
            $mensajeError.="La cantidad tiene que ser un valor numérico   <br/>";
        }
          if($precio=="")
        {
            $error=1;
            $mensajeError.="Introduzca el precio de la prenda <br/>";
        }   
        if(!is_numeric($precio))
        {
            $error=1;
            $mensajeError.="El precio tiene que ser un valor numérico <br/>";
        }
        if($error == 1)
        {
            echo cabecera($sesion,"Lista Compra",2);
            echo br(1);
           
             echo "<p class='bg-danger'><b>".$mensajeError."</b></a></p>";
             echo "<form name='frm' method='post' class='form-horizontal' action='nuevaPrenda.php'  class='form-group '  enctype='multipart/form-data'>";
   
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
                echo caja("cantidad","",$cantidad,"cantidad adquirida");
                echo "</div>";

                echo "<div class='col-sm-1'>";
                echo "Precio: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                echo caja("precio","",$precio);
                echo "</div>";

             echo "</div>";

            echo "<div class='form-group'>";
              
                echo "<div class='col-sm-1'>";
                echo "Imagen: ";
                echo "</div>";
                echo "<div class='col-sm-5'>";
                echo adjuntar();
                echo "</div>";
           echo "</div>";
            echo "<div class='form-group'>";	
                    echo "<div class='col-sm-offset-1 col-sm-1'>";

                           echo boton("alta","añadir otro");
                    echo "</div>";
                    echo"<div class=visible-xs> <br /> <br /> </div>";
                    echo "<div class='col-sm-offset-1 col-sm-4'>";
                    
                           echo boton("alta","Terminar");
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
                $nombreImagen.= "producto.jpg";
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
             $sql=sprintf("INSERT into listacompra (idUsu,nombre,cantidad, precio ,marca, medida,imagen) VALUES ('%s','%s','%s','%s','%s','%s','%s')",$sesion,$nombre,$cantidad,$precio,$marca,$medida,$nombreImagen);
            // echo $sql;
             mysqli_query($con, $sql);

            $num=mysqli_affected_rows();
            if ($num<1)
                echo "<label class=\"nom\">Error en la consulta, o no se ha podido hacer el alta</label>";
            if($boton=="Terminar")
               header("Location: armario.php");
            else
               header("Location: nuevaPrenda.php"); 
        
        }     
    
}
 echo finpag();
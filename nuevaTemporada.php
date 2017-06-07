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
 
  $con =conbd();
  $haydatos=(count($_POST)>0);
    if($haydatos)
    {
        $receta=$_POST["receta"];
         $fElaboracion=$_POST["fElaboracion"];
         $fCaducidad = $_POST["fCaducidad"];
         $numLote = $_POST["numLote"];
         $nombreReceta=" ";
          $sql="SELECT nombre From receta where idReceta='".$receta."' ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        $fila=mysqli_fetch_array($res);
        
        $nombreReceta=$fila["nombre"];
          $sql=sprintf("INSERT into lote (idUsuario,idReceta,fechaElaboracion,fechaCaducidad,numeroLote,receta) 
                                VALUES ('%s','%s','%s','%s','%s','%s')",$sesion,$receta,$fElaboracion,$fCaducidad,$numLote,$nombreReceta);
         // echo $sql.br(1);
            mysqli_query($con, $sql);
           $sql="SELECT max(idLote) FROM lote where idUsuario='".$sesion."' ";
         
                $res=mysqli_query($con, $sql);
                $fila=mysqli_fetch_array($res);
                $idLote=$fila["max(idLote)"];
                
                 $sql="SELECT idLista From escandallo where idReceta='".$receta."' ";
                $res=mysqli_query($con, $sql);  
               while ($fila=mysqli_fetch_array($res))
               {
                    $sql1=sprintf("INSERT into productoslote (idListaCompra,idLote) 
                                VALUES ('%s','%s')",$fila["idLista"],$idLote);
                //   echo $sql1;
                     mysqli_query($con, $sql1);
                  
               }
                
                header("Location: prendasTemporada.php?id=".$idLote);
         
            //
           // $num=mysql_affected_rows();
        
    }
     echo cabecera($sesion,"Reg. Sanitario",4);
 
  echo "<h1  class='col-sm-12 ' style='margin-bottom:24px'> <img    src='images/adt.png' width='40'/>Nuevo Registro de la Temporada</h1>";
 
    echo "<form name='frm' method='post' class='form-horizontal' action='nuevaTemporada.php'  class='form-group ' >";
    
      echo "<div class='form-group  '  >";
        
         
                echo "<div class='col-sm-3'>";
                echo "Seleccione Outfit: ";
                echo "</div>";
              
                
                
                
                echo "<div class='col-sm-8 '>";
                
                $sql="SELECT * From receta where idUsuario='".$sesion."'order by nombre ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)die ("No hay prendas en la lista de la compra");
                    $conta=1;
                    $prod=array();
                    $idProd=array();

                    $prod[0]="-- Seleccione Outfit -- ";
                    $idProd[0]="";
                    while ($fila=mysqli_fetch_array($res))
                    {
                        $prod[$conta]=$fila["nombre"];

                        $idProd[$conta]=$fila["idReceta"];
                        $conta++;
                    }
                    echo combo("receta", $prod, $idProd,"");
                    echo hidden("alta","Añadir");

                echo "</div>";
              
                
                
                
        echo "</div>";
    
        echo "<div class='form-group  '  >";
        
         
                echo "<div class='col-sm-3'>";
                echo "Número de colección: ";
                echo "</div>";
                echo "<div class='col-sm-8'>";
                $hoy = getdate();
                $sql="SELECT max(idLote) FROM lote where idUsuario='".$sesion."' ";
                $res=mysqli_query($con, $sql);
                $fila=mysqli_fetch_array($res);
                $codigo=0;
                $num=mysqli_num_rows($res);
                if($num<1||$fila["max(idLote)"]<1)
                    $codigo=1;
                else
                    $codigo=$fila["max(idLote)"]+1;
                $lote = sprintf("PRIM-VER %02d%02d%d%05d  ",$hoy["mday"],$hoy["mon"],$hoy["year"],$codigo);
              //  echo caja("numLote","","L-".$hoy["mday"].$hoy["mon"].$hoy["year"]);
                  echo caja("numLote","",$lote);
                echo "</div>";              

        echo "</div>";
        
        echo "<div class='form-group  '  >";
        
         
                echo "<div class='col-sm-3'>";
                echo "Fecha de inicio: ";
                echo "</div>";
                echo "<div class='col-sm-8'>";
                echo "<input type='date' name='fElaboracion' class='form-control' id='dp' />";
                echo "</div>";
        echo "</div>";
        echo "<div class='form-group  '  >";
                echo "<div class='col-sm-3'>";
                echo "Fecha fín: ";
                echo "</div>";
                echo "<div class='col-sm-8'>";
                echo "<input type='date' name='fCaducidad' class='form-control' id='dp' />";
                echo "</div>";
                echo "</div>";
                 echo "<div class='form-group '  >";;
                        echo "<div class='col-sm-12 col-sm-offset-3 '>";
                            echo boton("Aceptar","Aceptar");
                        echo "</div>";
                echo "</div>";
                
        
        
        
        
      
    echo "<form>"
  ?>
    <script>
     $( "#dp" ).datepicker({
		changeMonth: true,
		changeYear: true
	});
    </script> 
  <?php
  echo finpag();
?>
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
  echo cabecera($sesion,"Reg. Sanitario",4);
  $con =conbd();
  $haydatos="";
  $haydatos=(count($_POST)>0);
   
  echo "<h1  class='col-md-9 ' > <img    src='images/adt.png' width='40'/>Temporadas</h1>";
  echo "<div class='col-md-3 ' style='color:#444;padding-top:28px'><a href='nuevaTemporada.php' style='color:#444'  ><img    src='images/add.png' width='23'/> Nuevo Registro de la Temporada   </a></div><br/><br/><br/>";
    echo "<form name='frm' method='post' class='form-horizontal' action='temporada.php'  class='form-group ' >";
        echo "<div class='form-group row well ' style='background-color:#DAEFF8' data-toggle='tooltip'  data-placement='top' title='Introduzca un rango de fechas para mostrar los Registros de la Temporada' >";
        
         
                echo "<div class='col-sm-1'>";
                echo "Desde: ";
                echo "</div>";
                echo "<div class='col-sm-4'>";
                if($haydatos)
                      echo "<input type='date' value='".$_POST["desde"]."' name='desde' class='form-control' id='dp' />";
                else
                      echo "<input type='date' name='desde' class='form-control' id='dp' />";
                echo "</div>";

                echo "<div class='col-sm-1'>";
                echo "Hasta: ";
                echo "</div>";
                echo "<div class='col-sm-4'>";
                if($haydatos)
                    echo "<input type='date' value='".$_POST["hasta"]."'  name='hasta' class='form-control' id='dp' />";
                else
                    echo "<input type='date' name='hasta' class='form-control' id='dp' />";
                echo "</div>";
                echo "<div class='col-sm-1'>";
                echo boton("Aceptar","Aceptar");
                echo "</div>";
    echo "</div>";
        
    
     if($haydatos)
    {
       $sql="SELECT * From lote where idUsuario='".$sesion."'AND fechaElaboracion BETWEEN  '".$_POST["desde"]."' and '".$_POST["hasta"]."' order by fechaElaboracion";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)
        {
            echo ("No hay datos que mostrar");
        }
     
        
    }else
    {
        $sql="SELECT * From lote where idUsuario='".$sesion."'order by fechaElaboracion";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)echo ("No hay datos que mostrar");
    }
        echo "<table  class= 'table table-hover'>";
         echo "<tr> 
                    
                         
                          <th     class='lista' >Outfit</th>
                          <th   class='lista' >Fecha Inicio </th>
                          <th     class='lista' >Fecha Fin</th>
                          
                          <th     class='lista '  >Nº Coleccion</th>
                         
                          <th     class='lista '  ></th>
                          <th     class='lista '  ></th>
                       
               </tr>";
            while($fila=mysqli_fetch_array($res))
             {
               
               
                 
               echo "<tr   >"; 
               printf("<td   data-toggle='modal' data-target='#myModal".$fila['idLote']."' style='cursor: pointer'  class='lista'  >%s</td>
                        <td   data-toggle='modal' data-target='#myModal".$fila['idLote']."' style='cursor: pointer'  class='lista' >%s</td>
                         <td  data-toggle='modal' data-target='#myModal".$fila['idLote']."' style='cursor: pointer'   class='lista' >%s</td>
                          <td   data-toggle='modal' data-target='#myModal".$fila['idLote']."' style='cursor: pointer'  class='lista' >%s</td>
                          
                        <td  class='lista' width='35'><a href='modTemporada.php?id=%d'><img   data-toggle='tooltip' data-placement='top' title='Modificar Registro' src='images/edit.png' width='20'/></a></td> 
                        <td  class='lista' width='35'><a href='eliminarTemporada.php?id=%d'><img   data-toggle='tooltip' data-placement='top' title='ELIMINAR REGISTRO !' src='images/delete.png ' width='20'/></a></td>                    
                        
                        ",$fila['receta'],  SQLAfecha($fila['fechaElaboracion']),  SQLAfecha($fila['fechaCaducidad']),$fila['numeroLote'],$fila['idLote'],$fila['idLote']);
          
            
                echo "</tr>";  
            }
        echo "</table>";
        
        
         if($haydatos)
    {
        echo "<div style='float:right;'>";
        echo " <a href='regPDF.php?desde=".$_POST["desde"]."&hasta=".$_POST["hasta"]."' target='_blank'><img     src='images/PDF.png' width='40'/> <b>Exportar a PDF </b><br/><br/></a>";
        echo "</div>";
    }
    else {
       echo "<div style='float:right;'>";
       echo " <a href='regPDF.php' target='_blank'><img     src='images/PDF.png' width='40'/> <b>Exportar a PDF </b><br/><br/></a>";
       echo "</div>";
        
        }
        
      
    echo "<form>";
       
       
       
          if($haydatos)
    {
       $sql="SELECT * From lote where idUsuario='".$sesion."'AND fechaElaboracion BETWEEN  '".$_POST["desde"]."' and '".$_POST["hasta"]."' order by fechaElaboracion";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)
        {
            echo ("No hay datos que mostrar");
        }
     
        
    }else
    {
        $sql="SELECT * From lote where idUsuario='".$sesion."'order by fechaElaboracion";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)echo ("No hay datos que mostrar");
    }
        while($fila=mysqli_fetch_array($res))
        {
            echo "<div class='modal fade' id='myModal".$fila["idLote"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                         
                            
                            <div class='modal-body'>
                                 <div style=' float: right;padding:9px;'>
                                        <a href='modTemporada.php?id=".$fila["idLote"]."'><img    img style='margin-right:4px' data-toggle='tooltip' data-placement='top' title='Modificar Registro' src='images/edit.png' width='20'/></a>
                                        <a href='eliminarTemporada.php?id=".$fila["idLote"]."'><img style='margin-right:8px'  data-toggle='tooltip' data-placement='top' title='Eliminar REGISTRO' src='images/delete.png ' width='20'/></a>
                                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                                    </div>
                             <div class='row well' style='background-color:#FFF;font-size:12px' >
                                <table border=1  align=center >
                                    <tr ><td  class='sec' style='padding:7px;'> Outfit:</td><td style='padding:7px;'>".$fila["receta"]."</td></tr>
                                    <tr ><td class='sec' style='padding:7px;'>Fecha inicio:</td><td style='padding:7px;'>".SQLAfecha($fila["fechaElaboracion"])."</td></tr>
                                        <tr ><td  class='sec'  style='padding:7px;'>Fecha fin:</td><td style='padding:7px;'>".SQLAfecha($fila["fechaCaducidad"])."</td></tr>
                                </table><br/>
                                <table class ='normal'>
                                      <tr>
                                              <th ><span class='sec'>Prendas:</span></th>
                                               <th ><span class='sec'>Marca:</span></th>
                                                <th ><span class='sec'>Numero de Lote:</span></th>
                                              <th ><span class='sec'>Entrega:</span></th>
                                            
                                      </tr>";
                                 $sql1="SELECT * From productoslote where idLote='".$fila["idLote"]."'";
                                $res1=mysqli_query($con, $sql1);
                               
                                while($fila1=mysqli_fetch_array($res1))
                                {
                                    echo "<tr>
                                        <td >".$fila1["nombre"]."</td>
                                        <td >".$fila1["marca"]."</td>";
                                         
                                        if($fila1["imagen"]=="")
                                       echo " <td >".$fila1["numeroLote"]."</td>";
                                   else {
                                        echo "<td><img  width='120' src='imgUsu/".$fila1["imagen"]."'></td>";
                                   }
                                       echo " <td >".SQLAfecha($fila1["fechaCaducidad"])."</td>";
                                        
                                    echo "</tr>";
                                }
                              
                            echo" </table>

                            </div>
                           </div>
                       
                        </div>
                      </div> ";
        }
       
       
       
       
       
       
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
       
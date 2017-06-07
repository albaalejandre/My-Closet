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
  echo cabecera($sesion,"escandallos",3);
  $con =conbd();
  echo "<h1  class='col-md-9 ' > <img    src='images/outfitad.png' width='40'/>Administrar Outfits</h1>";
  echo "<div class='col-md-3 ' style='color:#444;padding-top:28px'><a href='nuevoOutfit.php' data-toggle='tooltip'   data-placement='top' title='Crear Outfit' style='color:#444'  ><img    src='images/add.png' width='23'/> Nuevo Outfit   </a></div>";
  
         $sql="SELECT * From receta where idUsuario='".$sesion."'order by Nombre";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num<1)echo ("No hay datos que mostrar");
        echo "<table  class= 'table table-hover'>";
         echo "<tr> 
                    
                         <th   class='lista' >Outfit </th>
                          <th     class='lista' >Coste Total</th>
                          <th     class='lista' >Nº de Prendas</th>
                          <th     class='lista '  >Coste Medio por Prenda</th>
                          <th     class='lista '  >Aceptación:</th>
                          <th     class='lista '  ></th>
                          <th     class='lista '  ></th>
                          <th     class='lista '  ></th>
                       
               </tr>";
            while($fila=mysqli_fetch_array($res))
             {
               
               
                 
               echo "<tr   >"; 
               printf("<td   data-toggle='modal' data-target='#myModal".$fila['idReceta']."' style='cursor: pointer'  class='lista'  >%s</td>
                        <td   data-toggle='modal' data-target='#myModal".$fila['idReceta']."' style='cursor: pointer'  class='lista' > &nbsp;   %0.2f€</td>
                         <td  data-toggle='modal' data-target='#myModal".$fila['idReceta']."' style='cursor: pointer'   class='lista' > &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;%s</td>
                          <td   data-toggle='modal' data-target='#myModal".$fila['idReceta']."' style='cursor: pointer'  class='lista' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;%0.2f€</td>
                          <td   data-toggle='modal' data-target='#myModal".$fila['idReceta']."' style='cursor: pointer'  class='lista' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;%s %%</td>
                         
                        <td  class='lista' width='35'><a href='modOutfit.php?id=".$fila['idReceta']."'><img   data-toggle='tooltip' data-placement='top' title='Modificar outfit' src='images/edit.png' width='20'/></a></td> 
						
						
                        <td  class='lista' width='35'><a href='eliminarOutfit.php?id=".$fila['idReceta']."'><img   data-toggle='tooltip' data-placement='top' title='ELIMINAR OUTFIT !' src='images/delete.png ' width='20'/></a></td>                    
                        
                        ",$fila['nombre'],$fila['costeTotal'],$fila['raciones'],$fila['costeRacion'],$fila['beneficio'],$fila['pvp'],$fila['idReceta'],$fila['idReceta']);
          
            
                echo "</tr>";  
            }
        echo "</table>";
  
 //------------------------------------------------------------------------------------------------------ 
  $sql0="SELECT * From receta where idUsuario='".$sesion."'order by Nombre";
        $res0=mysqli_query($con, $sql0);
        $num0=mysqli_num_rows($res0);
     while($fila0=mysqli_fetch_array($res0))
     {
         echo "<div class='modal fade' id='myModal".$fila0['idReceta']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                  <div class=''>                     
                    <div class='modal-body '>
                     <div class='row well' style='background-color:white' >
                     <div style=' float: right'>
                        <a href='modOutfit.php?id=".$fila0['idReceta']."'><img    img style='margin-right:4px' data-toggle='tooltip' data-placement='top' title='Modificar outfit' src='images/edit.png' width='20'/></a>
                        <a href='eliminarOutfit.php?id=".$fila0['idReceta']."'><img style='margin-right:8px'  data-toggle='tooltip' data-placement='top' title='ELIMINAR OUTFIT !' src='images/delete.png ' width='20'/></a>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                     </div>
                     <div class='col-sm-5'>
                            <h2 class='modal-title'  style='text-align:LEFT;margin-top:29px' id='myModalLabel'>".$fila0['nombre']."</h2>

                                
                                 <div  class='col-sm-12 ficha' style='margin-top:14px;' >

                                    <span class='sec' style='font-size:14px;' ><b>Número de prendas:</b></span> ".$fila0['raciones']." 
                                </div>
                            <div  class='col-sm-12 ficha' >
                                  <span class='sec' style='font-size:14px;' ><b>Aceptación:</b></span> ".$fila0['beneficio']."% 
                            </div>

                     </div>
                           
                            <div  class='col-sm-6'  style='margin-top:14px;margin-bottom:18px'>	
                                        <img src='imgUsu/".$fila0['imagen']."'  width='300' class='foto centrar'/>
                               </div>
                               
                       ";
         
         
         
          //mostramos la lista de productos agregados
        $sql="SELECT * From escandallo where idReceta='".$fila0['idReceta']."'order by idEscandallo ";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
        if($num>0)
        {
            echo "<table  class= 'table ' style='font-size:14px'>";
             echo "<tr class='sec'> 
                          
                          <th   class='lista' >Cantidad </th>
                          <th     class='lista' ></th>
                          <th     class='lista' >Nombre</th>
                          <th     class='lista '  >Marca</th>
                          <th     class='lista '  >Coste</th>
                       
                         
                       
               </tr>";
                while ($fila=mysqli_fetch_array($res))
                {
                     $sql1="SELECT * From listacompra where idLista='".$fila["idLista"]."' ";
                     $res1=mysqli_query($con, $sql1);
                     $num1=mysqli_num_rows($res1);
                     $fila1=mysqli_fetch_array($res1);
                     
                      printf ( "<tr type='image' data-toggle='tooltip' data-placement='top' title='Precio de compra %s%s = %0.2f€ '>",$fila1["cantidad"],$fila1["medida"],$fila1["precio"]);
                     printf(" <td   class='lista' >%s%s </td>
                              <td   class='lista' ><img src='imgUsu/%s' class='foto' width='25' /> </td>
                              <td   class='lista' >%s</td>
                              <td   class='lista' >%s</td>
                              <td   class='lista' >%0.2f€</td>           
                                      
                            ",$fila["cantidadReceta"],$fila1["medida"],$fila1["imagen"],$fila1["nombre"],$fila1["marca"],$fila["precioCalculado"],$fila["idEscandallo"]);
                     echo "<tr>";
                     // <td  class='lista' width='35'><a href='eliminaIngre.php?id=%d'><img   data-toggle='tooltip' data-placement='top' title='ELIMINAR INGREDIENTE !' src='images/delete.png ' width='20'/></a></td>               
                }
                //echo hidden("alta",$boton);
                      $sql1="SELECT * From receta where idReceta='".$fila0['idReceta']."' ";
                     $res1=mysqli_query($con, $sql1);
                     $num1=mysqli_num_rows($res1);
                     $fila1=mysqli_fetch_array($res1);
             /*   echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista' ><b>COSTE TOTAL:</b></td>
                              <td   class='lista' >%0.2f€</td>           
                                                       
                            ",$fila1["costeTotal"]);
                     echo "<tr>";
                      echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista' ><b>COSTE RACION:</b></td>
                              <td   class='lista' >%0.2f€</td>           
                                                       
                            ",$fila1["costeRacion"]);
                     echo "<tr>";
                      echo "<tr>";
                     printf(" <td ></td>
                              <td > </td>
                              <td ></td>
                              <td   class='lista'  ><b data-toggle='tooltip' data-placement='top' title='PVP por racion'>PVP:</b></td>
                              <td   class='lista' >%0.2f€</td>           
                                                        
                            ",$fila1["pvp"]);
                     echo "<tr>";*/
                     
                      echo "</table>";
                     echo "<table width=100%  >";
                      echo "<tr  align='center' ><td width=33%><b>Aceptación:</td><td width=33%><b>Precio total:</b></td><td width=33%><b>Precio medio por prenda</b></td></tr></tr>";

                     printf("<tr  align='center' ><td>%0.0f</td><td>%0.2f€</td><td>%0.2f€</td></tr></table>",$fila1["pvp"],$fila1["costeTotal"],$fila1["costeRacion"]);
           
        }
         
         
       
                        
             echo    " <div  class='col-sm-12 ficha' style='background-color:#DAEFF8;border-radius: 15px;margin-top:14px;'  >
                              <span class='sec' style='font-size:14px;'><b>Descripción:</b></span><br/> ".$fila0['descripcion']."
                        </div>
                         

                         </div>

                    </div>

                  </div>
                </div>
              </div>";
         
     }
  
  
  echo finpag();
?>
              

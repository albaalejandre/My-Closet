<?php
 require_once("biblioteca.php");
 session_start();
  $sesion="";
  $idUsu="";
    if (isset($_SESSION['id']))
            {
                $sesion=$_SESSION['id'];
                $idUsu=$sesion;
                  echo cabecera($sesion);
                 
            }else{
 $con =conbd();
 	$email=$_POST["email"];
	$pass=$_POST["pass"];
	
    $sql="SELECT * From usuario where password= '".$pass."' and correo='".$email."'";
    $res=mysqli_query($con, $sql);
            $num=mysqli_num_rows($res);
            if($num<1)
			header("Location: inicioSesion.php");
			
    $fila=mysqli_fetch_array($res);
    
   
	
    
	$_SESSION['id']=$fila["idUsu"];
            $idUsu=$fila["idUsu"];
   echo cabecera($_SESSION['id']);
   
            }
            
       
           echo br(2);
?>
<div style="text-align:center">

<a href="armario.php"><img src="images/armario.png" onmouseover="this.src='images/armarionegro.png';" onmouseout="this.src='images/armario.png';"/></a>
<a href="outfits.php"><img src="images/outfit.png" onmouseover="this.src='images/outfitnegro.png';" onmouseout="this.src='images/outfit.png';"/></a>
<a href="temporada.php"><img src="images/t.png" onmouseover="this.src='images/tnegro.png';" onmouseout="this.src='images/t.png';"/></a>
</div>

<?php
echo br (3);
  echo  finpag();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
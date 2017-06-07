<?php
require_once("biblioteca.php");

 echo cabecera("","Registro",3);
$haydatos="";
$haydatos=(count($_POST)>0);
 if(!$haydatos)
{
   echo "<form name='frm' method='post'    class='form-horizontal' action='registro.php'  class='form-group '>";
   		echo br(1);
   		echo "<div class='form-group'>";
                                 echo "<label  class='col-sm-3 control-label'>Alias: </label>";
			
			echo "<div class='col-sm-9'>";
				echo caja("alias","Nombre de usuario");
			echo "</div>";
                                 echo br(2);
			echo "<label for='inputEmail3'  class='col-sm-3 control-label'>Email: </label>";
			
			echo "<div class='col-sm-9'>";
				echo  "<input type='email' name='email' class='form-control' id='inputEmail3' placeholder='Email'>";
			echo "</div>";
				echo br(2);
			echo "<label for='inputEmail3'  class='col-sm-3 control-label'>Contraseña: </label>";
		
			echo "<div class='col-sm-9'>";
				echo  password("pass");
			echo "</div>";
                                echo br(2);
                                 echo "<label for='inputEmail3'  class='col-sm-3 control-label'>Confirmar contraseña: </label>";
		
			echo "<div class='col-sm-9'>";
				echo  password("confPass");
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group'>";	
			echo "<div class='col-sm-offset-3 col-sm-9'>";
				echo boton("boton","Registrarse");
			echo "</div>";
		echo "</div>";
			echo br(2);
                       
   echo "</form>";
}
 else 
{
      $alias="";
      $email="";
      $pass="";
      $confPass="";
      
      if (isset($_POST['alias']))
     {
         $alias= $_POST['alias'];
     }
     if (isset($_POST['email']))
     {
         $email= $_POST['email'];
     }
    if (isset($_POST['pass']))
     {
         $pass= $_POST['pass'];
     }
     if (isset($_POST['confPass']))
     {
         $confPass= $_POST['confPass'];
     }
     /* echo "nombre :".$alias;
      echo br(1);
      echo "email :".$email;
      echo br(1);
      echo "contraseña :".$pass;
      echo br(1);
      echo "confirma contraseña :".$confPass;
      echo br(1);*/
      $error=0;
      $mensajeError="";
      echo br(1);
      if($alias=="")
     {
         $error=1;
         $mensajeError.="<b>Alias: </b> Introduzca un nombre de usuario<br/>";
     }
      if($email=="")
     {
         $error=1;
         $mensajeError.="<b>Email: </b> Introduzca su correo electrónico <br/>";
     }
      if($pass=="" || $confPass=="")
     {
         $error=1;
         $mensajeError.="<b>Contraseña: </b> Introduzca su contraseña <br/>";
     }
      if(!($pass==$confPass))
     {
         $error=1;
         $mensajeError.="<b>Contraseña: </b> Las contraseñas no coinciden <br/>";
     }
     $con =conbd();
     $sql="SELECT * From usuario where correo= '".$email."'";
     $res=mysqli_query($con, $sql);
     $num=mysqli_num_rows($res);
      if($num>0)
     {
         $error=1;
         $mensajeError.="La direccion de correo electronico <b>".$email ."</b> ya se encuentra registrada <br/>";
     }
     if($error==1)
     {
         echo "<p class='bg-danger'>".$mensajeError."</a></p>";
         echo "<form name='frm' method='post'    class='form-horizontal' action='registro.php'  class='form-group '>";
   		
   		echo "<div class='form-group'>";
                                 echo "<label  class='col-sm-3 control-label'>Alias: </label>";
			
			echo "<div class='col-sm-9'>";
				echo caja("alias","Nombre de usuario",$alias);
			echo "</div>";
                                 echo br(2);
			echo "<label for='inputEmail3'  class='col-sm-3 control-label'>Email: </label>";
			
			echo "<div class='col-sm-9'>";
				echo  "<input type='email' name='email' class='form-control' value='".$email."' id='inputEmail3' placeholder='Email'>";
			echo "</div>";
				echo br(2);
			echo "<label for='inputEmail3'  class='col-sm-3 control-label'>Contraseña: </label>";
		
			echo "<div class='col-sm-9'>";
				echo  password("pass");
			echo "</div>";
                                echo br(2);
                                 echo "<label for='inputEmail3'  class='col-sm-3 control-label'>Confirmar contraseña: </label>";
		
			echo "<div class='col-sm-9'>";
				echo  password("confPass");
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group'>";	
			echo "<div class='col-sm-offset-3 col-sm-9'>";
				echo boton("boton","Registrarse");
			echo "</div>";
		echo "</div>";
			echo br(2);
                       
   echo "</form>";
     }
     else
     {
         echo br(2);
         echo "<h2>Felicidades ha sido dado de alta con exito  inicie sesion usando su dirección de correo electrónico ".$email." y su contraseña</h2>";
         $sql=sprintf("INSERT into usuario (alias,correo,password) VALUES ('%s','%s','%s')",$alias,$email,$pass);
         
         //aqui se ejecuta la consulta SQL por lo que añade la persona en este momento
        mysqli_query($con, $sql);
  
        //comprobamos que realiza la conslta mirando si affecta a alguna fila
        $num=mysqli_affected_rows($con);
        if ($num<1)
            echo "<label class=\"nom\">Error en la consulta, o no se ha podido hacer el alta</label>";
        else 
        {
           echo  br(3);
         }
     }
     
     
         
}
echo finpag();
?>

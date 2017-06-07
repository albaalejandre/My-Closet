<?php
 require_once("biblioteca.php");
 $con =conbd();
   echo cabecera();
   echo br(1);
   echo "<p class='bg-danger'>El usuario o la contraseña no son correctos. Si aun no te has registrado  <a href='registro.php'>puedes registrarte aquí</a></p>";
   echo "<form name='frm' method='post' class='form-horizontal' action='inicioUsu.php'  class='form-group '>";
   		echo br(1);
   		echo "<div class='form-group'>";
			echo "<label for='inputEmail3'  class='col-sm-2 control-label'>Email: </label>";
			
			echo "<div class='col-sm-10'>";
				echo  "<input type='email' name='email' class='form-control' id='inputEmail3' placeholder='Email'>";
			echo "</div>";
			
			echo "<label for='inputEmail3'  class='col-sm-2 control-label'>Contraseña: </label>";
			echo br(2);
			echo "<div class='col-sm-10'>";
				echo  password("pass");
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group'>";	
			echo "<div class='col-sm-offset-2 col-sm-10'>";
				echo boton("boton","Iniciar sesion");
			echo "</div>";
		echo "</div>";
			echo br(2);
   echo "</form>";
 
 
 echo finpag();
?>

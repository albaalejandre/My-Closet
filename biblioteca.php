<?php

//funcion para conectar la base de datos
function conbd()
{
  
           //se pone localhost root y sin contraseña porque ahora estamos usando la base de datos local
	$con = mysqli_connect("localhost","root","","escandallos");
        //$con = mysql_connect("localhost","escandal","Xrb9lr3Z76");
	if (!$con) die("No se puede conectar con el servidor");
            //aqui se pone el nombre de la base de datos a la que queremos conectarnos
	//$base=mysql_select_db("escandallos",$con);
       //$base=mysql_select_db("escandal_escandallos",$con);
	//if (!$base) die("No se puede conectar con la BD");
	return $con;
}
function cabecera($sesion="",$title="",$activo=1)
{
    $primero="";
    $segundo="";
    $tercero="";
    $cuarto="";
    $quinto="";
    $sexto="";
    if($activo==1)
            $primero="class='active'";
    else if($activo==2)
            $segundo="class='active'";
    else if($activo==3)
            $tercero="class='active'";
     else if($activo==4)
            $cuarto="class='active'";
     else if($activo==5)
            $quinto="class='active'";
     else if($activo==6)
            $sexto="class='active'";
    
    $cad="";
    $cad.="<!doctype html>";
    $cad.="<html><head><meta charset='utf-8'>\n";

    $cad.="<title>Mycloset ".$title." </title>\n";
    $cad.="<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
    $cad.="<link rel='stylesheet' href='css/bootstrap.css'>\n";
    $cad.="<link href='starter-template.css' rel='stylesheet'>\n";
    $cad.="<link rel='stylesheet' href='css/main.css'>\n";
    $cad.="<link rel='stylesheet' href='css/jumbotron.css'>\n";
     $cad.="<link rel='stylesheet' href='css/calendario.css'>\n";
    $cad.=" <script src='js/calendar.js' type='text/javascript'></script>
            <script src='js/calendar-es.js' type='text/javascript'></script>
            <script src='js/calendar-setup.js' type='text/javascript'></script>";
    $cad.="</head>\n";
    $cad.=" <body>\n";
    $cad.="<div class='container'>\n";
    $cad.="<div class='row'>
         <nav class='navbar navbar-fixed-top navbar-inverse ' role='navigation'>
        	<div class='navbar-header'>
          		<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
           			<span class='sr-only'>Toggle navigation</span>
            		<span class='icon-bar'></span>
            		<span class='icon-bar'></span>
            		<span class='icon-bar'></span>
         		 </button>
                &nbsp;&nbsp;&nbsp; <img alt='Brand' src='images/inicio.png'>&nbsp;&nbsp;&nbsp;
          		
       		</div>";
            if($sesion > 0)
            {
                  
                      $cad.= "<div id='navbar' class='collapse navbar-collapse'>
          		<ul class='nav navbar-nav'>
            		<li ".$primero."><a href='inicioUsu.php'>&nbsp;&nbsp;<b>Inicio</b>&nbsp;&nbsp;</a></li>
            		<li ".$segundo."><a href='armario.php'>&nbsp;&nbsp;<b>Mi armario</b>&nbsp;&nbsp;</a></li>
                         <li ".$tercero."><a href='outfits.php'>&nbsp;<b>Mis Outfits</b>&nbsp;&nbsp;</a></li>
                                 <li ".$cuarto."><a href='temporada.php'>&nbsp;<b>Temporadas</b>&nbsp;&nbsp;</a></li>
                                 <li ".$quinto."><a href='outfitsPublicados.php'>&nbsp;<b>Outfits públicos</b>&nbsp;&nbsp;</a></li>
                               <li ".$sexto."><a href='ayuda.php'>&nbsp;<b>Ayuda</b>&nbsp;&nbsp;</a></li>
          		</ul>";
            }else
            {
                    $cad.= "<div id='navbar' class='collapse navbar-collapse'>
          		<ul class='nav navbar-nav'>
            		<li ".$primero."><a href='index.php'>&nbsp;&nbsp;<b>Inicio</b>&nbsp;&nbsp;</a></li>
            		<li ".$segundo."><a href='outfitsPublicados.php'>&nbsp;&nbsp;<b>Outfits</b>&nbsp;&nbsp;</a></li>
                                 <li ".$tercero."><a href='registro.php'>&nbsp;<b>Registro</b>&nbsp;&nbsp;</a></li>
                               
          		</ul>";
            }
            
          if($sesion > 0)
          {
               $con =conbd();
               $sql="SELECT * From usuario where idUsu= '".$sesion."'";
               
               $res=mysqli_query($con, $sql);
               $fila=mysqli_fetch_array($res);
               $cad.="   <div class=' navbar-right' style='padding-top: 7px;'>";
               $cad.= "<b style='color:#CCC'>Hola: ".$fila["alias"];
              
               $cad.="</b> &nbsp;&nbsp;&nbsp;&nbsp; <a href='salir.php' class='btn btn-primary ' role='button'>Cerrar sesion</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $cad.="   </div>";
               
          } else
          {
            $cad.= "<form class='navbar-form navbar-right'  method='post' role='form' action='inicioUsu.php'>
                       <div  class='form-group  '>
                           <input type='text' name='email' placeholder='Email' class='form-control'>
                       </div>
                       <div class='form-group '>
                           <input type='password' name='pass' placeholder='Contraseña' class='form-control'>
                       </div>
                       <button type='submit' class='btn btn-primary'>Iniciar sesion</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </form>";
          }
      $cad.="</div></div><!--/.nav-collapse -->
            </nav>
            <div class='visible-sm'>".br(4)."</div>
                <div class='visible-md'>".br(2)."</div>
            <div class='container centro'>\n";

   
    return $cad;   
}

function finpag()
{
    $cad="";
    $cad.=" </div>

      

      <footer>
        <p>&copy;Trabajo de Ingeniería de Software II</p>
      </footer>
    </div>
    

     <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <script src='js/jquery.min.js'></script>
	<script src='js/bootstrap.js'></script>
       
        <script type=\"text/javascript\">
           $(function () {
                $('[data-toggle=\"tooltip\"]').tooltip()
})
        </script>
        <script type=\"text/javascript\">
          $('.carousel').carousel()
        </script>
    
</body>
</html>\n";
    
    return $cad; 
}


//funcion para dibujar varios br
function br($numero)
{
	$cad = "";
	for ($i = 0; $i < $numero; $i++)
	{
		$cad .= sprintf("\n<br />\n");
	}
	return $cad;
}

function caja($nom,$valdef="",$valor="",$toltip="",$tam=10,$max="")
{       
    $maxi="";
        if($max>0)
            $maxi="maxlength='".$max."'";
        if ($toltip=="")
	return sprintf("<input type='text'  class='form-control' name='%s' placeholder='%s' value='%s' size='%d' %s />\n",$nom,$valdef,$valor,$tam,$maxi);
        else
            return sprintf("<input type='text'  class='form-control' name='%s' placeholder='%s' value='%s' data-toggle='tooltip'   data-placement='top' title='%s' />\n",$nom,$valdef,$valor,$toltip);
}

function password ($nom,$val="",$tam=10,$max="")
{
    $maxi="";
        if($max>0)
            $maxi="maxlength='".$max."'";
	return sprintf("<input type='password'  class='form-control' name='%s' value='%s' size='%d' %s placeholder='Contraseña' />\n",$nom,$val,$tam,$maxi);
}
function combo($nom,$texto,$id,$sele=0,$submit=0)
{
	$cad="";
        if($submit==0)
        {    
	$cad.=sprintf("<select name='%s' class='form-control' >
        ",$nom);
        }
        else
            $cad.=sprintf("<select name='%s' class='form-control'  onChange=\"frm.submit();\" >
        ",$nom);
	$n=count($id);
	for($i=0;$i<$n;$i++)
	{
		if($id[$i]==$sele)
			$cad.=sprintf("<option value='%s' selected='selected'>%s</option>\n",$id[$i],$texto[$i]);
		else
			$cad.=sprintf("<option value='%s'>%s</option>\n",$id[$i],$texto[$i]);
	}
        $cad.="</select>
            ";
	return $cad;
	
}




function boton($name,$value="aceptar")
{
	return sprintf("\n<input type='submit' class='btn btn-primary' name='%s' value='%s' />\n",$name,$value);
}
function botonEliminar($name)
{
        return sprintf("<input type='submit' name='eliminar' value='%s' style='font-size:0;width: 80px;height: 30px;background:url(./images/pagina/eliminar.png)'>",$name);
}

function botonModificar($name)
{
        return sprintf("<input type='submit' name='modificar' value='%s' style='font-size:0;width: 80px;height: 30px;background:url(./images/pagina/modificar.png)'>",$name);
}

function chek($name,$activo="")
{
    if($activo=="")
        return sprintf("<input type='checkbox' name='%s' value='%s'  />",$name,$name);
    else
        return sprintf("<input type='checkbox' name='%s' value='%s'checked='checked' />",$name,$name);
}

function adjuntar($name="fichero")
{
    $cad=" ";
  //  $cad.="<input type='hidden' name='MAX_FILE_SIZE' value='3000000' /> ";
     $cad.= "  <input type='hidden' name='MAX_FILE_SIZE' value='9000000000' />";
            
    $cad.="<input type='file' name='".$name."'>";
    return $cad;
}
function formsubir($nom)
{
	return sprintf("<form name='frm' method='post' enctype=\"multipart/form-data\" action='%s'>",$nom);
}

function hidden($nom,$value)
{
    return " <input type='hidden' name='".$nom."' value='".$value."' />";
}

function FechaASQL($Fecha) 
{ 
if ($Fecha<>""){ 
   $trozos=explode("/",$Fecha,3); 
   return "'".$trozos[2]."-".$trozos[1]."-".$trozos[0]."'"; } 
else 
   {return "NULL";} 
} 
function SQLAfecha($MySQLFecha) 
{ 
if (($MySQLFecha == "") or ($MySQLFecha == "0000-00-00") ) 
    {return "";} 
else 
    {return date("d/m/Y",strtotime($MySQLFecha));} 
}
?>

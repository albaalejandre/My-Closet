
<?php


   require_once("biblioteca.php");
   

 session_start();
 $sesion="";
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
echo cabecera($sesion,"Ayuda",6);
?>
</div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-left:25px">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/miarmario.png" alt="...">
      <div class="carousel-caption">
       <h3>Mi Armario</h3>
    	<p>Organiza de forma sencilla todas tus prendas de ropa con su marca y precio.</p>
      </div>
    </div>
    <div class="item">
      <img src="images/outfits.png" >
      <div class="carousel-caption">
       <h3>Mis Outfits</h3>
    	<p>Calcula el precio de coste de tus outfit utilizando las prendas que has añadido a la lista de la compra.</p>
      </div>
    </div>
       <div class="item">
      <img src="images/temporadas.png" >
      <div class="carousel-caption">
       <h3>Temporada</h3>
    	<p>Crea tus propias estaciones del año con tus outfits preferidos.</p>
      </div>
    </div>
  
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br />

    <div class='container centro'>
      <!-- Example row of columns -->
      <div class='row'>
        <div class='col-md-4'>
           <img  class="centrar" src="images/armario.png" />
          <p>Agrega las prendas que utilices para realizar tus outfits y tendras una base de datos con su precio y marca que podras actualizar facilmente en muy pocos pasos.</p>
          <p><a class='btn btn-default' href='#' role='button'>View details &raquo;</a></p>
        </div>
        <div class='col-md-4'>
         <img  class="centrar" src="images/outfit.png" />
          <p>Crea outfits con tus prendas para saber el precio de coste de todo el conjunto, de una manera intuitiva y eficaz, ademas se actualizara su coste según el precio que tengas en las prendas.</p>
          <p><a class='btn btn-default' href='#' role='button'>View details &raquo;</a></p>
       </div>
        <div class='col-md-4'>
         <img  class="centrar" src="images/t.png" />
          <p>Podrás crear tu propia estación del año combinando tus prendas favoritas del armario. Fácil y sencillo de realizar, además, incluye la fecha de inicio y fin de tu estación.</p>
          <p><a class='btn btn-default' href='#' role='button'>View details &raquo;</a></p>
        </div>
      </div>

<?php
    echo finpag();

?>
 

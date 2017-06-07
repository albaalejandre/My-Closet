
<?php


   require_once("biblioteca.php");
   

 session_start();
 $sesion="";
 if(isset($_SESSION['id']))
   $sesion=$_SESSION['id'];
  if(!$sesion=="")
  {
      header("Location: inicioUsu.php");
  }
   echo cabecera();
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
      <img src="images/cabeceraMiArmario.png" alt="...">
      <div class="carousel-caption">
       <h3>Mi armario</h3>
    	<p>Organiza de forma sencilla todas tus prendas de ropa con su marca y precio.</p>
      </div>
    </div>
    <div class="item">
      <img src="images/img3o.png" >
      <div class="carousel-caption">
       <h3>Outfits</h3>
    	<p>Calcula el precio de tus outfits utilizando las prendas que has añadido a la lista de la compra</p>
      </div>
    </div>
       <div class="item">
      <img src="images/img4o.png" >
      <div class="carousel-caption">
       <h3>Buscador de Outfits</h3>
    	<p>Busca todos los Outfits que otros usuarios hayan subido.</p>
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
          <p>Agrega los productos que utilices para realizar tus elaboraciones y tendras una base de datos con su precio y marca que podras actualizar facilmente en muy pocos pasos. Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class='btn btn-default' href='#' role='button'>View details &raquo;</a></p>
        </div>
        <div class='col-md-4'>
         <img  class="centrar" src="images/outfit.png" />
          <p>Crea escandallos con tus recetas para saber el precio de coste el precio por racion y el precio de venta de tus elaboraciones, de una manera intuitiva y eficaz, ademas se actualizaran su coste  segun el precio que tengas en los productosEtiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class='btn btn-default' href='#' role='button'>View details &raquo;</a></p>
       </div>
        <div class='col-md-4'>
         <img  class="centrar" src="images/t.png" />
          <p>El registro sanitario de tus elaboraciones es un una documentacion que exige sanidad y muy pesada de mantener al dia que se necesita poner el lote y las fecha de elaboracion  y la caducidad y lote de cada uno de sus ingredientesa aplicacion podras crear el registro sanitario a traves de tus recetas y podra introducir el lote de sus ingredientes o cargar directamente una foto del lote . Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class='btn btn-default' href='#' role='button'>View details &raquo;</a></p>
        </div>
      </div>

<?php
    echo finpag();

?>
 

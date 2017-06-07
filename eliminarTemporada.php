<?php
require_once("biblioteca.php");
session_start();
 if (isset($_SESSION['id']))
{
    $sesion=$_SESSION['id'];
}
if($sesion==0)
{
    header("Location: index.php");
}
$con=  conbd();

        $sql="Delete From lote WHERE idLote='".$_GET['id']."'";
        $res=mysqli_query($con, $sql);
        $sql="Delete From productoslote WHERE idLote='".$_GET['id']."'";
        $res=mysqli_query($con, $sql);
        header("Location: temporada.php");
?>

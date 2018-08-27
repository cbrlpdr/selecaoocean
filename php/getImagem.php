<?php 
    include "conexao.php";
    $link = connect();
    $codigo=$_GET['cod'];
    $result=mysqli_query($link,"select ntc_img from noticia where ntc_id =".$codigo);
    while($row=mysqli_fetch_assoc($result)){
        $image=$row['ntc_img'];
        $image=explode("_delimitador_",$image);
        $imageData=$image[0];
        $imageType=$image[1];
        header('Content-type: '.$imageType);
        echo $imageData;

    }
    
    


?>
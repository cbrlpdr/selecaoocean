<?php

include "conexao.php";
$link = connect();
$acao = $_REQUEST['acao'];

if($acao=="cadastrarNoticia"){
    $titulo=$_REQUEST['titulo'];
    $noticia=$_REQUEST['noticia'];
    $autor=$_REQUEST['autor'];
    $fonte=$_REQUEST['fonte'];
    $tags=$_REQUEST['tags'];

    $imageData=mysqli_real_escape_string($link,file_get_contents($_FILES['imagem']["tmp_name"]));
    $imageType=mysqli_real_escape_string($link,$_FILES['imagem']["type"]);
    if(substr($imageType, 0, 5) == "image"){
        
    }
   

    $sql="INSERT INTO `dieseite`.`noticia`
    (`ntc_id`,
    `ntc_autor`,
    `ntc_datahora`,
    `ntc_titulo`,
    `ntc_conteudo`,
    `ntc_img`,
    `ntc_fonte`,
    `ntc_ativo`)
    VALUES
    (NULL,
    '$autor',
    now(),
    '$titulo',
    '$noticia',
    '$imageData._delimitador_.$imageType',
    '$fonte',
    1);";

    //echo $sql; echo "<br>";
    mysqli_query($link,$sql) or die("ERRO!".mysqli_error($link));

    if(!empty($tags)){
        $tags=explode(',',$tags);
        var_dump($tags);
    }

    //Busca o último PK adicionado na tabela notícia
    $sql="select max(ntc_id) from noticia;";
    $query = mysqli_query($link,$sql);
    while($res = mysqli_fetch_array($query))

    //Insere as tags na tabela
    foreach ($tags as $i => $tag) {
        $tag=strtolower($tag);
        $tag=str_replace($tag,' ','');
        $sql = " INSERT INTO `dieseite`.`tag`
        (`tag_id`,
        `tag_nome`,
        `tag_ativa`,
        `tag_noticia`)
        VALUES
        (NULL,
        '$tag',
        1,
        $res[0]);";
        //echo $sql;
        mysqli_query($link,$sql) or die("ERRO!".mysqli_error($link));
        
    }
    
    header('location:../index.php?p=posPostagem');

}

if($acao=="insertDenuncia"){
    $motivo=$_REQUEST['denunciaMotivo'];
    $ntc_id=$_REQUEST['ntc_id'];

    $sql="INSERT INTO `dieseite`.`denuncia`
    (`dnc_id`,
    `dnc_motivo`,
    `dnc_ativa`,
    `dnc_noticia`)
    VALUES
    (NULL,
    '$motivo',
    1,
    '$ntc_id');
    ";

    mysqli_query($link,$sql) or die("Erro!".mysqli_error($link));
    header('Location: ../index.php?p=posDenuncia');
}

mysqli_close($link);
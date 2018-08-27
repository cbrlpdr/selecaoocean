<?php
include "../php/conexao.php";
$link = connect();
$acao = $_REQUEST['acao'];
session_start();
if($acao=='login'){
    $login=$_REQUEST['login'];
    $senha=$_REQUEST['password'];

    $sql="select * from admin where adm_ativo=1 and adm_login='$login' and adm_senha='".md5($senha)."'";
    $query=mysqli_query($link,$sql);
    if(mysqli_num_rows($query)==0){
        echo "ERRO DE AUTENTICAÇÃO!";
    }else{
        echo "Administrador logado!";
        $_SESSION['admLogado']=1;
        $_SESSION['userLogado']=$login;
    }
    echo "<a href='index.php'><button>Voltar</button></a>";
}
if($acao=='toggleAtivo'){// Inverte o bool ntc_ativo no banco
    $sql="update noticia set ntc_ativo=not(ntc_ativo) where ntc_id=".$_REQUEST['id'];
    mysqli_query($link,$sql) or die("Erro!");
    header('location:index.php');
}
if($acao=='logoff'){
    $_SESSION['admLogado']=NULL;
    $_SESSION['userLogado']=NULL;
    echo "Você foi desconectado";
    echo "<a href='index.php'><button>Voltar</button></a>";
}
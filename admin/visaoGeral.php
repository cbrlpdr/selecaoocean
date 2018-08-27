<?php
include "../php/conexao.php";
$link = connect();
session_start();

$sql="select * from noticia";
$query=mysqli_query($link,$sql);

if(!isset($_SESSION['admLogado'])){
    header('location:index.php');
}
//Essa parte garante que somente quem estiver logado consegue acessar a visaoGeral

?>
Logado como <?php echo $_SESSION['userLogado'] ?><br>
<a href="controllerAdmin.php?acao=logoff"><button>Sair</button></a><br>
<table width=1000 style="text-align:center;border:groove;">
<tr>
    <th>
        Código
    </th>
    <th>
        Título
    </th>
    <th>
        Autor
    </th>
    <th>
        Imagem
    </th>
    <th>
        Denúncias
    </th>
    <th>
        Ações
    </th>
</tr>
<?php
while($res=mysqli_fetch_array($query)){
?>
<tr <?php if(!$res['ntc_ativo']) echo"style='background-color:#444;color:#fff'" ?>>
    <td>
        <?php echo $res['ntc_id'] ?>
    </td>
    <td>
        <?php echo $res['ntc_titulo'] ?>
    </td>
    <td>
        <?php echo $res['ntc_autor'] ?>
    </td>
    <td>
    <img class="card-img-top img-thumbnail ntcThumb" src="../php/getImagem.php?cod=<?php echo $res['ntc_id'] ?>" style="width:50px;height:50px" alt="Erro! Imagem não encontrada!">
    </td>
    <td>
        <?php
            $sqlDnc="select count(*) from denuncia where dnc_noticia=".$res['ntc_id'];
            $queryDnc=mysqli_query($link,$sqlDnc);
            $resDnc=mysqli_fetch_array($queryDnc);
            echo $resDnc[0];
        ?>
    </td>
    
    <td>
        <a target="_blank" href="../index.php?p=ler&id=<?php echo $res['ntc_id'] ?>"><button>Ver</button></a>
        <form action="controllerAdmin.php?acao=toggleAtivo&id=<?php echo $res['ntc_id'] ?>" method="POST">
            <button type="submit">
                <?php 
                    if($res['ntc_ativo'])   echo "Desativar";
                    else                    echo "Ativar";  
                ?>
            </button>
        </form>
    </td>
</tr>
<?php
}
?>
</table>
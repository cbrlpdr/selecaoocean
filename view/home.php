<?php 
include "php/conexao.php";
$link = connect();
?>

<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
    <h6 class="pt-2">Assuntos mais comentados:</h4>
    <?php 
    //Consulta as tags mais postadas e ordena
    $sql="select tag_nome, count(tag_id) as vezes from tag where tag_ativa=1 group by tag_nome order by vezes desc ;";
    $query=mysqli_query($link,$sql);
    $numTags=0;
    while($res=mysqli_fetch_array($query)){
        if($numTags>=6) break; //Limita o numero de tags
        ?>
            <a class="pt-2 text-muted text-capitalize" href="?p=home&tag=<?php echo $res['tag_nome'] ?>"><?php echo $res['tag_nome'] ?></a>
        <?php
        $numTags++;
    }
    ?>
    
    </nav>
</div>
<div class="jumbotron p-1 p-md-3 text-white rounded bg-info">
    <?php 
    if(isset($_GET['tag'])) echo "<h3 class='modal-title text-center text-capitalize'>".$_GET['tag']."</h3>";
    else echo "<h3 class='modal-title text-center'>Últimas notícias</h3>";
    ?>
    
</div>

    <?php 
    $numNoticias=0;
    $itensNaLinha = 0;
    //Consulta as notícias, da mais recente para a mais antiga
    //Caso exista algum assunto selecionado, filtra a consulta
    if(isset($_GET['tag'])){ $sql="select * from noticia 
    inner join tag on tag_noticia=ntc_id
    where ntc_ativo=1 and tag_nome='".$_GET['tag']."' order by ntc_datahora desc;";
    }  else $sql="select * from noticia where ntc_ativo=1 order by ntc_datahora desc";
    $query=mysqli_query($link,$sql);
    while($res=mysqli_fetch_array($query)){
        
        if($numNoticias==20) break;//Limita o número de postagens
        if($itensNaLinha==0){//Caso seja uma linha nova insere a div de abertura de linha
            echo "<div class='row mb-2'>";
        }
        $numNoticias++;
        $itensNaLinha++;
        ?><div class="col-md-3">
            <div class="card" style="height:560px">
            <div class="card-header">
            <a href="?p=ler&id=<?php echo $res['ntc_id'] ?>"><h5 class="card-title"><?php echo $res['ntc_titulo'] ?></h5></a>
            </div>
            <img class="card-img-top img-thumbnail ntcThumb" src="php/getImagem.php?cod=<?php echo $res['ntc_id'] ?>" alt="Erro! Imagem não encontrada!">
            <strong class="d-inline-block ml-3 text-info text-capitalize">
            <?php //Coloca as tags da notícia (se tiver)
                    $numTags=0;
                    $sqlTags="select * from tag where tag_noticia = ".$res['ntc_id']." and tag_ativa=1;";
                    $queryTags=mysqli_query($link,$sqlTags);
                    while($resTags=mysqli_fetch_assoc($queryTags)){
                        if($numTags>2) break;   //Limita o número de tags aparecendo
                    ?> <?php echo $resTags['tag_nome'] ?>
                    <?php
                    $numTags++;
                    }
                    if($numTags==0) echo "<font style='color: #ccc'>Nenhum marcador</font>"
                ?>
            </strong>
            <div class="card-body">
            
            <div class="mb-1 text-muted"><?php echo tempoDecorrido($res['ntc_datahora']) ?></div>
                
                <p class="card-text">
                
                <?php 
                //Mostra uma parte do conteúdo da notícia e trunca o excedente
                    if(strlen($res['ntc_conteudo'])>120){
                        echo substr($res['ntc_conteudo'],0,117)."...";
                    }else{
                        echo $res['ntc_conteudo'];
                    }
                ?>    
                <p>
                <a href="?p=ler&id=<?php echo $res['ntc_id'] ?>">Continuar lendo</a>
            </div>
            </div>
          
        </div>
        
    <?php
        if($itensNaLinha==4){//Caso já tenha quatro notícias em uma linha fecha a tag div
            echo "</div>";
            $itensNaLinha=0;
        }
    }
    //Caso não tenha nenhuma notícia, avisa o usuário
    if($numNoticias==0) echo "Não há nenhuma notícia! :(";
    //Caso o número de notícias mostradas seja diferente de 4, fecha a linha
    if($itensNaLinha!=4){
        echo "</div>";
    }
    
    ?>
        
        <hr>
			<footer class="modal-header" style="">
				<p>Criado por Pedro Cabral</p>
				
			</footer>
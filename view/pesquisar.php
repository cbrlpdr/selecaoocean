<?php 
include "php/conexao.php";
$link = connect();

$busca=$_GET['busca'];
?>



    <?php 
    $numNoticias=0;
    $itensNaLinha = 0;
    //Consulta as notícias, da mais recente para a mais antiga
    //Caso exista algum assunto selecionado, filtra a consulta
    $sql="select * from noticia 
        inner join tag on tag_noticia=ntc_id
        where ntc_ativo=1 and ntc_conteudo like '%$busca%' or ntc_titulo like '%$busca%' or tag_nome like '%$busca%' group by ntc_titulo order by ntc_datahora desc;";
    $query=mysqli_query($link,$sql);
    $num=mysqli_num_rows($query);

    ?>
    <div class="jumbotron p-1 p-md-3 text-white rounded bg-info">
        <?php 
        echo "<h3 class='modal-title text-center'>$num resultado(s) encontrados para '$busca'</h3>";
        ?>
        
    </div>
    <?php
    while($res=mysqli_fetch_array($query)){
        
        if($numNoticias==20) break;//Limita o número de postagens
        if($itensNaLinha==0){//Caso seja uma linha nova insere a div de abertura de linha
            echo "<div class='row mb-2'>";
        }
        $numNoticias++;
        $itensNaLinha++;
        ?><div class="col-md-3">
            <div class="card">
            <div class="card-header">
            <h5 class="card-title"><?php echo $res['ntc_titulo'] ?></h5>
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
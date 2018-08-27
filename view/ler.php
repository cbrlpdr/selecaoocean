<?php
include "php/conexao.php";
$link = connect();

$ntc_id=$_GET['id'];
$sql="select * from noticia where ntc_id=$ntc_id and ntc_ativo=1";
//echo $sql;
$query=mysqli_query($link,$sql);
$res=mysqli_fetch_array($query);
?>
<strong class="display-4"><?php echo $res['ntc_titulo'] ?>
    <button id="btnDenuncia" class="btn btn-danger float-right m-2" data-toggle="modal" data-target="#popUpDenuncia">Denunciar</button>
</strong>
<div>Escrito por <?php $time=$res['ntc_datahora']; echo $res['ntc_autor'].", ".getDiaCompleto($time).".<br> <i>".getHora($time).", ".tempoDecorrido($time).""; ?></i></div>
<hr>
<img class="card-img-top img-thumbnail ntcBig" src="php/getImagem.php?cod=<?php echo $res['ntc_id'] ?>" alt="Erro! Imagem não encontrada!">
 
<p class="lead">
<?php
echo $res['ntc_conteudo'];
?>
          
</p>


<!--- POP UP DENÚNCIA -->
<div class="modal fade" id="popUpDenuncia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Denúncia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="php/controller.php?acao=insertDenuncia&ntc_id=<?php echo $res['ntc_id']; ?>" method="POST">
      <div class="modal-body">
        Denuncie conteúdos que você achar ofensivos ou inapropriados.<br><br>
        
            <label for="denunciaMotivo"  class="inputTitle">Motivo:</label>
            <select class="" style="width:60%" name="denunciaMotivo">
                <option value="nudez">Nudez</option>
                <option value="violencia">Violência</option>
                <option value="noticiafalsa">Notícia Falsa</option>
                <option value="spam">Spam</option>
                <option value="discursodeodio">Discurso de ódio</option>
            </select>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Denunciar</button>
      </div>
    </form>
    </div>
  </div>
</div>

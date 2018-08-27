<br>
<div class="container align-content-center row">
<div class="col-2"></div>
<div class="col-8">
<div class="bd-callout bd-callout-warning">
<h5 id="conveying-meaning-to-assistive-technologies">Colabore com o Die Seite postando uma notícia!</h5>

<p>É de graça e não é obrigatório se cadastrar! Porém, em breve, você pode se cadastrar para ter algumas vantagens!<br>Cuidado ao escrever sobre assuntos polêmicos, fake news e não publique notícias sobre assuntos não permitidos na comunidade.</p>
</div>
<hr>
<form action="php/controller.php?acao=cadastrarNoticia" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="tituloNoticia"  class="inputTitle">Título da notícia</label>
    <input maxlength="40" required="required" class="form-control form-control-lg" type="text" name="titulo" id="titulo" placeholder="Seja criativo e pense num título atrativo">
</div>

<div class="form-group">
    <label for="conteudo"  class="inputTitle">Conteúdo da Notícia</label>
    <textarea maxlength="820" required="required" class="form-control form-control-lg" style="height: 200px" type="text" name="noticia" id="conteudo" placeholder="Aqui você pode escrever sua notícia. Lembre-se: para receber boas avaliações, escreva sobre algo que as pessoas gostam de ler!" onKeyDown="contadorChar();" onKeyUp="contadorChar();"></textarea>
    <label id="charRest" >Máximo de 820 caracteres</label>
</div>
<div class="form-group">
    <label for="image" class="inputTitle">Imagem</label><br>
    <input name="imagem" type="file" id="imagem">
</div>

<div class="form-group">
    <label for="autor"  class="inputTitle">Autor</label>
    <input  maxlength="60"  required="required" class="form-control form-control-lg" type="text" name="autor" id="autor" placeholder="Digite seu nome (ou pseudônimo)">
</div>

<div class="form-group">
    <label for="fonte"  class="inputTitle">Fonte</label>
    <input  maxlength="60"  class="form-control form-control-sm" type="text" name="fonte" id="fonte" placeholder="As fontes adicionam credibilidade à sua notícia.">
</div>

<div class="form-group">
    <label for="tags"  class="inputTitle">Marcadores</label>
    <input  maxlength="50"  class="form-control form-control-sm" type="text" name="tags" id="tags" placeholder="As pessoas costumam usar as tags para encontrar notícias. Use ',' para separar as tags.">
</div>

<div class="center">
<button class="btn btn-primary w-25" type="submit">Enviar</button>
<button class="btn btn-secundary w-25" type="reset">Limpar</button>
</div>


    
</form>
</div>
<div class="col-2"></div>
</div>
<br><br><br><br>

<script>
function contadorChar(campo, numChars, max){
    document.getElementById("charRest").innerHTML=document.getElementById("conteudo").value.length + "/820 <i>(" + (820 - document.getElementById("conteudo").value.length) + " caracteres restantes)</i>" ;
      
}
</script>

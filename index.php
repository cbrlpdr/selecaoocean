<!DOCTYPE html>
<!--
AUTOR: PEDRO HENRIQUE FREITAS CABRAL
-->
<html>
	<head>
		<link rel="icon" type="imagem/png" href="res/icon.png" />
		<meta charset="UTF-8">
		<title>Die Seite</title>
	</head>
	<body>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="font/css/open-iconic-bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-grid.css" rel="stylesheet">
		<link href="css/dieseite.css" rel="stylesheet">
		
		<div class="container">
			<header class="modal-header">
				<div class="col-4 py-3">
					<a href="?p=cadastrarNoticia">
						<button class="btn btn-outline-info" >Postar uma notícia</button>
					</a>
					<a href="?p=sobre">
						<button class="btn btn-outline-info" >Sobre</button>
					</a>
				</div>
				<div class="col-4 text-center">
					<a class="text-dark logo" style="font-size: 40px" href="?p=home">Die Seite</a>
					
				</div>
				<div class="col-4 py-3">
				<form action="" method="GET" class="form-inline my-2 my-lg-0">
					<input type="hidden" name="p" value="pesquisar">
					<input class="form-control mr-sm-2" type="search" name="busca" placeholder="Digite sua busca">
					<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Pesquisar</button>
				</form>
				</div>
				
			</header>
			
			
			<?php
				//Recebe a página enviada na URL, caso não exista, assume que é "home"
				include "php/functions.php";
				if(isset($_GET['p'])){
					$page=$_GET['p'];
				}else{
					$page="home";
				}
				include_once 'view/'.$page.'.php';

			?>
		
		</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>

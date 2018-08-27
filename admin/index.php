<!DOCTYPE html>
<!--
AUTOR: PEDRO HENRIQUE FREITAS CABRAL
-->
<html>
	<head>
		<?php
		session_start();
		if(isset($_SESSION['admLogado'])){
			echo "a";
			header('Location: visaoGeral.php');
		}
		?>
		<meta charset="UTF-8">
		<title>Die Seite - Administrador</title>
	</head>
	<body>	
		<div style="display:block;width:260px;text-align:center;margin-left:auto;margin-right:auto;">
			<h2>Die Seite - Administrador</h2>
			<form action="controllerAdmin.php?acao=login" method="POST">
			<table>
				<tr>
					<th>Login: </th>
					<td><input type="text" name="login"></td>
				</tr>
				<tr>
					<th>Senha: </th>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td colspan=2>
						<button type="submit" style="width:100%">Entrar</button>
					</td>
				</tr>
			</table>
			</form>
		</div>
    </body>
</html>
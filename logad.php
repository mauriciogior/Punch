<?php
session_start();
if(isset($_POST["senha"])){
	if($_POST["senha"] == "6uwgqj9w"){
		$_SESSION["admin"] = 1;
		echo "<script>window.location='index.php'</script>";
	}
}
?>
<BR>
<BR>
<BR>
<div align="center">
<form action="logad.php" method="post">
SENHA: <input name="senha" type="password">
<BR><input type="submit" value="Administrar"/>
</form>
<BR>
<BR>
<BR>
Veio aqui por acidente?
<BR>
<BR><a href="index.php">
Clique aqui para voltar</a>
<BR><a href="http://www.punchsub.com/">
Ou clique aqui para ir ao PUNCH! Fan Sub</a>
</div>

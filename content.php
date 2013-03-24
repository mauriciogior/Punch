<?php
include('simple_html_dom.php');	
include('class.php');
session_start();

$banco = new banco();

if(!$banco->connection()){
	switch($banco->connection()){
	case -1:
		echo "FALHA NA CONEXÃO COM O BANCO.";
		break;
	case -2:
		echo "FALHA NA CONEXÃO COM A DB.";
		break;
	}
}
else{

function progressBar($percentage) {
    $data = "<div id=\"progress-bar\" class=\"all-rounded\">";
    $data .= "<div id=\"progress-bar-percentage\" class=\"all-rounded\" style=\"width: $percentage%\">";
        if ($percentage > 5) { $data .= (int)($percentage)."%";} else {$data .= "<div class=\"spacer\"> </div>";}
    $data .= "</div></div>";
    return $data;
}

$html = file_get_html('http://www.punchsub.com/lista-de-animes/nome/todos/1');
  

$i = 0;
$a = 1;

$pag = $html->find('div[class=paginacao] ul li a');
while($pag[($a - 1)]){
	  foreach($html->find('div[class=pNome] a') as $nome){
		  $id = $nome->href;
		  $id = explode("/",$id);
		  $banco->nome[$i] = $nome->plaintext;
		  $banco->url[$i] = $nome->href;
		  $banco->id[$i] = $i;
		  $banco->pid[$i] = $id[4];
		  $i++;
	  }
	  if($pag[$a])
		  $html = file_get_html($pag[$a]->href);
	  $a++;
}

$i = 0;

while($banco->pid[$i]){

	$banco->register($i);
	$i++;

}
/*
$_SESSION["urls"] = array();
$_SESSION["urls"] = $banco->url;

$_SESSION["pid"] = array();
$_SESSION["pid"] = $banco->pid;

$_SESSION["nome"] = array();
$_SESSION["nome"] = $banco->nome;
?>
*/
?>
<script>parent.hide('loading')</script>
<script>parent.show('done')</script>
<script>parent.refreshp()</script>
<?php
/*
<script>parent.change('l2','<?=$banco->nome[0]?>')</script>
<script>parent.document.getElementById('percent').innerHTML = '<?php echo progressBar(0); ?>'</script>
<form name="link" action="links.php" method="POST">
	<input type="hidden" value="0" name="i"/>    
</form>
<script>link.submit()</script>
<?php
*/
}
?>
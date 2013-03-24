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

$ii = $_POST["i"];
$banco->nome[$ii] = $_SESSION["nome"][$ii];
$banco->pid[$ii] = $_SESSION["pid"][$ii];
$url = $_SESSION["urls"][$ii];

$arr1 = array();
$arr2 = array();
$arr3 = array();

$arr1 = $_SESSION["nome"];
$arr2 = $_SESSION["pid"];
$arr3 = $_SESSION["urls"];

$$_SESSION["nome"] = $arr1;
$$_SESSION["pid"] = $arr2;
$$_SESSION["urls"] = $arr3;

$html = file_get_html($url);

$pages = $html->find('div[class=paginacao] ul li a');
$qualities = $html->find('div[class=formatosBox] ul li a');

$qcount = 0;
foreach($qualities as $element){
	$qcount++;
}

$pcount = 0;
foreach($pages as $element){
	$pcount++;
}

$i = 0;
$j = 0;
$k = 0;
$_i = 0;
$_j = 0;
foreach($qualities as $quality){
	$_i++;
	$html = file_get_html($quality->href);
	$pages = $html->find('div[class=paginacao] ul li a');
	foreach($pages as $page){
		$_j++;
		$html = file_get_html($page->href);
		foreach($html->find('td[class=downTbl boxRound boxShadowBlue]') as $a){
			foreach($a->find('span[class=listagemEp]') as $b){
				$aux = $b->plaintext;
				$aux = explode(" ",$aux);
				$banco->ep[$k][$i] = $aux[1];
			}
			foreach($a->find('div[class=listagemLinks boxRound] a') as $c){
				$banco->link[$k][$i][$j] = $c->href;
				$banco->server[$k][$i][$j] = $c->plaintext;
				$j++;
			}
			$j = 0;
			$i++;
		}
		echo "<script>parent.document.getElementById('percent').innerHTML = '".progressBar(($_i+$_j)*100/($pcount*$qcount+$qcount))."'</script>";
	}
	$i = 0;
	$j = 0;
	$banco->quality[$k] = $quality->plaintext;
	$k++;
}
$i = 0;
$j = 0;
$k = 0;
while($banco->quality[$k]){
	while($banco->ep[$k][$i]){
		while($banco->link[$k][$i][$j]){
			$banco->links($ii,$i,$j,$k);
			$j++;
		}
		$j=0;
		$i++;
	}
	$i=0;
	$k++;
}

$ii++;
if(!isset($_SESSION["nome"][$ii])){
?>
<script>parent.show('done')</script>
<script>parent.hide('loading2')</script>
<?php
}
else {
?>
<script>parent.change('l2','<?=$_SESSION["nome"][$ii]?>')</script>
<script>parent.document.getElementById('percent').innerHTML = '<?php echo progressBar(0); ?>'</script>
<form name="link" action="links.php" method="POST">
	<input type="hidden" value="<?=$ii?>" name="i"/>    
</form>
<script>link.submit()</script>
<?php
}
}
?>
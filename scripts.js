function godireto(){
	document.getElementById("aviso").innerHTML = "Aviso: Esta opção pode demorar."
	$("input[class=vip]").attr("disabled","disabled")
}
function gopunch(){
	document.getElementById("aviso").innerHTML = ""
	$("input[class=vip]").removeAttr("disabled")
}
function genlista(pid,qual){
	window.open("genlista.php?pid="+pid+"&qual="+qual,"Ratting","width=600,height=600,scrollbar=no,resizable=no,toolbar=no,titlebar=no,status=no,menubar=no,location=no",false);
}
function download(pid,qual){
	document.getElementById("d"+pid).className = ""
	$("tr.d").fadeOut("fast")
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("download").innerHTML=xmlhttp.responseText;
	  }
	}
xmlhttp.open("GET","download.php?pid="+pid+"&qual="+qual,true);
xmlhttp.send();
	
}
function undownload(pid){
	document.getElementById("d"+pid).className = "d"
	$("tr.d").fadeIn("slow")
	document.getElementById("download").innerHTML = ""
}
function atualizar(pid){
	$("input[type=button]").attr("disabled","disabled");
	document.getElementById(pid).innerHTML = "<div id='progress'><img src='loading.gif' width='15px'/>  Atualizando...</div><iframe style=\"display:none\" src=\"update.php?pid="+pid+"\" frameborder=\"0\" height=\"0px\"></iframe>";
}
function links(pid){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("l"+pid).innerHTML=xmlhttp.responseText;
	  }
	}
xmlhttp.open("GET","links.php?pid="+pid,true);
xmlhttp.send();
}
function hide(id){
	document.getElementById(id).style.display = 'none'
}
function show(id){
	document.getElementById(id).style.display = ''
}
function change(id,data){
	document.getElementById(id).innerHTML = "Inserindo episódios de " + data + "..."
}
function registrar(){
	document.getElementById("content").innerHTML = "<iframe src=\"content.php\" frameborder=\"0\" width=\"100%\"></iframe>"
	document.getElementById("animes").innerHTML = ""
	document.getElementById("loading").style.display = ''
}
function refreshp(){
  setTimeout(function () { window.location = "index.php" }, 1500);
}
function listar(){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("data").innerHTML=xmlhttp.responseText;
	  }
	}
xmlhttp.open("GET","animes.php",true);
xmlhttp.send();
}

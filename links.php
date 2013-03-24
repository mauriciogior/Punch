<?php
  $query = mysql_query("SELECT * FROM links WHERE pid='$animes[pid]'");
  while($link = mysql_fetch_array($query)){
	  if($link["quality"] == "fullhd")
	  	$qual[0] = "FullHD";
	  if($link["quality"] == "hd")
	  	$qual[1] = "HD";
	  if($link["quality"] == "sd")
	  	$qual[2] = "SD";
	  if($link["quality"] == "mp4")
	  	$qual[3] = "MP4";
	  if($link["quality"] == "slq")
	  	$qual[4] = "SLQ";
	  if($link["quality"] == "rmvb")
	  	$qual[5] = "RMVB";
  }
  echo "<span class='link' onclick='download($animes[pid],0)'>".$qual[0]."</span> <span class='link' onclick='download($animes[pid],1)'>".$qual[1]."</span> <span class='link' onclick='download($animes[pid],2)'>".$qual[2]."</span> <span class='link' onclick='download($animes[pid],3)'>".$qual[3]."</span> <span class='link' onclick='download($animes[pid],4)'>".$qual[4]."</span> <span class='link' onclick='download($animes[pid],5)'>".$qual[5]."</span>";
?>
<?php
require "class.php";
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
?>
<html>
<head>
<title>LINKS PUNCH!</title>
<link rel="shortcut icon" href="http://www.punchsub.com/favicon.png">
<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="scripts.js"></script>
<script>
function deletar(pid,name){
<?php
if(isset($_SESSION["admin"])){
?>
var resposta = confirm ("Tem certeza que deseja deletar os links de "+name+"?")
if (resposta){
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
xmlhttp.open("GET","delete.php?pid="+pid,true);
xmlhttp.send();
}
<?php
}
else{
?>
alert('Redirecionando para a página do administrador...\n\nProteção feita para evitar bugs.\nSe não for admin, envie um email para \n\nmcgiordalp@gmail.com\n\nsolicitando a remoção dos links para atualização.\n\nObrigado!')
window.location="logad.php"
<?php
}
?>
}
</script>
<style type="text/css"></style>
</head>
    <body topmargin="0">
    
<div id="barraTopo" style="background-image: -webkit-linear-gradient(top, rgb(87, 141, 177), rgb(73, 127, 166)); background-position: initial initial; background-repeat: initial initial; ">
            <div class="barraTopoCorpo">
            <div width="100%" align="center"><BR>
            	<a target="_blank" href="http://www.punchsub.com/">CLIQUE AQUI OU NO BANNER PARA ACESSAR O SITE OFICIAL</a>
            </div>
        </div>
        </div>
    <div id="corpo">
    <div class="bannerContainer" width="100%" align="center">
                <div class="bannerLinha"></div>
                <div class="bannerSombra"></div>
                <div id="banner"><a href="http://www.punchsub.com/" target="_blank"><img src="http://www.punchsub.com/imagens/banners/<?php
$banner = array(
0 => "Banner1000x228-tra.jpg",
1 => "Banner1000x228_1.jpg",
2 => "Banner1000x228_2.jpg",
3 => "Banner1000x228_3.jpg",
4 => "Banner1000x228_toriko_01.jpg",
5 => "Banner_-_FT_02.jpg",
6 => "Banner_-_FT_04.jpg",
7 => "Banner_-_FT_05.jpg",
8 => "Banner_-_FT_06.jpg",
9 => "Banner_-_Fate_zero-final.jpg",
10 => "Banner_-_Fate_zero.jpg",
11 => "Banner_-_Hellsing_2.jpg",
12 => "Banner_-_Hellsing_3.jpg",
13 => "Banner_-_Hellsing_4.jpg",
14 => "Banner_-_Hellsing_5.jpg",
15 => "Banner_-_NSG.jpg",
16 => "Banner_-_Natsume_Yuujinchou_San_1.jpg",
17 => "Banner_-_Natsume_Yuujinchou_San_2.jpg",
18 => "Banner_-_New_word2.jpg",
19 => "Banner_-_Nuramago2_1.jpg",
20 => "Banner_-_Nuramago2_2.jpg",
21 => "Banner_-_One-piece_3Â°Simestre-2012.jpg",
22 => "Banner_-_One-piece___01.jpg",
23 => "Banner_-_One-piece___02.jpg",
24 => "Banner_-_One-piece___03.jpg",
25 => "Banner_-_Projeto_-nS_01.jpg",
26 => "Banner_-_Projeto_-nS_extra.jpg",
27 => "Banner_-_beelzebub_01.jpg",
28 => "Banner_-_beelzebub_02.jpg",
29 => "Banner_-_beelzebub_03.jpg",
30 => "Banner_-_ft_es_02.jpg",
31 => "Banner_-_ft_nv_01.jpg",
32 => "Banner_-_ft_nv_02.jpg",
33 => "Banner_-_ft_nv_03.jpg",
34 => "Banner_-_gintama_01.jpg",
35 => "Banner_-_gintama_02.jpg",
36 => "Banner_-_gintama_03.jpg",
37 => "Banner_-_gintama_04.jpg",
38 => "Banner_-_gintama_05.jpg",
39 => "Banner_-_gintama_06.jpg",
40 => "Banner_-_hentai_01.jpg",
41 => "Banner_-_hentai_04.jpg",
42 => "Banner_-_hentai_3.jpg",
43 => "Banner_-_movie_boodPrison.jpg",
44 => "Banner_-_op_com.jpg",
45 => "Banner_-_op_com_01.jpg",
46 => "Banner_1000x228-2.jpg",
47 => "Banner_1000x228_-digimon_nÃ£o-sei-o-nome.jpg",
48 => "Berserk2.jpg",
49 => "CabeÃ§alho.jpg",
50 => "NS3D01HiGhV2.jpg",
51 => "afs-.jpg",
52 => "banner1.jpg",
53 => "banner_-_AE.jpg",
54 => "banner_-_AnK.jpg",
55 => "banner_-_Another.jpg",
56 => "banner_-_Another_final.jpg",
57 => "banner_-_BRS_01.jpg",
58 => "banner_-_BRS_02.jpg",
59 => "banner_-_BRS_03.jpg",
60 => "banner_-_Bakuman_-2.jpg",
61 => "banner_-_Bem-to-2.jpg",
62 => "banner_-_Bem-to-3.jpg",
63 => "banner_-_Bem-to.jpg",
64 => "banner_-_Boku wa Tomodachi ga Sukunai.jpg",
65 => "banner_-_Brave_10.jpg",
66 => "banner_-_Brave_10_02.jpg",
67 => "banner_-_Chihayafuru_1.jpg",
68 => "banner_-_Chihayafuru_2.jpg",
69 => "banner_-_FMF2.jpg",
70 => "banner_-_GC.jpg",
71 => "banner_-_GC_12_1.jpg",
72 => "banner_-_GC_12_2.jpg",
73 => "banner_-_GC_12_3.jpg",
74 => "banner_-_GC_2.jpg",
75 => "banner_-_GC_3.jpg",
76 => "banner_-_Gundam_AGE-2012.jpg",
77 => "banner_-_Gundam_AGE.jpg",
78 => "banner_-_HS_DxD.jpg",
79 => "banner_-_HxH.jpg",
80 => "banner_-_Mk.jpg",
81 => "banner_-_Moretsu_Uchuu_Kaizoku.jpg",
82 => "banner_-_PBKP.jpg",
83 => "banner_-_Sjin_tennis.jpg",
84 => "banner_-_Wk2.jpg",
85 => "banner_-_ZnTF.jpg",
86 => "banner_-_af.jpg",
87 => "banner_-_aniclub.jpg",
88 => "banner_-_aniclub2.jpg",
89 => "banner_-_aniclub3.jpg",
90 => "banner_-_anm_1.jpg",
91 => "banner_-_anm_2.jpg",
92 => "banner_-_aw_es.jpg",
93 => "banner_-_aw_nv.jpg",
94 => "banner_-_binbougami-ga.jpg",
95 => "banner_-_champione.jpg",
96 => "banner_-_dbwhgd.jpg",
97 => "banner_-_dkn.jpg",
98 => "banner_-_esao_01_ne.jpg",
99 => "banner_-_hk_es.jpg",
100 => "banner_-_hk_ne.jpg",
101 => "banner_-_hn_es_01.jpg",
102 => "banner_-_hye.jpg",
103 => "banner_-_kb_es.jpg",
104 => "banner_-_kb_ne.jpg",
105 => "banner_-_kill me Baby.jpg",
106 => "banner_-_kingkong-no-coping.jpg",
107 => "banner_-_knnhigi.jpg",
108 => "banner_-_ktb.jpg",
109 => "banner_-_kz_est.jpg",
110 => "banner_-_kz_est_01.jpg",
111 => "banner_-_kz_nv.jpg",
112 => "banner_-_kz_nv_01.jpg",
113 => "banner_-_mb_es.jpg",
114 => "banner_-_mb_nv.jpg",
115 => "banner_-_mirai-nikki.jpg",
116 => "banner_-_mirai-nikki_2.jpg",
117 => "banner_-_mirai-nikki_3.jpg",
118 => "banner_-_mirai-nikki_4.jpg",
119 => "banner_-_mirai-nikki_5.jpg",
120 => "banner_-_n-n-kx.jpg",
121 => "banner_-_nk_es.jpg",
122 => "banner_-_p4_1.jpg",
123 => "banner_-_p4_2.jpg",
124 => "banner_-_p4_4.jpg",
125 => "banner_-_p4_5.jpg",
126 => "banner_-_porquemao.jpg",
127 => "banner_-_sa_ne.jpg",
128 => "banner_-_sc_es.jpg",
129 => "banner_-_sc_es_1.jpg",
130 => "banner_-_sc_nv.jpg",
131 => "banner_-_sc_nv_1.jpg",
132 => "banner_-_shakugan-no-shana-iii.jpg",
133 => "banner_-_sr_es_1.jpg",
134 => "banner_-_sr_nv.jpg",
135 => "banner_-_sr_nv_1.jpg",
136 => "banner_-_ss_dk_1.jpg",
137 => "banner_-_ss_dk_2.jpg",
138 => "banner_-_ss_new.jpg",
139 => "banner_-_ss_o_1.jpg",
140 => "banner_-_ss_o_2.jpg",
141 => "banner_-_ss_o_e_1.jpg",
142 => "banner_-_ss_o_e_2.jpg",
143 => "banner_-_tara-tara.jpg",
144 => "banner_-_te.jpg",
145 => "banner_-_uk.jpg",
146 => "banner_-_uk_nv.jpg",
147 => "banner_-_yy_1.jpg",
148 => "banner_-_yy_2.jpg",
149 => "banner_-_yy_3.jpg",
150 => "banner_-_yy_4.jpg",
151 => "banner_-_yy_5.jpg",
152 => "banner_-_zetman_e.jpg",
153 => "banner_-_zetman_ep.jpg",
154 => "bannernarutov3.png",
155 => "bardock.jpg",
156 => "beelzebub.png",
157 => "berserk1.jpg",
158 => "headerpunch.jpg",
159 => "kingdom.jpg",
160 => "toradora.jpg",
161 => "yunoBanner.jpg"
);
echo $banner[rand(138,142)];
				?>" border="0" width="985" height="224" alt="Banner"></a>
    </div>
    </div>
      <div id="principal" align="center">
      <div align="center" class="noticiaConteudo boxRound noticiaShadow" style="width:97%;font-size:24px;font-family:Trebuchet MS">
      Site dedicado à facilitar o acesso aos downloads. Feito por um fã do PUNCH!.
      </div>
      <div align="center" class="noticiaConteudo boxRound noticiaShadow" style="width:97%;font-size:16px"><b style="font-size:24px;font-family:Trebuchet MS">Como usar:</b><BR>
		Para visualizar os links, basta clicar na qualidade da imagem (ex: "HD, SD,..."). É bem simples de utilizar.<BR>
		Para poder copiar vários links simultaneamente, basta clicar em "GERAR LISTA DE LINKS".<BR><BR>
		Se não tiver links de um certo anime ou estiverem desatualizados, basta clicar em "Atualizar".<BR>
		Se por ventura algum link for deletado do PUNCH e ainda constar aqui, envie uma mensagem para:<BR>
		&nbsp;&nbsp;<b>mcgiordalp@gmail.com</b><BR><BR>
		<i>"OBS: Os downloads VIPs estão com bugs, já que a requisição dos links sem autenticação retorna <BR>&nbsp&nbsp&nbsp'http://www.punchsub.com/link-doadores'<BR>
		Isto acontece porque o site "baixa" os links do PUNCH! sem autenticação.<BR>
		Clique num link VIP sem estar logado, você cairá na página acima.<BR>
		Não consegui autenticar usando CURL. Se alguém estiver disposto a ajudar estarei disponível."</i>
		<BR><BR>
		Bom proveito!
      </div>
        <div id="animes" align="center" style="width:97%" class="noticiaConteudo boxRound noticiaShadow">
<?php

$data = $banco->check("animes","a");
if($data == -1){
?>
	<span id="nodata"><BR><BR><BR>
    Não há nenhum anime registrado.
    <BR><BR>
    <input type="button" onClick="registrar()" value="Registrar"/>
    </span>
<?php
}
else {
?>
	<span id="data"><BR><BR><BR>
    <script>listar()</script>
    </span>
<?php
}
?>
		 </div>
         <div id="download" align="center">
         </div>
            <span id="loading" style="display:none;"><BR><BR><BR>
                <div align="center">
                    <img src="loading.gif"/><BR><BR><BR>
                    <div>Carregando...</div>
                </div>
            </span>
            <span id="done" style="display:none;"><BR><BR><BR>
                <div align="center">
                    <div>Pronto!</div>
                </div>
            </span>
            <span id="loading2" style="display:none;"><BR><BR><BR>
                <div align="center">
                    <img src="loading.gif"/><BR><BR><BR>
                    <div id="l2"></div>
                    <div id="percent"></div>
                </div>
            </span>
      <div align="center" class="rodape boxRound noticiaShadow" style="width:98%;font-size:24px;font-family:Trebuchet MS">
      Sistema desenvolvido por Maurício Giordano (mcgiorda).<BR>
      mcgiordalp@gmail.com<BR><BR>
      OBS: LINKS e LEGENDAS DO FANSUBBER PUNCH!<BR>
      OBS: LAYOUT de Ulisses Dias e Hiei<BR>
      </div><BR>
      </div>
      <span id="content" width="100%">
      </span>
      </div>
    </body>
</html>
<?php
$banco->connection('kill');
}
?>
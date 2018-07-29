<html>
<head>
<meta charset="utf-8"/>
<title>emotionM</title>
<style type="text/css">
		/* Layout */
		body {
			min-width: 630px;
		}

		#container {
			padding-left: 200px;
			padding-right: 190px;
		}
		
		#container .column {
			position: relative;
			float: left;
		}
		
		#center {
			padding: 10px 20px;
			width: 100%;
		}
		
		#left {
			width: 180px;
			padding: 0 10px;
			right: 240px;
			margin-left: -100%;
		}
		
		#right {
			width: 130px;
			padding: 0 10px;
			margin-right: -100%;
		}
		
		#footer {
			clear: both;
		}
		
		/* IE hack */
		* html #left {
			left: 150px;
		}

		/* Make the columns the same height as each other */
		#container {
			overflow: hidden;
		}

		#container .column {
			padding-bottom: 1001em;
			margin-bottom: -1000em;
		}

		/* Fix for the footer */
		* html body {
			overflow: hidden;
		}
		
		* html #footer-wrapper {
			float: left;
			position: relative;
			width: 100%;
			padding-bottom: 10010px;
			margin-bottom: -10000px;
			background: #fff;
		}

		/* Aesthetics */
		body {
			margin: 0;
			padding: 0;
			font-family:Sans-serif;
			line-height: 1.5em;
		}
		
		p {
			color: #555;
		}

		nav ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}
		
		nav ul a {
			color: darkgreen;
			text-decoration: none;
		}
		

		#header, #footer {
			font-size: large;
			color: #FFFFFF;
			padding: 0.3em;
			background: #333;
		}

		#left {
			background: #9ad3de;
		}
		
		#right {
			background: #9ad3de;
		}

		#center {
			background: #18BC9C;
		}

		#container .column {
			padding-top: 1em;
		}
		
	</style>
</head>
<body>

<header id="header"><a href="https://www.info-rne.net:5026/" style="text-decoration:none"><b><font color="#FFFFFF">EMOTIONM</font></b></a></header>
<?php
	$statement = $_POST["statement"];

	$statarray = array();
	$wordarray = array();
	$num = array();
	$start=0;
	$j = 0;
	$k = 0;
	//1)음절단위로 잘라 statarray에 저장 2)음절에서의 단어수 num에 저장
	for($i = 0; $i < strlen($statement); $i++)
	{	
		if(ord($statement[$i]) != 32){
			$statarray[$j][$k] = ord($statement[$i]);
			$num[$j] = $k;
			$k++;
			$numab=$num[$j]+1;
			$numabc = $numab/3;
			$wordarray[$j]=iconv_substr($statement,$start,$numabc,"UTF-8");
		}else{
			$start = $start+$numabc+1;
			$j++;
			$k=0;
		}
	}
	//statarray출력해봄...
	for($i=0; $i<=$j;$i++){
		//echo "<br>".$wordarray[$i].": ";
		for($k=0;$k<=$num[$i];$k++){
			//echo " ".$statarray[$i][$k];
		}
	}
?>
<?php
	$hostname=
	$username =
	$passwd =
	$dbname = 
	
	$connect = mysql_connect($hostname,$username,$passwd)or die("Failed");
	$result = mysql_select_db($dbname,$connect);
	
	mysql_query("set names utf8");
	
	$sql = "SELECT * FROM emotion";
	$rs = mysql_query($sql,$connect);
	
	$data = array();
	$dataid=0;
	
	//각 단어들을 불러와 아스키 코드로 디코딩 함 그리고 echo 함수로 출력
	while($info=mysql_fetch_array($rs)){
		$data[$dataid][0]=$info["word"];
		$data[$dataid][1]=$info["happy"];
		$data[$dataid][2]=$info["sad"];
		$data[$dataid][3]=$info["mad"];
		$data[$dataid][4]=$info["excited"];
		$data[$dataid][5]=$info["extroverted"];
		$data[$dataid][6]=$info["introverted"];
		$lastdataid = $dataid;
		$dataid++;
	}
	$dataid=0;
	$statid=0;
	$datatemp=array();
	$stattemp=array();
	
	$alikeword=array();
	$alikenum=0;
	//$statarray[i][j]i번째 단어구에 j번째 문자 아스키코드 저장 :: $data[i][j]i번째 row에 j번째 db데이터 저장
	for($dataid=0;$dataid<=$lastdataid;$dataid++){
		$dataword=$data[$dataid][0];
		$dataword_length = strlen($dataword);
		for($statid=0;$statid<=$j;$statid++){
			if(strlen($dataword)<=$num[$statid]+1){
				$tempi=0;
				$subtract = (($num[$statid]+1)-$dataword_length)/3;
				for($i = 0; $i < $dataword_length; $i++){
					$datatemp[$i]=ord($dataword[$i]);
				}
				for($i=0;$i<=$num[$statid];$i++){
					$stattemp[$i]=$statarray[$statid][$i];
				}
				//echo "<br>".$data[$dataid][0]." ".$wordarray[$statid]." ".$subtract;
				$check=0;
				$confirm=0;
				for($tempi=0;$tempi<=$subtract;$tempi++){
					$tempj=0;
					for($tempj=0;$tempj<($dataword_length/3);$tempj++){
						if((($tempj+1)*3)<$dataword_length){
							$wordnum=$tempi+$tempj;
							$dbnum=$tempj;
							if($datatemp[$dbnum*3]==$stattemp[$wordnum*3]&&$datatemp[($dbnum*3)+1]==$stattemp[($wordnum*3)+1]&&$datatemp[($dbnum*3)+2]==$stattemp[($wordnum*3)+2]){
								$check++;
							}else{
								$check=0;
							}
							$confirm=0;
							//echo "tempi: $tempi+$tempj tempj: $tempj check: $check";
						}else{
							$wordnum=$tempi+$tempj;
							$dbnum=$tempj;
							if($datatemp[$dbnum*3]==$stattemp[$wordnum*3]&&$datatemp[($dbnum*3)+1]==$stattemp[($wordnum*3)+1]&&$datatemp[($dbnum*3)+2]+5>$stattemp[($wordnum*3)+2]&&$datatemp[($dbnum*3)+2]-5<$stattemp[($wordnum*3)+2]){
								$check++;
							}else{
								$check=0;
							}
							if($check==$dataword_length/3){
								$confirm=1;
							}
							//echo "(end) tempi: $tempi+$tempj tempj: $tempj check: $check confirm: $confirm";
						}
						
						if($confirm==1){
							$alikeword[$alikenum][0]=$alikenum;
							$alikeword[$alikenum][1]=$dataid;
							$alikeword[$alikenum][2]=$data[$dataid][0];
							$alikeword[$alikenum][3]=$statid;
							$alikeword[$alikenum][4]=$wordarray[$statid];
							$alikenum++;
						}
						$confirm=0;
					}
				}
			}
		}
	}
	$exist=0;
	if(empty($alikeword)){
		//echo "<br>No entry was found";
		$exist=2;
	}else{
		$justtest=0;
		for($justtest=0;$justtest<=$alikenum-1;$justtest++){
			//echo "<br>".$alikeword[$justtest][2]."=".$alikeword[$justtest][4];
		}
		$datamean=array();
		for($justtest=0;$justtest<=$alikenum-1;$justtest++){
			$datamean[0]=$datamean[0]+$data[$alikeword[$justtest][1]][1];
			$datamean[1]=$datamean[1]+$data[$alikeword[$justtest][1]][2];
			$datamean[2]=$datamean[2]+$data[$alikeword[$justtest][1]][3];
			$datamean[3]=$datamean[3]+$data[$alikeword[$justtest][1]][4];
			$datamean[4]=$datamean[4]+$data[$alikeword[$justtest][1]][5];
			$datamean[5]=$datamean[5]+$data[$alikeword[$justtest][1]][6];
		}
		for($justtest=0;$justtest<6;$justtest++){
			$datamean[$justtest]=$datamean[$justtest]/$alikenum;
			//echo "<br>".$datamean[$justtest];
		}
	}
	
	$sqlclust = "SELECT * FROM cluster";//cluster라는 데이터 베이스 만들기
	$rsclust = mysql_query($sqlclust,$connect);
	$dataclust=array();
	$lastclustid=0;
	$dataid=0;

	while($infoclust=mysql_fetch_array($rsclust)){
		$dataclust[$dataid][0]=$infoclust["id"];
		$dataclust[$dataid][1]=$infoclust["happy"];
		$dataclust[$dataid][2]=$infoclust["sad"];
		$dataclust[$dataid][3]=$infoclust["mad"];
		$dataclust[$dataid][4]=$infoclust["excited"];
		$dataclust[$dataid][5]=$infoclust["extroverted"];
		$dataclust[$dataid][6]=$infoclust["introverted"];
		$lastclustid = $dataid;
		$dataid++;
	}

	$sqlcenter = "SELECT * FROM center";//center라는 데이터 베이스 만들기
	$rscenter = mysql_query($sqlcenter,$connect);
	$datacenter=array();
	$lastcenterid=0;
	$dataid=0;

	while($infocenter=mysql_fetch_array($rscenter)){
		$datacenter[$dataid][0]=$infocenter["id"];
		$datacenter[$dataid][1]=$infocenter["happy"];
		$datacenter[$dataid][2]=$infocenter["sad"];
		$datacenter[$dataid][3]=$infocenter["mad"];
		$datacenter[$dataid][4]=$infocenter["excited"];
		$datacenter[$dataid][5]=$infocenter["extroverted"];
		$datacenter[$dataid][6]=$infocenter["introverted"];
		$lastcenterid = $dataid;
		$dataid++;
	}
	$a=0;
	$existid=0;
	for($a=0;$a<=$lastclustid;$a++){
		if($datamean[0]==$dataclust[$a][1]&&$datamean[1]==$dataclust[$a][2]&&$datamean[2]==$dataclust[$a][3]&&$datamean[3]==$dataclust[$a][4]&&$datamean[4]==$dataclust[$a][5]&&$datamean[5]==$dataclust[$a][6]){
			$exist=1;
			$existid=$a;
		}
	}
	$finalid=0;
	if($exist==0){
		$clusterid;
		$distance=pow($datamean[0]-$datacenter[0][1],2)+pow($datamean[1]-$datacenter[0][2],2)+pow($datamean[2]-$datacenter[0][3],2)+pow($datamean[3]-$datacenter[0][4],2)+pow($datamean[4]-$datacenter[0][5],2)+pow($datamean[5]-$datacenter[0][6],2);
		$tempdistance;
		for($clusterid=0;$clusterid<=$lastcenterid;$clusterid++){
			$tempdistance=pow($datamean[0]-$datacenter[$clusterid][1],2)+pow($datamean[1]-$datacenter[$clusterid][2],2)+pow($datamean[2]-$datacenter[$clusterid][3],2)+pow($datamean[3]-$datacenter[$clusterid][4],2)+pow($datamean[4]-$datacenter[$clusterid][5],2)+pow($datamean[5]-$datacenter[$clusterid][6],2);
			//echo "<br>id: ".$clusterid." dis: ".$tempdistance;
			if($tempdistance<$distance){
				$distance=$tempdistance;
				$finalid=$clusterid;
			}
		}
		//echo "<br>final: ".$finalid;
		$insertquery="INSERT INTO cluster (id, happy, sad, mad, excited, extroverted, introverted) VALUES ('".$finalid."', '".$datamean[0]."', '".$datamean[1]."', '".$datamean[2]."', '".$datamean[3]."', '".$datamean[4]."', '".$datamean[5]."')";
		mysql_query($insertquery,$connect);
			

	}else if($exist==1){
		$finalid=$dataclust[$existid][0];
		//echo "<br>final: ".$finalid;
	}
	if($exist!=2){
	$cntst=array();
	if($datacenter[$finalid][1]==42){
		$cntst[0]=2;
	}else if($datacenter[$finalid][1]==26){
		$cntst[0]=1;
	}else if($datacenter[$finalid][1]==9){
		$cntst[0]=0;
	}
	
	if($datacenter[$finalid][3]==42){
		$cntst[1]=2;
	}else if($datacenter[$finalid][3]==26){
		$cntst[1]=1;
	}else if($datacenter[$finalid][3]==9){
		$cntst[1]=0;
	}
	
	if($datacenter[$finalid][4]==42){
		$cntst[2]=2;
	}else if($datacenter[$finalid][4]==26){
		$cntst[2]=1;
	}else if($datacenter[$finalid][4]==9){
		$cntst[2]=0;
	}
	
	if($datacenter[$finalid][5]==0){
		$cntst[3]=0;
	}else{
		$cntst[3]=1;
	}
	$wrd=0;
	while($wrd!=4){
		//echo "<br>".$cntst[$wrd];
		$wrd++;
	}
	}
?>
	<div id="container">

		<main id="center" class="column">
			<article>
				<?php
					if($exist==2){
						echo "<h1>죄송합니다. 데이터 분석이 불가능합니다</h1>";
					}else{
						echo "<h1>이런 음악은 어떤가요?</h1>";
						echo "<p>당신이 좋아할 만한 음악을 추천해보았습니다.</p>";
					}

					$linksql = "SELECT * FROM link";//center라는 데이터 베이스 만들기
					$link = mysql_query($linksql,$connect);
					$datalink=array();
					$sortlink=array();
					$linkid=0;

					while($infolink=mysql_fetch_array($link)){
						if($cntst[0]==$infolink["fia"]&&$cntst[1]==$infolink["fib"]&&$cntst[2]==$infolink["fic"&&$cntst[3]==$infolink["fid"]]){
							$datalink[$linkid][0]=$infolink["fia"];
							$datalink[$linkid][1]=$infolink["fib"];
							$datalink[$linkid][2]=$infolink["fic"];
							$datalink[$linkid][3]=$infolink["fid"];
							$datalink[$linkid][4]=$infolink["link"];
							$datalink[$linkid][5]=$infolink["id"];
							$datalink[$linkid][6]=$infolink["pop"];
							$datalink[$linkid][7]=$infolink["title"];

							$sortlink[$linkid][0]=$infolink["link"];
							$sortlink[$linkid][1]=$infolink["id"];
							$sortlink[$linkid][2]=$infolink["pop"];
							$sortlink[$linkid][3]=$infolink["title"];
							$linkid++;
						}
					}
					$random = rand(0,$linkid-1);
					$finallink=$datalink[$random][4];
					$reallink = "https://www.youtube.com/embed/".$finallink."?enablejsapi=1";
					echo '<iframe id="existing-iframe-example" width="560" height="315" src="'.$reallink.'" frameborder="0" allowfullscreen style="border: solid 4px #37474F"></iframe>';
				?>
				
				<!--위 iframe 에서 src에서의 링크를 php mysql에서 데이터 베이스로 바꿔야됩니다-->
				<script type="text/javascript">
  				var tag = document.createElement('script');
  				tag.id = 'iframe-demo';
  				tag.src = 'https://www.youtube.com/iframe_api';
  				var firstScriptTag = document.getElementsByTagName('script')[0];
  				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  				var player;
  				function onYouTubeIframeAPIReady() {
   					player = new YT.Player('existing-iframe-example', {
        			events:{
          				'onReady': onPlayerReady,
          				'onStateChange': onPlayerStateChange
        				}
    				});
  				}
  				function onPlayerReady(event) {
    				document.getElementById('existing-iframe-example').style.borderColor = '#FF6D00';
  				}
  function changeBorderColor(playerStatus) {
    var color;
    if (playerStatus == -1) {
      color = "#37474F"; // unstarted = gray
    } else if (playerStatus == 0) {
      color = "#FFFF00"; // ended = yellow
    } else if (playerStatus == 1) {
      color = "#33691E"; // playing = green
    } else if (playerStatus == 2) {
      color = "#DD2C00"; // paused = red
    } else if (playerStatus == 3) {
      color = "#AA00FF"; // buffering = purple
    } else if (playerStatus == 5) {
      color = "#FF6DOO"; // video cued = orange
    }
    if (color) {
      document.getElementById('existing-iframe-example').style.borderColor = color;
    }
  }
  function onPlayerStateChange(event){
    changeBorderColor(event.data);
  }
</script>
			<form action="" method="post">
 				<input type="hidden" name="likevalue" value= 1>
 				<input type="hidden" name="likeid" value= <?php echo $datalink[$random][5]?>>
 				<p><input type="submit" name="like" value="좋아요"/></p>
			</form>
			</article>
			<?php
				$likevalue = $_POST["likevalue"];
				$likeid = $_POST["likeid"];
				$finalvalue = $datalink[$likeid][6]+$likevalue;
				if(empty($likevalue)){
				}else{
					$likequery = "UPDATE link SET pop=".$finalvalue." WHERE id=".$likeid;
					mysql_query($likequery,$connect);
					$gohome=1;
				}
			?>
			<script type="text/javascript">
				var gohome =  " <?php echo $gohome ?>";
				if(gohome==1){
					location.href='https://www.info-rne.net:5026/';
				}
			</script>						
		</main>

		<nav id="left" class="column">
			<h3>인기 트랙</h3>
			<!--인기 트랙 데이터 베이스 불러오는 php 코드-->
			<h3>추천 트랙</h3>
			<h4>당신과 비슷한 사람들이 추천한 곡</h4>
			<!--추천 트랙 데이터 베이스 불러오는 php 코드-->
			<?php
				$sqlrec = "SELECT * FROM recommend";//center라는 데이터 베이스 만들기
				$mysql_rec = mysql_query($sqlrec,$connect);
				$lastrecid=0;
				$recid=0;
				echo "<ol>";
				while($inforec=mysql_fetch_array($mysql_rec)){
					if($inforec["fia"]==$cntst[0]&&$inforec["fib"]==$cntst[1]&&$inforec["fic"]==$cntst[2]&&$inforec["fid"]==$cntst[3]){
						echo "<li>".$inforec["title"]."</li>";
					}
				}
				echo "</ol>";
			?>
		</nav>

		<nav id="right" class="column">
			<h3>좋은 노래를 추천해주세요</h3>
			<?php
				if(isset($_POST["songtitle"])){
					$title = $_POST["songtitle"];
					$a = $_POST["a"];
					$b = $_POST["b"];
					$c = $_POST["c"];
					$d = $_POST["d"];
					$recquery="INSERT INTO recommend (fia,fib,fic,fid,title) VALUES ('".$a."', '".$b."', '".$c."', '".$d."', '".$title."')";
				mysql_query($recquery,$connect);
				$gotohome=1;
				}
			?>
			<script type="text/javascript">
				var home =  " <?php echo $gotohome ?>";
				if(home==1){
					location.href='https://www.info-rne.net:5026/';
				}
			</script>
			<form action="" method="post">
 				<p>곡제목<input type="text" name="songtitle" placeholder="추천하시는 곡이름을 입력해주세요" id="title_val" /></p>
 				<input type="hidden" name="a" value= <?php echo $cntst[0]?> >
 				<input type="hidden" name="b" value= <?php echo $cntst[1]?> >
 				<input type="hidden" name="c" value= <?php echo $cntst[2]?> >
 				<input type="hidden" name="d" value= <?php echo $cntst[3]?> >
 				<p><input type="submit" name="Submit" value="추천하기"/></p>
			</form>
			
			<!--노래 추천 텍스트 필드 만들기 그리고 데이터 베이스 올리는 코드 만들기-->
			<p></p>
		</nav>
		<p id="demo"></p>
			<button onclick="myFunction()">Click me</button>
			<script>
				function myFunction() {
					var bla = $('#title_val').val();
					document.getElementById("demo").innerHTML = bla;
				}
			</script>

	</div>

	<div id="footer-wrapper">
		<footer id="footer"><b>EMOTIONM과 재밌는 시간을 보내셨나요?</b></footer>
	</div>

	<?php
	mysql_close($connect);
	?>

</body>
</html>

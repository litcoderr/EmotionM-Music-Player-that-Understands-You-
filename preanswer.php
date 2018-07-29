<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>emotionM</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    input[type=text]{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                color: black;
            }
            input[type=submit] {
                width: 100%;
                background-color: #1E88E5;
                color:white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type=submit]:hover {
                background-color: #1565C0;
            }
            input[type=button] {
                width: 100%;
                background-color: #1DE9B6;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type=button]:hover {
                background-color: #00BFA5;
            }
    </style>

</head>

<body id="page-top" class="index">
	<script type="text/javascript">
		function loadDoc(url, cFunction) {
			var xhttp;
			xhttp=new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				cFunction(this);
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}
		function myFunction(xhttp) {
			document.getElementById("demo").innerHTML = xhttp.responseText;
		}
    </script>

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="https://www.info-rne.net:5026/">EMOTIONM</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Popular</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">Recommend</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
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
    $cntst[0]=$datacenter[$finalid][0];
    }

    $rearrange = array();
    $re_exist = array();
    $re_count=0;
    for($re_count=0;$re_count<=$lastclustid;$re_count++){
        if($re_exist[$dataclust[$re_count][0]]==1){
            $count_i=0;
            while($count_i<6){
                $rearrange[$dataclust[$re_count][0]][$count_i]=$rearrange[$dataclust[$re_count][0]][$count_i]+$dataclust[$re_count][$count_i+1];
                $count_i++;
            }
            $rearrange[$dataclust[$re_count][0]][6]++;
        }else{
            $rearrange[$dataclust[$re_count][0]][0]=$dataclust[$re_count][1];
            $rearrange[$dataclust[$re_count][0]][1]=$dataclust[$re_count][2];
            $rearrange[$dataclust[$re_count][0]][2]=$dataclust[$re_count][3];
            $rearrange[$dataclust[$re_count][0]][3]=$dataclust[$re_count][4];
            $rearrange[$dataclust[$re_count][0]][4]=$dataclust[$re_count][5];
            $rearrange[$dataclust[$re_count][0]][5]=$dataclust[$re_count][6];
            $rearrange[$dataclust[$re_count][0]][6]=1;
        }
        $re_exist[$dataclust[$re_count][0]]=1;
    }
    for($re_count=0;$re_count<54;$re_count++){
        if($re_exist[$re_count]==1){
            $count_i=0;
            //echo $re_count."/ ";
            while($count_i<6){
                $rearrange[$re_count][$count_i]=$rearrange[$re_count][$count_i]/$rearrange[$re_count][6];
                //echo $rearrange[$re_count][$count_i]." ";
                $count_i++;
            }//echo " /".$rearrange[$re_count][6]."<br>";
            $rearrange_query="UPDATE update_center SET happy=".$rearrange[$re_count][0].", sad=".$rearrange[$re_count][1].", mad=".$rearrange[$re_count][2].", excited=".$rearrange[$re_count][3].", extroverted=".$rearrange[$re_count][4].", introverted=".$rearrange[$re_count][5]." WHERE id=".$re_count." ";
            mysql_query($rearrange_query,$connect);
        }
    }


?>
    <div id="container">

        <main id="center" class="column">
            <article>
                <?php

                    $linksql = "SELECT * FROM link";//center라는 데이터 베이스 만들기
                    $link = mysql_query($linksql,$connect);
                    $datalink=array();
                    $sortlink=array();
                    $linkid=0;

                    while($infolink=mysql_fetch_array($link)){
                        if($cntst[0]==$infolink["clust"]){
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
						$cntst[1]=$infolink["id"];
                    }
                    $random = rand(0,$linkid-1);
                    $finallink=$datalink[$random][4];
                    $reallink = "https://www.youtube.com/embed/".$finallink."?enablejsapi=1";
					if($exist==2){
                        echo "<h1>안녕하세요 EMOTIONM 입니다</h1><h2>데이터 베이스 구축이 미완성되어 완벽한 해석이 어렵습니다. 양해부탁드립니다.</h2>";
                    }else{
                        echo '<h1>'.$datalink[$random][7].'</h1>';
                        echo "<p>이 음악은 어떤가요?</p>";
                    }
                    echo '<iframe id="existing-iframe-example" width=100%; height="450" src="'.$reallink.'" frameborder="0" allowfullscreen ></iframe>';
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
  /function changeBorderColor(playerStatus) {
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
  }/
  function onPlayerStateChange(event){
    changeBorderColor(event.data);
  }
</script>
<span class="glyphicon glyphicon-heart" aria-hidden="true"></span><div id="like_number"><p><?php echo $datalink[$random][6].'like'; ?></p></div>
            <form action="" method="post">
                <input type="hidden" name="likevalue" value= 1>
                <input type="hidden" name="likeid" value= <?php echo $datalink[$random][5]?>>
                <input type="hidden" name="pop" value=<?php echo $datalink[$random][6]?>>
                <p><input type="submit" name="like" value="좋아요"/></p>
            </form>
            <?php
                $likevalue = $_POST["likevalue"];
                $likeid = $_POST["likeid"];
                $prepop = $_POST["pop"];
                $finalvalue = $prepop+$likevalue;
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
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Popular</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <?php
                //$sortlink[$linkid][0]=$infolink["link"];
                //$sortlink[$linkid][1]=$infolink["id"];
                //$sortlink[$linkid][2]=$infolink["pop"];
                //$sortlink[$linkid][3]=$infolink["title"];
            function sortByOrder($a, $b) {
                return $a[2] - $b[2];
            }
            usort($sortlink, 'sortByOrder');
            echo '<div class="row">';
            $linki=1;
            if($linkid>=5){
                for($sortid=($linkid-1);$sortid>=($linkid-5);$sortid--){
                    echo'<div class="col-sm-4 portfolio-item"><a href="#portfolioModal'.$linki.'" class="portfolio-link" data-toggle="modal"><h3>#'.$linki.' '.$sortlink[$sortid][3].'</h3></a></div>';
                    $linki++;       
                }
            }else{
                for($sortid=($linkid-1);$sortid>=0;$sortid--){
                    echo'<div class="col-sm-4 portfolio-item"><a href="#portfolioModal'.$linki.'" class="portfolio-link" data-toggle="modal"><h3>#'.$linki.' '.$sortlink[$sortid][3].'</h3></a></div>';
                    $linki++;
                }
            }
            echo "</div>";
            ?>
            
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>추천곡</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
            <?php
                if(isset($_POST["songtitle"])){
                    $title = $_POST["songtitle"];
                    $a = $_POST["clust"];
                    $recquery="INSERT INTO recommend (clust,title) VALUES ('".$a."', '".$title."')";
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
                <p>곡제목<input type="text" name="songtitle" placeholder="추천하시는 곡이름을 입력해주세요" id="title_val"/></p>
                <input type="hidden" name="clust" value= <?php echo $cntst[0]?> >
                <p><input type="submit" name="Submit" value="추천하기" onclick="recom()"/></p>


			<script>
				function recom() {
					var title_value = $('#title_val').val();
					var cluster_id = <?php echo $cntst[0]?>;
					if(title_value.length !=0){
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("recommend_list").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET", "recommend.php?title=" + title_value+"&cluster="+cluster_id, true);
						xmlhttp.send();
						
						$('#title_val').reset();
					}
				}
			</script>
			
                </div>
                <div class="col-lg-4" id="recommend_list">
                    <?php
                $sqlrec = "SELECT * FROM recommend";//center라는 데이터 베이스 만들기
                $mysql_rec = mysql_query($sqlrec,$connect);
                $lastrecid=0;
                $recid=0;
                echo "<ol>";
                while($inforec=mysql_fetch_array($mysql_rec)){
                    if($inforec["clust"]==$cntst[0]){
                        echo "<li>".$inforec["title"]."</li>";
                    }
                }
                echo "</ol>";
            ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h3>EMOTIONM과 좋은 시간을 보내셨나요?</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/EmotionMusicAI/" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; emotionM 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    <?php
        /*$finallink=$datalink[$random][4];
        $reallink = "https://www.youtube.com/embed/".$finallink."?enablejsapi=1";
        echo '<iframe id="existing-iframe-example" width=100%; height="450" src="'.$reallink.'" frameborder="0" allowfullscreen ></iframe>';*/

        //$sortlink[$linkid][0]=$infolink["link"];
        //$sortlink[$linkid][1]=$infolink["id"];
        //$sortlink[$linkid][2]=$infolink["pop"];
        //$sortlink[$linkid][3]=$infolink["title"];
        $realid=$linki-2;
        for($up=1;$up<$linki;$up++){
            $finallink=$sortlink[$realid][0];
            $reallink="https://www.youtube.com/embed/".$finallink."?enablejsapi=1";
            echo '<div class="portfolio-modal modal fade" id="portfolioModal'.$up.'" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-content"><div class="close-modal" data-dismiss="modal"><div class="lr"><div class="rl"></div></div></div><div class="container"><div class="row"><div class="col-lg-8 col-lg-offset-2"><div class="modal-body"><h2>'.$sortlink[$realid][3].'</h2><hr class="star-primary"><iframe id="existing-iframe-example" width=100%; height="450" src="'.$reallink.'" frameborder="0" allowfullscreen ></iframe></div></div></div></div></div></div>';
                $realid--;
        }
    ?>


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>
<?php
    mysql_close($connect);
    ?>
</body>

</html>

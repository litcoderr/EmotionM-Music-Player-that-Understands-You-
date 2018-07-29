
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIGN UP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="css/simple-line-icons.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- 
    Default Theme Style 
    You can change the style.css (default color purple) to one of these styles
    
    1. pink.css
    2. blue.css
    3. turquoise.css
    4. orange.css
    5. lightblue.css
    6. brown.css
    7. green.css

    -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Styleswitcher ( This style is for demo purposes only, you may delete this anytime. ) -->
    <link rel="stylesheet" id="theme-switch" href="css/style.css">
    <!-- End demo purposes only -->


    <style>
    /* For demo purpose only */
    
    /* For Demo Purposes Only ( You can delete this anytime :-) */
    #colour-variations {
        padding: 10px;
        -webkit-transition: 0.5s;
        -o-transition: 0.5s;
        transition: 0.5s;
        width: 140px;
        position: fixed;
        left: 0;
        top: 100px;
        z-index: 999999;
        background: #fff;
        /*border-radius: 4px;*/
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        -webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        -moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        -ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
    }
    #colour-variations.sleep {
        margin-left: -140px;
    }
    #colour-variations h3 {
        text-align: center;;
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #777;
        margin: 0 0 10px 0;
        padding: 0;;
    }
    #colour-variations ul,
    #colour-variations ul li {
        padding: 0;
        margin: 0;
    }
    #colour-variations li {
        list-style: none;
        display: block;
        margin-bottom: 5px!important;
        float: left;
        width: 100%;
    }
    #colour-variations li a {
        width: 100%;
        position: relative;
        display: block;
        overflow: hidden;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        border-radius: 4px;
        -webkit-transition: 0.4s;
        -o-transition: 0.4s;
        transition: 0.4s;
    }
    #colour-variations li a:hover {
        opacity: .9;
    }
    #colour-variations li a > span {
        width: 33.33%;
        height: 20px;
        float: left;
        display: -moz-inline-stack;
        display: inline-block;
        zoom: 1;
        *display: inline;
    }
    

    .option-toggle {
        position: absolute;
        right: 0;
        top: 0;
        margin-top: 5px;
        margin-right: -30px;
        width: 30px;
        height: 30px;
        background: #f64662;
        text-align: center;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        color: #fff;
        cursor: pointer;
        -webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        -moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        -ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
    }
    .option-toggle i {
        top: 2px;
        position: relative;
    }
    .option-toggle:hover, .option-toggle:focus, .option-toggle:active {
        color:  #fff;
        text-decoration: none;
        outline: none;
    }
    </style>
    <!-- End demo purposes only -->


    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    </head>
    <body>
    <script>
    var name = '';
    var id = 0;
  // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
    }
    }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
    function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
    }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1780885872191867',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  var signupStatus = 0;
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
        name = response.name;
        id = response.id;
        getSignupStatus(name,id);
        if(signupStatus==0){
            document.getElementById('is_done').innerHTML ='이미 신청이 되어있습니다, '+name+'님!';
        }else{
            document.getElementById('is_done').innerHTML ='신청이 완료되었습니다, '+name+'님!';
        }
    });
  }
</script>

<?php
    $hostname=
    $username =
    $passwd =
    $dbname =

    $connect = mysql_connect($hostname,$username,$passwd)or die("Failed");
    $result = mysql_select_db($dbname,$connect);
    mysql_query("set names utf8");
    $sql = "SELECT * FROM Signup_list";
    $rs = mysql_query($sql,$connect);

    $newdata_id = 0;
    $newdata_name = '';
    $data = array();
    $data_size = 0;    

    function fetchdata(){
        $i = 0;
        while($info = mysql_fetch_array($rs)){
            $data[$i][0] = $info["id"];
            $data[$i][1] = $info["name"];
            $i++;
        }
        $data_size = $i-1;
    }
?>

<script type="text/javascript">
   function getSignupStatus(name,id){
    document.getElementById('is_done').innerHTML ='여기까지 작동됨';
    $.post('vote.php',{name: name});
    $.post('vote.php',{id: id});
    <?php
        $issigned = false;
        $newdata_name = $_POST['name'];
        $newdata_id = $_POST['id'];

        fetchdata();
        $i=0;
        for($i=0;$i<=$data_size;$i++){
            if($data[$i][0]==$newdata_id||$data[$i][1]==$newdata_name){
                $issigned = true;
            }else{
                $insert_query = "INSERT INTO Signup_list (id,name) VALUES ('".$newdata_id."','".$newdata_name."')";
                mysql_query($insert_query,$connect);
            }
        }
        // js variable to php variable statement is needed
    ?>
    signupStatus = <?php echo $issigned; ?>
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
<div id="status">
</div>
    <header role="banner" id="fh5co-header">
            <div class="container">
                <!-- <div class="row"> -->
                <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <!-- Mobile Toggle Menu Button -->
                    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                 <a class="navbar-brand" href="">EmotionM</a> 
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                </div>
                </nav>
              <!-- </div> -->
          </div>
    </header>

    <section id="fh5co-home" data-section="home" style="background-image: url(images/full_image_2.jpg);" data-stellar-background-ratio="0.5">
        <div class="gradient"></div>
        <div class="container">
            <div class="text-wrap">
                <div class="text-inner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="to-animate">VOID 자바 강의 신청</h1>
                            <h2 class="to-animate">대전동신과학고 2학년 3학년 정보 완벽 정복</h2>
                            <h4 id = "is_done" class="to-animate">아래 버튼을 눌러 신청하세요</h4>
                        </div>
                        <div class="fb-login-button" data-width="10000" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slant"></div>
    </section>

    
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="js/jquery.stellar.min.js"></script>
    <!-- Counter -->
    <script src="js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
    <script src="js/google_map.js"></script>

    <!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
    <script src="js/jquery.style.switcher.js"></script>
    <script>
        $(function(){
            $('#colour-variations ul').styleSwitcher({
                defaultThemeId: 'theme-switch',
                hasPreview: false,
                cookie: {
                    expires: 30,
                    isManagingLoad: true
                }
            }); 
            $('.option-toggle').click(function() {
                $('#colour-variations').toggleClass('sleep');
            });
        });
    </script>
    <!-- End demo purposes only -->

    <!-- Main JS (Do not remove) -->
    <script src="js/main.js"></script>

    </body>
</html>

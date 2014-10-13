<!DOCTYPE html>
<html>
<head>
<script>

function validate(id){
    var email = document.getElementById('Email').value;
    var nama = document.getElementById('Nama').value;
    var kom = document.getElementById('Komentar').value;
    var re = /[a-z]*[@][a-z]*(.[a-z]*)*/;
    if(email.length==0||nama.length==0||kom.length==0){
        alert('ada kolom yang masih kosong');
        return false;
    }
    else{
        if(re.test(email)){
            send_comment(id);
        }else{
            alert('masukan email yang benar');
            return false;
        }
    }
}

function send_comment(id){
    var email = document.getElementById('Email').value;
    var nama = document.getElementById('Nama').value;
    var kom = document.getElementById('Komentar').value;
    var xmml_http;
    if(window.XMLHttpRequest){
        xmml_http=new XMLHttpRequest();
    }else{
        xmml_http=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmml_http.onreadystatechange=function(){
        if (xmml_http.readyState==4&&xmml_http.status==200){
            document.getElementById("komens").innerHTML=xmml_http.responseText;
        }
    }
    xmml_http.open("GET","add_comment.php?id="+id+"&email="+email+"&nama="+nama+"&komentar="+kom);
    xmml_http.send();
}
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->



<?php 
$con=mysqli_connect("localhost","root","","blogdb");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$Id=$_GET["id"];
$query = "SELECT * FROM post WHERE ID = $Id";
$hasil_q= mysqli_query($con,$query) or die(mysql_error());
if(!$hasil_q){
    echo "lalala";
    exit();
}
$post = mysqli_fetch_array($hasil_q) ;
?>
<title>Simple Blog | <?php echo $post['Judul'] ?> </title>
</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="new_post.php">+ Tambah Post</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    <header class="art-header">
        <div class="art-header-inner" style="margin-top: 0px; opacity: 1;">
            <time class="art-time"><?php echo $post['Tanggal']; ?></time>
            <h2 class="art-title"><?php echo $post['Judul']; ?></h2>
            <p class="art-subtitle"><?php echo $post['Isi']; ?></p>
        </div>
    </header>

    <div class="art-body">
        <div class="art-body-inner">
            <hr class="featured-article" />
            <p><?php echo $post['Isi']; ?>

            <hr />
            
            <h2>Komentar</h2>   

            <div id="contact-area">
                <form method="post" >
                    <label for="Nama">Nama:</label>
                    <input type="text" name="Nama" id="Nama">
        
                    <label for="Email">Email:</label>
                    <input type="text" name="Email" id="Email">
                    
                    <label for="Komentar">Komentar:</label><br>
                    <textarea name="Komentar" rows="20" cols="20" id="Komentar"></textarea>

                    <?php echo '<input type="button" onClick="validate('.$Id.')" name="submit" value="Kirim" class="submit-button">'; ?>
                </form>
            </div>
            <ul class="art-list-body">
                <?php 
                    $query="SELECT * FROM komentar WHERE ID_post=$Id ";
                    $hasil_q= mysqli_query($con,$query) or die(mysql_error());
                    echo '<div id="komens">';
                    while($row = mysqli_fetch_array($hasil_q)) {
                        echo'<li class="art-list-item">
                        <div class="art-list-item-title-and-time">
                        <h2 class="art-list-title">' . $row['Nama'] . '</a></h2>
                        <div class="art-list-time">';
                        date_default_timezone_set("Asia/Jakarta");
                        $timekomen=strtotime($row['Waktu']);
                        $timenow=strtotime(date("Y-m-d H:i:s"));
                        $delta= $timenow-$timekomen;
                        $parsed=date_parse(date("H:i:s",$delta));
                        $second=$parsed['hour']*3600+$parsed['minute']*60+$parsed['second'];
                        if($second/60<0){
                            echo $second . ' detik yang lalu';
                        }else{
                            if($second/3600<0){
                                echo $second/60 . ' menit yang lalu';
                            }else if($second/(3600*24)<0){
                                echo $second/3600 . 'jam yang lalu';
                            }
                            else{
                                echo $second/(3600*24) . ' hari yang lalu';
                            }

                        }
                        echo '<div class="art-list-time"><p>' . $row['Value'] . '</p></div>
                    </div>
                </li>';
                }
                echo '</div>';
                ?>
            </ul>
        </div>
    </div>

</article>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        Asisten IF3110 /
        <a class="rss-link" href="#rss">RSS</a> /
        <br>
        <a class="twitter-link" href="http://twitter.com/YoGiiSinaga">Yogi</a> /
        <a class="twitter-link" href="http://twitter.com/sonnylazuardi">Sonny</a> /
        <a class="twitter-link" href="http://twitter.com/fathanpranaya">Fathan</a> /
        <br>
        <a class="twitter-link" href="#">Renusa</a> /
        <a class="twitter-link" href="#">Kelvin</a> /
        <a class="twitter-link" href="#">Yanuar</a> /
        
    </aside>
</footer>

</div>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
</script>

</body>
</html>
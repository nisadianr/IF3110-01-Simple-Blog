<?php
	$con=mysqli_connect("localhost","root","","blogdb");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$ID=$_GET['id'];
	$name=$_GET['nama'];
	$email=$_GET['email'];
	$comment=$_GET['komentar'];
	date_default_timezone_set("Asia/Jakarta");
	$time=date("Y-m-d H:i:s");
	$sql = "INSERT INTO komentar (ID_post, Nama, Value, Email, Waktu) VALUES ('$ID','$name','$comment','$email','$time')";

	$a = mysqli_query($con,$sql);

	if (!$a) {
		echo "Error in MySQL";
	}
	$query="SELECT * FROM komentar WHERE ID_post=".$ID." ORDER BY ID DESC";
	$hasil_q= mysqli_query($con,$query) or die(mysql_error());
	while($row = mysqli_fetch_array($hasil_q)) {
		echo'<li class="art-list-item">
		<div class="art-list-item-title-and-time">
		    <h2 class="art-list-tit.le">' . $row['Nama'] . '</a></h2>
		    <div class="art-list-time">';
		    date_default_timezone_set("Asia/Jakarta");
            $timekomen=$row['Waktu'];
            $timenow=date("Y-m-d H:i:s");
            echo $timenow."hai".<br>;
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
	mysqli_close($con);
?>
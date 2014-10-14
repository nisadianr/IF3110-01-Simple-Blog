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
	$time=date("Y-m-d");
	$clock=date("H:i:s");
	$sql = "INSERT INTO komentar (ID_post, Nama, Value, Email, Tanggal, Jam) VALUES ('$ID','$name','$comment','$email','$time','$clock')";

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
            $tanggal_komen=$row['Tanggal'];
            $tanggal_sekarang=date("Y-m-d");
            $jam_komen=$row['Jam'];
            $jam_sekarang=date("H:i:s");

            if($tanggal_sekarang==$tanggal_komen){
            	echo 'hari ini';
            }
            else
            {
            	echo $tanggal_sekarang-$tanggal_komen+1 . " hari yang lalu";
            }
            echo '<div class="art-list-time"><p>' . $row['Value'] . '</p></div>
        </div>
    </li>';
    }
	mysqli_close($con);
?>
<?php
$con=mysqli_connect("localhost","root","","blogdb");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$ID=$_GET["id"];
mysqli_query($con,"DELETE FROM post WHERE ID='$ID'");
?>
<?php
$post = mysqli_query($con,"SELECT * FROM post"); 
// while($row = mysqli_fetch_array($post)) {
// 	$id=$row['ID'];
// 	echo'<li class="art-list-item">
// 	    <div class="art-list-item-title-and-time">
// 	        <h2 class="art-list-title"><a href="post.php?id=' . $row['ID'] . '">' . $row['Judul'].'</a></h2>
// 	        <div class="art-list-time">'.$row['Tanggal'].'</div>
// 	        <div class="art-list-time"><span style="color:#F40034;">&#10029;</span> Featured</div>
// 	    </div>
// 	    <p>'.$row['Isi'].'</p>
// 	    <p>
// 	      <a href="edit_post.php?id=' . $id . '">Edit</a> | <a href="javascript:delete_conf('. $id . ');">Hapus</a>
// 	    </p>
	    
// 	</li>
// 	';
// } 
echo $post;
mysqli_close($con);
?>
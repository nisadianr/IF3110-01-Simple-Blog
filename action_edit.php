<?php
$con=mysqli_connect("localhost","root","","blogdb");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$Judul=$_POST['Judul'];
$Tanggal=$_POST['Tanggal'];
$Isi=$_POST['Konten'];
$ID= $_GET["id"];


mysqli_query($con,"UPDATE post SET Judul='$Judul',Isi='$Isi',Tanggal='$Tanggal',ID='$ID' WHERE ID='$ID'");


mysqli_close($con);
header("Location: index.php");
?>
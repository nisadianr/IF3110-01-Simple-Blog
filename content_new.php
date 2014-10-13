<?php
$con=mysqli_connect("localhost","root","","blogdb");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$Judul=$_POST['Judul'];
$Tanggal=$_POST['Tanggal'];
//$Tanggal=date("Y-m-d");
$Isi=$_POST['Konten'];
mysqli_query($con,"INSERT INTO post (Judul, Tanggal, Isi)
VALUES ('$Judul', '$Tanggal','$Isi')");


mysqli_close($con);
header("Location: index.php");
?>
<?php 
$db = mysqli_connect("localhost","root","","SQLlearn");
if ( !$db ) {
	die("<h1>GAGAL TERKONEKSI KE DATABASE</h1>");
}
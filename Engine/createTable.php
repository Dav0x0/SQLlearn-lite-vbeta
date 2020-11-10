<?php require_once 'db.php';
$cek = mysqli_query($db,"SELECT * FROM data1");
$dataTable = mysqli_num_rows($cek);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Buat Data</title>
	<link rel="stylesheet" href="../BS/css/bootstrap.min.css">
</head>
<body>
	<div class="container bg-light shadow mt-4 position-relative" style="min-height: 90vh">
		<div class="row justify-content-center mb-5">
			<div class="col-12 col-md-6 mt-3">
				<form action="" method="POST" class="mx-auto shadow-sm rounded bg-white form-inline p-3">
					<input type="number" class="form-control w-75" name="loop">
					<button name="create" class="btn btn-success ml-2" type="submit">Buat</button>
					<small id="passwordHelpBlock" class="form-text text-muted">
					  Jumlah data pada table "data1" adalah <?= $dataTable ?>
					</small>
				</form>
			</div>
		</div>
		<small class="text-dark">Log Proccess : </small>
		<div class="bg-white px-3" style="
		box-shadow: inset 1px 0 5px rgba(0,0,0,.5);  
		min-height: 30vh;
		max-height: 50vh;
		overflow-y: auto;
		">
			<?php 
			if ( isset($_POST['create']) ) {
				$loop = $_POST['loop'];
				require_once '../BS/Faker/src/autoload.php';

				$faker = Faker\Factory::create('id_ID');

				$age="15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50";
				$age = explode(",", $age);

				echo("<small class='text-muted'>Membuat ".$loop." data ...</small> </br>");
				for ($i=1; $i <= $loop; $i++) { 
					if ($i % 2 == 0) {
				        $gender = 'Pria';
				    } else {
				        $gender = 'Wanita';
				    }
					$query = "INSERT INTO `data1` (`id`, `nama`, `umur`, `gender`, `email`, `telp`, `alamat`) VALUES (NULL, '".$faker->name."', '".$age[mt_rand(0, count($age)-1)]."', '".$gender."', '".$faker->email."', '".$faker->phonenumber."', '".$faker->address."')";
					$send = mysqli_query($db,$query);
					if ( $send ) {
						echo("<small class='text-muted'>Membuat Data ke-".$i." <span class='text-success'>OK</span> ...</small> </br>");
					}else{
						echo("<small class='text-muted'>Membuat Data ke-".$i." <span class='text-danger'>Failed</span> ...</small> </br>");
					}
				}

				echo("<small class='text-muted'>Memeriksa semua data dari tabel data1 ...</small> </br>");
				$cek = mysqli_query($db,"SELECT * FROM data1");
				$dataTable = mysqli_num_rows($cek);
				echo("<small class='text-muted'>".$dataTable." data ditemukan. </small> </br>");
			} ?>
		</div>
		
		<div class="position-absolute" style="bottom: 20px; width: 300px;">
			<div class="d-flex justify-content-around" style="bottom: 0">
				<a href="../" class="btn btn-secondary btn-sm">Kembali</a>
				<a href="./createTable.php" class="btn btn-primary btn-sm">Segarkan</a>
			</div>
		</div>
	</div>
</body>
</html>
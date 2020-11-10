<?php 
require 'db.php';
$GETquery = $_GET['keyQuery'];
$data  = mysqli_query($db, $GETquery);
// sleep(0.5);
if ($data): ?>
	<div class="table-responsive" style="max-height: calc(100vh - 155px) ">
		<table class="table table-sm table-striped table-hover table-bordered mb-0">
		  	<thead class="thead-dark">
			    <tr>
			    <?php $noFT = 1; while( $info = mysqli_fetch_field($data) ) : ?>
			    	<th scope="col"><?= $info->name ?></th>
			    <?php
			    	${ $info->name } = true;
			    	$noFT++;
			     endwhile; ?>
			    </tr>
		  	</thead>

			<tbody>			
			<?php if ( $data->num_rows > 0 ) : ?>
			  	<?php while ( $k = mysqli_fetch_assoc($data) ) : ?>
				    <tr>
				    	<?= ( !empty($id) ) ? "<th scope='row'>".$k['id']."</th>" : "" ?>
				    	<?= ( !empty($nama) ) ? "<td>".$k['nama']."</td>" : "" ?>
				    	<?= ( !empty($umur) ) ? "<td>".$k['umur']."</td>" : "" ?>
				    	<?= ( !empty($gender) ) ? "<td>".$k['gender']."</td>" : "" ?>
				    	<?= ( !empty($email) ) ? "<td>".$k['email']."</td>" : "" ?>
				    	<?= ( !empty($telp) ) ? "<td>".$k['telp']."</td>" : "" ?>
				    	<?= ( !empty($alamat) ) ? "<td>".$k['alamat']."</td>" : "" ?>
				    </tr>
			  	<?php endwhile; ?>
			<?php else : ?>
				<tr class="text-white-50" style="height: calc(100vh - 190px); background: rgba(0,0,0,.4);">
					<td colspan="<?= $noFT ?>" class="text-center" style="padding: calc(100vh / 2 - 125px) calc(100vw / 2 - 730px);">
						<h1 class="mt-n5 display-2 bg-dark noSelect">Hasil Query Kosong</h1>
					</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>

<?php else : ?>
	<div class="text-white-50 d-flex justify-content-center align-items-center" style="height: calc(100vh - 155px); background: rgba(0,0,0,.4);"><h1 class="mt-n5 display-1 noSelect">QUERY SALAH</h1></div>
<?php endif ?>
</div>
<?php require 'Engine/db.php'; 
$data = mysqli_query($db, "SELECT * FROM data1");
mysqli_close($db);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SQL Database learning</title>
	<link rel="stylesheet" href="BS/css/bootstrap.min.css">
	<style>
		::-webkit-scrollbar {
		  width: 8px;
		  background: transparent;
		}
		::-webkit-scrollbar-track {
		  background: #f1f1f1;
		}
		/* Handle */
		::-webkit-scrollbar-thumb {
		  background: #888;
		  border-radius: 4px
		}
		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
		  background: #555;
		}

		tr td {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		* { box-sizing: border-box; }
		body {
		  font: 16px Arial;
		}
		.autocomplete {
		  /*the container must be positioned relative:*/
		  position: relative;
		  display: inline-block;
		}
		.autocomplete-items {
		  position: absolute;
		  border: 1px solid #d4d4d4;
		  border-bottom: none;
		  border-top: none;
		  z-index: 99;
		  /*position the autocomplete items to be the same width as the container:*/
		  top: 100%;
		  left: 0;
		  right: 0;
		}
		.autocomplete-items div {
		  padding: 10px;
		  cursor: pointer;
		  background-color: #fff;
		  border-bottom: 1px solid #d4d4d4;
		}
		.autocomplete-items div:hover {
		  /*when hovering an item:*/
		  background-color: #e9e9e9;
		}
		.autocomplete-active {
		  /*when navigating through the items using the arrow keys:*/
		  background-color: DodgerBlue !important;
		  color: #ffffff;
		}
		.noSelect {
			-webkit-touch-callout: none;
			  -webkit-user-select: none;
			   -khtml-user-select: none;
				 -moz-user-select: none;
				  -ms-user-select: none;
					  user-select: none;
		}
		mark, .mark{
		    color: #fd4d59;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-dark bg-secondary shadow-sm sticky-top">
	 	<a class="navbar-brand" href="#"><sup class="text-white-50"><i>Lite</i></sup>MySQL <sub>learning</sub></a>
	 	<h5 class="text-white-50">Table : <span class="font-italic">data1</span></h5>

	 	<form class="w-100 rounded-0" autocomplete="off">
	 	<div class="autocomplete w-100">
	  		<textarea class="form-control" id="myInput" required name="query" placeholder="Your Query">SELECT * FROM data1</textarea>
		</div>
	 	</form>
	  	<div class="mt-2 d-flex justify-content-between w-100">
	  		<a href="./" class="btn btn-sm btn-primary">Muat Ulang</a>
	  		<button class="btn btn-sm btn-success text-white" id="sendQ">kirim</button>
	  		<span class="text-white-50">Version : Beta</span>
	  	</div>
	</nav>

	<div class="position-absolute w-100 justify-content-center align-items-center" id="loader" style="
		background: rgba(0,0,0,.7);
		height: calc(100vh - 155px);
		display: none;
	">
		<div class="h4 text-white-50 mt-n5">
		  <strong class="mr-2">Loading...</strong>
		  <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
		</div>
	</div>

<div id="TableData">
<?php if ($data): ?>
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

	<script src="BS/js/jquery-3.5.1.min.js"></script>
	<script src="BS/js/bootstrap.min.js"></script>
	<script src="BS/dist/jquery.mark.min.js" charset="UTF-8"></script>
	<script src="myAjax.js"></script>
	<script>

	// function autocomplete(inp, arr) {
	//   /*the autocomplete function takes two arguments,
	//   the text field element and an array of possible autocompleted values:*/
	//   var currentFocus;
	//   /*execute a function when someone writes in the text field:*/
	//   inp.addEventListener("input", function(e) {
	//       var a, b, i, val = this.value;
	//       /*close any already open lists of autocompleted values*/
	//       closeAllLists();
	//       if (!val) { return false;}
	//       currentFocus = -1;
	//       /*create a DIV element that will contain the items (values):*/
	//       a = document.createElement("DIV");
	//       a.setAttribute("id", this.id + "autocomplete-list");
	//       a.setAttribute("class", "autocomplete-items");
	//       /*append the DIV element as a child of the autocomplete container:*/
	//       this.parentNode.appendChild(a);
	//       /*for each item in the array...*/
	//       for (i = 0; i <= arr.length; i++) {
	//         /*check if the item starts with the same letters as the text field value:*/
	//         if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
	//           /*create a DIV element for each matching element:*/
	//           b = document.createElement("DIV");
	//           /*make the matching letters bold:*/
	//           b.innerHTML = "<strong class='text-success'>" + arr[i].substr(0, val.length) + "</strong>";
	//           b.innerHTML += arr[i].substr(val.length);
	//           /*insert a input field that will hold the current array item's value:*/
	//           b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
	//           /*execute a function when someone clicks on the item value (DIV element):*/
	//           b.addEventListener("click", function(e) {
	//               /*insert the value for the autocomplete text field:*/
	//               inp.value = this.getElementsByTagName("input")[0].value;
	//               /*close the list of autocompleted values,
	//               (or any other open lists of autocompleted values:*/
	//               closeAllLists();
	//           });
	//           a.appendChild(b);
	//         }
	//       }
	//   });
	//   /*execute a function presses a key on the keyboard:*/
	//   inp.addEventListener("keydown", function(e) {
	//       var x = document.getElementById(this.id + "autocomplete-list");
	//       if (x) x = x.getElementsByTagName("div");
	//       if (e.keyCode == 40) {
	//         /*If the arrow DOWN key is pressed,
	//         increase the currentFocus variable:*/
	//         currentFocus++;
	//         /*and and make the current item more visible:*/
	//         addActive(x);
	//       } else if (e.keyCode == 38) { //up
	//         /*If the arrow UP key is pressed,
	//         decrease the currentFocus variable:*/
	//         currentFocus--;
	//         /*and and make the current item more visible:*/
	//         addActive(x);
	//       } else if (e.keyCode == 13) {
	//         /*If the ENTER key is pressed, prevent the form from being submitted,*/
	//         e.preventDefault();
	//         if (currentFocus > -1) {
	//           /*and simulate a click on the "active" item:*/
	//           if (x) x[currentFocus].click();
	//         }
	//       }
	//   });
	//   function addActive(x) {
	//     /*a function to classify an item as "active":*/
	//     if (!x) return false;
	//     /*start by removing the "active" class on all items:*/
	//     removeActive(x);
	//     if (currentFocus >= x.length) currentFocus = 0;
	//     if (currentFocus < 0) currentFocus = (x.length - 1);
	//     /*add class "autocomplete-active":*/
	//     x[currentFocus].classList.add("autocomplete-active");
	//   }
	//   function removeActive(x) {
	//     /*a function to remove the "active" class from all autocomplete items:*/
	//     for (var i = 0; i < x.length; i++) {
	//       x[i].classList.remove("autocomplete-active");
	//     }
	//   }
	//   function closeAllLists(elmnt) {
	//     /*close all autocomplete lists in the document,
	//     except the one passed as an argument:*/
	//     var x = document.getElementsByClassName("autocomplete-items");
	//     for (var i = 0; i < x.length; i++) {
	//       if (elmnt != x[i] && elmnt != inp) {
	//         x[i].parentNode.removeChild(x[i]);
	//       }
	//     }
	//   }
	//   /*execute a function when someone clicks in the document:*/
	//   document.addEventListener("click", function (e) {
	//       closeAllLists(e.target);
	//   });
	// }

	// /*An array containing all the country names in the world:*/
	// var commandQuery = ["ALTER","SELECT","JOIN","FROM","WHERE"];

	// /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
	// autocomplete(document.getElementById("myInput"), commandQuery);

	</script>
</body>
</html>
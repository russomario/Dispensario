<?php

list($id, $prec, $prox, $end) = explode(',', $meds[$i]);

?>


<div class="row">
	<div class="col s10">
		<h5> <a class="btn-floating btn-large waves-effect waves-light red mybutton" href="/pilly/editMedicine.php?ID_MEDICINA=<?php echo $row["ID_MEDICINA"]?>	 "><i class="material-icons myicon">edit</i></a><?php echo " ".$row["ID_MEDICINA"] ?> <i class="material-icons mystatusicon"></i></h5>
		<div class="divider"></div>
	</div>
</div>
<div class="row">
	<div class="col s10">
		<div class="col s8">
			<?php 
				if($row["FOTO"]==NULL){
					?><img class="responsive-img" src="src/med.png" width="400px" height="400px"><?php
				}else{
					echo '<img class="responsive-img" src="data:image/jpeg;base64,' . base64_encode($row["FOTO"]) . '" width="400" height="400"/>'; 
				}
			?>
		</div>
		<div class="col s4">
			<h7><b>Prossima assunzione</b></h7>
			<div class="divider"></div>
			<p><?php echo $prox ?></p>
			
			<h7><b>Ultima assunzione</b></h7>
			<div class="divider"></div>
			<p><?php echo $prec ?></p>

			<h7><b>Quantit&agrave</b></h7>
			<div class="divider"></div>
			<p><?php echo $row["QUANTITY"] ?></p>

			<h7><b>Fine assunzione</b></h7>  
			<div class="divider"></div>
			<p><?php echo $end ?></p>

		</div>
	</div>
</div>
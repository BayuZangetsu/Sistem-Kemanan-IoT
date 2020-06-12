<table class="table table-responsive" id="tabelRfid">
	<thead>
		<tr>
			<th>No</th>
			<th>ID Kartu</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php $i =1;
	foreach($table as $t):?>
	<?php 
	if($t['status']=="Kartu Terdaftar"){
		$warna="red";
	}
	else{
		$warna="green";
	}
	
	?>
		<tr>
			<td><?=$i?></td>
			<td><?=$t['id_kartu']?></td>
			<td style="color:<?=$warna?>"><?=$t['status']?></td>
		</tr>
	<?php $i++;endforeach;?>
	</tbody>
</table>

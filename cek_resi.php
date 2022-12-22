<form method="post" action="#">
	<span>No Resi	:	</span><input type="text" placeholder="No resi..." max="30" name="waybill" autofocus>
	<select name="courier">
		<option value="sicepat">Sicepat Express</option>
		<option value="anteraja">Anteraja</option>
		<option value="pos">POS</option>
		<option value="wahana">Wahana Express</option>
		<option value="jnt">JNT Express</option>
		<option value="sap">SAP Express</option>
		<option value="jet">JET Express</option>
		<option value="ninja">Ninja Express</option>
	</select>
	<input type="submit" class="btn btn-success btn-submit" name="simpan" value="Cek Resi">
</form>


<hr>
<?php

@$waybill_post     = $_POST['waybill'];
@$courier_post		= $_POST['courier'];

@$waybill_get     	= $_GET['waybill'];
@$courier_get		= $_GET['courier'];

if($waybill_post!=""){
	$waybill = $waybill_post;
	$courier = $courier_post;
}else if ($waybill_get!=""){
	$waybill = $waybill_get;
	$courier = $courier_get;
}else{
	@$waybill=="";
	@$courier=="";
	
}

if(@$waybill==""){
	echo "
		<h4>Silahkan Masukkan Resi Yang Mau Di Cek ...</h4><br>

		
	";
}else{

function cekresi($courier,$waybill){
	$courierwaybill = 'courier='.$courier.'&waybill='.$waybill;
	$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://pro.rajaongkir.com/api/waybill',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $courierwaybill,
		  CURLOPT_HTTPHEADER => array(
			'key: 2d720xxxxxxxxxxxxxxxxxxxxxxxxxx',
			'Content-Type: application/x-www-form-urlencoded'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);

		return json_decode($response, true);

		}
	
	

	$result = cekresi($courier,$waybill);
		
		if(@$data	= $result['rajaongkir']['result']['summary']==""){
			echo "<table><tr><td>No Resi <b>".$waybill."</b> Tidak Ditemukan Diekspedisi <b>".$courier."</b></td></tr></table>";
		}else{
		@$data	= $result['rajaongkir']['result']['summary'];
		@$manifest	= $result['rajaongkir']['result']['manifest'];
		@$delivery_status	= $result['rajaongkir']['result']['delivery_status'];

?>

<table width=27%>
    <tr>
        <td>No Resi :</td>
        <td><?=$waybill;?></td>
        <td><?=$data['status'];?></td>
    </tr>
</table>


<table width=70%>

	<tr>	<td>Tanggal Kirim</td><td><?=$data['waybill_date'];?></td>	</tr>
	<tr>	<td>Penerima</td><td><?=$data['receiver_name'];?></td>	</tr>
	<tr>	<td>Asal Kota</td><td><?=$data['origin'];?></td>	</tr>
	<tr>	<td>Destinasi</td><td><?=$data['destination'];?></td>	</tr>
	<tr>	<td colspan=2>
			<?php
			echo @$delivery_status['pod_receiver']."<br>";
			echo @$delivery_status['pod_date']." | ".@$delivery_status['pod_time'];
			
			?>
		</td>
	</tr>
</table>



<br>
<br>
<table width=100%>
	<tr>
		<td>Detail Pengiriman Resi  </td><td colspan=2><b></b>: &nbsp;<?=$waybill;?></b></td>
	</tr>
	
	<tr>
		<td>Status</td>
		<td>Detail Status</td>
		<td>Tanggal</td>
	</tr>


<?php
	foreach (@$manifest as $outbond) {
		echo "<tr>";
			echo "<td>".@$outbond['manifest_date'] . " | ".$outbond['manifest_time']."</td>";
			echo "<td>". @$outbond['manifest_code']."</td>";
			echo "<td>". @$outbond['manifest_description']."</td>";
			echo "<td>". @$outbond['Citiname']."</td>";
		echo "</tr>";
		}
	}
}
	?>
</table>
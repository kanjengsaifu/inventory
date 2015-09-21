<script type="text/javascript">
$(function() {
	$("#dataTable tr:even").addClass("stripe1");
	$("#dataTable tr:odd").addClass("stripe2");
	$("#dataTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
</script>
<style type="text/css">
.stripe1 {
    background-color:#FBEC88;
}
.stripe2 {
    background-color:#FFF;
}
.highlight {
	-moz-box-shadow: 1px 1px 2px #fff inset;
	-webkit-box-shadow: 1px 1px 2px #fff inset;
	box-shadow: 1px 1px 2px #fff inset;		  
	border:             #aaa solid 1px;
	background-color: #fece2f;
}
</style>
<table id="dataTable" width="100%">
<tr>
        <th rowspan="2" style="text-align:right; font-size:10px">No</th>
        <th colspan="3" align="center" style="font-size:10px">Pelaksanaan</th>
        <th colspan="2" align="center" style="font-size:10px">Tanggal</th>
        <th colspan="2" align="center" style="font-size:10px">Glasir</th>
        <th rowspan="2" style="font-size:10px">Mesin</th>
        <th rowspan="2" style="font-size:10px">Diambil<br>dari</th>
        <th rowspan="2" style="font-size:10px">Batch</th>
        <th rowspan="2" style="font-size:10px">Volu<br>me</th>
        <th rowspan="2" style="font-size:10px">Den<br>sitas</th>
        <th rowspan="2" style="font-size:10px">Vis<br>cositas<br>/Boume</th>
        <th rowspan="2" style="font-size:10px">Berat <br> Kering <br>(Kg)</th>
        <th rowspan="2" style="font-size:10px">Ket.</th>
        <th rowspan="2" style="font-size:10px">Petugas<br>(Karu)</th>
        <th rowspan="2" style="font-size:10px">Petugas<br>(Supply)</th>
        <th rowspan="2" style="font-size:10px">Inputer</th>
        <th rowspan="2" style="font-size:10px">Aksi</th>
</tr>
<tr>
    <th style="font-size:10px">Tgl</th>
    <th style="font-size:10px">Jam</th>
    <th style="font-size:10px">Shift</th>
    <th style="font-size:10px">Produksi</th>
    <th style="font-size:10px">Tes Bakar</th>
    <th style="font-size:10px">Kode</th>
    <th style="font-size:10px">Nama</th>
</tr>
<?php
	if($data->num_rows()>0){
		$g_total=0;
                $b_total=0;
		$no =1;
                $bkg =0;
		foreach($data->result_array() as $db){
                $noprod = $db['no_prod'];
                $idglasir = $db['id_glasir'];
                $batch = $db['idthd'];
                //$new_status = $this->glzModel->NewStatus($noprod,$idglasir,$batch);
                //$count_status = $this->glzModel->CountStatus($noprod,$idglasir,$batch);
		$total = $db['volume'];
                $bkg = 1.565 *(($db['densitas']-1000)/1000) * $db['volume'];
		?>    
    	<tr>
            <td align="center" style="font-size:10px"><?php echo $no; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['tgl']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['jam']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['shift']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['tglp']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['tglb']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['id_glasir']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['nama_glasir']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['nama_bm']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['ddri']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['idthd']; ?></td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['volume']); ?> Ltr</td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['densitas']); ?> gr/L</td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['vsc'],2,'.', ''); ?> Pois</td>
            <td align="right" style="font-size:10px"><?php echo number_format($bkg,2,'.', ''); ?> Kg</td>
            <td align="center" style="font-size:10px"><?php echo $db['dsc']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['petugas3']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['petugas4']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['inputer']; ?></td>
            <td align="center" style="font-size:10px">
            <a href="<?php echo base_url();?>index.php/glasir_retu/editDetail/<?php echo $db['no_prod'];?>/<?php echo $db['id_glasir'];?>/<?php echo $db['idthd'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/glasir_retu/hapus_detail/<?php echo $db['no_prod'];?>/<?php echo $db['id_glasir'];?>/<?php echo $db['idthd'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
    </tr>
    <?php
		$no++;
		$g_total=$g_total+$total;
                $b_total=$b_total+$bkg;
		}
	}else{
		$g_total=0;
                $b_total=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<th colspan="8" align="center" style="font-size:10px">Total</th>
        <th style="text-align:right;font-size:10px"><?php echo number_format($g_total);?> Liter</th>
        <th colspan="2" style="text-align:right;font-size:10px"></th>
        <th style="text-align:right;font-size:10px"><?php echo number_format($b_total,2,'.', '');?> Kg</th>
</tr>    
</table>
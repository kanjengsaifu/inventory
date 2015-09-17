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
    <th style="font-size:10px">No</th>
    <th style="font-size:10px">Shift</th>
    <th style="font-size:10px">Tgl</th>
    <th style="font-size:10px">Jam</th>
    <th style="font-size:10px">Id. Glasir</th>
    <th style="font-size:10px">Nama Glasir</th>
    <th style="font-size:10px">Area</th>
    <th style="font-size:10px">Batch</th>
    <th style="font-size:10px">Viscositas</th>
    <th style="font-size:10px">Stok Opname</th>
    <th style="font-size:10px">Stok Sistem</th>
    <th style="font-size:10px">Selisih Stok</th>
    <th style="font-size:10px">Keterangan</th>
    <th style="font-size:10px">Kasie/Wasie(Prod)</th>
    <th style="font-size:10px">Inputer</th>
    <th style="font-size:10px">Aksi</th>
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
            <td align="center" style="font-size:10px"><?php echo $db['shift']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['tgl']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['jam']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['id_glasir']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['nama_glasir']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['area']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['idthd']; ?></td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['vsc'],2,'.', ''); ?> Pois</td>
            <td align="right" style="font-size:10px"><?php echo number_format($bkg,2,'.', ''); ?> Kg</td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['sts']); ?> Kg</td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['selisih'],2,'.', ''); ?> Kg</td>
            <td align="center" style="font-size:10px"><?php echo $db['dsc']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['petugas']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['inputer']; ?></td>
            <td align="center" style="font-size:10px">
            <a href="<?php echo base_url();?>index.php/glasir_opna/hapus_detailBgps/<?php echo $db['no_prod'];?>/<?php echo $db['id_glasir'];?>/<?php echo $db['idthd'];?>/<?php echo $db['volume'];?>/<?php echo $db['densitas'];?>"
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
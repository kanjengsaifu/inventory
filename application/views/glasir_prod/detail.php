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
    <th style="font-size:10px">Tgl</th>
    <th style="font-size:10px">Jam</th>
    <th style="font-size:10px">Shift</th>
    <th style="font-size:10px">Id. Glasir</th>
    <th style="font-size:10px">Nama Glasir</th>
    <th style="font-size:10px">Batch</th>
    <th style="font-size:10px">Volume</th>
    <th style="font-size:10px">Densitas</th>
    <th style="font-size:10px">Berat Kering (Kg)</th>
    <th style="font-size:10px">Mesin Ball Mill</th>
    <th style="font-size:10px">Keterangan</th>
    <th style="font-size:10px">PIC</th>
    <th style="font-size:10px">Inputer</th>
    <th style="font-size:10px">Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$g_total=0;
		$no =1;
		foreach($data->result_array() as $db){
                $noprod = $db['no_prod'];
                $idglasir = $db['id_glasir'];
                $batch = $db['idphd'];
                //$new_status = $this->glzModel->NewStatus($noprod,$idglasir,$batch);
                //$count_status = $this->glzModel->CountStatus($noprod,$idglasir,$batch);
		$total = 1.565*(($db['densitas']-1000)/1000)*$db['volume'];
                $bk = 1.565*(($db['densitas']-1000)/1000)*$db['volume'];
		?>    
    	<tr>
            <td align="center" width="20" style="font-size:10px"><?php echo $no; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['tgl']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['jam']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['nama']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['id_glasir']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['nama_glasir']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['idphd']; ?></td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['volume'],2,',','.'); ?> Liter</td>
            <td align="right" style="font-size:10px"><?php echo number_format($db['densitas'],2,',','.'); ?></td>
            <td align="right" style="font-size:10px"><?php echo number_format($bk,2,',','.'); ?> Kg</td>
            <td align="center" style="font-size:10px"><?php echo $db['nama_bm']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['dsc']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['petugas']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['inputer']; ?></td>
            <td align="center" style="font-size:10px">
            <a href="<?php echo base_url();?>index.php/glasir_prod/hapus_detail/<?php echo $db['no_prod'];?>/<?php echo $db['id_glasir'];?>/<?php echo $db['idphd'];?>/<?php echo $db['volume'];?>/<?php echo $db['densitas'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
    </tr>
    <?php
		$no++;
		$g_total=$g_total+$total;
		}
	}else{
		$g_total=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<th colspan="6" align="center">Total</th>
        <th style="text-align:right"><?php echo number_format($g_total,2,'.',',');?> Kg</th>
</tr>    
</table>
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
    <th>No</th>
    <th>No. Produksi</th>
    <th>Id. Glasir</th>
    <th>Status Glasir</th>
    <th>Volume (ltr)</th>
    <th>Densitas</th>
    <th>Ball Mill</th>
    <th>Tong</th>
    <th>Petugas</th>
    <th>Inputer</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$g_total=0;
		$no =1;
		foreach($data->result_array() as $db){  
		$total = $db['volume'];
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['no_prod']; ?></td>
            <td align="center" width="100" ><?php echo $db['id_glasir']; ?></td>
            <td align="center" width="100" ><?php echo $db['nama_gps']; ?></td>
            <td align="right" width="100" ><?php echo number_format($db['volume']); ?></td>
            <td align="right" width="100" ><?php echo number_format($db['densitas']); ?></td>
            <td align="center" width="100" ><?php echo $db['nama_bm']; ?></td>
            <td align="center" width="100" ><?php echo $db['nama_tong']; ?></td>
            <td align="center" width="100" ><?php echo $db['petugas']; ?></td>
            <td align="center" width="100" ><?php echo $db['inputer']; ?></td>
            <td align="center" width="80">
            <a href="<?php echo base_url();?>index.php/glasir_prod/hapus_detail/<?php echo $db['no_prod'];?>/<?php echo $db['id_glasir'];?>"
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
	<th colspan="4" align="center">Total</th>
        <th style="text-align:right"><?php echo number_format($g_total);?></th>
</tr>    
</table>
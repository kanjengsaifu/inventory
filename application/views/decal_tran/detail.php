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
        <th colspan="7" align="center" style="font-size:10px">Decal</th>
        <th rowspan="2" style="font-size:10px">Batch</th>
        <th rowspan="2" style="font-size:10px">KW 1</th>
        <th rowspan="2" style="font-size:10px">KW 2</th>
        <th rowspan="2" style="font-size:10px">KW 3</th>
        <th rowspan="2" style="font-size:10px">No. Po</th>
        <th colspan="3" align="center" style="font-size:10px">Petugas Pelaksana</th>
        <th rowspan="2" style="font-size:10px">Aksi</th>
</tr>
<tr>
    <th style="font-size:10px">Tanggal</th>
    <th style="font-size:10px">Jam</th>
    <th style="font-size:10px">Shift</th>
    <th style="font-size:10px">Kode</th>
    <th style="font-size:10px">Nama</th>
    <th style="font-size:10px">Jenis</th>
    <th style="font-size:10px">Kertas</th>
    <th style="font-size:10px">Ukuran</th>
    <th style="font-size:10px">Warna</th>
    <th style="font-size:10px">Komposisi</th>
    <th style="font-size:10px">P. Decal</th>
    <th style="font-size:10px">P. Glaze</th>
    <th style="font-size:10px">Inputer</th>
</tr>
<?php
	if($data->num_rows()>0){
		$g_total1=0;
                $g_total2=0;
                $g_total3=0;
		$no =1;
		foreach($data->result_array() as $db){
                //$noprod = $db['id_related'];
                //$id_decal_items = $db['id_decal_items'];
                //$batch = $db['batch'];
                //$new_status = $this->glzModel->NewStatus($noprod,$idglasir,$batch);
                //$count_status = $this->glzModel->CountStatus($noprod,$idglasir,$batch);
		$total1 = $db['kw1'];
                $total2 = $db['kw2'];
                $total3 = $db['kw3'];
		?>    
    	<tr>
            <td align="center" width="20" style="font-size:10px"><?php echo $no; ?></td>
            <td align="center" style="font-size:10px"><?php echo $this->dclModel->tgl_indo($db['tgli']); ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['jam']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['shift']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['id_decal_items']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['nama']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['jenis']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['size_kertas']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['size_kat']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['warna']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['komposisi']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['batch']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['kw1']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['kw2']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['kw3']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['no_po']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['petugas']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['penerima']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['inputer']; ?></td>
            <td align="center" style="font-size:10px">
            <a href="<?php echo base_url();?>index.php/decal_tran/editDetail/<?php echo $db['id_related'];?>/<?php echo $db['id_decal_items'];?>/<?php echo $db['batch'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/decal_tran/hapus_detail/<?php echo $db['id_related'];?>/<?php echo $db['id_decal_items'];?>/<?php echo $db['batch'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
    </tr>
    <?php
		$no++;
		$g_total1=$g_total1+$total1;
                $g_total2=$g_total2+$total2;
                $g_total3=$g_total3+$total3;
		}
	}else{
		$g_total1=0;
                $g_total2=0;
                $g_total3=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<th colspan="12" align="center">Total</th>
        <th style="text-align:right; font-size: 10px"><?php echo number_format($g_total1,0,'.',',');?> Pcs</th>
        <th style="text-align:right; font-size: 10px"><?php echo number_format($g_total2,0,'.',',');?> Pcs</th>
        <th style="text-align:right; font-size: 10px"><?php echo number_format($g_total3,0,'.',',');?> Pcs</th>
        <th colspan="6" style="text-align:left; font-size: 13px">Grand Total [KW1+KW2+KW3]: <?php echo number_format($g_total3+$g_total1+$g_total2,0,'.',',');?> Pcs</th>
</tr>    
</table>
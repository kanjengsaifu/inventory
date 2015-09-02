<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/glasir_prod/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>index.php/glasir_prod">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/glasir_prod">
Tanggal <input type="text" name="cari_tgl" id="cari_tgl" size="15" />
Cari No. Produksi/No. Order : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
    <th>No</th>
    <th>No. Transaksi</th>
    <th>Tanggal Input</th>
    <th>Banyak Transaksi Input</th>
    <th>Jumlah Produksi Glasir di Ball Mill</th>
    <th>Inputer</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
                $g_total=0;
                $p_total=0;
		foreach($data->result_array() as $db){  
		$tgl_plng = $this->glzModel->tgl_indo($db['tgl_inp']);
		$nama_lengkap = $this->glzModel->NamaLengkap($db['inputer']);
		$proses = $this->glzModel->ProsesGlasir($db['no_prod']);
		$jml = $this->glzModel->JmlGlasir($db['no_prod']);
                $p_total = $p_total + $proses;
                $g_total = $g_total + $jml;
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['no_prod']; ?></td>
            <td align="center"><?php echo $tgl_plng; ?></td>
            <td align="right" width="200"><?php echo $proses; ?></td>
            <td align="right"><?php echo number_format($jml,2,',','.'); ?> Kilogram</td>
            <td align="center"><?php echo $nama_lengkap; ?></td>
            <td align="center" width="80">
            <?php
			if($this->session->userdata('level')=='01'){
			?>
            <a href="<?php echo base_url();?>index.php/glasir_prod/edit/<?php echo $db['no_prod'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/glasir_prod/hapus/<?php echo $db['no_prod'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            <?php } ?>
            </td>
    </tr>
    <?php
		$no++;
		}
                ?>
                <th colspan="3" align="right">Total</th>
                <th style="text-align:right"><?php echo number_format($p_total);?></th>
                <th style="text-align:right"><?php echo number_format($g_total,2,'.',',');?> Kilogram</th>
    <?php
	}else{
                $g_total=0;
                $p_total=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
        <tr>
	<th colspan="3" align="right">Total</th>
        <th style="text-align:right"><?php echo number_format($p_total);?></th>
        <th style="text-align:right"><?php echo number_format($g_total);?> Kilogram</th>
    </tr>
    <?php	
	}
?>
    
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/prod_glasir/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>index.php/prod_glasir">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/prod_glasir">
Tanggal <input type="text" name="cari_tgl" id="cari_tgl" size="15" />
Cari Kode Beli & Kode Supplier : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
    <th>No</th>
    <th>No. Produksi</th>
    <th>Tanggal Planning</th>
    <th>No. Order</th>
    <th>Banyak Order</th>
    <th>Jumlah Glasir</th>
    <th>Inputer</th>
    <th>Waktu Input</th>
    <th>Update Terakhir</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		$tgl_plng = $this->app_model->tgl_indo($db['tgl_plng']);
		$nama_lengkap = $this->app_model->NamaLengkap($db['inputer']);
		$proses = $this->app_model->ProsesGlasir($db['no_prod']);
		$jml = $this->app_model->JmlGlasir($db['no_prod']);
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['no_prod']; ?></td>
            <td align="center" width="130" ><?php echo $tgl_plng; ?></td>
            <td align="center" width="100" ><?php echo $db['no_po']; ?></td>
            <td align="right"><?php echo $proses; ?></td>
            <td align="right"><?php echo $jml; ?> Liter</td>
            <td align="center"><?php echo $nama_lengkap; ?></td>
            <td align="center" width="130" ><?php echo $db['tgl_inp']; ?></td>
            <td align="center" width="130" ><?php echo $db['lst_upd']; ?></td>
            <td align="center" width="80">
            <?php
			if($this->session->userdata('level')=='01'){
			?>
            <a href="<?php echo base_url();?>index.php/prod_glasir/edit/<?php echo $db['no_prod'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/prod_glasir/hapus/<?php echo $db['no_prod'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            <?php } ?>
            </td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
</div>
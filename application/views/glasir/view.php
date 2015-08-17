<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/glasir/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>index.php/glasir">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/glasir">
Cari Kode & Nama Glasir : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
    <th>No</th>
    <th>Kode Glasir</th>
    <th>Nama Glasir</th>
    <th>Nama Alias Glasir</th>
    <th>Stok Awal</th>
    <th>Satuan</th>
    <th>Inputer</th>
    <th>Status</th>
    <th>Tgl Input</th>
    <th>Update Terakhir</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){ 
		$status = $this->app_model->CariGlasirStatus($db['status']); 
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $db['id_glasir']; ?></td>
            <td ><?php echo $db['nama_glasir']; ?></td>
            <td ><?php echo $db['nama_alias']; ?></td>
             <td align="center" width="80" ><?php echo $db['stok_awal']; ?></td>
            <td align="center" width="50" ><?php echo $db['satuan']; ?></td>
            <td align="center" width="60" ><?php echo $db['inputer']; ?></td>
            <td align="center" width="60" ><?php echo $status; ?></td>
            <td align="center" width="120" ><?php echo $db['tgl_input']; ?></td>
            <td align="center" width="120" ><?php echo $db['tgl_update']; ?></td>
            <td align="center" width="60">
            <a href="<?php echo base_url();?>index.php/glasir/edit/<?php echo $db['id_glasir'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/glasir/hapus/<?php echo $db['id_glasir'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
</div>
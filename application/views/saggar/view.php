<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/saggar/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>index.php/saggar">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/saggar">
Cari Kode & Nama Saggar : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
    <th>No</th>
    <th>Kode Saggar</th>
    <th>Nama Saggar</th>
    <th>Nama Alias Saggar</th>
    <th>Posisi Stok</th>
    <th>Stok</th>
    <th>Satuan</th>
    <th>User Input</th>
    <th>Status</th>
    <th>Tgl Input</th>
    <th>Update Terakhir</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){ 
		$status = $this->sgrmodel->CariSaggarStatus($db['status']); 
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $db['id_saggar']; ?></td>
            <td ><?php echo $db['nama_saggar']; ?></td>
            <td ><?php echo $db['nama_alias']; ?></td>
             <td align="center" width="80" ><?php echo $db['stok_awal']; ?></td>
            <td align="center" width="50" ><?php echo $db['satuan']; ?></td>
            <td align="center" width="60" ><?php echo $db['user_input']; ?></td>
            <td align="center" width="60" ><?php echo $status; ?></td>
            <td align="center" width="120" ><?php echo $db['tgl_input']; ?></td>
            <td align="center" width="120" ><?php echo $db['tgl_update']; ?></td>
            <td align="center" width="60">
            <a href="<?php echo base_url();?>index.php/saggar/edit/<?php echo $db['id_saggar'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/saggar/hapus/<?php echo $db['id_saggar'];?>"
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
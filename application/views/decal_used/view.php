<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/decal_used/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah</button>
</a>
<a href="<?php echo base_url();?>index.php/decal_used">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/decal_used">
Tanggal <input type="text" name="cari_tgl" id="cari_tgl" size="15" />
Transaksi/Kode/Nama/Inputer : <input type="text" name="txt_cari" id="txt_cari" size="15" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
        <th rowspan="2" style="text-align:right; font-size:10px">No</th>
        <th rowspan="2" style="font-size:10px">No.  <br> Transaksi</th>
        <th rowspan="2" style="font-size:10px">Tanggal  <br> Input</th>
        <th rowspan="2" style="font-size:10px">Input <br> Transaksi</th>
        <th colspan="3" align="center" style="font-size:10px">Produksi</th>
        <th rowspan="2" style="font-size:10px">Inputer</th>
        <th rowspan="2" style="font-size:10px">Aksi</th>
</tr>
<tr>
    <th style="font-size:10px">Jumlah Pieces</th>
    <th style="font-size:10px">Jumlah Pieces Rusak</th>
    <th style="font-size:10px">List Design</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
                $g_total1=0;
                $g_total2=0;
                //$g_total3=0;
                //$g_total4=0;
                $p_total=0;
		foreach($data->result_array() as $db){  
		$tgl_input = $this->dclModel->tgl_indo($db['tgl_input']);
		$nama_lengkap = $this->dclModel->NamaLengkap($db['inputer']);
		$proses = $this->dclModel->ProsesDecalUsed($db['id_related']);
                $prosesItem = $this->dclModel->ProsesItemUsed($db['id_related']);
		$jml1 = $this->dclModel->JmlUsedJML($db['id_related']);
                $jml2 = $this->dclModel->JmlUsedRusak($db['id_related']);
                $p_total = $p_total + $proses;
                $g_total1 = $g_total1 + $jml1;
                $g_total2 = $g_total2 + $jml2;
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center"><?php echo $db['id_related']; ?></td>
            <td align="center"><?php echo $tgl_input; ?></td>
            <td align="right"><?php echo $proses; ?></td>
            <td align="right"><?php echo number_format($jml1,0,',','.'); ?> Pcs</td>
            <td align="right"><?php echo number_format($jml2,0,',','.'); ?> Pcs</td>
            <td align="left"><?php echo $prosesItem; ?></td>
            <td align="center"><?php echo $nama_lengkap; ?></td>
            <td align="center" width="80">
            <?php
			if($this->session->userdata('level')=='01'){
			?>
            <a href="<?php echo base_url();?>index.php/decal_used/edit/<?php echo $db['id_related'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/decal_used/hapus/<?php echo $db['id_related'];?>"
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
                <th style="text-align:right"><?php echo number_format($g_total1,0,',','.');?> Pcs</th>
                <th style="text-align:right"><?php echo number_format($g_total2,0,',','.');?> Pcs</th>
    <?php
	}else{
                $g_total1=0;
                $g_total2=0;
                //$g_total3=0;
                //$g_total4=0;
                $p_total=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
        <tr>
	<th colspan="3" align="right">Total</th>
        <th style="text-align:right"><?php echo number_format($p_total);?></th>
        <th style="text-align:right"><?php echo number_format($g_total1);?> Pcs</th>
        <th style="text-align:right"><?php echo number_format($g_total2);?> Pcs</th>
    </tr>
    <?php	
	}
?>
    
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
</div>
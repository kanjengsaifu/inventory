<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/glasir_opna/tambahBgps">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">BGPS Glasir</button>
</a>
<a href="<?php echo base_url();?>index.php/glasir_opna/tambahSply">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Supply Glasir</button>
</a>
<a href="<?php echo base_url();?>index.php/glasir_opna">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/glasir_opna">
Tanggal <input type="text" name="cari_tgl" id="cari_tgl" size="15" />
Cari No. Transaksi/Inputer : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
    <th>No</th>
    <th>No. Transaksi</th>
    <th>Tanggal Input</th>
    <th>Transaksi BGPS</th>
    <th>Selisih BGPS</th>
    <th>Aksi</th>
    <th>Transaksi Supply</th>
    <th>Selisih Supply</th>
    <th>Inputer</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
                $g_totalBgps=0;
                $p_totalBgps=0;
                $g_totalSply=0;
                $p_totalSply=0;
		foreach($data->result_array() as $db){  
		$tgl = $this->glzModel->tgl_indo($db['tgl_inp']);
		$nama_lengkap = $this->glzModel->NamaLengkap($db['inputer']);
		$prosesBgps = $this->glzModel->ProsesGlasirOpnaBgps($db['no_prod']);
		$jmlBgps = $this->glzModel->JmlGlasirOpnaBgps($db['no_prod']);
                $p_totalBgps = $p_totalBgps + $prosesBgps;
                $g_totalBgps = $g_totalBgps + $jmlBgps;
                $prosesSply = $this->glzModel->ProsesGlasirOpnaSply($db['no_prod']);
		$jmlSply = $this->glzModel->JmlGlasirOpnaSply($db['no_prod']);
                $p_totalSply = $p_totalSply + $prosesSply;
                $g_totalSply = $g_totalSply + $jmlSply;
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" ><?php echo $db['no_prod']; ?></td>
            <td align="center"><?php echo $tgl; ?></td>
            <td align="right" ><?php echo $prosesBgps; ?></td>
            <td align="right"><?php echo number_format($jmlBgps,2,',','.'); ?> Kilogram</td>
            <td align="center">
            <?php
			if($this->session->userdata('level')=='01'){
			?>
                        <?php
			if($prosesBgps>0){
			?>
            <a href="<?php echo base_url();?>index.php/glasir_opna/editBgps/<?php echo $db['no_prod'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
                        <?php } ?>
            <?php } ?>
            </td>
            <td align="right" ><?php echo $prosesSply; ?></td>
            <td align="right"><?php echo number_format($jmlSply,2,',','.'); ?> Kilogram</td>
            <td align="center"><?php echo $nama_lengkap; ?></td>
            <td align="center">
            <?php
			if($this->session->userdata('level')=='01'){
			?>
                        <?php
			if($prosesSply>0){
			?>
            <a href="<?php echo base_url();?>index.php/glasir_opna/editSply/<?php echo $db['no_prod'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
                        <?php } ?>
            <a href="<?php echo base_url();?>index.php/glasir_opna/hapus/<?php echo $db['no_prod'];?>"
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
                <th style="text-align:right"><?php echo number_format($p_totalBgps);?></th>
                <th style="text-align:right"><?php echo number_format($g_totalBgps,2,',','.');?> Kilogram</th>
                <th style="text-align:right"></th>
                <th style="text-align:right"><?php echo number_format($p_totalSply);?></th>
                <th style="text-align:right"><?php echo number_format($g_totalSply,2,',','.');?> Kilogram</th>
    <?php
	}else{
                $g_totalBgps=0;
                $p_totalBgps=0;
                $g_totalSply=0;
                $p_totalSply=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
        <tr>
	<th colspan="3" align="right">Total</th>
        <th style="text-align:right"><?php echo number_format($p_totalBgps);?></th>
        <th style="text-align:right"><?php echo number_format($g_totalBgps,2,',','.');?> Liter</th>
        <th style="text-align:right"></th>
        <th style="text-align:right"><?php echo number_format($p_totalSply);?></th>
        <th style="text-align:right"><?php echo number_format($g_totalSply,2,',','.');?> Liter</th>
    </tr>
    <?php	
	}
?>
    
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
</div>
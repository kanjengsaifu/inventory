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
    background-color:#ffffff;
}
.stripe2 {
    background-color:#ccffff;
}
.highlight {
	-moz-box-shadow: 1px 1px 2px #fff inset;
	-webkit-box-shadow: 1px 1px 2px #fff inset;
	box-shadow: 1px 1px 2px #fff inset;		  
	border:             #aaa solid 1px;
	background-color: #00b2b3;
}
</style>
<table id="dataTable" width="100%">
<tr>
        <th rowspan="2" style="text-align:right; font-size:10px">No</th>
        <th colspan="3" align="center" style="font-size:10px">Pelaksanaan</th>
        <th colspan="5" align="center" style="font-size:10px">Desain</th>
        <th rowspan="2" style="font-size:10px">Batch</th>
        <th rowspan="2" style="font-size:10px">Jumlah</th>
        <th rowspan="2" style="font-size:10px">Rusak</th>
        <th rowspan="2" style="font-size:10px">Mesin</th>
        <th rowspan="2" style="font-size:10px">Disimpan</th>
        <th rowspan="2" style="font-size:10px">PIC</th>
        <th rowspan="2" style="font-size:10px">Inputer</th>
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
    <th style="font-size:10px">Isi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$g_total1=0;
                $g_total2=0;
		$no =1;
		foreach($data->result_array() as $db){
                $namaDesain = $this->dclModel->namaDesain($db['parent_id']);
                $jenisDesain = $this->dclModel->jenisDesain($db['parent_id']);
                $kertas = $this->dclModel->kertas($db['parent_id']);
		$total1 = $db['jml'];
                $total2 = $db['rusak'];
		?>    
    	<tr>
            <td align="center" width="20" style="font-size:11px; font-weight: bold;"><?php echo $no; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $this->dclModel->tgl_indo($db['tgli']); ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $db['jam']; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $db['shift']; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $db['parent_id']; ?></td>
            <td style="font-size:11px; font-weight: bold;"><?php echo $namaDesain; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $jenisDesain; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $kertas; ?></td>
            <td align="right" style="font-size:11px; font-weight: bold;"><?php echo $db['isi_motif']; ?> pcs</td>
            <td align="right" style="font-size:11px; font-weight: bold;"><?php echo $db['id_group']; ?></td>
            <td align="right" style="font-size:11px; font-weight: bold;"></td>
            <td align="right" style="font-size:11px; font-weight: bold;"></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $db['id_bm']; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $db['id_bm']; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $db['petugas']; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;"><?php echo $db['inputer']; ?></td>
            <td align="center" style="font-size:11px; font-weight: bold;">
            <a href="<?php echo base_url();?>index.php/decal_tran/editDetail/<?php echo $db['id_related'];?>/<?php echo $db['parent_id'];?>/<?php echo $db['id_group'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/decal_tran/hapus_detail/<?php echo $db['id_related'];?>/<?php echo $db['parent_id'];?>/<?php echo $db['id_group'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
                <?php
                    foreach($dataDetail->result_array() as $dx){
                        if($db['id_group'] == $dx['id_group']){
                    ?>
                <tr>                                                                                
                            <td colspan="4" align="center" style="font-size:10px">-------------------------</td>
                            <td align="center" style="font-size:10px"><?php echo $dx['item_code']; ?></td>
                            <td style="font-size:10px"><?php echo $dx['item']; ?></td>
                            <td colspan="2" align="center" style="font-size:10px">---------------</td>
                            <td align="right" style="font-size:10px"><?php echo $dx['isi_motif']; ?> pcs</td>
                            <td align="right" style="font-size:10px"><?php echo $dx['id']; ?></td>
                            <td align="right" style="font-size:10px"><?php echo $dx['jml']; ?> pcs</td>
                            <td align="right" style="font-size:10px"><?php echo $dx['rusak']; ?> pcs</td>
                            <td colspan="2" align="center" style="font-size:10px">-------------</td>
                            <td align="center" style="font-size:10px"><?php echo $dx['petugas']; ?></td>
                            <td align="center" style="font-size:10px"><?php echo $dx['inputer']; ?></td>
                            <td align="center" style="font-size:10px">
                            <a href="<?php echo base_url();?>index.php/decal_tran/editItem/<?php echo $db['id_related'];?>/<?php echo $dx['parent_id'];?>/<?php echo $dx['id_group'];?>/<?php echo $dx['item_code'];?>/<?php echo $dx['id'];?>">
                                        <img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
                                        </a>
                            </td>
                </tr>        
                <?php
                        }
                        else{
                            
                        }
                    }
                    ?>
    </tr>
    <?php
		$no++;
		$g_total1=$g_total1+$total1;
                $g_total2=$g_total2+$total2;
		}
	}else{
		$g_total1=0;
                $g_total2=0;
	?>
    	<tr>
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
<tr>
	<th colspan="10" align="center">Grand Total</th>
        <th style="text-align:right; font-size: 10px"><?php echo number_format($g_total1,0,'.',',');?> Pcs</th>
        <th style="text-align:right; font-size: 10px"><?php echo number_format($g_total2,0,'.',',');?> Pcs</th>
        <th colspan="6" style="text-align:left; font-size: 13px">[KW 1: <?php echo number_format($g_total1-$g_total2,0,'.',',');?> Pcs]-[KW 2: <?php echo number_format($g_total2,0,'.',',');?> Pcs]</th>
</tr>    
</table>
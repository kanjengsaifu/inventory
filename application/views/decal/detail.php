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
    background-color:#cccccc;
}
.stripe2 {
    background-color:#ffffff;
}
.highlight {
	-moz-box-shadow: 1px 1px 2px #fff inset;
	-webkit-box-shadow: 1px 1px 2px #fff inset;
	box-shadow: 1px 1px 2px #fff inset;		  
	border:             #aaa solid 1px;
	background-color: #84909c;
}
</style>
<table id="dataTable" width="100%">
<tr>
    <th style="font-size:10px">No</th>
    <th style="font-size:10px">Batch</th>
    <th style="font-size:10px">Kode Induk</th>
    <th style="font-size:10px">Urutan Posisi</th>
    <th style="font-size:10px">Nama Item</th>
    <th style="font-size:10px">Isi Motif</th>
    <th style="font-size:10px">Banyak Warna</th>
    <th style="font-size:10px">Inputer</th>
    <th style="font-size:10px">Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
                $no =1;
		foreach($data->result_array() as $db){
		?>    
    	<tr>
            <td align="center" width="20" style="font-size:10px"><?php echo $no; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['item_code']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['parent_id']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['position']; ?></td>
            <td style="font-size:10px"><?php echo $db['item']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['isi_motif']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['warna']; ?></td>
            <td align="center" style="font-size:10px"><?php echo $db['inputer']; ?></td>
            <td align="center" style="font-size:10px">
            <a href="<?php echo base_url();?>index.php/decal/editDetail/<?php echo $db['parent_id'];?>/<?php echo $db['item_code'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/decal/hapus_detail/<?php echo $db['parent_id'];?>/<?php echo $db['item_code'];?>"
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
        	<td colspan="8" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>   
</table>
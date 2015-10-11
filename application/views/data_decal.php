<script type="text/javascript">
$(function() {
	$("#dataTable.detail tr:even").addClass("stripe1");
	$("#dataTable.detail tr:odd").addClass("stripe2");
	$("#dataTable.detail tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});

function pilih(id){
	$("#dlg").dialog('close');
	$("#id_decal_items").val(id);
	$("#id_decal_items").focus();
	
}
</script>
<table id="dataTable" class="detail" width="100%">
<tr>
    <th>No</th>
    <th>Kode Decal</th>
    <th>Nama Decal</th>
    <th>Nama Alias Decal</th>
    <th>Satuan</th>
    <th>Jenis</th>
    <th>Group</th>
    <th>Ambil</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db){ 
		$jenis = $this->dclModel->CariDecalJenis($db['jenis']); 
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $db['id']; ?></td>
            <td ><?php echo $db['nama']; ?></td>
            <td ><?php echo $db['alias']; ?></td>
            <td align="center" width="50" ><?php echo $db['satuan']; ?></td>
            <td align="center" width="60" ><?php echo $jenis; ?></td>
            <td align="center" width="60" ><?php echo $db['parent']; ?></td>
            <td align="center" width="80">
            <a href="javascript:pilih('<?php echo $db['id'];?>')" >
        	<img src="<?php echo base_url();?>asset/images/add.png" title='Ambil'>
        	</a>
            </td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="7" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
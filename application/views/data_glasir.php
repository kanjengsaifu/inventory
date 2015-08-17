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
	$("#id_glasir").val(id);
	$("#id_glasir").focus();
	
}
</script>
<table id="dataTable" class="detail" width="100%">
<tr>
    <th>No</th>
    <th>Kode Glasir</th>
    <th>Nama Glasir</th>
    <th>Nama Alias Glasir</th>
    <th>Stok Awal</th>
    <th>Satuan</th>
    <th>Inputer</th>
    <th>Status</th>
    <th>Ambil</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
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
            <td align="center" width="80">
            <a href="javascript:pilih('<?php echo $db['id_glasir'];?>')" >
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
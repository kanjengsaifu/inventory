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
        <th rowspan="2" style="text-align:right; font-size:10px;">No</th>
        <th colspan="2" style="" align="center" style="font-size:10px">Kode Glaze</th>
        <th colspan="2" align="center" style="font-size:10px">Nama Glaze</th>
        <th rowspan="2" style="font-size:10px">Nama Alias Glaze</th>
        <th rowspan="2" style="font-size:10px">Satuan</th>
        <th rowspan="2" style="font-size:10px">Inputer</th>
        <th rowspan="2" style="font-size:10px">Status</th>
        <th rowspan="2" style="font-size:10px">Ambil</th>
</tr>    
<tr>
    <th>Turunan</th>
    <th>Induk</th>
    <th>Induk</th>
    <th>Turunan</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db){ 
		$status = $this->glzModel->CariGlasirStatus($db['status']); 
                $parent = $this->glzModel->CariParentName($db['parent']); 
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $db['id_glasir']; ?></td>
            <td align="center" width="80" ><?php echo $db['parent']; ?></td>
            <td ><?php echo $parent; ?></td>
            <td ><?php echo $db['nama_glasir']; ?></td>
            <td ><?php echo $db['nama_alias']; ?></td>
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
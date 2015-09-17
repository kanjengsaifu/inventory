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

function pilih(tglp,tglb){
	$("#dlgp").dialog('close');
	$("#tglp").val(tglp);
        $("#tglb").val(tglb);
	//$("#tglp").focus();
	
}
</script>
<table id="dataTable" class="detail" width="100%">
<tr>
    <th>No</th>
    <th>No Produksi</th>
    <th>Kode Glasir</th>
    <th>Nama Glasir</th>
    <th>Tgl. Produksi</th>
    <th>Tgl. Lulus Tes bakar</th>
    <th>Inputer</th>
    <th>Ambil</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db){ 
		$nama_glasir = $this->glzModel->CariGlasirTglp($db['id_glasir']); 
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center"><?php echo $db['id_glasir']; ?></td>
            <td align="center"><?php echo $db['no_prod']; ?></td>
            <td align="left"><?php echo $nama_glasir; ?></td>
            <td align="center"><?php echo $this->glzModel->tgl_indo($db['tglp']); ?></td>
            <td align="center"><?php echo $this->glzModel->tgl_indo($db['tglb']); ?></td>
            <td align="center"><?php echo $db['inputer']; ?></td>
            <td align="center" width="80">
            <a href="javascript:pilih('<?php echo $this->glzModel->tgl_str($db['tglp']);?>','<?php echo $this->glzModel->tgl_str($db['tglb']);?>')" >
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
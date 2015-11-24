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
	$("#parent_id").val(id);
	$("#parent_id").focus();
	
}
</script>
<table id="dataTable" class="detail" width="100%">
<tr>
    <th>No</th>
    <th>Kode <br> Desain</th>
    <th>Nama <br> Desain</th>
    <th>Nama <br> Alias Desain</th>
    <th>Nama <br> Buyer</th>
    <th>Satuan</th>
    <th>Jenis</th>
    <th>Ukuran</th>
    <th>Dekorasi</th>
    <th>Ambil</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db){ 
		$jenis = $this->dclModel->CariDecalJenis($db['jenis']); 
		?>    
    	<tr>
            <td style="font-weight: bold" align="center" width="20"><?php echo $no; ?></td>
            <td style="font-weight: bold" align="center"><?php echo $db['id']; ?></td>
            <td style="font-weight: bold" ><?php echo $db['nama']; ?></td>
            <td style="font-weight: bold" ><?php echo $db['alias']; ?></td>
            <td style="font-weight: bold" ><?php echo $db['buyer']; ?></td>
            <td style="font-weight: bold" align="center"><?php echo $db['satuan']; ?></td>
            <td style="font-weight: bold" align="center"><?php echo $jenis; ?></td>
            <td style="font-weight: bold" ><?php echo $db['size']; ?></td>
            <td style="font-weight: bold" ><?php echo $db['dekorasi']; ?></td>
            <td style="font-weight: bold" align="center">
            <a href="javascript:pilih('<?php echo $db['id'];?>')" >
        	<img src="<?php echo base_url();?>asset/images/add.png" title='Ambil'>
        	</a>
            </td>
            <?php
                    foreach($item->result_array() as $dx){
                        if($db['id'] == $dx['parent_id']){
                    ?>
                <tr>          
                            <td colspan="1" align="center" style="font-size:10px">----</td>
                            <td align="center" style="font-size:10px"><?php echo $dx['item_code']; ?></td>
                            <td style="font-size:10px"><?php echo $dx['item']; ?> = <?php echo $dx['isi_motif']; ?> pcs</td>
                            <td colspan="7" align="center" style="font-size:10px"></td>
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
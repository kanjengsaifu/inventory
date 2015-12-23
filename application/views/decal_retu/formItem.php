<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
	tampil_data();
	
	function tampil_data(){
		var kode = $("#id").val();
		//alert(kode);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/decal_retu/DataDetail",
			data	: "kode="+kode,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
		//return false();
	}
	        
        $("#tgli").datepicker({
			dateFormat:"dd-mm-yy"
            });
	
	$("#parent_id").focus();
	$("#parent_id").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	$("#parent_id").focus(function(e){
		var isi = $(e.target).val();
		CariDecal();
	});
	
	$("#parent_id").keyup(function(){
		CariDecal();
		
	});
	
	function CariDecal(){
		var kode = $("#parent_id").val();
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/ref_json/InfoDecal",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nama_decal").val(data.nama_decal);
			}
		});
	};
	
	$("#simpan").click(function(){
		var string = $("#form").serialize();
		
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/decal_retu/simpanItem",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data, 
					timeout:2000,
					showType:'slide'
				});
				tampil_data();
			},
			error : function(xhr, teksStatus, kesalahan) {
				$.messager.show({
					title:'Info',
					msg: 'Server tidak merespon :'+kesalahan,
					timeout:2000,
					showType:'slide'
				});
			}
		});
		return false();		
	});
	
	$("#tambah_data").click(function(){
		$(".detail").val('');
		$("#parent_id").val('');
                $("#petugas").val('');
                $("#nama_decal").val('');
                $("#tgli").val('');
                $("#jam").val('');
                $("#shift").val('1');
                $("#id_bm").val('1');
                $("#id_bmt").val('1');
                $("#jml").val(0);
		$("#parent_id").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/decal_retu/cetak/'+kode);
		return false();
	});
	
	$("#cari_barang").click(function(){
		AmbilDaftarDecal();
		$("#dlg").dialog('open');
	});
	
	$("#text_cari").keyup(function(){
		AmbilDaftarDecal();
		//$("#dlg").dialog('open');
	});
	
	function AmbilDaftarDecal(){
		var cari = $("#text_cari").val();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/DataDecal",
			data	: "cari="+cari,
			cache	: false,
			success	: function(data){
				$("#daftar_decal").html(data);
			}
		});
	}
});	
</script>
<form name="form" id="form">
<table width="100%">
<tr>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
    <tr>    
        <td width="150">No. Transaksi</td>
        <td width="5">:</td>
        <td><input type="text" name="id" id="id" size="45" maxlength="12" readonly="readonly" value="<?php echo $id;?>" /></td>
    </tr>
    <tr>    
        <td width="150">No. Group</td>
        <td width="5">:</td>
        <td><input type="text" name="id_group" id="id_group" size="45" maxlength="12" readonly="readonly" value="<?php echo $id_group;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Kode Desain</td>
        <td width="5">:</td>
        <td><input type="text" name="parent_id" id="parent_id" size="45" maxlength="12" readonly="readonly" value="<?php echo $parent_id;?>" /></td>
    </tr>
    <tr>    
        <td width="150">No. Batch</td>
        <td width="5">:</td>
        <td><input type="text" name="batch" id="batch" size="45" maxlength="12" readonly="readonly" value="<?php echo $batch;?>" /></td>
    </tr>
    </table>
    </fieldset>
</td>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
    <tr>    
        <td width="150">No. Group</td>
        <td width="5">:</td>
        <td><input type="text" name="id_group" id="id_group" size="45" maxlength="12" readonly="readonly" value="<?php echo $id_group;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Kode Item</td>
        <td width="5">:</td>
        <td><input type="text" name="item_code" id="item_code" size="45" maxlength="12" readonly="readonly" value="<?php echo $item_code;?>" /></td>
    </tr>
    <tr>    
        <td>Jumlah Kembali (pcs)</td>
        <td>:</td>
        <td><input type="text" name="jml" id="jml"  size="45" class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $jml;?>" /></td>
    </tr>
    </table>
    </fieldset>
</td>
</tr>
</table>    
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <a href="<?php echo base_url();?>index.php/decal_retu/edit/<?php echo $id;?>">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-logout'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>
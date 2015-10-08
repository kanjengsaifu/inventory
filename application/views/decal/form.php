<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	$("#kode_glasir").focus();
	$("#kode_glasir").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		CariDataGlasir();
	});
        
	function CariDataGlasir(){
		var kode = $("#kode_glasir").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoGlasir",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nama_glasir").val(data.nama_glasir);
				$("#satuan").val(data.satuan);
				$("#status").val(data.status);
                                $("#nama_alias").val(data.nama_alias);
			}
		});
	}
		
	$("#simpan").click(function(){
		var kode_glasir	= $("#kode_glasir").val();
		var nama_glasir	= $("#nama_glasir").val();
		var satuan	= $("#satuan").val();
		
		var string = $("#form").serialize();
		
		if(kode_glasir.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Glasir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kode_glasir").focus();
			return false();
		}
		if(nama_glasir.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Glasir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nama_glasir").focus();
			return false();
		}
		if(satuan.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Satuan tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#satuan").focus();
			return false();
		}
                if(!$("#status").val()){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Status tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#status").focus();
			return false();
		}
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/glasir/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data, 
					timeout:2000,
					showType:'slide'
				});
				CariSimpanan();
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
	
});	
</script>
<form name="form" id="form">
<fieldset class="atas">
<table width="100%">
<tr>    
	<td width="150">Kode Glasir</td>
    <td width="5">:</td>
    <td><input type="text" name="kode_glasir" id="kode_glasir" size="12" maxlength="12" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $kode_glasir;?>" /></td>
</tr>
<tr>    
	<td>Nama Glasir</td>
    <td>:</td>
    <td><input type="text" name="nama_glasir" id="nama_glasir"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,50]'" value="<?php echo $nama_glasir;?>"/></td>
</tr>
<tr>    
	<td>Nama Alias</td>
    <td>:</td>
    <td><input type="text" name="nama_alias" id="nama_alias"  size="10" maxlength="50" class="easyui-validatebox" data-options="required:false,validType:'length[3,50]'" value="<?php echo $nama_alias;?>"/></td>
</tr>
<tr>    
	<td>Satuan</td>
    <td>:</td>
    <td><input value="Kilogram" readonly="true" type="text" name="satuan" id="satuan"  size="10" maxlength="10" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $satuan;?>"/></td>
</tr>
<tr>    
	<td>Status</td>
    <td>:</td>
    <td>
    <select name="status" id="status">
    <?php if(isset($status)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->app_model->status_glasir();
			foreach($data->result() as $dt){					
				if($status==$dt->id_status){
	?>
    			<option	 value="<?php echo $dt->id_status;?>" selected="selected"><?php echo $dt->status;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id_status;?>"><?php echo $dt->status;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <a href="<?php echo base_url();?>index.php/glasir/tambah">
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    </a>
    <a href="<?php echo base_url();?>index.php/glasir/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>
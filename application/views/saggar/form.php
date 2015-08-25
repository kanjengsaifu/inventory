<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	$("#kode_saggar").focus();
	$("#kode_saggar").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		CariDatasaggar();
	});
        
	function CariDatasaggar(){
		var kode = $("#kode_saggar").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoGlasir",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nama_saggar").val(data.nama_saggar);
				$("#satuan").val(data.satuan);
				$("#status").val(data.status);
                                $("#posisi_stok").val(data.posisi_stok);
                                $("#stok").val(data.stok_awal);
			}
		});
	}
		
	$("#simpan").click(function(){
		var kode_saggar	= $("#kode_saggar").val();
		var nama_saggar	= $("#nama_saggar").val();
		var satuan	= $("#satuan").val();satuan
                var posisi_stok	= $("#posisi_stok").val();
                var stok_awal	= $("#stok_awal").val();
		
		var string = $("#form").serialize();
		
		if(kode_saggar.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode saggar tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kode_saggar").focus();
			return false();
		}
		if(nama_saggar.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama saggar tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nama_saggar").focus();
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
                if(posisi_stok.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, posisi Stok tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#posisi_stok").focus();
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
	<td width="150">Kode Saggar</td>
    <td width="5">:</td>
    <td><input type="text" name="kode_saggar" id="kode_saggar" size="12" maxlength="12" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $kode_saggar;?>" /></td>
</tr>
<tr>    
	<td>Nama Saggar</td>
    <td>:</td>
    <td><input type="text" name="nama_saggar" id="nama_saggar"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,50]'" value="<?php echo $nama_saggar;?>"/></td>
</tr>
<tr>    
	<td>Default Location</td>
    <td>:</td>
    <td>
    <select name="default_location" id="default_location">
    <?php if(isset($default_location)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->app_model->saggar_patt();
			foreach($data->result() as $dt){					
				if($posisi_stok==$dt->id_stok){
	?>
    			<option	 value="<?php echo $dt->id_stok;?>" selected="selected"><?php echo $dt->nm_stok;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id_stok;?>"><?php echo $dt->nm_stok;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
<tr>    
	<td>Stok</td>
    <td>:</td>
    <td><input type="text" name="posisi_stok" id="stok_awal"  size="10" maxlength="10" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $posisi_stok;?>"/></td>
</tr>
<tr>    
	<td>Satuan</td>
    <td>:</td>
    <td><input value="Pcs" readonly="true" type="text" name="satuan" id="satuan"  size="10" maxlength="10" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $satuan;?>"/></td>
</tr>
<tr>    
	<td>Status</td>
    <td>:</td>
    <td>
    <select name="status" id="status">
    <?php if(isset($status)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->app_model->status_saggar();
			foreach($data->result() as $dt){					
				if($status==$dt->id_status){
	?>
    			<option	 value="<?php echo $dt->id_status;?>" selected="selected"><?php echo $dt->nm_status;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id_status;?>"><?php echo $dt->nm_status;?></option>
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
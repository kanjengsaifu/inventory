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
		var string = $("#form").serialize();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/decal/simpan",
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
	<td width="150">Kode Decal</td>
    <td width="5">:</td>
    <td><input type="text" name="id" id="id" size="45" maxlength="12" readonly="readonly" value="<?php echo $id;?>" /></td>
</tr>
<tr>    
	<td>Nama Decal</td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama"  size="45" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,50]'"/></td>
</tr>
<tr>    
	<td>Nama Alias</td>
    <td>:</td>
    <td><input type="text" name="alias" id="alias"  size="45" maxlength="50" class="easyui-validatebox" data-options="required:false,validType:'length[3,50]'"/></td>
</tr>
<tr>    
	<td>Nama Buyer</td>
    <td>:</td>
    <td>
    <select name="buyer" id="buyer" style="width:288px;">
    <?php if(isset($buyer)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadBuyer();
			foreach($data->result() as $dt){					
				if($buyer==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->nama;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->nama;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Material</td>
    <td>:</td>
    <td>
    <select name="material" id="material" style="width:288px;">
    <?php if(isset($material)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadMaterial();
			foreach($data->result() as $dt){					
				if($material==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->dsc;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->dsc;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Forming</td>
    <td>:</td>
    <td>
    <select name="forming" id="forming" style="width:288px;">
    <?php if(isset($forming)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadForming();
			foreach($data->result() as $dt){					
				if($forming==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->dsc;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->dsc;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Shape</td>
    <td>:</td>
    <td>
    <select name="shape" id="shape" style="width:288px;">
    <?php if(isset($shape)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadShape();
			foreach($data->result() as $dt){					
				if($shape==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->nama;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->nama;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Item</td>
    <td>:</td>
    <td>
    <select name="item" id="item" style="width:288px;">
    <?php if(isset($item)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadItem();
			foreach($data->result() as $dt){					
				if($item==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->nama;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->nama;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Dekorasi</td>
    <td>:</td>
    <td>
    <select name="dekorasi" id="dekorasi" style="width:288px;">
    <?php if(isset($dekorasi)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadDekorasi();
			foreach($data->result() as $dt){					
				if($dekorasi==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->dsc;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->dsc;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Ukuran</td>
    <td>:</td>
    <td>
    <select name="size" id="size" style="width:288px;">
    <?php if(isset($size)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadSize();
			foreach($data->result() as $dt){					
				if($size==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->nama;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->nama;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Satuan</td>
    <td>:</td>
    <td><input value="pcs" readonly="true" type="text" name="satuan" id="satuan"  size="45" maxlength="10" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $satuan;?>"/></td>
</tr>
<tr>    
	<td>Jenis</td>
    <td>:</td>
    <td>
    <select name="jenis" id="jenis" style="width:288px;">
    <?php if(isset($jenis)){ ?>
    	<option value="" selected="selected">-Pilih-</option>
    <?php } 
			$data = $this->dclModel->loadJenis();
			foreach($data->result() as $dt){					
				if($jenis==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->nama;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->nama;?></option>
    <?php 		}
			}
	?>		
    </select>
    </td>
</tr>
<tr>    
	<td>Status</td>
    <td>:</td>
    <td>
    <select name="status" id="status" style="width:288px;">
    <?php if(isset($status)){ ?>
    <?php } 
			$data = $this->app_model->status_glasir();
			foreach($data->result() as $dt){					
				if($status==$dt->id){
	?>
    			<option	 value="<?php echo $dt->id;?>" selected="selected"><?php echo $dt->status;?></option>
    <?php		}else{ ?>
    			
    			<option	 value="<?php echo $dt->id;?>"><?php echo $dt->status;?></option>
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
    <a href="<?php echo base_url();?>index.php/decal/tambah">
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    </a>
    <a href="<?php echo base_url();?>index.php/decal/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>
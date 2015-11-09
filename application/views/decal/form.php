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
			url		: "<?php echo site_url(); ?>/decal/DataDetail",
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
	
	$("#id_decal_items").focus();
	$("#id_decal_items").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	$("#id_decal_items").focus(function(e){
		var isi = $(e.target).val();
		CariDecal();
	});
	
	$("#id_decal_items").keyup(function(){
		CariDecal();
		
	});
	
	function CariDecal(){
		var kode = $("#id_decal_items").val();
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
			url	: "<?php echo site_url(); ?>/decal/simpan",
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
		$("#item").val('');
                $("#position").val('');
                $("#isi_motif").val('');
                $("#warna").val('');
		$("#item").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/decal/cetak/'+kode);
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
	<td width="150">Kode Desain</td>
    <td width="5">:</td>
    <td><input type="text" name="id" id="id" size="45" maxlength="12" readonly="readonly" value="<?php echo $id;?>"/></td>
    </tr>
    <tr>    
        <td>Nama Desain</td>
        <td>:</td>
        <td><input style="width: 350px;" id="nama" class="easyui-combobox" name="nama" data-options="valueField:'nama',textField:'nama',url:'<?php echo base_url().'index.php/decal/getNama'?>'"  value="<?php echo $nama;?>" ></td>
    </tr>
    <tr>    
        <td>Nama Alias</td>
        <td>:</td>
        <td><input style="width: 350px;" id="alias" class="easyui-combobox" name="alias" data-options="valueField:'alias',textField:'alias',url:'<?php echo base_url().'index.php/decal/getAlias'?>'"  value="<?php echo $alias;?>" ></td>
    </tr>
    <tr>    
            <td>Jenis</td>
        <td>:</td>
        <td>
        <select name="jenis" id="jenis" style="width:350px;">
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
            <td>Nama Buyer</td>
        <td>:</td>
        <td>
        <select name="buyer" id="buyer" style="width:350px;">
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
	<td>Dekorasi</td>
    <td>:</td>
    <td>
    <select name="dekorasi" id="dekorasi" style="width:350px;">
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
            <td>Ukuran Kertas</td>
        <td>:</td>
        <td>
        <select name="size" id="size" style="width:350px;">
        <?php if(isset($size)){ ?>
            <option value="" selected="selected">-Pilih-</option>
        <?php } 
                            $data = $this->dclModel->loadSize();
                            foreach($data->result() as $dt){					
                                    if($size==$dt->id){
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
            <td>Satuan</td>
        <td>:</td>
        <td><input value="sheet" readonly="true" type="text" name="satuan" id="satuan"  size="45" maxlength="10" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $satuan;?>"/></td>
    </tr>
    <tr>    
            <td>Status</td>
        <td>:</td>
        <td>
        <select name="status" id="status" style="width:350px;">
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
</td>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
    <tr>    
        <td width="150">Kode Item</td>
        <td width="5">:</td>
        <td><input type="text" name="item_code" id="item_code" size="45" maxlength="12" readonly="readonly" value="<?php echo $item_code;?>" /></td>
    </tr>    
    <tr>    
        <td>Item</td>
        <td>:</td>
        <td><input style="width: 350px;" id="item" class="easyui-combobox" name="item" data-options="valueField:'item',textField:'item',url:'<?php echo base_url().'index.php/decal/getItem'?>'"  value="<?php echo $item;?>" ></td>
    </tr>
    <tr>    
        <td>Urutan Posisi</td>
        <td>:</td>
        <td><input type="text" name="position" id="position"  size="45" class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;"  value="<?php echo $position;?>"/></td>
    </tr>
    <tr>    
        <td>Isi Motif</td>
        <td>:</td>
        <td><input type="text" name="isi_motif" id="isi_motif"  size="45" class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;"  value="<?php echo $isi_motif;?>"/></td>
    </tr>
    <tr>    
        <td>Warna</td>
        <td>:</td>
        <td><input type="text" name="warna" id="warna"  size="45" class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;"  value="<?php echo $warna;?>"/></td>
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
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH ITEM</button>
    <a href="<?php echo base_url();?>index.php/decal/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-logout'">TUTUP</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>

<fieldset>
<div id="tampil_data"></div>
</fieldset>
<div id="dlg" class="easyui-dialog" title="Item Decal" style="width:800px;height:400px; padding:5px;" data-options="closed:true">
	Cari : <input type="text" name="text_cari" id="text_cari" size="50"/>
	<div id="daftar_decal"></div>
</div>
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
			url		: "<?php echo site_url(); ?>/decal_opna/DataDetail",
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
            
		var id_decal_items	= $("#id_decal_items").val();
		var kw1                 = $("#kw1").val();
                var kw2                 = $("#kw2").val();
                var kw3                 = $("#kw3").val();
		
		var string = $("#form").serialize();
		
		if(id_decal_items.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Decal tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#id_decal_items").focus();
			return false();
		}
                
                if(kw1.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, KW 1 tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kw1").focus();
			return false();
		}
                
                if(kw1<0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kuantitas KW 1 tidak boleh kurang dari 0', 
				timeout:2000,
				showType:'show'
			});
			$("#kw1").focus();
			return false();
		}
                
                if(kw2<0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kuantitas KW 2 tidak boleh kurang dari 0', 
				timeout:2000,
				showType:'show'
			});
			$("#kw2").focus();
			return false();
		}
                
                if(kw3<0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kuantitas KW 3 tidak boleh kurang dari 0', 
				timeout:2000,
				showType:'show'
			});
			$("#kw3").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/decal_opna/simpan",
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
		$("#id_decal_items").val('');
                $("#no_po").val('');
                $("#batch").val('');
                $("#petugas").val('');
                $("#nama_decal").val('');
                $("#tgli").val('');
                $("#jam").val('');
                $("#shift").val('');
                $("#id_bm").val('');
                $("#id_bmt").val('');
                $("#size_kertas").val('');
                $("#size_kat").val('');
                $("#warna").val('');
                $("#komposisi").val('');
                $("#kw1").val(0);
                $("#kw2").val(0);
                $("#kw3").val(0);
		$("#id_decal_items").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/decal_opna/cetak/'+kode);
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
        <td width="100%">No. Transaksi</td>
        <td width="100%">:</td>
        <td><input type="text" name="id" id="id" size="45" maxlength="12" readonly="readonly" value="<?php echo $id;?>" /></td>
    </tr>
    <tr>    
        <td width="150">No. Batch</td>
        <td width="5">:</td>
        <td><input type="text" name="batch" id="batch" size="45" maxlength="12" readonly="readonly" value="<?php echo $batch;?>" /></td>
    </tr>
    <tr>    
        <td>Petugas</td>
        <td>:</td>
        <td><input type="text" name="petugas" id="petugas" class="detail" size="45" maxlength="20" value="<?php echo $petugas;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Kode Decal</td>
        <td width="5">:</td>
        <td><input type="text" name="id_decal_items" id="id_decal_items" size="34" maxlength="12" class="easyui-validatebox" data-options="required:false,validType:'length[3,10]'"  value="<?php echo $id_decal_items;?>" />
        <button type="button" name="cari_barang" id="cari_barang" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
        </td>
    </tr>
    <tr>    
        <td>Nama Decal</td>
        <td>:</td>
        <td><input readonly="readonly" type="text" name="nama_decal" id="nama_decal"  size="45" class="detail" maxlength="50"/></td>
    </tr>
    <tr>    
        <td width="150">Tanggal Pelaksanaan</td>
        <td width="5">:</td>
        <td><input name="tgli" id="tgli"  size="45" maxlength="12" class="easyui-validatebox" value="<?php echo $tgli;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Jam Pelaksanaan</td>
        <td width="5">:</td>
        <td><input name="jam" id="jam"  size="54" maxlength="30" class="easyui-timespinner" value="<?php echo $jam;?>" /></td>
    </tr>
    </table>
    </fieldset>
</td>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
    <tr>    
        <td>Shift</td>
        <td>:</td>
        <td>
        <select name="shift" id="shift" style="width:382px;">
        <?php 
		if(empty($shift)){
		?>
            <option value="<?php echo $shift;?>">-PILIH-</option>
        <?php
		}
		foreach($l_sft->result() as $t){
			if($shift==$t->id){
		?>
        <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->nama;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->id;?> - <?php echo $t->nama;?></option>
        <?php }
		} ?>
        </select>
        </td>
    </tr>    
    <tr>    
        <td>Jenis Decal</td>
        <td>:</td>
        <td>
            <select name="jenis_decal" id="jenis_decal" style="width:382px;">
        <?php 
		if(empty($jenis_decal)){
		?>
        <option  value="<?php echo $jenis_decal;?>">-PILIH-</option>
        <?php
		}
		foreach($l_jd->result() as $t){
			if($jenis_decal==$t->id){
		?>
        <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->dsc;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->id;?> - <?php echo $t->dsc;?></option>
        <?php }
		} ?>
        </select>
        </td>
        </td>
    </tr>
    <tr>    
        <td>Area Opname</td>
        <td>:</td>
        <td>
            <select name="area" id="area" style="width:382px;">
        <?php 
		if(empty($area)){
		?>
        <option  value="<?php echo $area;?>">-PILIH-</option>
        <?php
		}
		foreach($l_area->result() as $t){
			if($area==$t->id){
		?>
        <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->nama;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->id;?> - <?php echo $t->nama;?></option>
        <?php }
		} ?>
        </select>
        </td>
        </td>
    </tr>
    <tr>    
        <td>Ukuran Kertas</td>
        <td>:</td>
        <td>
            <select name="size_kertas" id="size_kertas" style="width:382px;">
        <?php 
		if(empty($size_kertas)){
		?>
        <option  value="<?php echo $size_kertas;?>">-PILIH-</option>
        <?php
		}
		foreach($l_uk->result() as $t){
			if($size_kertas==$t->id){
		?>
        <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->dsc;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->id;?> - <?php echo $t->dsc;?></option>
        <?php }
		} ?>
        </select>
        </td>
        </td>
    </tr>
    <tr>    
        <td>Ukuran Logo</td>
        <td>:</td>
        <td>
            <select name="size_kat" id="size_kat" style="width:382px;">
        <?php 
		if(empty($size_kat)){
		?>
        <option  value="<?php echo $size_kat;?>">-PILIH-</option>
        <?php
		}
		foreach($l_ul->result() as $t){
			if($size_kat==$t->id){
		?>
        <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->dsc;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->id;?> - <?php echo $t->dsc;?></option>
        <?php }
		} ?>
        </select>
        </td>
        </td>
    </tr>
    <tr>    
        <td>Banyak Warna</td>
        <td>:</td>
        <td><input type="text" name="warna" id="warna"  size="49" class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;"  value="<?php echo $warna;?>"/></td>
    </tr>
    <tr>    
        <td>Komposisi</td>
        <td>:</td>
        <td><input type="text" name="komposisi" id="komposisi" class="detail" size="49" maxlength="20" value="<?php echo $komposisi;?>" /></td>
    </tr>
    </table>
    </fieldset>
</td>
</tr>
</table>
<table width="100%">
<tr>
<td valign="top" width="30%">
    <fieldset>
    <table width="100%">
        <tr>    
            <td>KW 1 DI SYSTEM</td>
            <td>:</td>
            <td><input type="text" name="kw1_system" id="kw1_system"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw1;?>" /></td>
        </tr>
        <tr>    
            <td>KW 2 DI SYSTEM</td>
            <td>:</td>
            <td><input type="text" name="kw2_system" id="kw2_system"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw2;?>" /></td>
        </tr>
        <tr>    
            <td>KW 3 DI SYSTEM</td>
            <td>:</td>
            <td><input type="text" name="kw3_system" id="kw3_system"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw3;?>" /></td>
        </tr>
    </table>
    </fieldset>
</td>
<td valign="top" width="30%">
    <fieldset>
    <table width="100%">
        <tr>    
            <td>HASIl OPNAME KW 1</td>
            <td>:</td>
            <td><input type="text" name="kw1_opname" id="kw1_opname"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw1;?>" /></td>
        </tr>
        <tr>    
            <td>HASIl OPNAME KW 2</td>
            <td>:</td>
            <td><input type="text" name="kw2_opname" id="kw2_opname"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw2;?>" /></td>
        </tr>
        <tr>    
            <td>HASIl OPNAME KW 3</td>
            <td>:</td>
            <td><input type="text" name="kw3_opname" id="kw3_opname"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw3;?>" /></td>
        </tr>
    </table>
    </fieldset>
</td>
<td valign="top" width="30%">
    <fieldset>
    <table width="100%">
        <tr>    
            <td>SELISIH KW 1</td>
            <td>:</td>
            <td><input type="text" name="kw1_selisih" id="kw1_selisih"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw1;?>" /></td>
        </tr>
        <tr>    
            <td>SELISIH KW 2</td>
            <td>:</td>
            <td><input type="text" name="kw2_selisih" id="kw2_selisih"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw2;?>" /></td>
        </tr>
        <tr>    
            <td>SELISIH KW 3</td>
            <td>:</td>
            <td><input type="text" name="kw3_selisih" id="kw3_selisih"  class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw3;?>" /></td>
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
    <button type="button" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">CETAK</button>
    <a href="<?php echo base_url();?>index.php/decal_opna/">
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
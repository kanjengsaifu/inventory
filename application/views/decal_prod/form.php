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
			url		: "<?php echo site_url(); ?>/decal_prod/DataDetail",
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
            
		var parent_id           = $("#parent_id").val();
                var tgli                = $("#tgli").val();
                var jam                 = $("#jam").val();
                var shift               = $("#shift").val();
                var id_bm               = $("#id_bm").val();
                var id_bmt              = $("#id_bmt").val();
                var jml                 = $("#jml").val();
		
		var string = $("#form").serialize();
                
                if(parent_id.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode desain tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#parent_id").focus();
			return false();
		}
                
                if(tgli.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tanggal pelaksanaan tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tgli").focus();
			return false();
		}
                
                if(shift.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Shift tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#shift").focus();
			return false();
		}
                
                if(id_bm.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Mesin produksi tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#id_bm").focus();
			return false();
		}
                
                if(id_bmt.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Penyimpanan tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#id_bmt").focus();
			return false();
		}
                
                if(jml.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jumlah Sheet tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jml").focus();
			return false();
		}
                
                if(jml<0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jumlah Sheet tidak boleh kurang dari 0', 
				timeout:2000,
				showType:'show'
			});
			$("#jml").focus();
			return false();
		}

		
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/decal_prod/simpan",
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
		$("#parent_id").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/decal_prod/cetak/'+kode);
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
        <td width="150">No. Batch</td>
        <td width="5">:</td>
        <td><input type="text" name="batch" id="batch" size="45" maxlength="12" readonly="readonly" value="<?php echo $batch;?>" /></td>
    </tr>
    <tr>    
        <td>Petugas</td>
        <td>:</td>
        <td><input style="width: 350px;" id="petugas" class="easyui-combobox" name="petugas" data-options="required:true,valueField:'petugas',textField:'petugas',url:'<?php echo base_url().'index.php/decal_prod/getPicProdDecal'?>'"  value="<?php echo $petugas;?>" ></td>
    </tr>
    <tr>    
        <td width="150">Kode Desain</td>
        <td width="5">:</td>
        <td><input type="text" name="parent_id" id="parent_id" size="34.5" maxlength="12" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'"  value="<?php echo $parent_id;?>" />
        <button type="button" name="cari_barang" id="cari_barang" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
        </td>
    </tr>
    <tr>    
        <td>Nama Desain</td>
        <td>:</td>
        <td><input readonly="readonly" type="text" name="nama_decal" id="nama_decal"  size="45" class="detail" maxlength="50"/></td>
    </tr>
    </table>
    </fieldset>
</td>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
    <tr>    
        <td width="150">Tgl. Pelaksanaan</td>
        <td width="5">:</td>
        <td><input name="tgli" id="tgli"  size="45" maxlength="12" class="easyui-validatebox" value="<?php echo $tgli;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Jam Pelaksanaan</td>
        <td width="5">:</td>
        <td><input style="width: 350px;" name="jam" id="jam"  size="45" maxlength="12" class="easyui-timespinner" value="<?php echo $jam;?>" /></td>
    </tr>
    <tr>    
        <td>Shift</td>
        <td>:</td>
        <td>
        <select name="shift" id="shift" style="width:350px;">
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
        <td>Mesin Produksi</td>
        <td>:</td>
        <td>
            <select name="id_bm" id="id_bm" style="width:350px;">
        <?php 
		if(empty($id_bm)){
		?>
        <option  value="<?php echo $id_bm;?>">-PILIH-</option>
        <?php
		}
		foreach($l_bm->result() as $t){
			if($id_bm==$t->id_bm){
		?>
        <option value="<?php echo $t->id_bm;?>" selected="selected"><?php echo $t->id_bm;?> - <?php echo $t->nama_bm;?> - <?php echo $t->jns_bm;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id_bm;?>"><?php echo $t->id_bm;?> - <?php echo $t->nama_bm;?> - <?php echo $t->jns_bm;?></option>
        <?php }
		} ?>
        </select>
        </td>
        </td>
    </tr>
    <tr>    
        <td>Disimpan Ke</td>
        <td>:</td>
        <td>
            <select name="id_bmt" id="id_bmt" style="width:350px;">
        <?php 
		if(empty($id_bmt)){
		?>
        <option  value="<?php echo $id_bmt;?>">-PILIH-</option>
        <?php
		}
		foreach($x_bm->result() as $t){
			if($id_bmt==$t->id_bm){
		?>
        <option value="<?php echo $t->id_bm;?>" selected="selected"><?php echo $t->id_bm;?> - <?php echo $t->nama_bm;?> - <?php echo $t->jns_bm;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id_bm;?>"><?php echo $t->id_bm;?> - <?php echo $t->nama_bm;?> - <?php echo $t->jns_bm;?></option>
        <?php }
		} ?>
        </select>
        </td>
        </td>
    </tr>
    <tr>    
        <td>Jumlah Sheet</td>
        <td>:</td>
        <td><input type="text" name="jml" id="jml"  size="45" class="easyui-numberbox" data-options="min:0,precision:0" style="text-align:right;" value="<?php echo $kw1;?>" /></td>
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
    <a href="<?php echo base_url();?>index.php/decal_prod/">
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
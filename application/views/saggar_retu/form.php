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
		var kode = $("#no_prod").val();
		//alert(kode);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/glasir_retu/DataDetail",
			data	: "kode="+kode,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
		//return false();
	}
	        
        $("#tgl_plng").datepicker({
			dateFormat:"dd-mm-yy"
            });
        $("#wktp").datepicker({
			dateFormat:"dd-mm-yy"
            });
	
	$("#id_glasir").focus();
	$("#id_glasir").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	$("#id_glasir").focus(function(e){
		var isi = $(e.target).val();
		CariGlasir();
	});
	
	$("#id_glasir").keyup(function(){
		CariGlasir();
		
	});
	
	function CariGlasir(){
		var kode = $("#id_glasir").val();
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/ref_json/InfoGlasir",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nama_glasir").val(data.nama_glasir);
			}
		});
	};
	
	$("#simpan").click(function(){
                var tgl_plng    = $("#tgl_plng").val();
                var planner     = $("#planner").val();
                var buyer       = $("#buyer").val();
                var jns         = $("#jns").val();
                var shift       = $("#shift").val();
                var mpr         = $("#mpr").val();
                
		var id_glasir	= $("#id_glasir").val();
		var volume	= $("#volume").val();
                var densitas    = $("#densitas").val();
                var vsc         = $("#vsc").val();
                var petugas     = $("#petugas").val();
                var wktp        = $("#wktp").val();
		
		var string = $("#form").serialize();
		
                if(tgl_plng.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tanggal planning tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tgl_plng").focus();
			return false();
		}
                
                 if(planner.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Planner tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#planner").focus();
			return false();
		}
                
		if(buyer.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Buyer tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#buyer").focus();
			return false();
		}
		
		if(jns.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jenis pengiriman tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jns").focus();
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
                
                if(mpr.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Mesin produksi tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#mpr").focus();
			return false();
		}
                
                if(id_glasir.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Glasir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#id_glasir").focus();
			return false();
		}
                
                if(volume.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Volume tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#volume").focus();
			return false();
		}
                
                if(densitas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Densitas tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#densitas").focus();
			return false();
		}
                
                if(vsc.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Viscositas tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#vsc").focus();
			return false();
		}
                
                if(petugas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Petugas tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#petugas").focus();
			return false();
		}
                
                if(wktp.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Waktu transaksi tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#wktp").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/glasir_retu/simpan",
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
                $("#dsc").val('');
                $("#buyer").val('');
                $("#jns").val('');
                $("#shift").val('');
                $("#mpr").val('');
		$("#id_glasir").val('');
                $("#volume").val('');
                $("#densitas").val('');
                $("#vsc").val('');
                $("#petugas").val('');
                $("#wktp").val('');
		$("#id_glasir").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/glasir_retu/cetak/'+kode);
		return false();
	});
	
	$("#cari_barang").click(function(){
		AmbilDaftarGlasir();
		$("#dlg").dialog('open');
	});
	
	$("#text_cari").keyup(function(){
		AmbilDaftarGlasir();
		//$("#dlg").dialog('open');
	});
	
	function AmbilDaftarGlasir(){
		var cari = $("#text_cari").val();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/DataGlasir",
			data	: "cari="+cari,
			cache	: false,
			success	: function(data){
				$("#daftar_glasir").html(data);
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
        <td width="150">No. Produksi</td>
        <td width="5">:</td>
        <td><input type="text" name="no_prod" id="no_prod" size="45" maxlength="12" readonly="readonly" value="<?php echo $no_prod;?>" /></td>
    </tr>
    <tr>    
        <td>Tgl Planning</td>
        <td>:</td>
        <td><input name="tgl_plng" id="tgl_plng"  size="45" maxlength="12" class="easyui-validatebox" value="<?php echo $tgl_plng;?>"/></td>
    </tr>
    <tr>    
        <td width="150">Planner</td>
        <td width="5">:</td>
        <td><input type="text" name="planner" id="planner" size="45" maxlength="12" value="<?php echo $planner;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Keterangan</td>
        <td width="5">:</td>
        <td><input type="text" name="dsc" id="dsc" size="45" maxlength="255"/></td>
    </tr>
    <tr>    
        <td>Buyer</td>
        <td>:</td>
        <td>
        <select name="buyer" id="buyer" style="width:382px;">
        <?php 
		if(empty($buyer)){
		?>
        <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_byr->result() as $t){
			if($buyer==$t->id){
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
        <td>Jenis Pengiriman</td>
        <td>:</td>
        <td>
        <select name="jns" id="jns" style="width:382px;">
        <?php 
		if(empty($jns)){
		?>
            <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_dlv->result() as $t){
			if($jns==$t->id){
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
        <td>Shift</td>
        <td>:</td>
        <td>
        <select name="shift" id="shift" style="width:382px;">
        <?php 
		if(empty($shift)){
		?>
            <option value="">-PILIH-</option>
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
        <select name="mpr" id="mpr" style="width:382px;">
        <?php 
		if(empty($mpr)){
		?>
            <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_mpr->result() as $t){
			if($mpr==$t->id_bm){
		?>
        <option value="<?php echo $t->id_bm;?>" selected="selected"><?php echo $t->id_bm;?> - <?php echo $t->nama_bm;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id_bm;?>"><?php echo $t->id_bm;?> - <?php echo $t->nama_bm;?></option>
        <?php }
		} ?>
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
        <td width="150">Kode Glasir</td>
        <td width="5">:</td>
        <td><input type="text" name="id_glasir" id="id_glasir" size="35.5" maxlength="12" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" />
        <button type="button" name="cari_barang" id="cari_barang" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
        </td>
    </tr>
    <tr>    
        <td>Nama Glasir</td>
        <td>:</td>
        <td><input readonly="readonly" type="text" name="nama_glasir" id="nama_glasir"  size="45" class="detail" maxlength="50"/></td>
    </tr>
    <tr>    
        <td>Volume (liter)</td>
        <td>:</td>
        <td><input type="text" name="volume" id="volume"  size="45" class="easyui-numberbox" data-options="min:0,precision:2" style="text-align:right;"/></td>
    </tr>
    <tr>    
        <td>Densitas (gr/L)</td>
        <td>:</td>
        <td><input type="text" name="densitas" id="densitas"  size="45" class="easyui-numberbox" data-options="min:0,precision:2" style="text-align:right;"/></td>
    </tr>
    <tr>    
        <td>Viscositas (Pois)</td>
        <td>:</td>
        <td><input type="text" name="vsc" id="vsc"  size="45" class="easyui-numberbox" data-options="min:0,precision:2" style="text-align:right;"/></td>
    </tr>
    <tr>    
        <td>Petugas</td>
        <td>:</td>
        <td><input type="text" name="petugas" id="petugas" class="detail" size="45" maxlength="20"/></td>
    </tr>
    <tr>    
        <td>Waktu Transaksi</td>
        <td>:</td>
        <td><input name="wktp" id="wktp"  size="45" maxlength="45" class="easyui-validatebox"/></td>
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
    <a href="<?php echo base_url();?>index.php/glasir_retu/">
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
<div id="dlg" class="easyui-dialog" title="Item Glasir" style="width:900px;height:400px; padding:5px;" data-options="closed:true">
	Cari : <input type="text" name="text_cari" id="text_cari" size="50" />
	<div id="daftar_glasir"></div>
</div>
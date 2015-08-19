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
		var noprod = $("#noprod").val();
                var batch = $("#batch").val();
                var idphd = $("#idphd").val();
		//alert(kode);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/glasir_prod/DataDetailHistory",
			data	: { 'noprod' : noprod, 'batch' : batch, 'idphd' : idphd,},
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
        
	$("#harga").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
        
	$("#jml").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	
	function hitung(){
		var jml = $("#jml").val();
		var harga = $("#harga").val();
		
		var total = parseInt(jml)*parseInt(harga);
		$("#total").val(total);
	}
	$("#jml").keyup(function(){
		hitung();
	});
	$("#harga").keyup(function(){
		hitung();
	});
	
	$("#simpan").click(function(){
            
		var id_glasir	= $("#id_glasir").val();
		var status	= $("#status").val();
		var volume	= $("#volume").val();
		var no_po	= $("#no_po").val();
		var planner     = $("#planner").val();
		var tgl_plng    = $("#tgl_plng").val();
                var petugas     = $("#petugas").val();
                var densitas    = $("#densitas").val();
		
		var string = $("#form").serialize();
		
                if(no_po.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, No Order tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#no_po").focus();
			return false();
		}
                
                 if(tgl_plng.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, No Order tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tgl_plng").focus();
			return false();
		}
                
		if(planner.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Planner tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#planner").focus();
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
		if(status.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Status Glasir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#status").focus();
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
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/glasir_prod/simpan",
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
		$("#id_glasir").val('');
                $("#status").val('');
                $("#volume").val('');
                $("#densitas").val('');
                $("#id_bm").val('');
                $("#id_tong").val('');
		$("#id_glasir").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/glasir_prod/cetak/'+kode);
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
        <td width="150">Kode Histori</td>
        <td width="5">:</td>
        <td><input type="text" name="idphdh" id="idphdh" size="45" maxlength="12" readonly="readonly" value="<?php echo $idphdh;?>" /></td>
    </tr>
    <tr>    
        <td width="150">No. Produksi</td>
        <td width="5">:</td>
        <td><input type="text" name="noprod" id="noprod" size="45" maxlength="12" readonly="readonly" value="<?php echo $no_prod;?>" /></td>
    </tr>
    <tr>    
        <td>Kode Glasir</td>
        <td width="5">:</td>
        <td><input type="text" name="idglasir" id="idglasir" size="45" maxlength="12" readonly="readonly" value="<?php echo $id_glasir;?>" /></td>
    </tr>
    <tr>    
        <td>Batch</td>
        <td width="5">:</td>
        <td><input type="text" name="batch" id="batch" size="45" maxlength="12" readonly="readonly" value="<?php echo $batch;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Status Produksi</td>
        <td>:</td>
        <td>
        <select name="status" id="status" style="width:382px;">
        <?php 
		if(empty($status)){
		?>
        <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_gps->result() as $t){
			if($status==$t->idgps){
		?>
        <option value="<?php echo $t->idgps;?>" selected="selected"><?php echo $t->idgps;?> - <?php echo $t->nama_gps;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->idgps;?>"><?php echo $t->idgps;?> - <?php echo $t->nama_gps;?></option>
        <?php }
		} ?>
        </select>
    </tr>
    </table>
    </fieldset>
</td>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
    <tr>    
        <td width="150">Volume</td>
        <td width="5">:</td>
        <td><input type="text" name="volume" id="volume"  size="41" class="easyui-numberbox" data-options="min:0,precision:2" style="text-align:right;"/> liter</td>
    </tr>
    <tr>    
        <td>Densitas</td>
        <td>:</td>
        <td><input type="text" name="volume" id="volume"  size="45" class="easyui-numberbox" data-options="min:0,precision:2" style="text-align:right;"/></td>
    <tr>    
        <td>Ball Mill</td>
        <td>:</td>
        <td>
            <select name="id_bm" id="id_bm" style="width:382px;">
        <?php 
		if(empty($id_bm)){
		?>
        <option value="">-PILIH-</option>
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
        <td>Tong</td>
        <td>:</td>
        <td>
        <select name="id_tong" id="id_tong" style="width:382px;">
        <?php 
		if(empty($id_tong)){
		?>
        <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_tong->result() as $t){
			if($id_tong==$t->id_tong){
		?>
        <option value="<?php echo $t->id_tong;?>" selected="selected"><?php echo $t->id_tong;?> - <?php echo $t->nama_tong;?> - <?php echo $t->jns_tong;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id_tong;?>"><?php echo $t->id_tong;?> - <?php echo $t->nama_tong;?> - <?php echo $t->jns_tong;?></option>
        <?php }
		} ?>
        </select>
        </td>
    </tr>
    <tr>    
        <td>Petugas</td>
        <td>:</td>
        <td><input type="text" name="petugas" id="petugas" class="detail" size="45" maxlength="20"/></td>
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
    <a href="<?php echo base_url();?>index.php/glasir_prod/edit/<?php echo $no_prod;?>">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-logout'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>

<fieldset>
<div id="tampil_data"></div>
</fieldset>
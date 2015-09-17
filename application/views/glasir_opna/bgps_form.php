<script type="text/javascript">
        $(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});
        
        function hitung(){
		var volume = $("#volume").val();
                var densitas = $("#densitas").val();
                var sts = $("#sts").val();
		
		var bk_opname = 1.565*(parseFloat(densitas-1000)/1000)*parseFloat(volume);
		$("#bkg").val(bk_opname);
                
                if (parseFloat(sts)>bk_opname) {
                    var selisih = parseFloat(bk_opname)-parseFloat(sts);
                    $("#selisih").val(selisih);
                } else if (parseFloat(sts)<bk_opname) {
                    var selisih = parseFloat(bk_opname)-parseFloat(sts);
                    $("#selisih").val(selisih);
                }
	}
	$("#id_glasir").keyup(function(){
		hitung();
	});
	$("#sts").keyup(function(){
		hitung();
	});
	$("#volume").keyup(function(){
		hitung();
	});
	$("#densitas").keyup(function(){
		hitung();
	});
        
	tampil_data();
	
	function tampil_data(){
		var kode = $("#no_prod").val();
		//alert(kode);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/glasir_opna/DataDetailBgps",
			data	: "kode="+kode,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
		//return false();
	}
	        
        $("#tgl").datepicker({
			dateFormat:"dd-mm-yy"
            });
        $("#tglp").datepicker({
			dateFormat:"dd-mm-yy"
            });
        $("#tglb").datepicker({
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
                                $("#sts").val(data.s_bgps);
			}
		});
	};
	
	$("#simpan").click(function(){
                var tgl         = $("#tgl").val();
                var id_glasir   = $("#id_glasir").val();
                var volume      = $("#volume").val();
                var densitas    = $("#densitas").val();
                var id_bm    = $("#id_bm").val();
		
		var string = $("#form").serialize();
		
                if(tgl.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tanggal pelaksanaan tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tgl").focus();
			return false();
		}
                
                 if(id_glasir.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode glasir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#id_glasir").focus();
			return false();
		}
                
                if(id_bm.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Ball mill tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#id_bm").focus();
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
                
                if(densitas<1000){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Densitas tidak boleh kurang dari 1000', 
				timeout:2000,
				showType:'show'
			});
			$("#densitas").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/glasir_opna/simpanBgps",
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
                $("#volume").val('');
                $("#densitas").val('');
                $("#vsc").val('');
		$("#id_glasir").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/glasir_opna/cetak/'+kode);
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
        <td width="150">No. Tranaskasi</td>
        <td width="5">:</td>
        <td><input type="text" name="no_prod" id="no_prod" size="45" maxlength="12" readonly="readonly" value="<?php echo $no_prod;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Keterangan</td>
        <td width="5">:</td>
        <td><input type="text" name="dsc" id="dsc" size="45" maxlength="255"/></td>
    </tr>
    <tr>    
        <td>Kasie/Wasie Prod</td>
        <td>:</td>
        <td><input type="text" name="petugas" id="petugas" class="detail" size="45" maxlength="20"/></td>
    </tr>
    <tr>    
        <td>Tgl Pelaksanaan</td>
        <td>:</td>
        <td><input name="tgl" id="tgl"  size="45" maxlength="12" class="easyui-validatebox" value=""/></td>
    </tr>
    <tr>    
        <td width="150">Jam Pelaksanaan</td>
        <td width="5">:</td>
        <td><input name="jam" id="jam"  size="45" maxlength="12" class="easyui-timespinner" value=""/></td>
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
        <td>Ball Mill/Tong</td>
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
        <td width="150">Tgl. Produksi</td>
        <td width="5">:</td>
        <td><input name="tglp" id="tglp"  size="45" maxlength="12" class="easyui-validatebox" value=""/></td>
    </tr>
    <tr>    
        <td width="150">Tgl. Lulus Tes Bakar</td>
        <td width="5">:</td>
        <td><input name="tglb" id="tglb"  size="45" maxlength="12" class="easyui-validatebox" value=""/></td>
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
        <td><input readonly="readonly" type="text" name="nama_glasir" id="nama_glasir"  size="45" class="detail" maxlength="50" readonly="readonly"/></td>
    </tr>
    <tr>    
        <td>Stok di Sistem (Kg)</td>
        <td>:</td>
        <td><input type="text" name="sts" id="sts" class="detail" size="20" maxlength="20" readonly="readonly"/></td>
    </tr>
    <tr>    
        <td>Volume (liter)</td>
        <td>:</td>
        <td><input type="text" name="volume" id="volume" class="detail" size="20" maxlength="20"/></td>
    </tr>
    <tr>    
        <td>Densitas (gr/L)</td>
        <td>:</td>
        <td><input type="text" name="densitas" id="densitas" class="detail" size="20" maxlength="20"/></td>
    </tr>
    <tr>    
        <td>Viscositas (Pois)</td>
        <td>:</td>
        <td><input type="text" name="vsc" id="vsc" class="detail" size="20" maxlength="20"</td>
    </tr>
     <tr>    
        <td>Stok Opname (Kg)</td>
        <td>:</td>
        <td><input type="text" name="bkg" id="bkg" class="detail" size="20" maxlength="20" readonly="readonly"/></td>
    </tr>
    <tr>    
        <td>Selisih Stok (Kg)</td>
        <td>:</td>
        <td><input type="text" name="selisih" id="selisih" class="detail" size="20" maxlength="20" readonly="readonly"/></td>
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
    <a href="<?php echo base_url();?>index.php/glasir_opna/">
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
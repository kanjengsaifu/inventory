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
			url		: "<?php echo site_url(); ?>/glasir_adju/DataDetail",
			data	: "kode="+kode,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
		//return false();
	}
	        
        $("#tgli").datepicker({
			dateFormat:"dd-mm-yy",
                        numberOfMonths:[2,3],
                        showCurrentAtPos: 5,
                        beforeShow: function(){    
                        $(".ui-datepicker").css('font-size', 11) 
                        }
            });
        $("#tgl_start").datepicker({
			dateFormat:"dd-mm-yy",
                        numberOfMonths:[2,3],
                        showCurrentAtPos: 5,
                        beforeShow: function(){    
                        $(".ui-datepicker").css('font-size', 11) 
                        }
            });
        $("#tgl_end").datepicker({
			dateFormat:"dd-mm-yy",
                        numberOfMonths:[2,3],
                        showCurrentAtPos: 5,
                        beforeShow: function(){    
                        $(".ui-datepicker").css('font-size', 11) 
                        }
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
                                $("#parent").val(data.parent);
			}
		});
	};
	
	$("#simpan").click(function(){
            
                var periode     = $("#periode").val();
                var tgli        = $("#tgli").val();
                var jam         = $("#jam").val();
                var shift       = $("#shift").val();
                var tgl_start   = $("#tgl_start").val();
                var jam_start   = $("#jam_start").val();
                var tgl_end     = $("#tgl_end").val();
                var jam_end     = $("#jam_end").val();
		
		var string = $("#form").serialize();
                
                if(periode.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Periode tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#periode").focus();
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
				msg:'Maaf, Tanggal shift tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#shift").focus();
			return false();
		}
                
                if(tgl_start.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tanggal opname terakhir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tgl_start").focus();
			return false();
		}
                
                if(jam_start.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jam opname terakhir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jam_start").focus();
			return false();
		}
                
                if(tgl_end.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tanggal opname sekarang tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tgl_end").focus();
			return false();
		}
                
                if(jam_end.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jam opname sekarang tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jam_end").focus();
			return false();
		}
                
                if(jam.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jam pelaksanaan tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jam").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url	: "<?php echo site_url(); ?>/glasir_adju/simpan",
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
                $("#id_bm").val('');
                $("#dsc").val('');
                $("#jam").val('');
                $("#tgl").val('');
                $("#shift").val('');
		$("#id_glasir").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#no_prod").val();
		window.open('<?php echo site_url();?>/glasir_adju/cetak/'+kode);
		return false();
	});
	
	$("#cari_barang").click(function(){
		AmbilDaftarGlasir();
		$("#dlg").dialog('open');
	});
        
        $("#cari_tglp").click(function(){
		AmbilTglp();
		$("#dlgp").dialog('open');
	});
	
	$("#text_cari").keyup(function(){
		AmbilDaftarGlasir();
		//$("#dlg").dialog('open');
	});
        
        $("#text_cari1").keyup(function(){
		AmbilTglp();
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
        
        function AmbilTglp(){
		var cari = $("#id_glasir").val();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/DataTglp",
			data	: "cari="+cari,
			cache	: false,
			success	: function(data){
				$("#daftar_tglp").html(data);
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
        <td width="150">No. Adjusment</td>
        <td width="5">:</td>
        <td><input type="text" name="id" id="id" size="45" maxlength="12" readonly="readonly" value="<?php echo $id;?>" /></td>
    </tr>
    <tr>    
        <td>Petugas</td>
        <td>:</td>
        <td><input type="text" style="width: 350px;" id="petugas" class="easyui-combobox" name="petugas" data-options="required:true,valueField:'petugas',textField:'petugas',url:'<?php echo base_url().'index.php/glasir_adju/getPicAdju'?>'"  value="<?php echo $petugas;?>" ></td>
    </tr>
    <tr>    
        <td width="150">Periode</td>
        <td width="5">:</td>
        <td><input type="text" name="periode" id="periode" size="45" maxlength="255" value="<?php echo $periode;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Tanggal Pelaksanaan</td>
        <td width="5">:</td>
        <td><input name="tgli" id="tgli"  size="45" maxlength="12" class="easyui-validatebox" value="<?php echo $tgli;?>" /></td>
    </tr>
    <tr>    
        <td width="150">Jam Pelaksanaan</td>
        <td width="5">:</td>
        <td><input name="jam" id="jam"  size="45" maxlength="12" class="easyui-timespinner" value="<?php echo $jam;?>" /></td>
    </tr>
    <tr>    
        <td>Shift</td>
        <td>:</td>
        <td>
        <select name="shift" id="shift" style="width:382px;">
        <?php 
		if(empty($shift)){
		?>
            <option value="<?php echo $shift;?>-PILIH-</option>
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
    </table>
    </fieldset>
</td>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
        <tr>    
            <td width="150">Tgl. Opname Terakhir</td>
            <td width="5">:</td>
            <td><input name="tgl_start" id="tgl_start"  size="45" maxlength="12" class="easyui-validatebox" value="<?php echo $tgl_start;?>" /></td>
        </tr>
        <tr>    
            <td width="150">Jam. Opname Terakhir</td>
            <td width="5">:</td>
            <td><input name="jam_start" id="jam_start"  size="45" maxlength="12" class="easyui-timespinner" value="<?php echo $jam_start;?>" /></td>
        </tr>
        <tr>    
            <td width="150">Tgl. Opname Sekarang</td>
            <td width="5">:</td>
            <td><input name="tgl_end" id="tgl_end"  size="45" maxlength="12" class="easyui-validatebox" value="<?php echo $tgl_end;?>" /></td>
        </tr>
        <tr>    
            <td width="150">Jam. Opname Sekarang</td>
            <td width="5">:</td>
            <td><input name="jam_end" id="jam_end"  size="45" maxlength="12" class="easyui-timespinner" value="<?php echo $jam_end;?>" /></td>
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
    <a href="<?php echo base_url();?>index.php/glasir_adju/">
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
	Cari : <input type="text" name="text_cari" id="text_cari" size="50"/>
	<div id="daftar_glasir"></div>
</div>
<div id="dlgp" class="easyui-dialog" title="Tanggal Produksi Glasir" style="width:1000px;height:400px; padding:5px;" data-options="closed:true">
	Cari : <input type="text" name="text_cari1" id="text_cari1" size="50"/>
	<div id="daftar_tglp"></div>
</div>
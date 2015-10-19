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
			url		: "<?php echo site_url(); ?>/decal_adju/DataDetail",
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
			url	: "<?php echo site_url(); ?>/decal_adju/simpan",
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
		window.open('<?php echo site_url();?>/decal_adju/cetak/'+kode);
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


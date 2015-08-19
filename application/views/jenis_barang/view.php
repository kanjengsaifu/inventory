<script type="text/javascript">
var url;
function tambah(){
	jQuery('#dialog-form').dialog('open').dialog('setTitle','Tambah Data');
	jQuery('#form').form('clear');
}
function simpan(){

	var jenis = $("#jenis").val();
	
	var string = $("#form").serialize();
	
	//alert(string);
	
	if(jenis.length==0){
		$.messager.show({
			title:'Info',
			msg:'Maaf, Jenis tidak boleh kosong',
			timeout:2000,
			showType:'slide'
		});
		$("#jenis").focus();
		return false();
	}
	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url('jenis_barang/simpan'); ?>",
		data	: string,
		success	: function(data){
			$.messager.show({
				title:'Info',
				msg:data, //'Password Tidak Boleh Kosong.',
				timeout:2000,
				showType:'slide'
			});
			$('#datagrid-crud').datagrid('reload');
			$('#dialog-form').dialog('close');
		}
	});
	return false();
}
function edit(){
	var row = $('#datagrid-crud').datagrid('getSelected');
	if(row){
		$('#dialog-form').dialog('open').dialog('setTitle','Edit Data');
		$('#form').form('load',row);
	}
}
function hapus(){  
	var row = $('#datagrid-crud').datagrid('getSelected');  
	if (row){  
		$.messager.confirm('Confirm','Apakah Anda akan menghapus data ini ?',function(r){  
			if (r){  
				$.ajax({
					type	: "POST",
					url		: "<?php echo site_url('jenis_barang/hapus'); ?>",
					data	: 'id='+row.id_jenis,
					success	: function(data){
						$.messager.show({
							title:'Info',
							msg:data,
							timeout:2000,
							showType:'slide'
						});
						$('#datagrid-crud').datagrid('reload');
					}
				});  
			}  
		});  
	}  
} 
function doSearch(value){  
	$('#datagrid-crud').datagrid('load',{    
        cari: value //$('#productid').val()  
    });  
}  
</script>
<!-- Data Grid -->
<table id="datagrid-crud" title="Daftar <?php echo $judul;?>" class="easyui-datagrid" style="width:auto; height: auto;" url="<?php echo site_url('jenis_barang/view'); ?>?grid=true" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true">
	<thead>
		<tr>
			<th field="id_jenis" width="10" sortable="true">ID</th>
			<th field="jenis" width="50" sortable="true">Jenis</th>
		</tr>
	</thead>
</table>

<!-- Toolbar -->
<div id="toolbar" >
<table cellpadding="0" cellspacing="0" style="width:100%">
<tr>
	<td style="padding-left:2px;"> 
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambah()">Tambah</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()">Edit </a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus()">Hapus</a>
    <a href="<?php echo base_url();?>index.php/jenis_barang" class="easyui-linkbutton" iconCls="icon-reload" plain="true">Refresh</a>
    </td>
    <td style="text-align:right; padding-right:2px;">
	<input id="cari" class="easyui-searchbox" data-options="prompt:'Pencarian data..',searcher:doSearch" style="width:200px"></input> 
    </td>
</tr>    
</table>
</div>                

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:400px; height:200px; padding: 10px 20px" closed="true" buttons="#dialog-buttons" data-options="modal:true">
	<form id="form" method="post" novalidate>
		<div class="form-item">
			<label for="type">ID</label><br />
			<input type="text" name="id_jenis" id="id_jenis" class="easyui-validatebox" required="true" size="5" maxlength="3" />
		</div>
        <div class="form-item">
			<label for="type">Jenis Barang</label><br />
			<input type="text" name="jenis" id="jenis" class="easyui-validatebox" required="true" size="40" maxlength="40" />
		</div>
	</form>
</div>

<!-- Dialog Button -->
<div id="dialog-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="simpan()">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
</div>

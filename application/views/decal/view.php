<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/decal/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>index.php/decal">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div id="gird" style="float:left; width:100%;">
<script type="text/javascript">
    $(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [
                        { name: 'id' },
                        { name: 'buyer' },
                        { name: 'nama' },
                        { name: 'alias' },
                        { name: 'dekorasi' },
                        { name: 'size' },
                        { name: 'satuan' },
                        { name: 'jenis' },
                        { name: 'tgl_insert' },
                        { name: 'tgl_update' }
        ],
        url: '<?php echo base_url().'index.php/decal/ldg'?>'
    };
    
    var button_renderer = function (row, columnfield, value, defaulthtml, columnproperties) {
            var id = $('#jqxgrid').jqxGrid('getcelltext', row, "id");
            var button = '<center><a class="btn btn-xs btn-primary" href="'+ '<?php echo base_url('index.php/decal/edit'); ?>' +'/'+ id +'">Ubah</a>\n\
            <a class="btn btn-xs btn-primary" href="'+ '<?php echo base_url('index.php/decal/hapus'); ?>' +'/'+ id +'">Hapus</a></center>';
            return button;
        };
    
    $("#jqxgrid").jqxGrid({
        width: '100%',
        height: 480,
        source: source,
        pagesize: 15,
        pageable: true,
        sortable: true,
        columnsresize: true,
        filterable: true,
        showtoolbar: true,
        showstatusbar: true,
        statusbarheight: 25,
        pagesizeoptions: ['15', '30', '90', '100'],
        columns: [
                        { text: 'Aksi', align: 'center', datafield: 'edit', filterable: false, width: 150,
                          cellsalign: 'center', cellsrenderer: button_renderer, editable: false, exportable: false },
                        { text: 'Kode Decal', datafield: 'id', width: 90 },
                        { text: 'Buyer', datafield: 'buyer', width: 110 },
                        { text: 'Nama Decal', datafield: 'nama', width: 50 },
                        { text: 'Alias', datafield: 'alias', width: 100 },
                        { text: 'Jenis Dekorasi', datafield: 'dekorasi', width: 130 },
                        { text: 'Ukuran Kertas', datafield: 'size', width: 130 },
                        { text: 'Tanggal Insert', datafield: 'tgl_insert', width: 90 },
                        { text: 'Tanggal Update', datafield: 'tgl_update', width: 70 }
        ]
    });
});
</script>
<div id="jqxgrid"></div>
</div>
</div>
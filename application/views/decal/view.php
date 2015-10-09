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
                        { name: 'nama' },
                        { name: 'alias' },
                        { name: 'buyer' },
                        { name: 'material' },
                        { name: 'forming' },
                        { name: 'shape' },
                        { name: 'item' },
                        { name: 'dekorasi' },
                        { name: 'size' },
                        { name: 'satuan' },
                        { name: 'jenis' },
                        { name: 'status' }
        ],
        url: '<?php echo base_url().'index.php/decal/ldg'?>'
    };
    
    var button_renderer = function (row, columnfield, value, defaulthtml, columnproperties) {
            var id = $('#jqxgrid').jqxGrid('getcelltext', row, "id");
            var button = '<a class="btn btn-xs btn-primary" href="'+ '<?php echo base_url('index.php/decal/edit'); ?>' +'/'+ id +'">Ubah Data</a>';
            return button;
        };
    
    $("#jqxgrid").jqxGrid({
        width: '100%',
        height: 480,
        source: source,
        editable: true,
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
                        { text: 'Kode Decal', datafield: 'id', width: 90 },
                        { text: 'Nama Decal', datafield: 'nama', width: 110 },
                        { text: 'Alias', datafield: 'alias', width: 50 },
                        { text: 'Nama Buyer', datafield: 'buyer', width: 130 },
                        { text: 'Material', datafield: 'material', width: 90 },
                        { text: 'Forming', datafield: 'forming', width: 70 },
                        { text: 'Shape', datafield: 'shape', width: 55 },
                        { text: 'Item', datafield: 'item', width: 200 },
                        { text: 'Dekorasi', datafield: 'dekorasi', width: 70 },
                        { text: 'Ukuran', datafield: 'size', width: 80 },
                        { text: 'Satuan', datafield: 'satuan', width: 70 },
                        { text: 'Jenis', datafield: 'jenis', width: 100 },
                        { text: 'Status', datafield: 'status', width: 100 },
                        { text: 'Edit', align: 'center', datafield: 'edit', filterable: false, width: 100,
                            cellsalign: 'center', cellsrenderer: button_renderer, editable: false, exportable: false }
        ]
    });
});
</script>
<div id="jqxgrid"></div>
</div>
</div>
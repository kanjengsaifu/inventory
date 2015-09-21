<div id="gird" style="float:left; width:100%;">
<script type="text/javascript">
    $(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [
                        { name: 'id_glasir' },
                        { name: 'nama_glasir' },
                        { name: 'nama_alias' },
                        { name: 'satuan' },
                        { name: 'status' },
                        { name: 'inputer' },
                        { name: 'tgl_input' },
                        { name: 'tgl_update' },
        ],
        url: '<?php echo base_url().'index.php/glasir/ldg'?>'
    };
    $("#jqxgrid").jqxGrid({
        width: '100%',
        height: 490,
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
                        { text: 'ID Glasir', datafield: 'id_glasir', width: 80 },
                        { text: 'Nama Glasir', datafield: 'nama_glasir', width: 250 },
                        { text: 'Nama Alias Glasir', datafield: 'nama_alias', width: 250 },
                        { text: 'Satuan', datafield: 'satuan', width: 100 },
                        { text: 'Status', datafield: 'status', width: 60 },
                        { text: 'Inputer', datafield: 'inputer', width: 60 },
                        { text: 'Tgl. Input', datafield: 'tgl_input', width: 160 },
                        { text: 'Tgl. Update', datafield: 'tgl_update', width: 160 }
        ]
    });
});
</script>
<div id="jqxgrid"></div>
</div>   
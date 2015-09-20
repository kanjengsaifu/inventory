<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/glasir/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>index.php/glasir">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/glasir">
Cari Kode & Nama Glasir : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<?php   
    $url_load_data = "index.php/glasir/ldg";
?>
<script type="text/javascript">
        $(document).ready(function () {
            var data_url = "<?php echo base_url( $url_load_data ); ?>";
            // prepare the data
            
            var source = {
            datatype: "json",
            datafields: [
                    { 
                        name: 'id_glasir', 
                        type: 'string'
                    },
                    { 
                        name: 'nama_glasir', 
                        type: 'string' 
                    },
                    { 
                        name: 'nama_alias', 
                        type: 'string' 
                    },
                    { 
                        name: 'satuan', 
                        type: 'date' 
                    },
                    { 
                        name: 'status', 
                        type: 'string'
                    },
                    { 
                        name: 'inputer', 
                        type: 'string' 
                    },
                    { 
                        name: 'tgl_input', 
                        type: 'date' 
                    },
                    { 
                        name: 'tgl_update', 
                        type: 'date' 
                    }

            ],
            id: 'id_glasir',
            url: data_url,
            filter: function(){
                // update the grid and send a request to the server.
                $("#data_list").jqxGrid('updatebounddata', 'filter');
            },
            cache: false,
            deleterow: function (rowid, commit) {

                var result = confirm("Yakin menghapus data ini?");
                if (result) {
                    //Logic to delete the item
                    // synchronize with the server - send delete command
                    var data = "id_glasir=" + rowid;
                    $.ajax({
                        dataType: 'json',
                        url: '<?php echo base_url().'index.php/glasir/delete'?>',
                        cache: false,
                        data: data,
                        success: function (data, status, xhr) {
                            // delete command is executed.
                            if ( data == '1') {

                                commit(true);
                                //alert("Data berhasil dihapus");

                            } else {

                                commit(false);
                                //alert("Data gagal dihapus");

                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            commit(false);
                            alert("Data gagal dihapus");
                        }
                    });
                }

            }
        };
        
        var dataAdapter = new $.jqx.dataAdapter(source, {
            downloadComplete: function (data, status, xhr) { },
            loadComplete: function (data) { },
            loadError: function (xhr, status, error) { }
        });

        var button_renderer = function (row, columnfield, value, defaulthtml, columnproperties) {
            // var rowID = $('#data_list').jqxGrid('getrowid', editrow);
            var status = $('#data_list').jqxGrid('getcelltext', row, "status");
            var id_glasir = $('#data_list').jqxGrid('getcelltext', row, "id_glasir");

            if (status == "completed") {
                var button = '';
            } else {
                var button = '<a class="btn btn-xs btn-primary" href="'+ '<?php echo base_url().'index.php/glasir/edit'?>' +'?id_glasir='+ id_glasir +'">Ubah Data</a>';
            }
            
            return button;
        };
        
        // initialize jqxGrid
        $("#data_list").jqxGrid({
            width: '1000',
            source: dataAdapter,                
            pageable: true,
            sortable: true,
            columnsresize: true,
            showfilterrow: true,
            filterable: true,
            showtoolbar: true,
            showaggregates: true,
            showstatusbar: true,
            statusbarheight: 25,
            pagesizeoptions: ['10', '25', '50', '100'],

            rendertoolbar: function (toolbar) {
                var me = this;
                var container = $("<div style='margin: 5px;'></div>");
                toolbar.append(container);
                <?php if(in_array('write', explode(',', $this->session->userdata('access')))) : ?>
                container.append('<button class="btn btn-sm btn-danger" id="deleterowbutton">Hapus baris yang dipilih</button>');
                <?php endif ?>
                $("#deleterowbutton").jqxButton();
            
                // delete row.
                $("#deleterowbutton").bind('click', function () {
                    var selectedrowindex = $("#data_list").jqxGrid('getselectedrowindex');
                    var rowscount = $("#data_list").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#data_list").jqxGrid('getrowid', selectedrowindex);
                        var datarow = $("#data_list").jqxGrid('getrowdata', selectedrowindex);
                        $("#data_list").jqxGrid('deleterow', id);
                    }
                });
            },
            
            columns: [
                { 
                    text: 'Kode Glaze', 
                    datafield: 'id_glasir', 
                    align: 'center',
                    width: 40,
                    cellsalign: 'center'
                },
                { 
                    text: 'Nama Glaze', 
                    datafield: 'nama_glasir', 
                    align: 'center',
                    width: 40,
                    cellsalign: 'center'
                },
                { 
                    text: 'Satuan', 
                    datafield: 'satuan', 
                    align: 'center',
                    width: 40,
                    cellsalign: 'center'
                },
                { 
                    text: 'Status', 
                    datafield: 'status', 
                    align: 'center',
                    width: 40,
                    cellsalign: 'center'
                },
                { 
                    text: 'Inputer', 
                    datafield: 'inputer', 
                    align: 'center',
                    width: 40,
                    cellsalign: 'center'
                },
                { 
                    text: 'Tanggal Input', 
                    datafield: 'tgl_input', 
                    filtertype: 'date', 
                    align: 'center',
                    width: 100,
                    filterable: false, 
                    cellsalign: 'center',
                    cellsformat: 'dd-MM-yyyy',
                    
                },
                { 
                    text: 'Tanggal Update', 
                    datafield: 'tgl_update', 
                    filtertype: 'date', 
                    align: 'center',
                    width: 100,
                    filterable: false, 
                    cellsalign: 'center',
                    cellsformat: 'dd-MM-yyyy',
                    
                }    
            ],
        });
        
        });
    </script>
</head>
<body>
<div id="data_list"></div>
</body>
</div>
</div>
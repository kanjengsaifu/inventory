<div id="view">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>index.php/decal/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Decal</button>
</a>
<a href="<?php echo base_url();?>index.php/decal">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div id="gird" style="float:left; width:100%;">
<head>
   <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'string'},
                    { name: 'nama', type: 'string'},
                    { name: 'buyer', type: 'string'},
                    { name: 'dekorasi', type: 'string'},
                    { name: 'size', type: 'string'},
                    { name: 'satuan', type: 'string'},
                    { name: 'jenis', type: 'string'}
                ],
		id: 'id',
                url: '<?php echo base_url().'index.php/decal/ldg'?>',
		root: 'Rows',
		cache: false,
                beforeprocessing: function (data) {
                    source.totalrecords = data[0].TotalRows;
                },
				sort: function()
				{
					$("#jqxgrid").jqxGrid('updatebounddata', 'sort');
				}				
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
			
			var initrowdetails = function (index, parentElement, gridElement) {      
			var row = index;
			var id = $("#jqxgrid").jqxGrid('getrowdata', row)['id'];
			var grid = $($(parentElement).children()[0]);
            
				var source =
				{
					url: '<?php echo base_url().'index.php/decal/ldg'?>',
					dataType: 'json',
					data: {id: id},
					datatype: "json",
					cache: false,
					datafields: [
						 { name: 'parent_id' },
						 { name: 'item' },
						 { name: 'isi_motif' },
						 { name: 'warna' },
						 { name: 'position' }
					],
					root: 'Rows',
					beforeprocessing: function (data) {
						source.totalrecords = data[0].TotalRows;
					},     
					sort: function()
					{
						grid.jqxGrid('updatebounddata', 'sort');
					}
 				};
				var adapter = new $.jqx.dataAdapter(source);

				// init Orders Grid
				grid.jqxGrid(
				{
					virtualmode: true,
					height: 200,
					width: '90%',
					sortable: true,
					pageable: true,
					pagesize: 15,
					source: adapter,
					theme: 'classic',
					rendergridrows: function (obj) {
						return obj.data;
					},
					columns: [
						  { text: 'No', datafield: 'position', width: 50 },
						  { text: 'Nama Item', datafield: 'item', width: 400 },
						  { text: 'Komposisi', datafield: 'isi_motif', width: 180 },
						  { text: 'Banyak Warna', datafield: 'warna', width: 150 }
					  ]
				});					
			};
			  
			// set rows details.
            $("#jqxgrid").bind('bindingcomplete', function (event) {
                if (event.target.id == "jqxgrid") {
                    $("#jqxgrid").jqxGrid('beginupdate');
                    var datainformation = $("#jqxgrid").jqxGrid('getdatainformation');
                    for (i = 0; i < datainformation.rowscount; i++) {
                        $("#jqxgrid").jqxGrid('setrowdetails', i, "<div id='grid" + i + "' style='margin: 10px;'></div>", 220, true);
                    }
                    $("#jqxgrid").jqxGrid('resumeupdate');
                }
            });
            
            var button_renderer = function (row, columnfield, value, defaulthtml, columnproperties) {
            var id = $('#jqxgrid').jqxGrid('getcelltext', row, "id");
            var button = '<center><a class="btn btn-xs btn-primary" href="'+ '<?php echo base_url('index.php/decal/edit'); ?>' +'/'+ id +'">Ubah</a>\n\
            <a class="btn btn-xs btn-primary" href="'+ '<?php echo base_url('index.php/decal/hapus'); ?>' +'/'+ id +'">Hapus</a></center>';
            return button;
            };
			
            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height: 480,
                source: dataAdapter,
                theme: 'classic',
		pageable: true,
		sortable: true,
		autoheight: true,
                virtualmode: true,
                rowdetails: true,
                pagesize: 15,
                initrowdetails: initrowdetails,
                rendergridrows: function () {
                    return dataAdapter.records;
                },				
                columns: [
                  { text: 'Aksi', align: 'center', datafield: 'edit', filterable: false, width: 150,
                  cellsalign: 'center', cellsrenderer: button_renderer, editable: false, exportable: false },  
                  { text: 'ID Decal', datafield: 'id', width: 70},
                  { text: 'Jenis', datafield: 'jenis', width: 100 },
                  { text: 'Nama Desain', datafield: 'nama', width: 330 },
                  { text: 'Buyer', datafield: 'buyer', width: 180 },
                  { text: 'Dekorasi', datafield: 'dekorasi', width: 100 },
                  { text: 'Ukuran Kertas', datafield: 'size', width: 120 },
                  { text: 'Satuan', datafield: 'satuan', width: 100 }
              ]
            });        	
        });
    </script>
</head>
<body class='default'>
   <div id="jqxgrid"></div>
</body>
</div>
</div>
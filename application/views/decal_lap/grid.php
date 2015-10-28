    <style>
        .column1 {
            background-color: #B2CEBC;
            color: white;
        }
        .column1a {
            background-color: #CCDED2;
            color: white;
        }
        .column1b {
            background-color: #E6EFE9;
            color: white;
        }
        .column2 {
            background-color: #005C1F;
            font-weight: bold;
        }
        .column3 {
            background-color: #B2C2F0;
            color: white;
        }
        .column3a {
            background-color: #CCD6F5;
            color: white;
        }
        .column3b {
            background-color: #E6EBFA;
            color: white;    
        }
        .column4 {
            background-color: #0033CC;
            font-weight: bold;
        }
        .column5 {
            background-color: #000000;
            font-weight: bold;
        }
    </style>
<div style='float: left;'>
     <input style="margin-top: 20px;" type="button" id='jqxButton1' value="Check All" />
     <input style="margin-top: 20px;" type="button" id='jqxButton2' value="Uncheck All" />
     <input type="button" value="Export to Excel" id='excelExport' />
</div>
<div id="gird" style="float:left; width:100%;">
<script type="text/javascript">
    $(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [
                        { name: 'id' , type: 'string' },
                        { name: 'nama' , type: 'string' },
                        { name: 'buyer' , type: 'string' },
                        //========================================
                        { name: 'Pkw1k' , type: 'number' },
                        { name: 'Pkw1s' , type: 'number' },
                        { name: 'Pkw1b' , type: 'number' },
                        { name: 'Pkw2k' , type: 'number' },
                        { name: 'Pkw2s' , type: 'number' },
                        { name: 'Pkw2b' , type: 'number' },
                        { name: 'Pkw3k' , type: 'number' },
                        { name: 'Pkw3s' , type: 'number' },
                        { name: 'Pkw3b' , type: 'number' },
                        //========================================
                        { name: 'Tkw1k' , type: 'number' },
                        { name: 'Tkw1s' , type: 'number' },
                        { name: 'Tkw1b' , type: 'number' },
                        { name: 'Tkw2k' , type: 'number' },
                        { name: 'Tkw2s' , type: 'number' },
                        { name: 'Tkw2b' , type: 'number' },
                        { name: 'Tkw3k' , type: 'number' },
                        { name: 'Tkw3s' , type: 'number' },
                        { name: 'Tkw3b' , type: 'number' },
                        //========================================
                        { name: 'Ukw1k' , type: 'number' },
                        { name: 'Ukw1s' , type: 'number' },
                        { name: 'Ukw1b' , type: 'number' },
                        { name: 'Ukw2k' , type: 'number' },
                        { name: 'Ukw2s' , type: 'number' },
                        { name: 'Ukw2b' , type: 'number' },
                        { name: 'Ukw3k' , type: 'number' },
                        { name: 'Ukw3s' , type: 'number' },
                        { name: 'Ukw3b' , type: 'number' },
                        //========================================
                        { name: 'Rkw1k' , type: 'number' },
                        { name: 'Rkw1s' , type: 'number' },
                        { name: 'Rkw1b' , type: 'number' },
                        { name: 'Rkw2k' , type: 'number' },
                        { name: 'Rkw2s' , type: 'number' },
                        { name: 'Rkw2b' , type: 'number' },
                        { name: 'Rkw3k' , type: 'number' },
                        { name: 'Rkw3s' , type: 'number' },
                        { name: 'Rkw3b' , type: 'number' },
                         //========================================
                        { name: 'RPkw1k' , type: 'number' },
                        { name: 'RPkw1s' , type: 'number' },
                        { name: 'RPkw1b' , type: 'number' },
                        { name: 'RPkw2k' , type: 'number' },
                        { name: 'RPkw2s' , type: 'number' },
                        { name: 'RPkw2b' , type: 'number' },
                        { name: 'RPkw3k' , type: 'number' },
                        { name: 'RPkw3s' , type: 'number' },
                        { name: 'RPkw3b' , type: 'number' },
                        //========================================
                        { name: 'Skw1kP' , type: 'number' },
                        { name: 'Skw1sP' , type: 'number' },
                        { name: 'Skw1bP' , type: 'number' },
                        { name: 'Skw2kP' , type: 'number' },
                        { name: 'Skw2sP' , type: 'number' },
                        { name: 'Skw2bP' , type: 'number' },
                        { name: 'Skw3kP' , type: 'number' },
                        { name: 'Skw3sP' , type: 'number' },
                        { name: 'Skw3bP' , type: 'number' },
                        { name: 'Skw1kT' , type: 'number' },
                        { name: 'Skw1sT' , type: 'number' },
                        { name: 'Skw1bT' , type: 'number' },
                        { name: 'Skw2kT' , type: 'number' },
                        { name: 'Skw2sT' , type: 'number' },
                        { name: 'Skw2bT' , type: 'number' },
                        { name: 'Skw3kT' , type: 'number' },
                        { name: 'Skw3sT' , type: 'number' },
                        { name: 'Skw3bT' , type: 'number' },
                        //========================================
                        { name: 'Fokw1kP' , type: 'number' },
                        { name: 'Fokw1sP' , type: 'number' },
                        { name: 'Fokw1bP' , type: 'number' },
                        { name: 'Fokw2kP' , type: 'number' },
                        { name: 'Fokw2sP' , type: 'number' },
                        { name: 'Fokw2bP' , type: 'number' },
                        { name: 'Fokw3kP' , type: 'number' },
                        { name: 'Fokw3sP' , type: 'number' },
                        { name: 'Fokw3bP' , type: 'number' },
                        { name: 'Fokw1kT' , type: 'number' },
                        { name: 'Fokw1sT' , type: 'number' },
                        { name: 'Fokw1bT' , type: 'number' },
                        { name: 'Fokw2kT' , type: 'number' },
                        { name: 'Fokw2sT' , type: 'number' },
                        { name: 'Fokw2bT' , type: 'number' },
                        { name: 'Fokw3kT' , type: 'number' },
                        { name: 'Fokw3sT' , type: 'number' },
                        { name: 'Fokw3bT' , type: 'number' }
        ],
        url: '<?php echo base_url().'index.php/decal_lap/loadStok'?>'
    };
    
    var cellsrendererx = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                if (value < 20) {
                    return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
                }
                else {
                    return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
                }
            }
    
    $("#jqxgrid").jqxGrid({
        width: '100%',
        height: 490,
        source: source,
        pagesize: 12,
        pageable: true,
        sortable: true,
        columnsresize: true,
        filterable: true,
        showtoolbar: true,
        showstatusbar: true,
        showaggregates: true,
        statusbarheight: 25,
        pagesizeoptions: ['12', '30', '90', '100'],
        columns: [
                        { text: 'Kode',  align: 'center',datafield: 'id', width: 60, pinned: true },
                        { text: 'Nama',  align: 'center',datafield: 'nama', width: 201, pinned: true },
                        { text: 'Buyer',  align: 'center',datafield: 'buyer', width: 100, pinned: true, hidden: true },
                        //GRAND TOTAL
                        {
                            cellclassname: 'column5', text: 'Grand <br>Total', align: 'center', editable: false, datafield: 'gtot', width: 80, pinned: true ,
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var Pstok_awal1 = parseFloat(rowdata.Fokw1kP) + parseFloat(rowdata.Fokw1sP)+ parseFloat(rowdata.Fokw1bP);
                                var Pstok_awal2 = parseFloat(rowdata.Fokw2kP) + parseFloat(rowdata.Fokw2sP)+ parseFloat(rowdata.Fokw2bP);
                                var Pstok_awal3 = parseFloat(rowdata.Fokw3kP) + parseFloat(rowdata.Fokw3sP)+ parseFloat(rowdata.Fokw3bP);
                                var Pscrap1 = parseFloat(rowdata.Skw3kP) + parseFloat(rowdata.Skw3sP)+ parseFloat(rowdata.Skw3bP);
                                var Pscrap2 = parseFloat(rowdata.Skw2kP) + parseFloat(rowdata.Skw2sP)+ parseFloat(rowdata.Skw2bP);
                                var Pscrap3 = parseFloat(rowdata.Skw1kP) + parseFloat(rowdata.Skw1sP)+ parseFloat(rowdata.Skw1bP);
                                var Pproduksi3 = parseFloat(rowdata.Pkw3k) + parseFloat(rowdata.Pkw3s)+ parseFloat(rowdata.Pkw3b);
                                var Pproduksi2 = parseFloat(rowdata.Pkw2k) + parseFloat(rowdata.Pkw2s)+ parseFloat(rowdata.Pkw2b);
                                var Pproduksi1 = parseFloat(rowdata.Pkw1k) + parseFloat(rowdata.Pkw1s)+ parseFloat(rowdata.Pkw1b);
                                var Pretur3 = parseFloat(rowdata.RPkw3k) + parseFloat(rowdata.RPkw3s)+ parseFloat(rowdata.RPkw3b);
                                var Pretur2 = parseFloat(rowdata.RPkw2k) + parseFloat(rowdata.RPkw2s)+ parseFloat(rowdata.RPkw2b);
                                var Pretur1 = parseFloat(rowdata.RPkw1k) + parseFloat(rowdata.RPkw1s)+ parseFloat(rowdata.RPkw1b);
                                var Transit3 = parseFloat(rowdata.Tkw3k) + parseFloat(rowdata.Tkw3s)+ parseFloat(rowdata.Tkw3b);
                                var Transit2 = parseFloat(rowdata.Tkw2k) + parseFloat(rowdata.Tkw2s)+ parseFloat(rowdata.Tkw2b);
                                var Transit1 = parseFloat(rowdata.Tkw1k) + parseFloat(rowdata.Tkw1s)+ parseFloat(rowdata.Tkw1b);
                                var Pstok_awal = Pstok_awal1+Pstok_awal2+Pstok_awal3;
                                var Pscrap = Pscrap1+Pscrap2+Pscrap3;
                                var Pproduksi = Pproduksi1+Pproduksi2+Pproduksi3;
                                var Transit = Transit1+Transit2+Transit3;
                                var Pretur = Pretur1+Pretur2+Pretur3;
                                var Ptotal = (Pstok_awal+Pproduksi+Pretur)-(Pscrap+Transit);
                                //===========================================================
                                var Tstok_awal1 = parseFloat(rowdata.Fokw1kT) + parseFloat(rowdata.Fokw1sT)+ parseFloat(rowdata.Fokw1bT);
                                var Tstok_awal2 = parseFloat(rowdata.Fokw2kT) + parseFloat(rowdata.Fokw2sT)+ parseFloat(rowdata.Fokw2bT);
                                var Tstok_awal3 = parseFloat(rowdata.Fokw3kT) + parseFloat(rowdata.Fokw3sT)+ parseFloat(rowdata.Fokw3bT);
                                var Tscrap3 = parseFloat(rowdata.Skw3kT) + parseFloat(rowdata.Skw3sT)+ parseFloat(rowdata.Skw3bT);
                                var Tscrap2 = parseFloat(rowdata.Skw2kT) + parseFloat(rowdata.Skw2sT)+ parseFloat(rowdata.Skw2bT);
                                var Tscrap1 = parseFloat(rowdata.Skw1kT) + parseFloat(rowdata.Skw1sT)+ parseFloat(rowdata.Skw1bT);
                                var Transit3 = parseFloat(rowdata.Tkw3k) + parseFloat(rowdata.Tkw3s)+ parseFloat(rowdata.Tkw3b);
                                var Transit2 = parseFloat(rowdata.Tkw2k) + parseFloat(rowdata.Tkw2s)+ parseFloat(rowdata.Tkw2b);
                                var Transit1 = parseFloat(rowdata.Tkw1k) + parseFloat(rowdata.Tkw1s)+ parseFloat(rowdata.Tkw1b);
                                var Used3 = parseFloat(rowdata.Ukw3k) + parseFloat(rowdata.Ukw3s)+ parseFloat(rowdata.Ukw3b);
                                var Used2 = parseFloat(rowdata.Ukw2k) + parseFloat(rowdata.Ukw2s)+ parseFloat(rowdata.Ukw2b);
                                var Used1 = parseFloat(rowdata.Ukw1k) + parseFloat(rowdata.Ukw1s)+ parseFloat(rowdata.Ukw1b);
                                var Used = Used1+Used2+Used3;
                                var Tretur3 = parseFloat(rowdata.Rkw3k) + parseFloat(rowdata.Rkw3s)+ parseFloat(rowdata.Rkw3b);
                                var Tretur2 = parseFloat(rowdata.Rkw2k) + parseFloat(rowdata.Rkw2s)+ parseFloat(rowdata.Rkw2b);
                                var Tretur1 = parseFloat(rowdata.Rkw1k) + parseFloat(rowdata.Rkw1s)+ parseFloat(rowdata.Rkw1b);
                                var Tstok_awal = Tstok_awal1+Tstok_awal2+Tstok_awal3;
                                var Tscrap = Tscrap1+Tscrap2+Tscrap3;
                                var Transit = Transit1+Transit2+Transit3;
                                var Tretur = Tretur1+Tretur2+Tretur3;
                                var Ttotal = (Tstok_awal+Transit+Tretur)-(Tscrap+Used);
                                var total = Ptotal+Ttotal;
                                
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #66FF33;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TOTAL KANTOR GLAZE
                        {
                            cellclassname: 'column4', text: 'Kantor <br>Glaze', align: 'center', editable: false, datafield: 'atd_tot', width: 75 ,  pinned: true , 
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var Tstok_awal1 = parseFloat(rowdata.Fokw1kT) + parseFloat(rowdata.Fokw1sT)+ parseFloat(rowdata.Fokw1bT);
                                var Tstok_awal2 = parseFloat(rowdata.Fokw2kT) + parseFloat(rowdata.Fokw2sT)+ parseFloat(rowdata.Fokw2bT);
                                var Tstok_awal3 = parseFloat(rowdata.Fokw3kT) + parseFloat(rowdata.Fokw3sT)+ parseFloat(rowdata.Fokw3bT);
                                var Tscrap3 = parseFloat(rowdata.Skw3kT) + parseFloat(rowdata.Skw3sT)+ parseFloat(rowdata.Skw3bT);
                                var Tscrap2 = parseFloat(rowdata.Skw2kT) + parseFloat(rowdata.Skw2sT)+ parseFloat(rowdata.Skw2bT);
                                var Tscrap1 = parseFloat(rowdata.Skw1kT) + parseFloat(rowdata.Skw1sT)+ parseFloat(rowdata.Skw1bT);
                                var Transit3 = parseFloat(rowdata.Tkw3k) + parseFloat(rowdata.Tkw3s)+ parseFloat(rowdata.Tkw3b);
                                var Transit2 = parseFloat(rowdata.Tkw2k) + parseFloat(rowdata.Tkw2s)+ parseFloat(rowdata.Tkw2b);
                                var Transit1 = parseFloat(rowdata.Tkw1k) + parseFloat(rowdata.Tkw1s)+ parseFloat(rowdata.Tkw1b);
                                var Used3 = parseFloat(rowdata.Ukw3k) + parseFloat(rowdata.Ukw3s)+ parseFloat(rowdata.Ukw3b);
                                var Used2 = parseFloat(rowdata.Ukw2k) + parseFloat(rowdata.Ukw2s)+ parseFloat(rowdata.Ukw2b);
                                var Used1 = parseFloat(rowdata.Ukw1k) + parseFloat(rowdata.Ukw1s)+ parseFloat(rowdata.Ukw1b);
                                var Used = Used1+Used2+Used3;
                                var Tretur3 = parseFloat(rowdata.Rkw3k) + parseFloat(rowdata.Rkw3s)+ parseFloat(rowdata.Rkw3b);
                                var Tretur2 = parseFloat(rowdata.Rkw2k) + parseFloat(rowdata.Rkw2s)+ parseFloat(rowdata.Rkw2b);
                                var Tretur1 = parseFloat(rowdata.Rkw1k) + parseFloat(rowdata.Rkw1s)+ parseFloat(rowdata.Rkw1b);
                                var Tstok_awal = Tstok_awal1+Tstok_awal2+Tstok_awal3;
                                var Tscrap = Tscrap1+Tscrap2+Tscrap3;
                                var Transit = Transit1+Transit2+Transit3;
                                var Tretur = Tretur1+Tretur2+Tretur3;
                                var total = (Tstok_awal+Transit+Tretur)-(Tscrap+Used);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #FFFFFF;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TOTAL PRODUKSI DECAL
                        {
                            cellclassname: 'column2', text: 'Produksi <br>Decal', align: 'center', editable: false, datafield: 'apd_tot', width: 75 ,  pinned: true ,
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var Pstok_awal1 = parseFloat(rowdata.Fokw1kP) + parseFloat(rowdata.Fokw1sP)+ parseFloat(rowdata.Fokw1bP);
                                var Pstok_awal2 = parseFloat(rowdata.Fokw2kP) + parseFloat(rowdata.Fokw2sP)+ parseFloat(rowdata.Fokw2bP);
                                var Pstok_awal3 = parseFloat(rowdata.Fokw3kP) + parseFloat(rowdata.Fokw3sP)+ parseFloat(rowdata.Fokw3bP);
                                var Pscrap1 = parseFloat(rowdata.Skw3kP) + parseFloat(rowdata.Skw3sP)+ parseFloat(rowdata.Skw3bP);
                                var Pscrap2 = parseFloat(rowdata.Skw2kP) + parseFloat(rowdata.Skw2sP)+ parseFloat(rowdata.Skw2bP);
                                var Pscrap3 = parseFloat(rowdata.Skw1kP) + parseFloat(rowdata.Skw1sP)+ parseFloat(rowdata.Skw1bP);
                                var Pproduksi3 = parseFloat(rowdata.Pkw3k) + parseFloat(rowdata.Pkw3s)+ parseFloat(rowdata.Pkw3b);
                                var Pproduksi2 = parseFloat(rowdata.Pkw2k) + parseFloat(rowdata.Pkw2s)+ parseFloat(rowdata.Pkw2b);
                                var Pproduksi1 = parseFloat(rowdata.Pkw1k) + parseFloat(rowdata.Pkw1s)+ parseFloat(rowdata.Pkw1b);
                                var Pretur3 = parseFloat(rowdata.RPkw3k) + parseFloat(rowdata.RPkw3s)+ parseFloat(rowdata.RPkw3b);
                                var Pretur2 = parseFloat(rowdata.RPkw2k) + parseFloat(rowdata.RPkw2s)+ parseFloat(rowdata.RPkw2b);
                                var Pretur1 = parseFloat(rowdata.RPkw1k) + parseFloat(rowdata.RPkw1s)+ parseFloat(rowdata.RPkw1b);
                                var Transit3 = parseFloat(rowdata.Tkw3k) + parseFloat(rowdata.Tkw3s)+ parseFloat(rowdata.Tkw3b);
                                var Transit2 = parseFloat(rowdata.Tkw2k) + parseFloat(rowdata.Tkw2s)+ parseFloat(rowdata.Tkw2b);
                                var Transit1 = parseFloat(rowdata.Tkw1k) + parseFloat(rowdata.Tkw1s)+ parseFloat(rowdata.Tkw1b);
                                var Pstok_awal = Pstok_awal1+Pstok_awal2+Pstok_awal3;
                                var Pscrap = Pscrap1+Pscrap2+Pscrap3;
                                var Pproduksi = Pproduksi1+Pproduksi2+Pproduksi3;
                                var Transit = Transit1+Transit2+Transit3;
                                var Pretur = Pretur1+Pretur2+Pretur3;
                                var total = (Pstok_awal+Pproduksi+Pretur)-(Pscrap+Transit);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #FFFFFF;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [RETUR KW1]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Rkw1k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd24',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Rkw1s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd24',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Rkw1b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd24',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Rkw1ksb', width: 75 , columngroup: 'apd24',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Rkw1k) + parseFloat(rowdata.Rkw1s)+ parseFloat(rowdata.Rkw1b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [RETUR KW2]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Rkw2k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd23',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Rkw2s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd23',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Rkw2b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd23',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Rkw2ksb', width: 75 , columngroup: 'apd23',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Rkw2k) + parseFloat(rowdata.Rkw2s)+ parseFloat(rowdata.Rkw2b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [RETUR KW3]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Rkw3k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd22',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Rkw3s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd22',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Rkw3b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd22',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Rkw3ksb', width: 75 , columngroup: 'apd22',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Rkw3k) + parseFloat(rowdata.Rkw3s)+ parseFloat(rowdata.Rkw3b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [USED KW1]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Ukw1k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd21',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Ukw1s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd21',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Ukw1b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd21',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Ukw1ksb', width: 75 , columngroup: 'apd21',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Ukw1k) + parseFloat(rowdata.Ukw1s)+ parseFloat(rowdata.Ukw1b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [USED KW2]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Ukw2k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd20',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Ukw2s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd20',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Ukw2b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd20',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Ukw2ksb', width: 75 , columngroup: 'apd20',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Ukw2k) + parseFloat(rowdata.Ukw2s)+ parseFloat(rowdata.Ukw2b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [USED KW3]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Ukw3k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd19',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Ukw3s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd19',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Ukw3b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd19',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Ukw3ksb', width: 75 , columngroup: 'apd19',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Ukw3k) + parseFloat(rowdata.Ukw3s)+ parseFloat(rowdata.Ukw3b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [TRANSIT KW1]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Tkw1k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd18',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Tkw1s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd18',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Tkw1b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd18',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Tkw1ksb', width: 75 , columngroup: 'apd18',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Tkw1k) + parseFloat(rowdata.Tkw1s)+ parseFloat(rowdata.Tkw1b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [TRANSIT KW2]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Tkw2k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd17',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Tkw2s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd17',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Tkw2b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd17',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Tkw2ksb', width: 75 , columngroup: 'apd17',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Tkw2k) + parseFloat(rowdata.Tkw2s)+ parseFloat(rowdata.Tkw2b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [TRANSIT KW3]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Tkw3k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd16',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Tkw3s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd16',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Tkw3b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd16',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Tkw3ksb', width: 75 , columngroup: 'apd16',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Tkw3k) + parseFloat(rowdata.Tkw3s)+ parseFloat(rowdata.Tkw3b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [SCRAP KW1]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Skw1kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd12',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Skw1sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd12',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Skw1bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd12',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Skw1ksbT', width: 75 , columngroup: 'apd12',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Skw1kT) + parseFloat(rowdata.Skw1sT)+ parseFloat(rowdata.Skw1bT);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [SCRAP KW2]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Skw2kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd11',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Skw2sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd11',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Skw2bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd11',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Skw2ksbT', width: 75 , columngroup: 'apd11',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Skw2kT) + parseFloat(rowdata.Skw2sT)+ parseFloat(rowdata.Skw2bT);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [SCRAP KW3]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Skw3kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd10',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Skw3sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd10',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Skw3bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd10',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column1',text: 'Sub Total', align: 'center', editable: false, datafield: 'Skw3ksbT', width: 75 , columngroup: 'apd10',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Skw3kT) + parseFloat(rowdata.Skw3sT)+ parseFloat(rowdata.Skw3bT);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [STOK AWAL KW1]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Fokw1kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Fokw1sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Fokw1bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd4',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column1', text: 'Sub Total', align: 'center', editable: false, datafield: 'Fokw1ksbT', width: 75 , columngroup: 'apd4',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Fokw1kT) + parseFloat(rowdata.Fokw1sT)+ parseFloat(rowdata.Fokw1bT);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [STOK AWAL KW2]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Fokw2kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Fokw2sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Fokw2bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd5',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column1', text: 'Sub Total', align: 'center', editable: false, datafield: 'Fokw2ksbT', width: 75 , columngroup: 'apd5',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Fokw2kT) + parseFloat(rowdata.Fokw2sT)+ parseFloat(rowdata.Fokw2bT);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [STOK AWAL KW3]
                        { hidden: true , cellclassname: 'column1a', text: '[Sml]',  align: 'center',datafield: 'Fokw3kT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Med]',  align: 'center',datafield: 'Fokw3sT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column1a', text: '[Big]',  align: 'center',datafield: 'Fokw3bT', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd6',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column1', text: 'Sub Total', align: 'center', editable: false, datafield: 'Fokw3ksbT', width: 75 , columngroup: 'apd6',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Fokw3kT) + parseFloat(rowdata.Fokw3sT)+ parseFloat(rowdata.Fokw3bT);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [RETUR KW1]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'RPkw1k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd27',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'RPkw1s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd27',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'RPkw1b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd27',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'RPkw1ksb', width: 75 , columngroup: 'apd27',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.RPkw1k) + parseFloat(rowdata.RPkw1s)+ parseFloat(rowdata.RPkw1b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [RETUR KW2]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'RPkw2k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd26',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'RPkw2s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd26',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'RPkw2b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd26',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'RPkw2ksb', width: 75 , columngroup: 'apd26',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.RPkw2k) + parseFloat(rowdata.RPkw2s)+ parseFloat(rowdata.RPkw2b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA KANTOR GLAZE [RETUR KW3]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'RPkw3k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd25',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'RPkw3s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd25',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'RPkw3b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd25',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'RPkw3ksb', width: 75 , columngroup: 'apd25',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.RPkw3k) + parseFloat(rowdata.RPkw3s)+ parseFloat(rowdata.RPkw3b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI [PRODUKSI KW1]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Pkw1k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd15',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Pkw1s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd15',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Pkw1b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd15',cellsformat: 'd2', width: 60 },
                        {
                           hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'Pkw1ksb', width: 75 , columngroup: 'apd15',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Pkw1k) + parseFloat(rowdata.Pkw1s)+ parseFloat(rowdata.Pkw1b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Pkw2k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd14',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Pkw2s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd14',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Pkw2b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd14',cellsformat: 'd2', width: 60 },
                        //TRANSAKSI DETAIL AREA PRODUKSI [PRODUKSI KW2]
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'Pkw2ksb', width: 75 , columngroup: 'apd14',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Pkw2k) + parseFloat(rowdata.Pkw2s)+ parseFloat(rowdata.Pkw2b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Pkw3k', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd13',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Pkw3s', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd13',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Pkw3b', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd13',cellsformat: 'd2', width: 60 },
                        //TRANSAKSI DETAIL AREA PRODUKSI [PRODUKSI KW3]
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'Pkw3ksb', width: 75 , columngroup: 'apd13',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Pkw3k) + parseFloat(rowdata.Pkw3s)+ parseFloat(rowdata.Pkw3b);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI [SCRAP KW1]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Skw1kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd9',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Skw1sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd9',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Skw1bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd9',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'Skw1ksbP', width: 75 , columngroup: 'apd9',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Skw1kP) + parseFloat(rowdata.Skw1sP)+ parseFloat(rowdata.Skw1bP);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI [SCRAP KW2]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Skw2kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd8',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Skw2sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd8',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Skw2bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd8',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'Skw2ksbP', width: 75 , columngroup: 'apd8',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Skw2kP) + parseFloat(rowdata.Skw2sP)+ parseFloat(rowdata.Skw2bP);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI [SCRAP KW3]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Skw3kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd7',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Skw3sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd7',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Skw3bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd7',cellsformat: 'd2', width: 60 },
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'Skw3ksbP', width: 75 , columngroup: 'apd7',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Skw3kP) + parseFloat(rowdata.Skw3sP)+ parseFloat(rowdata.Skw3bP);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI [STOK AWAL KW1]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Fokw1kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Fokw1sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Fokw1bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd1',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column3',text: 'Sub Total', align: 'center', editable: false, datafield: 'Fokw1ksbP', width: 75 , columngroup: 'apd1',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Fokw1kP) + parseFloat(rowdata.Fokw1sP)+ parseFloat(rowdata.Fokw1bP);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI [STOK AWAL KW2]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Fokw2kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Fokw2sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Fokw2bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd2',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column3', text: 'Sub Total', align: 'center', editable: false, datafield: 'Fokw2ksbP', width: 75 , columngroup: 'apd2',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Fokw2kP) + parseFloat(rowdata.Fokw2sP)+ parseFloat(rowdata.Fokw2bP);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        },
                        //TRANSAKSI DETAIL AREA PRODUKSI [STOK AWAL KW3]
                        { hidden: true , cellclassname: 'column3b', text: '[Sml]',  align: 'center',datafield: 'Fokw3kP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Med]',  align: 'center',datafield: 'Fokw3sP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60 },
                        { hidden: true , cellclassname: 'column3b', text: '[Big]',  align: 'center',datafield: 'Fokw3bP', cellsrenderer: cellsrendererx, cellsalign: 'right', columngroup: 'apd3',cellsformat: 'd2', width: 60},
                        {
                            hidden: true , cellclassname: 'column3', text: 'Sub Total', align: 'center', editable: false, datafield: 'Fokw3ksbP', width: 75 , columngroup: 'apd3',
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total = parseFloat(rowdata.Fokw3kP) + parseFloat(rowdata.Fokw3sP)+ parseFloat(rowdata.Fokw3bP);
                                if (total < 10) {
                                    return "<div style='margin: 4px; color: #ff0000;' class='jqx-right-align'>" + total + "</div>";
                                }
                                else {
                                    return "<div style='margin: 4px; color: #008000;' class='jqx-right-align'>" + total + "</div>";
                                }
                            }
                        }
        ],
        columngroups: [
                    { text: 'Area Produksi Decal', align: 'center', name: 'header1' },
                    { text: 'Retur [KW 1]', align: 'center', name: 'apd27' , parentgroup: 'header1'},
                    { text: 'Retur [KW 2]', align: 'center', name: 'apd26' , parentgroup: 'header1'},
                    { text: 'Retur [KW 3]', align: 'center', name: 'apd25' , parentgroup: 'header1'},
                    { text: 'Produksi [KW 1]', align: 'center', name: 'apd15' , parentgroup: 'header1'},
                    { text: 'Produksi [KW 2]', align: 'center', name: 'apd14' , parentgroup: 'header1'},
                    { text: 'Produksi [KW 3]', align: 'center', name: 'apd13' , parentgroup: 'header1'},
                    { text: 'Scrap [KW 1]', align: 'center', name: 'apd9' , parentgroup: 'header1'},
                    { text: 'Scrap [KW 2]', align: 'center', name: 'apd8' , parentgroup: 'header1'},
                    { text: 'Scrap [KW 3]', align: 'center', name: 'apd7' , parentgroup: 'header1'},
                    { text: 'Stok Awal [KW 1]', align: 'center', name: 'apd1' , parentgroup: 'header1'},
                    { text: 'Stok Awal [KW 2]', align: 'center', name: 'apd2' , parentgroup: 'header1'},
                    { text: 'Stok Awal [KW 3]', align: 'center', name: 'apd3' , parentgroup: 'header1'},
                    //======================================================================================
                    { text: 'Area Transit Decal', align: 'center', name: 'header2' },
                    { text: 'Pemakaian [KW 1]', align: 'center', name: 'apd21' , parentgroup: 'header2'},
                    { text: 'Pemakaian [KW 2]', align: 'center', name: 'apd20' , parentgroup: 'header2'},
                    { text: 'Pemakaian [KW 3]', align: 'center', name: 'apd19' , parentgroup: 'header2'},
                    { text: 'Retur [KW 1]', align: 'center', name: 'apd24' , parentgroup: 'header2'},
                    { text: 'Retur [KW 2]', align: 'center', name: 'apd23' , parentgroup: 'header2'},
                    { text: 'Retur [KW 3]', align: 'center', name: 'apd22' , parentgroup: 'header2'},
                    { text: 'Transit [KW 1]', align: 'center', name: 'apd18' , parentgroup: 'header2'},
                    { text: 'Transit [KW 2]', align: 'center', name: 'apd17' , parentgroup: 'header2'},
                    { text: 'Transit [KW 3]', align: 'center', name: 'apd16' , parentgroup: 'header2'},
                    { text: 'Scrap [KW 1]', align: 'center', name: 'apd12' , parentgroup: 'header2'},
                    { text: 'Scrap [KW 2]', align: 'center', name: 'apd11' , parentgroup: 'header2'},
                    { text: 'Scrap [KW 3]', align: 'center', name: 'apd10' , parentgroup: 'header2'},
                    { text: 'Stok Awal [KW 1]', align: 'center', name: 'apd4' , parentgroup: 'header2'},
                    { text: 'Stok Awal [KW 2]', align: 'center', name: 'apd5' , parentgroup: 'header2'},
                    { text: 'Stok Awal [KW 3]', align: 'center', name: 'apd6' , parentgroup: 'header2'}
                ]
    });
    var listSource = [  { label: 'Kode', value: 'id', checked: true }, 
                        { label: 'Nama', value: 'nama', checked: true }, 
                        { label: 'Buyer', value: 'buyer', checked: false },
                        { label: 'Grand Total', value: 'gtot', checked: true },
                        { value: 'atd_tot' , label: 'KGtot', checked: true  },
                        { value: 'apd_tot' , label: 'PDtot', checked: true  },
                        //AREA KANTOR GLAZE
                        //=======================================================
                        //=======================================================
                        { value: 'Rkw1k' , label: 'RKW1k', checked: false  },
                        { value: 'Rkw1s' , label: 'RKW1s', checked: false  },
                        { value: 'Rkw1b' , label: 'RKW1b', checked: false  },
                        { value: 'Rkw1ksb' , label: 'RKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Rkw2k' , label: 'RKW2k', checked: false  },
                        { value: 'Rkw2s' , label: 'RKW2s', checked: false  },
                        { value: 'Rkw2b' , label: 'RKW2b', checked: false  },
                        { value: 'Rkw2ksb' , label: 'RKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Rkw3k' , label: 'RKW3k', checked: false  },
                        { value: 'Rkw3s' , label: 'RKW3s', checked: false  },
                        { value: 'Rkw3b' , label: 'RKW3b', checked: false  },
                        { value: 'Rkw3ksb' , label: 'RKW3ksb', checked: false  },
                        //=======================================================
                        { value: 'Ukw1k' , label: 'UKW1k', checked: false  },
                        { value: 'Ukw1s' , label: 'UKW1s', checked: false  },
                        { value: 'Ukw1b' , label: 'UKW1b', checked: false  },
                        { value: 'Ukw1ksb' , label: 'UKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Ukw2k' , label: 'UKW2k', checked: false  },
                        { value: 'Ukw2s' , label: 'UKW2s', checked: false  },
                        { value: 'Ukw2b' , label: 'UKW2b', checked: false  },
                        { value: 'Ukw2ksb' , label: 'UKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Ukw3k' , label: 'UKW3k', checked: false  },
                        { value: 'Ukw3s' , label: 'UKW3s', checked: false  },
                        { value: 'Ukw3b' , label: 'UKW3b', checked: false  },
                        { value: 'Ukw3ksb' , label: 'UKW3ksb', checked: false  },
                        //=======================================================
                        { value: 'Tkw1k' , label: 'TKW1k', checked: false  },
                        { value: 'Tkw1s' , label: 'TKW1s', checked: false  },
                        { value: 'Tkw1b' , label: 'TKW1b', checked: false  },
                        { value: 'Tkw1ksb' , label: 'TKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Tkw2k' , label: 'TKW2k', checked: false  },
                        { value: 'Tkw2s' , label: 'TKW2s', checked: false  },
                        { value: 'Tkw2b' , label: 'TKW2b', checked: false  },
                        { value: 'Tkw2ksb' , label: 'TKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Tkw3k' , label: 'TKW3k', checked: false  },
                        { value: 'Tkw3s' , label: 'TKW3s', checked: false  },
                        { value: 'Tkw3b' , label: 'TKW3b', checked: false  },
                        { value: 'Tkw3ksb' , label: 'TKW3ksb', checked: false  },
                        //=======================================================
                        { value: 'Skw1kT' , label: 'STKW1k', checked: false  },
                        { value: 'Skw1sT' , label: 'STKW1s', checked: false  },
                        { value: 'Skw1bT' , label: 'STKW1b', checked: false  },
                        { value: 'Skw1ksbT' , label: 'STKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Skw2kT' , label: 'STKW2k', checked: false  },
                        { value: 'Skw2sT' , label: 'STKW2s', checked: false  },
                        { value: 'Skw2bT' , label: 'STKW2b', checked: false  },
                        { value: 'Skw2ksbT' , label: 'STKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Skw3kT' , label: 'STKW3k', checked: false  },
                        { value: 'Skw3sT' , label: 'STKW3s', checked: false  },
                        { value: 'Skw3bT' , label: 'STKW3b', checked: false  },
                        { value: 'Skw3ksbT' , label: 'STKW3ksb', checked: false  },
                        //=======================================================
                        { value: 'Fokw1kT' , label: 'SATKW1k', checked: false  },
                        { value: 'Fokw1sT' , label: 'SATKW1s', checked: false  },
                        { value: 'Fokw1bT' , label: 'SATKW1b', checked: false  },
                        { value: 'Fokw1ksbT' , label: 'SATKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Fokw2kT' , label: 'SAPKW2k', checked: false  },
                        { value: 'Fokw2sT' , label: 'SAPKW2s', checked: false  },
                        { value: 'Fokw2bT' , label: 'SAPKW2b', checked: false  },
                        { value: 'Fokw2ksbT' , label: 'SATKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Fokw3kT' , label: 'SAPKW3k', checked: false  },
                        { value: 'Fokw3sT' , label: 'SAPKW3s', checked: false  },
                        { value: 'Fokw3bT' , label: 'SAPKW3b', checked: false  },
                        { value: 'Fokw3ksbT' , label: 'SATKW3ksb', checked: false  },
                        //=======================================================
                        //AREA PRODUKSI DECAL
                        //=======================================================
                        { value: 'RPkw1k' , label: 'RPKW1k', checked: false  },
                        { value: 'RPkw1s' , label: 'RPKW1s', checked: false  },
                        { value: 'RPkw1b' , label: 'RPKW1b', checked: false  },
                        { value: 'RPkw1ksb' , label: 'RPKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'RPkw2k' , label: 'RPKW2k', checked: false  },
                        { value: 'RPkw2s' , label: 'RPKW2s', checked: false  },
                        { value: 'RPkw2b' , label: 'RPKW2b', checked: false  },
                        { value: 'RPkw2ksb' , label: 'RPKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'RPkw3k' , label: 'RPKW3k', checked: false  },
                        { value: 'RPkw3s' , label: 'RPKW3s', checked: false  },
                        { value: 'RPkw3b' , label: 'RPKW3b', checked: false  },
                        { value: 'RPkw3ksb' , label: 'RPKW3ksb', checked: false  },
                        //=======================================================
                        { value: 'Pkw1k' , label: 'PKW1k', checked: false  },
                        { value: 'Pkw1s' , label: 'PKW1s', checked: false  },
                        { value: 'Pkw1b' , label: 'PKW1b', checked: false  },
                        { value: 'Pkw1ksb' , label: 'PKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Pkw2k' , label: 'PKW2k', checked: false  },
                        { value: 'Pkw2s' , label: 'PKW2s', checked: false  },
                        { value: 'Pkw2b' , label: 'PKW2b', checked: false  },
                        { value: 'Pkw2ksb' , label: 'PKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Pkw3k' , label: 'PKW3k', checked: false  },
                        { value: 'Pkw3s' , label: 'PKW3s', checked: false  },
                        { value: 'Pkw3b' , label: 'PKW3b', checked: false  },
                        { value: 'Pkw3ksb' , label: 'PKW3ksb', checked: false  },
                        //=======================================================
                        { value: 'Skw1kP' , label: 'SPKW1k', checked: false  },
                        { value: 'Skw1sP' , label: 'SPKW1s', checked: false  },
                        { value: 'Skw1bP' , label: 'SPKW1b', checked: false  },
                        { value: 'Skw1ksbP' , label: 'SPKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Skw2kP' , label: 'SPKW2k', checked: false  },
                        { value: 'Skw2sP' , label: 'SPKW2s', checked: false  },
                        { value: 'Skw2bP' , label: 'SPKW2b', checked: false  },
                        { value: 'Skw2ksbP' , label: 'SPKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Skw3kP' , label: 'SPKW3k', checked: false  },
                        { value: 'Skw3sP' , label: 'SPKW3s', checked: false  },
                        { value: 'Skw3bP' , label: 'SPKW3b', checked: false  },
                        { value: 'Skw3ksbP' , label: 'SPKW3ksb', checked: false  },
                        //=======================================================
                        { value: 'Fokw1kP' , label: 'SAPKW1k', checked: false  },
                        { value: 'Fokw1sP' , label: 'SAPKW1s', checked: false  },
                        { value: 'Fokw1bP' , label: 'SAPKW1b', checked: false  },
                        { value: 'Fokw1ksbP' , label: 'SAPKW1ksb', checked: false  },
                        //=======================================================
                        { value: 'Fokw2kP' , label: 'SAPKW2k', checked: false  },
                        { value: 'Fokw2sP' , label: 'SAPKW2s', checked: false  },
                        { value: 'Fokw2bP' , label: 'SAPKW2b', checked: false  },
                        { value: 'Fokw2ksbP' , label: 'SAPKW2ksb', checked: false  },
                        //=======================================================
                        { value: 'Fokw3kP' , label: 'SAPKW3k', checked: false  },
                        { value: 'Fokw3sP' , label: 'SAPKW3s', checked: false  },
                        { value: 'Fokw3bP' , label: 'SAPKW3b', checked: false  },
                        { value: 'Fokw3ksbP' , label: 'SAPKW3ksb', checked: false  }
                        //=======================================================
                        
                        ];
    $("#jqxlistbox").jqxListBox({ 
                        source: listSource, 
                        width: 140, 
                        height: 490,  
                        checkboxes: true });
                        
    $("#jqxlistbox").on('checkChange', function (event) {
                $("#jqxgrid").jqxGrid('beginupdate');
                if (event.args.checked) {
                    $("#jqxgrid").jqxGrid('showcolumn', event.args.value);
                }
                else {
                    $("#jqxgrid").jqxGrid('hidecolumn', event.args.value);
                }
                $("#jqxgrid").jqxGrid('endupdate');
            });
            
    $("#excelExport").jqxButton();
    $("#jqxButton1").jqxButton({theme: 'energyblue'});
    $('#jqxButton1').on('click', function () {
       $("#jqxlistbox").jqxListBox('checkAll');
    });
    $("#jqxButton2").jqxButton({theme: 'energyblue'});
    $('#jqxButton2').on('click', function () {
       $("#jqxlistbox").jqxListBox('uncheckAll');
    });
    $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'Data Stok Decal');           
            });
});
</script>
</div>
<table width="100%">
<tr>
<td valign="top" width="10%">
   <div id="jqxlistbox" style="font-size: 9px;"></div>
</td>
<td valign="top" width="90%">
    <div id="jqxgrid"></div>
</td>
</tr>
</table> 
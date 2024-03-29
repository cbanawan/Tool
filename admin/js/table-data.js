var TableData = function() {
    //function to initiate DataTable
    //DataTable is a highly flexible tool, based upon the foundations of progressive enhancement, 
    //which will add advanced interaction controls to any HTML table
    //For more information, please visit https://datatables.net/

    var runDataTable = function() {
        
        var oTable = $('#sample_1').dataTable({            
            "sServerMethod": "POST",
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": base_url + "browser/filter_browser",
            "bDeferRender": true,
            "error": fnhandleAjaxError
        });
        $('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#sample_1_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#sample_1_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
//        $('#sample_1_column_toggler input[type="checkbox"]').change(function() {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
//            var iCol = parseInt($(this).attr("data-column"));
//            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
//            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
//        });
function fnhandleAjaxError(xhr, textStatus, error) {
            if (textStatus === 'timeout') {
                alert('The server took too long to send the data.');
            }
            else {
                alert('An error occurred on the server. Please try again in a minute.');
            }
        }
    };
    return {
        //main function to initiate template pages
        init: function() {
            

            runDataTable();
        }
    };
}();

TableData.init();

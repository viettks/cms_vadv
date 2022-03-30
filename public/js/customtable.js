var CMTBL = {
    init : function(table,colunms,ajax,callback){
        return table.DataTable({
            "searching": false,
            "bLengthChange": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "bInfo" : false,
            "columns" : colunms,
            "ajax": ajax,
            "drawCallback": function( settings ) {
                callback(settings);
            }
        });
    },

}
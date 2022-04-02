var CMTBL = {
    init : function(table,colunms,ajax,callback){
        return table.DataTable({
            "searching": false,
            "bLengthChange": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 15,
            "bInfo" : false,
            "columns" : colunms,
            "ajax": ajax,
            "drawCallback": function( settings ) {
                if(callback){
                    callback(settings);
                }
            },
            "language": {
                "processing": "Đang xử lý...",
                "paginate": {
                    "next":       "Trang tiếp",
                    "previous":   "Trang trước"
                },
                "emptyTable":     "Không có dữ liệu",
            },

        });
    },

}
@extends('layout.app')
@section('title','Danh sách loại in')
@section('style')
<style>
    .mh-76 {
        min-height: 76vh;
    }

    .input-date-wrap {
        width: 185px;
    }

    .modal-lg {
        min-width: 60%;
    }

    .switch-label {
        border-color: #ff182b !important;
        background-color: #ff182b !important;
    }
</style>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mh-76">
        <div class="card-header">
            <i class="mr-2 fa fa-align-justify"></i>
            <strong class="card-title" v-if="headerText">Danh sách loại in</strong>
        </div>
        <div class="card-body">
            <div class="table-data__tool">
                <div class="table-data__tool-left w-75">

                </div>
                <div class="table-data__tool-right">
                    <a type="button" class="btn btn btn-outline-success mr-2" href="{{ url('settings/add-print') }}">
                        <i class="fa fa fa-plus"></i>&nbsp; Tạo mới loại 1</a>
                    <a type="button" class="btn btn btn-outline-success" href="{{ url('settings/add-print-1') }}">
                        <i class="fa fa fa-plus"></i>&nbsp; Tạo mới loại 2</a>
                </div>
                <hr>
            </div>
            <div class="m-b-30">
                <div class="m-b-45 mr-2 seach-box">
                    <div class="form-group mr-2">
                        <label></label>
                        <input class="form-control" type="text" name="sValue" id="sValue" placeholder="Tìm kiếm...">
                    </div>
                    <div class="form-group mr-2">
                        <label></label>
                        <button type="button" class="btn btn-primary" id="btnSeach">Tra cứu</button>
                    </div>
                </div>
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-bordered" id="tb_data">
                        <thead>
                            <tr>
                                <th>TÊN LOẠI</th>
                                <th>TÊN PHỤ CHI TIẾT</th>
                                <th>ĐƠN VỊ TÍNH</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END USER DATA-->
        </div>
    </div>
</div>
@section('modal')
@endsection

@endsection
@section('extend_script')
<script>
    //FOR DATATABLE

    var columns = [
            {"data" : "name", "orderable": false,"render": function ( data, type, row, meta ) {
                if(row.price_type == 1 || row.price_type == 2){
                    return `<a href="{{url('/settings/print/update')}}/${row.id}">${data}</a>`;
                }else{
                    return `<a href="{{url('/settings/print-1/update')}}/${row.id}">${data}</a>`;
                }

            }},
            {"data" : "sub_name", "orderable": false,},
            {"data" : "type_name", "orderable": false,},
            {"data" : "name", "orderable": false,"render": function ( data, type, row, meta ) {
                return `<button type="button" class="btn btn-danger" onclick="deletePrint('${row.id}');"><i class="fa fa-trash"></i>&nbsp;Xóa</button>`;
            }},
        ];

    var ajax = {
            'url' : '{{url("api/print/list/pagging")}}',
            "type": "GET",
            "data": {
                "value" : function() { return $('#sValue').val() },
            }
        };

    $(document).ready(function(){
        $("#btnSeach").click(function(){
            table.ajax.reload(null,true);
        });

        var table = CMTBL.init($('#tb_data'),columns,ajax,null);
    });

    function deletePrint(id) {
    if(confirm('Bạn có muốn xóa loại in đã chọn?')){
        
        var data = {
            "id" : id,
        }
        return $.ajax({
            url : "{{ url('api/print') }}",
            type : "DELETE",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message);
                $("#btnSeach").click();
            },
            error : function(xhr) {
                if(xhr.responseJSON && xhr.responseJSON.message!='') {
                    alert(xhr.responseJSON.message);
                }
            },
            beforeSend: function() {
                $("#overlay").show();
            },
            complete: function() {
                $("#overlay").hide();
            }
        });
    }
}
</script>
@endsection
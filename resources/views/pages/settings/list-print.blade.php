@extends('layout.app')
@section('title','Danh sách loại in')
@section('style')
<style>
    .mh-76{
        min-height: 76vh;
    }
    .input-date-wrap{
        width: 185px;
    }
    .modal-lg{
        min-width: 60%;
    }
    .switch-label{
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
                    <table class="table table-borderless table-striped table-earning" id="tb_data">
                        <thead>
                            <tr>
                                <th>TÊN LOẠI</th>
                                <th>TÊN PHỤ CHI TIẾT</th>
                                <th>ĐƠN VỊ TÍNH</th>
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
                return `<a href="{{url('/settings/print/update')}}/${row.id}">${data}</a>`;
            }},
            {"data" : "sub_name", "orderable": false,},
            {"data" : "type_name", "orderable": false,},
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

</script>
@endsection
@extends('layout.app')
@section('title','Quản lý chi')
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
            <strong class="card-title" v-if="headerText">Quản lý chi</strong>
        </div>
        <div class="card-body">
            <div class="table-data__tool">
                <div class="table-data__tool-left w-100">
                    <span class="text-danger text-strong">
                        <i class="fa fa-dollar"></i>&nbsp; Tổng chi : </span>
                    <span class="text-danger text-strong" id="total">0</span>
                    <span class="text-danger text-strong"></span>
                </div>
                <div class="table-data__tool-right">
                    <button type="button" class="btn btn-outline-primary" onclick="exportExcel();">
                        <i class="fa fa-download"></i>&nbsp; Xuất file excel</button>
                </div>
                <hr>
            </div>
            <div class="m-b-30">
                <div class="m-b-45 mr-2 seach-box">
                    <div class="form-group mr-2">
                        <label>Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="form-group mr-2">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="form-group mr-2">
                        <label>Tình trạng</label>
                        <select class="form-control" name="sStatus" id="sStatus">
                            <option value="" selected="selected">Tất cả</option>
                            <option value="0">Đang xử lý</option>
                            <option value="1">Từ chối</option>
                            <option value="2">Hoàn thành</option>
                        </select>
                    </div>
                    @can('ADMIN')
                    <div class="form-group mr-2">
                        <label>Nhân viên</label>
                        <select class="form-control" name="time" name="sStaff" id="sStaff">
                            <option value="" selected="selected">Tất cả</option>
                            @foreach ($memberes as $member)
                            <option value="{{$member->id}}">{{$member->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endcan
                    <div class="form-group mr-2">
                        <label></label>
                        <input class="form-control" type="text" name="sValue" id="sValue" placeholder="Tìm kiếm...">
                    </div>
                    <div class="form-group mr-2">
                        <label></label>
                        <button type="button" class="btn btn-primary" id="btnSeach">Tra cứu</button>
                    </div>
                    <div class="form-group mr-2 w-100 d-flex justify-content-end">
                        <label></label>
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal1" id="btnCreate">
                            <i class="fa fa-plus"></i>
                            Thêm mới</button>
                    </div>
                </div>
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-bordered" id="tb_data">
                        <thead>
                            <tr>
                                <th>NGÀY</th>
                                <th>TÊN ĐỐI TÁC</th>
                                <th>SỐ ĐIỆN THOẠI</th>
                                <th>LÝ DO CHI</th>
                                <th>SỐ TIỀN</th>
                                <th>HÓA ĐƠN</th>
                                <th>NHÂN VIÊN</th>
                                <th>NGƯỜI DUYỆT</th>
                                <th>TRẠNG THÁI</th>
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
<!-- modal medium -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">
                        <i class="mr-2 fa fa-align-justify"></i>
                        Tạo mới phiếu chi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="crForm" method="post" class="form-horizontal">
                        <div class="row form-group">
                            <h5 class="title-5 m-b-30 ml-3">Thông tin phiếu chi</h5>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="name" class=" form-control-label">Tên đối tác (<span class="required">*</span>)</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="text" id="crName" name="name" placeholder="Tên đối tác" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="name" class=" form-control-label">Số điện thoại (<span class="required">*</span>)</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="text" id="crPhone" name="phone" placeholder="Số điện thoại" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="name" class=" form-control-label">Số tiền (<span class="required">*</span>)</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="number" id="crAmount" name="amount" placeholder="Giá tiền" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="name" class=" form-control-label">Hóa đơn (<span class="required">*</span>)</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="file" id="crFile" name="file" placeholder="Hóa đơn" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="name" class=" form-control-label">Lý do chi (<span class="required">*</span>)</label>
                            </div>
                            <div class="col col-sm-8">
                                <textarea name="note" id="crNote" rows="9" placeholder="Ghi chú..." class="form-control"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="create();"><i class="fa fa-save"></i>&nbsp;Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal medium -->
@endsection

@endsection
@section('extend_script')
@can('ADMIN', null)
<script>
    //FOR DATATABLE
    
    var columns = [
            {"data" : "create_date", "orderable": false,},
            {"data" : "name", "orderable": false,},
            {"data" : "phone", "orderable": false,},
            {"data" : "note", "orderable": false,},
            {"data" : "amount", "orderable": false, "render": function ( data, type, row, meta ) {
                return (data+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            }},
            {"data" : "file_name", "orderable": false, "render": function ( data, type, row, meta ) {
      
                return '<a href="{{url('revenue')}}/'+row.url+'">'+data+'</a>';

            }},
            {"data" : "created_by", "orderable": false,},
            {"data" : "updated_by", "orderable": false,},
            {"data" : "status", "orderable": false, "render": function ( data, type, row, meta ) {
                if(data == 2){
                    return '<p class="text-success">Hoàn thành.</p>';
                }else if(data == 1){
                    return '<p class="text-danger">Từ chối.</p>';
                }else{
                    return `<button type="button" onclick="approve(${row.id},2)" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-check"></i>&nbsp; Duyệt</button>
                            <button type="button" onclick="approve(${row.id},1)" class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-times"></i>&nbsp;Hủy</button>`;
                }
            }},
        ];

    var ajax = {
            'url' : '{{url("api/revenue/list")}}',
            "type": "GET",
            "data": {
                "fromDate" : function() { return $('#fromDate').val() },
                "toDate" : function() { return $('#toDate').val() },
                "status" : function() { return $('#sStatus').val() },
                "staff" : function() { return $('#sStaff').val() },
                "value" : function() { return $('#sValue').val() },
            }
        };

    function callback(settings){
        var total = (settings.json.total+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        $("#total").text(total);
    }

    $(document).ready(function(){
        init();

        $("#btnSeach").click(function(){
            if(COMMON._isNullOrEmpty($("#fromDate"))||COMMON._isNullOrEmpty($("#toDate"))){
                alert('Vui lòng kiểm tra ngày bắt đầu và ngày kết thúc!');
            }else{
                table.ajax.reload(null,true);
            }
        });

        var table = CMTBL.init($('#tb_data'),columns,ajax,callback);
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);
        $("#fromDate").val(firstDayOfMonth.toLocaleDateString('en-CA'));
        $("#toDate").val(lastDayOfMonth.toLocaleDateString('en-CA'));
    }

    function create() {
        if(!validateCreate()) return;
        var formData = new FormData($('#crForm')[0]);
        formData.append('file',$('#crFile')[0].files[0]);

        $.ajax({
            type:'POST',
            url: "{{ url('/api/revenue')}}",
            contentType: 'multipart/form-data',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                alert(data.message);
                $('#modal1').modal('hide');
                $("#btnSeach").click();
            },
            error: function(data){
                
            }
        });
    }

    function validateCreate() {
        if(COMMON._isNullOrEmpty($('#crName'))){
            alert('Vui lòng nhập tên đối tác!');
            $('#crName').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crPhone'))){
            alert('Vui lòng nhập số điện thoại!');
            $('#crPhone').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crAmount'))){
            alert('Vui lòng nhập số tiền!');
            $('#crAmount').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crFile'))){
            alert('Vui lòng chọn tệp hóa đơn!');
            $('#crFile').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crNote'))){
            alert('Vui lòng nhập lý do chi!');
            $('#crNote').focus();
            return false;
        }
        return true;
    }

    $('#modal1').on('show.bs.modal', function (event) {
        $('#crName').val('');
        $('#crAmount').val('');
        $('#crPhone').val('');
        $('#crFile').val('');
        $('#crNote').val('');
    });

    function approve(id,status) {
        $.ajax({
            type: "PATCH",
            url: "{{url('/api/revenue')}}",
            data: {
                "id": id,
                "status" :status
            },
            dataType: "json",
            success: function(data) {
                $("#btnSeach").click();
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi!')
            },
        });
    }

    function exportExcel() {
        var data = {
                "fromDate" : $('#fromDate').val(),
                "toDate" : $('#toDate').val(),
                "status" : $('#sStatus').val(),
                "staff" : $('#sStaff').val(),
                "value" : $('#sValue').val()
            };
        window.open('{{url('revenue/download/excel')}}?' + $.param(data), '_blank').focus();
    }
</script>
@endcan

@can('USER', null)
<script>
    //FOR DATATABLE

    var columns = [
            {"data" : "create_date", "orderable": false,},
            {"data" : "name", "orderable": false,},
            {"data" : "phone", "orderable": false,},
            {"data" : "note", "orderable": false,},
            {"data" : "amount", "orderable": false, "render": function ( data, type, row, meta ) {
                return (data+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            }},
            {"data" : "file_name", "orderable": false, "render": function ( data, type, row, meta ) {
      
                return '<a href="{{url('revenue')}}/'+row.url+'">'+data+'</a>';

            }},
            {"data" : "created_by", "orderable": false,},
            {"data" : "updated_by", "orderable": false,},
            {"data" : "status", "orderable": false, "render": function ( data, type, row, meta ) {
                if(data == 2){
                    return '<p class="text-success">Hoàn thành.</p>';
                }else if(data == 1){
                    return '<p class="text-danger">Từ chối.</p>';
                }else{
                    return '<p class="text-danger">Đang xử lý.</p>';
                }
            }},
        ];

    var ajax = {
            'url' : '{{url("api/revenue/list")}}',
            "type": "GET",
            "data": {
                "fromDate" : function() { return $('#fromDate').val() },
                "toDate" : function() { return $('#toDate').val() },
                "status" : function() { return $('#sStatus').val() },
                "staff" : function() { return $('#sStaff').val() },
                "value" : function() { return $('#sValue').val() },
            }
        };

    function callback(settings){
        var total = (settings.json.total+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' VNĐ';
        $("#total").text(total);
    }

    $(document).ready(function(){
        init();

        $("#btnSeach").click(function(){
            if(COMMON._isNullOrEmpty($("#fromDate"))||COMMON._isNullOrEmpty($("#toDate"))){
                alert('Vui lòng kiểm tra ngày bắt đầu và ngày kết thúc!');
            }else{
                table.ajax.reload(null,true);
            }
        });

        var table = CMTBL.init($('#tb_data'),columns,ajax,callback);
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);
        $("#fromDate").val(firstDayOfMonth.toLocaleDateString('en-CA'));
        $("#toDate").val(lastDayOfMonth.toLocaleDateString('en-CA'));
    }

    function create() {
        if(!validateCreate()) return;
        var formData = new FormData($('#crForm')[0]);
        formData.append('file',$('#crFile')[0].files[0]);

        $.ajax({
            type:'POST',
            url: "{{ url('/api/revenue')}}",
            contentType: 'multipart/form-data',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                alert(data.message);
                $('#modal1').modal('hide');
                $("#btnSeach").click();
            },
            error: function(data){
                
            }
        });
    }

    function validateCreate() {
        if(COMMON._isNullOrEmpty($('#crName'))){
            alert('Vui lòng nhập tên đối tác!');
            $('#crName').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crPhone'))){
            alert('Vui lòng nhập số điện thoại!');
            $('#crPhone').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crAmount'))){
            alert('Vui lòng nhập số tiền!');
            $('#crAmount').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crFile'))){
            alert('Vui lòng chọn tệp hóa đơn!');
            $('#crFile').focus();
            return false;
        }
        if(COMMON._isNullOrEmpty($('#crNote'))){
            alert('Vui lòng nhập lý do chi!');
            $('#crNote').focus();
            return false;
        }
        return true;
    }

    $('#modal1').on('show.bs.modal', function (event) {
        $('#crName').val('');
        $('#crAmount').val('');
        $('#crPhone').val('');
        $('#crFile').val('');
        $('#crNote').val('');
    });

    function exportExcel() {
        var data = {
                "fromDate" : $('#fromDate').val(),
                "toDate" : $('#toDate').val(),
                "status" : $('#sStatus').val(),
                "staff" : $('#sStaff').val(),
                "value" : $('#sValue').val()
            };
        window.open('{{url('revenue/download/excel')}}?' + $.param(data), '_blank').focus();
    }
</script>
@endcan

@endsection
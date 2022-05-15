@extends('layout.app')
@section('title','Quản lý nợ')
@section('style')
<style>
    .mh-76 {
        min-height: 76vh;
    }

    .input-date-wrap {
        width: 185px;
    }

    .modal-lg {
        min-width: 80%;
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
            <strong class="card-title" v-if="headerText">Quản lý nợ</strong>
        </div>
        <div class="card-body">
            <div class="table-data__tool">
                <div class="table-data__tool-left w-100">
                    <span class="text-danger text-strong">
                        <i class="fa fa-dollar"></i>&nbsp; Tổng công nợ : </span>
                    <span class="text-danger text-strong" id="total">0</span>
                    <span class="text-danger text-strong"> VNĐ.</span>
                </div>
                <div class="table-data__tool-right d-flex">
                    <a type="button" class="btn btn btn-outline-success mr-2" href="{{url('/debt/create')}}">
                        <i class="fa fa fa-plus"></i>&nbsp; Tạo mới</a>

                    <button type="button" class="btn btn-outline-primary" onclick="exportExcel();">
                        <i class="fa fa-download"></i>&nbsp; Xuất file excel</button>
                </div>
                <hr>
            </div>
            <div class="m-b-30">
                <div class="m-b-45 mr-2 seach-box">
                    <div class="form-group mr-2">
                        <label>Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate"
                            placeholder="Ngày bắt đầu">
                    </div>
                    <div class="form-group mr-2">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="form-group mr-2">
                        <label>Tình trạng</label>
                        <select class="form-control" name="sStatus" id="sStatus">
                            <option value="" selected="selected">Tất cả</option>
                            <option value="0">Dưới 15 ngày</option>
                            <option value="1">Trên 15 ngày</option>
                            <option value="2">Trên 30 ngày</option>
                            <option value="3">Hoàn thành</option>
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
                </div>
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-bordered" id="tb_data">
                        <thead>
                            <tr>
                                <th>NGÀY</th>
                                <th>MÃ ĐƠN</th>
                                <th>TÊN KHÁCH HÀNG</th>
                                <th>SỐ ĐIỆN THOẠI</th>
                                <th>TỒNG TIỀN</th>
                                <th>CHI TRẢ</th>
                                <th>NỢ</th>
                                <th>TÌNH TRẠNG</th>
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
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">
                    <i class="mr-2 fa fa-align-justify"></i>
                    Chi tiết hóa đơn
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <h5 class="title-5 m-b-30 ml-3">Thông tin khách hàng</h5>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="note" class=" form-control-label">Mã vận đơn</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="billId" name="billId" class="form-control">
                        </div>
                        <div class="col col-sm-6">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-2">
                            <label for="name" class=" form-control-label">Tên khách hàng (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-4">
                            <input type="text" disabled id="name" name="name" placeholder="Tên khách hàng"
                                class="form-control">
                            <input type="hidden" id="orderID" />
                        </div>
                        <div class="col col-sm-2">
                            <label for="name" class=" form-control-label">Trạng thái (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-4">
                            <label for="">Chưa hoàn thành</label>
                            <label class="switch switch-default switch-pill switch-danger mr-2">
                                <input type="checkbox" id="status" class="switch-input" checked="true" disabled>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            <label for="">hoàn thành</label>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="phone" class=" form-control-label">Số điện thoại (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="phone" name="phone" placeholder="Số điện thoại"
                                class="form-control">
                        </div>
                        <div class="col col-md-2">
                            <label for="address" class=" form-control-label">Địa chỉ (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="address" name="address" placeholder="Địa chỉ"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="payment" class=" form-control-label">Trả trước</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="number" disabled id="payment" name="payment" placeholder="Số tiền trả trước"
                                class="form-control" value="0">
                        </div>
                        <div class="col col-md-2">
                            <label for="release" class=" form-control-label">Ngày hoàn thành</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="release" name="release" placeholder="Ngày hoàn thành"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="note" class=" form-control-label">Ghi chú</label>
                        </div>
                        <div class="col-12 col-md-10">
                            <textarea disabled name="note" id="note" rows="9" placeholder="Ghi chú..."
                                class="form-control"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <h5 class="title-5 m-b-30 ml-3">Chi tiết đơn hàng (<span class="required">*</span>)</h5>
                    </div>
                    <div class="row form-group">
                        <div class="table-responsive table-data">
                            <table class="table" id="tb_data_sub">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>LOẠI IN</td>
                                        <td>GIA CÔNG</td>
                                        <td>HỖ TRỢ (CHẤT LIỆU)</td>
                                        <td>KÍCH THƯỚC</td>
                                        <td>SỐ LƯỢNG</td>
                                        <td>ĐƠN GIÁ</td>
                                        <td>TỔNG</td>
                                        <td>THÀNH TIỀN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left w-100">
                            <span class="text-danger text-strong">
                                <i class="fa fa-dollar"></i>&nbsp; Tổng giá trị : </span>
                            <span class="text-danger text-strong" id="totalPrice">0</span>
                            <span class="text-danger text-strong"> VNĐ.</span>
                        </div>
                        <hr>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fa fa-times"></i>&nbsp;Hủy</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal medium -->

<!-- modal detail -->
<div class="modal fade" id="mdDetail" tabindex="-1" role="dialog" aria-labelledby="mdDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdDetailLabel">
                    <i class="mr-2 fa fa-align-justify"></i>
                    Chi tiết đơn hàng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="dPrintType" class=" form-control-label">Tên loại in</label>
                            <input type="hidden" id="mode" value="I">
                            <input type="hidden" id="index" value="0">
                            <input type="hidden" id="defmc1" value="0">
                            <input type="hidden" id="defmc2" value="0">
                            <input type="hidden" id="defmc3" value="0">
                        </div>
                        <div class="col-12 col-md-8">
                        </div>
                    </div>
                    <div id="detailWrap">

                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label class=" form-control-label">Tổng :</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <span id="spTotal">0</span>&nbsp;
                            <span id="spunit"></span>
                        </div>
                        <div class="col col-md-4">
                            <label class=" form-control-label">Thành tiền :</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <span id="spAmount">0</span><span> VNĐ</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mr-2" onclick="addPrintDetail();">
                    <i class="fa fa-check"></i>&nbsp; Xác nhận</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>&nbsp;Hủy</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal medium -->
@endsection

@endsection
@section('extend_script')
<script>
    //FOR DATATABLE

    var columns = [
            {"data" : "create_date", "orderable": false,},
            {"data" : "bill_code","orderable": false, "render": function ( data, type, row, meta ) {
                return '<a href="#" onclick="showInfo(\''+row.id+'\')">'+ data + '</a>';
            }},
            {"data" : "name", "orderable": false,},
            {"data" : "phone", "orderable": false,},
            {"data" : "amount", "orderable": false, "render": function ( data, type, row, meta ) {
                return (data+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            }},
            {"data" : "payment", "orderable": false, "render": function ( data, type, row, meta ) {
                return (data+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            }},
            {"data" : "debt", "orderable": false, "render": function ( data, type, row, meta ) {
                return (data+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            }},
            {"data" : "status", "orderable": false, "render": function ( data, type, row, meta ) {
 
                if(data == 1){
                    return '<p class="text-success">Hoàn thành.</p>';
                }else{
                    if(row.debt_date <= 15){
                        return '<p class="text-danger">Dưới 15 ngày.<button class="btn btn-outline-primary btn-sm ml-2" onClick="completeDebt(\''+row.debt_id+'\')">Hoàn tất?</button></p>';
                    }else if(row.debt_date > 30){
                        return '<p class="text-danger">Trên 30 ngày.<button class="btn btn-outline-primary btn-sm ml-2" onClick="completeDebt(\''+row.debt_id+'\')">Hoàn tất?</button></p>';
                    }else{
                        return '<p class="text-danger">Trên 15 ngày.<button class="btn btn-outline-primary btn-sm ml-2" onClick="completeDebt(\''+row.debt_id+'\')">Hoàn tất?</button></p>';
                    }
                }
            }},
        ];

    var ajax = {
            'url' : '{{url("api/debt")}}',
            "type": "GET",
            "data": {
                "fromDate" : function() { return $('#fromDate').val() },
                "toDate" : function() { return $('#toDate').val() },
                "status" : function() { return $('#sStatus').val() },
                "staff" : function() { return $('#sStaff').val() },
                "value" : function() { return $('#sValue').val() },
            }
        };
    
    var table;

    function callback(settings){
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

        table = CMTBL.init($('#tb_data'),columns,ajax,callback);
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);
        $("#fromDate").val(firstDayOfMonth.toLocaleDateString('en-CA'));
        $("#toDate").val(lastDayOfMonth.toLocaleDateString('en-CA'));
    }

    function showInfo(id) {
        $.ajax({
            type: "GET",
            url: "{{url('/api/order')}}",
            data: {
                'id': id,
            },
            dataType: "json",
            success: function(data) {
                if(data.length > 0){
                    $('#billId').val(data[0].bill_code);
                    $('#name').val(data[0].customer);
                    $('#phone').val(data[0].phone);
                    $('#address').val(data[0].address);
                    $('#payment').val(data[0].payment);
                    $('#release').val(data[0].release_dt);
                    $('#note').val(data[0].note);
                    $("#totalPrice").text((data[0].total_amount+ "").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
                    $("#orderID").val(data[0].id)
                    $("#tb_data_sub tbody").empty();
                    data.forEach((element,index) => {
                        let amountTemp = (element.amount+ "").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
                        var row = `<tr>
                                    <td>${index + 1}</td>
                                    <td>${element.print_name}</td>
                                    <td>${element.machine1}</td>
                                    <td>${element.machine2}</td>
                                    <td>${element.size}</td>
                                    <td>${element.quantity}</td>
                                    <td>${element.unit_price}</td>
                                    <td>${element.total_size}</td>
                                    <td>${element.amount_display}</td></tr>`;
                        $("#tb_data_sub tbody").append(row);
                    });

                    if(data[0].status == 1){
                        $('#status .badge-success').show();
                        $('#status .badge-danger ').hide();
                    }else{
                        $('#status .badge-success').hide();
                        $('#status .badge-danger ').show();
                    }
                    $('#modal1').modal('show');
                }else{
                    alert('Đã xảy ra lỗi!')
                }
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi!')
            },
        });
    }

    function showDebt(id) {
        $.ajax({
            type: "GET",
            url: "{{url('/api/order')}}",
            data: {
                'id': id,
            },
            dataType: "json",
            success: function(data) {
                if(data.length > 0){
                    $('#billId').val(data[0].bill_code);
                    $('#name').val(data[0].customer);
                    $('#phone').val(data[0].phone);
                    $('#address').val(data[0].address);
                    $('#payment').val(data[0].payment);
                    $('#release').val(data[0].release_dt);
                    $('#note').val(data[0].note);
                    $("#totalPrice").text((data[0].total_amount+ "").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
                    $("#orderID").val(data[0].id)
                    $("#tb_data_sub tbody").empty();
                    data.forEach((element,index) => {
                        let amountTemp = (element.amount+ "").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
                        var row = `<tr>
                                    <td>${index + 1}</td>
                                    <td>${element.print_name}</td>
                                    <td>${element.machine1}</td>
                                    <td>${element.machine2}</td>
                                    <td>${element.size}</td>
                                    <td>${element.quantity}</td>
                                    <td>${element.unit_price}</td>
                                    <td>${element.total_size}</td>
                                    <td>${element.amount_display}</td></tr>`;
                        $("#tb_data_sub tbody").append(row);
                    });

                    if(data[0].status == 1){
                        $('#status .badge-success').show();
                        $('#status .badge-danger ').hide();
                    }else{
                        $('#status .badge-success').hide();
                        $('#status .badge-danger ').show();
                    }
                    $('#modal1').modal('show');
                }else{
                    alert('Đã xảy ra lỗi!')
                }
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
        window.open('{{url('debt/download')}}?' + $.param(data), '_blank').focus();
    }

    function completeDebt(id) {
        if(confirm('Xác nhận hoàn tất công nợ?')){
            return $.ajax({
            url : "{{ url('api/debt/complete') }}",
            type : "PATCH",
            dataType:"json",
            data: {id:id},
            success : function(data) {
                alert(data.message);
                $("#btnSeach").click();
            },
            error : function(xhr) {

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
@extends('layout.app')
@section('title','Tạo mới công nợ')
@section('style')
<style>
    .mh-76 {
        min-height: 76vh;
    }

    .input-date-wrap {
        width: 185px;
    }
    input.form-control-sm{
        border: 1px solid #ced4da;
    }
</style>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mh-76">
        <div class="card-header">
            <i class="mr-2 fa fa-align-justify"></i>
            <strong class="card-title" v-if="headerText">Tạo mới công nợ</strong>
        </div>
        <div class="card-body">
            <form action="" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin công nợ</h5>
                </div>

                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="billcode" class=" form-control-label">Mã đơn hàng (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="billcode" name="billcode" placeholder="Mã đơn hàng" class="form-control" maxlength="200" disabled>
                    </div>
                    <div class="col col-sm-6">
                        <button id="btnSelect"><i class="fa fa-user"></i></button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="name" class="form-control-label">Tên khách hàng</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="name" name="name" placeholder="Tên khách hàng" class="form-control" maxlength="200" disabled>
                        <input type="hidden" id="orderId" name="orderId" placeholder="Tên khách hàng" class="form-control" maxlength="200" disabled>
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="phone" class="form-control-label">Số điện thoại</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="phone" name="phone" placeholder="Số điện thoại" class="form-control" maxlength="200" disabled>
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="amount" class=" form-control-label">Tổng giá trị (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="number" id="amount" name="amount" placeholder="Tổng giá trị" class="form-control" maxlength="200">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="payment" class=" form-control-label">Số tiền chi trả (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="number" id="payment" name="payment" placeholder="Số tiền chi trả" class="form-control" maxlength="200">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="fromdate" class=" form-control-label">Ngày bắt đầu nợ (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="date" id="fromdate" name="fromdate" placeholder="Ngày bắt đầu" class="form-control" maxlength="200" value="0">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
            </form>
            <!-- END USER DATA-->
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-outline-primary mr-2" id="btnSave">
                <i class="fa fa-save"></i>&nbsp; Lưu</button>
            <button type="button" class="btn btn-outline-primary mr-2" id="btnSaveBack">
                <i class="fa fa-reply"></i>&nbsp; Lưu và quay lại</button>
            <button type="button" class="btn btn-outline-warning mr-2" onclick="reset();">
                <i class="fa fa-undo"></i>&nbsp; Reset</button>
            <a type="button" class="btn btn-outline-secondary" href="{{url('/settings/list-print')}}">
                <i class="fa fa-times"></i>&nbsp; Hủy</a>
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
                    Danh sách khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <div class="table-responsive table-data">
                            <table class="table" id="tb_data_sub">
                                <thead>
                                    <tr>
                                        <td>MÃ ĐƠN</td>
                                        <td>TÊN</td>
                                        <td>SỐ ĐIỆN THOẠI</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Hủy</button>
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
    {"data" : "bill_code", "orderable": false,},
    {"data" : "name", "orderable": false,},
    {"data" : "phone", "orderable": false,},
    {"data" : "name", "orderable": false, "render": function ( data, type, row, meta ) {
        return `<a href="#" onclick="setCustomer('${row.name}','${row.phone}','${row.bill_code}','${row.id}')"><i class="fa fa fa-magic"></i></a>`;
    }},
];

var ajax = {
    'url' : '{{url("api/order/billcode")}}',
    "type": "GET",
    "data": {
        "value" : function() { return $('#sValue').val() },
        },
    };

var table;

$(document).ready(function(){
    
    $("#btnSelect").click(function(){
        $("#modal1").modal('show');
    });
    
    $('#modal1').on('shown.bs.modal', function () {
        if(!table){
            table = CMTBL.init($('#tb_data_sub'),columns,ajax,null);
        }
    });
    
    $("#btnSeach").click(function(){
        table.ajax.reload(null,true);
    });

    $("#btnSave").click(function(){
        saveDebt();
    });

    $("#btnSaveBack").click(function(){
        saveDebt(true);
    });
});

    function deleteRow(rowIcon) {
        $(rowIcon).closest('tr').remove();
    }

    function saveDebt(isback=false){
        if(!validateDebt()) return;

        var data = {
            "id" : $("#orderId").val(),
            "amount" : $("#amount").val(),
            "payment" : $("#payment").val(),
            "fromdate" : $("#fromdate").val(),
        }

        return $.ajax({
            url : "{{ url('api/debt') }}",
            type : "POST",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message);
                if(isback){
                    window.location.href = '{{url("/debt")}}';
                }else{
                    reset();
                }
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

    function reset() {
        $("#billcode").val("");
        $("#name").val("");
        $("#phone").val("");
        $("#amount").val("");
        $("#payment").val("");
        $("#fromdate").val("");
    }

    function validateDebt() {
        if(COMMON._isNullOrEmpty($('#billcode'))){
            alert('Vui lòng nhập mã hóa đơn!');
            $('#billcode').focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($('#amount')) || Number.parseInt($('#amount').val() <= 0)){
            alert('Vui lòng kiểm tra giá trị đơn!');
            $('#amount').focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($('#payment')) || Number.parseInt($('#payment').val() <= 0)){
            alert('Vui lòng kiểm tra số tiền đã trả!');
            $('#payment').focus();
            return false;
        }

        if(Number.parseInt($('#payment').val()) > Number.parseInt($('#amount').val())){
            alert('Vui lòng kiểm tra số tiền đã trả!');
            $('#payment').focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($('#fromdate'))){
            alert('Vui lòng nhập ngày bắt đầu nợ!');
            $('#fromdate').focus();
            return false;
        }
        return true;
    }

    function addManu(info) {
        if(info == 1){
            let template = $("#tmpManu1");
            $("#groupManu1").append(template.html());
        }else{
            let template = $("#tmpManu2");
            $("#groupManu2").append(template.html());
        }
    }

    function setCustomer(name,phone,billcode,id) {
        $("#billcode").val(billcode);
        $("#name").val(name);
        $("#phone").val(phone);
        $("#orderId").val(id);
        $("#modal1").modal('hide');
    }
</script>
@endsection
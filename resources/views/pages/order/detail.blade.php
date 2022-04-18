@extends('layout.app')
@section('title','Chi tiết đơn hàng')
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
    .print-size{
        max-width: 50px;
    }
    .print-quant{
        max-width: 75px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mh-76">
        <div class="card-header">
            <i class="mr-2 fa fa-align-justify"></i>
            <strong class="card-title" v-if="headerText">Tạo mới đơn hàng</strong>
        </div>
        <div class="card-body">
            <form action="" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin khách hàng</h5>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="billCd" class=" form-control-label">Mã đơn hàng</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="billCd" name="billCd" disabled placeholder="Mã đơn hàng" class="form-control" value="{{$order->bill_code}}" disabled>
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="name" class=" form-control-label">Tên khách hàng (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="name" name="name" placeholder="Tên khách hàng" class="form-control" value="{{$order->name}}">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="phone" class=" form-control-label">Số điện thoại (<span class="required">*</span>)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="phone" name="phone" placeholder="Số điện thoại" class="form-control" value="{{$order->phone}}">
                    </div>
                    <div class="col col-md-2">
                        <label for="address" class=" form-control-label">Địa chỉ (<span class="required">*</span>)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="address" name="address" placeholder="Địa chỉ" class="form-control" value="{{$order->address}}">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="payment" class=" form-control-label">Trả trước</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="number" id="payment" name="payment" placeholder="Số tiền trả trước" class="form-control" value="{{$order->payment}}">
                    </div>
                    <div class="col col-md-2">
                        <label for="release" class=" form-control-label">Ngày hoàn thành</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="date" id="release" name="release" placeholder="Ngày hoàn thành" class="form-control" value="{{$order->release}}">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="note" class=" form-control-label">Ghi chú</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <textarea name="note" id="note" rows="9" placeholder="Ghi chú..." class="form-control">{{$order->note}}</textarea>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Chi tiết đơn hàng (<span class="required">*</span>)</h5>
                </div>
                <div class="row form-group">
                    <div class="table-data w-100">
                        <table class="table table-responsive" id="tb_data">
                            <colgroup>
                                <col style="width:15%">
                                <col style="width:15%">
                                <col style="width:15%">
                                <col style="width:5%">
                                <col style="width:5%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:10%">
                              </colgroup>
                            <thead>
                                <tr>
                                    <td>LOẠI IN</td>
                                    <td>GIA CÔNG</td>
                                    <td>HỖ TRỢ</td>
                                    <td>NGANG</td>
                                    <td>DỌC</td>
                                    <td>SỐ LƯỢNG</td>
                                    <td>ĐƠN GIÁ</td>
                                    <td>TỔNG</td>
                                    <td>THÀNH TIỀN</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                <tr>
                                    <td>
                                        <input type="hidden" name="flg" value="U">
                                        <input type="hidden" name="unit" value="{{$detail->width == 0 ? "2" : "1"}}">
                                        <input type="hidden" name="unit_name" value="{{$detail->unit_name}}">
                                        <input disabled type="hidden" name="print" value="{{$detail['print_name']}}" class="form-control-sm">
                                        {{$detail['print_name']}}
                                    </td>
                                    <td>
                                        <input disabled type="hidden" name="manufac1" value="{{$detail->manufac1}}" class="form-control-sm">       
                                        {{$detail->manufac1}}                          
                                    </td>
                                    <td>                                        
                                        <input disabled type="hidden" name="manufac2" value="{{$detail->manufac2}}" class="form-control-sm"> 
                                        {{$detail->manufac2}}
                                    </td>
                                    <td>
                                        @if ($detail->width == 0)
                                        <input type="hidden" name="width" value="{{$detail->width}}" class="form-control-sm print-size" onchange="changeData(this);"></td>
                                        @else
                                        <input type="number" name="width" value="{{$detail->width}}" class="form-control-sm print-size" onchange="changeData(this);"></td>
                                        @endif
                                    <td>
                                        @if ($detail->heigth == 0)
                                        <input type="hidden" name="height" value="{{$detail->heigth}}" class="form-control-sm print-size" onchange="changeData(this);"></td>
                                        @else
                                        <input type="number" name="height" value="{{$detail->heigth}}" class="form-control-sm print-size" onchange="changeData(this);"></td>
                                        @endif
                                    <td><input type="number" name="quantity" value="{{$detail->quantity}}" class="form-control-sm print-quant" onchange="changeData(this);"></td>
                                    <td><input type="number" name="unitPrice" value="{{$detail->unit_price}}" placeholder="Đơn giá" class="form-control-sm" onchange="changeData(this);"></td>
                                    <td><span class="rowQuantity">{{$detail->total}}</span>&nbsp;<span class="row-unit">{{$detail->unit_name}}</span></td>
                                    <td><span class="rowPriceData">{{$detail->amount}}</span>&nbsp;<span>VNĐ</span></td>
                                    <td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-group">
                    <button type="button" class="btn btn-outline-primary btn-sm ml-5" id="addRow">Thêm dòng</button>
                </div>
                <div class="table-data__tool">
                    <div class="table-data__tool-left w-100">
                        <span class="text-danger text-strong">
                            <i class="fa fa-dollar"></i>&nbsp; Tổng giá trị : </span>
                        <span class="text-danger text-strong" id="totalPrice">{{$order->amount}}</span>
                        <span class="text-danger text-strong"> VNĐ.</span>
                    </div>
                    <hr>
                </div>
            </form>
            <!-- END USER DATA-->
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-outline-primary mr-2" id="btnSave">
                <i class="fa fa-save"></i>&nbsp; Lưu</button>
            <button type="button" class="btn btn-outline-primary mr-2" id="btnSaveBack">
                <i class="fa fa-reply"></i>&nbsp; Lưu và quay lại</button>
            <button type="button" class="btn btn-outline-warning mr-2" id="btnReset">
                <i class="fa fa-undo"></i>&nbsp; Reset</button>
            <a class="btn btn-outline-secondary" href="{{url('/order/list')}}">
                <i class="fa fa-times"></i>&nbsp; Hủy</a>
        </div>
    </div>
</div>
<template id="templateRow">
    <tr>
        <td>
            <input type="hidden" name="flg" value="I">
            <select name="print" class="form-control-sm form-control" onchange="changeData(this);">
                <option value=''>Chọn loại in</option>
                @foreach ($printes as $pr)
                <option value="{{$pr->id}}" data-subtype="{{$pr->price_type}}" data-subunit="{{$pr->type_name}}">{{$pr->name . " / " .$pr->sub_name}}</option>
                @endforeach
            </select>
        </td>
        <td class="row-manu1">                                        
            <select name="manufac1" class="form-control-sm form-control" onchange="changeData(this);">
                <option value=''>Chọn gia công</option>
            </select>
        </td>
        <td class="row-manu2">                                             
            <select name="manufac2" class="form-control-sm form-control" onchange="changeData(this);">
                <option value=''>Chọn hỗ trợ</option>
            </select>
        </td>
        <td><input type="number" name="width" value="0" class="form-control-sm print-size" onchange="changeData(this);"></td>
        <td><input type="number" name="height" value="0" class="form-control-sm print-size" onchange="changeData(this);"></td>
        <td><input type="number" name="quantity" value="0" class="form-control-sm print-quant" onchange="changeData(this);"></td>
        <td><input type="number" name="unitPrice" value="0" placeholder="Đơn giá" class="form-control-sm" onchange="changeData(this);"></td>
        <td><span class="rowQuantity">0</span>&nbsp;<span class="row-unit">m2</span></td>
        <td><span class="rowPriceData">0</span>&nbsp;<span>VNĐ</span></td>
        <td>
            <div class="table-data-feature">
                <button class="item" onclick="deleteRow(this);">
                    <i class="zmdi zmdi-delete"></i>
                </button>
            </div>
        </td>
    </tr>
</template>
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
            <form action="" method="post" class="form-horizontal">
                <div class="row form-group">
                    <div class="table-responsive table-data">
                        <table class="table" id="tb_data_sub">
                            <thead>
                                <tr>
                                    <td>TÊN</td>
                                    <td>SỐ ĐIỆN THOẠI</td>
                                    <td>ĐỊA CHỈ</td>
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

    $(document).ready(function(){
        $("#addRow").click(function(){
            let template = $("#templateRow");
            $("#tb_data tbody").append(template.html());
        });

        $("#btnReset").click(function(){
            window.location.reload();
        });

        $("#btnSave").click(function(){
            save();
        });

        $("#btnSaveBack").click(function(){
            save(true);
        });

        $("#btnSelect").click(function(){
            $("#modal1").modal('show');
        });

        $('#modal1').on('shown.bs.modal', function () {
            if(!table){
                table = CMTBL.init($('#tb_data_sub'),columns,ajax,null);
            }
        });
    });

    function deleteRow(rowIcon) {
        $(rowIcon).closest('tr').remove();
        getTotalPrice();
    }

    function changeData(subRow){
        var row = $(subRow).closest('tr');
        if(subRow.name == "print"){
            $(row).find('select[name=manufac1]').empty().html('<option value>Chọn gia công</option>');
            $(row).find('select[name=manufac2]').empty().html('<option value>Chọn hỗ trợ</option>');

            if(!COMMON._isNullOrEmpty(subRow)){
                let option = $(subRow).find(':selected');
                let dataType = option.data('subtype');
                let unit = option.data('subunit');
                $.when(getPrintData($(subRow).val())).done(data=>{
                    var manu1 = data.data.manufac1;
                    var manu2 = data.data.manufac2;
                    $.each(manu1, ( index, item ) => {
                        $(row).find('select[name=manufac1]').append(`<option value="${item.name}">${item.name}</option>`);
                    });
                    $.each(manu2, ( index, item ) => {
                        $(row).find('select[name=manufac2]').append(`<option value="${item.name}">${item.name}</option>`);
                    });
                    if(dataType == "2"){
                        $(row).find('input[name=width]').prop('type','hidden');
                        $(row).find('input[name=height]').prop('type','hidden');
                    }else{
                        $(row).find('input[name=width]').prop('type','number');
                        $(row).find('input[name=height]').prop('type','number');
                    }
                    $(row).find('.row-unit').text(unit);
                });
            }
        }

        let width = COMMON._isNullOrEmpty($(row).find('input[name=width]')) ? 0 :  Number.parseFloat($(row).find('input[name=width]')[0].value);
        let height = COMMON._isNullOrEmpty($(row).find('input[name=height]')) ? 0 : Number.parseFloat($(row).find('input[name=height]')[0].value);
        let quantity = COMMON._isNullOrEmpty($(row).find('input[name=quantity]')) ? 0 : Number.parseInt($(row).find('input[name=quantity]')[0].value);
        let unitPrice = COMMON._isNullOrEmpty($(row).find('input[name=unitPrice]')) ? 0 : Number.parseFloat($(row).find('input[name=unitPrice]')[0].value);
        
        var isIns = $(row).find('input[name=flg]')[0].value == 'I' ? true :false;
        
        let print = isIns ? $(row).find('select[name=print]')[0].value : $(row).find('input[name=print]')[0].value;

        if(print == ''){
            $(row).find('span.rowPriceData').text(0);
        }else{
            let unit = isIns ? $(row).find('select[name=print] option:selected').data('subtype') : $(row).find('input[name=unit]')[0].value;
            if(unit == 1){
                var size = width * height * quantity;
                let price = size * unitPrice;
                $(row).find('span.rowQuantity').text(size);
                $(row).find('span.rowPriceData').text((price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            }else{
                let price = quantity * unitPrice;
                $(row).find('span.rowQuantity').text(quantity);
                $(row).find('span.rowPriceData').text((price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            }
            getTotalPrice();
        }
    }

    function reset() {
        window.location.reload();
    }

    function save(isback=false) {
        if(!validate()) return;

        if($("#tb_data tbody tr").length == 0){
            alert('Vui lòng kiểm tra chi tiết.');
            return;
        }
        var details = getDetails();

        if(details.length == 0) return;

        var data = {
            'id' : '{{$order->id}}',
            "name"   : $("#name").val(),
            "phone"  : $("#phone").val(),
            "address": $("#address").val(),
            "payment": Number.parseInt($("#payment").val()),
            "release": $("#release").val(),
            "note"   : $("#note").val(),
            "detail" : details,
            "amount"  : $("#totalPrice").text().replaceAll('.','')
        }

        return $.ajax({
            url : "{{ url('api/order') }}",
            type : "PATCH",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message)
                if(isback){
                    window.location.href = '{{url("/order/list")}}';
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

    function getDetails() {
        var rows = $("#tb_data tbody tr");
        var rowSize = rows.length;
        var result = [];

        $(rows).each(function (index,row) {

            let flg = $(row).find('input[name=flg]')[0].value;

            var print_name,
                manufac1,
                manufac2,
                unit,
                unit_name;

            var width = COMMON._isNullOrEmpty($(row).find('input[name=width]')) ? 0 :  Number.parseFloat($(row).find('input[name=width]')[0].value);
            var height = COMMON._isNullOrEmpty($(row).find('input[name=height]')) ? 0 : Number.parseFloat($(row).find('input[name=height]')[0].value);
            var quantity = COMMON._isNullOrEmpty($(row).find('input[name=quantity]')) ? 0 : Number.parseInt($(row).find('input[name=quantity]')[0].value);
            var unitPrice = COMMON._isNullOrEmpty($(row).find('input[name=unitPrice]')) ? 0 : Number.parseFloat($(row).find('input[name=unitPrice]')[0].value);
            var amount = Number.parseFloat($(row).find('span.rowPriceData').text().replaceAll('.',''));
            var total = Number.parseInt($(row).find('span.rowQuantity').text());

            if(flg == 'I'){
                print_name = $(row).find('select[name=print] option:selected')[0].text;
                manufac1 = $(row).find('select[name=manufac1]')[0].value;
                manufac2 = $(row).find('select[name=manufac2]')[0].value;

                if(COMMON._isNullOrEmpty($(row).find('select[name=print]'))){
                    alert('Vui lòng chọn loại in!');
                    $(item).find('select[name=print]')[0].focus();
                    result = [];
                    return false;
                }

                unit = $(row).find('select[name=print] option:selected').data('subtype');
                unit_name = $(row).find('select[name=print] option:selected').data('subunit');
  

            }else{
                print_name =  $(row).find('input[name=print]')[0].value;
                manufac1 = $(row).find('input[name=manufac1]')[0].value;
                manufac2 = $(row).find('input[name=manufac2]')[0].value;
                unit = $(row).find('input[name=unit]')[0].value;
                unit_name = $(row).find('input[name=unit_name]')[0].value;
            }

            if(unit == 1){
                if(width == 0){
                    alert('Vui lòng chọn nhập chiều rộng!');
                    $(row).find('input[name=width]')[0].focus();
                    result = [];
                    return false;
                }

                if(height == 0){
                    alert('Vui lòng chọn nhập chiều dài!');
                    $(row).find('input[name=height]')[0].focus();
                    result = [];
                    return false;
                }
            }

            if(quantity == 0){
                alert('Vui lòng chọn nhập số lượng!');
                $(row).find('input[name=quantity]')[0].focus();
                result = [];
                return false;
            }

            if(unitPrice == 0){
                alert('Vui lòng chọn nhập đơn giá!');
                $(row).find('input[name=unitPrice]')[0].focus();
                result = [];
                return false;
            }

            var data = {
                    "print_name"  : print_name,
                    "manufac1"  : manufac1,
                    "manufac2"  : manufac2,
                    "width"     : width,
                    "heigth"    : height,
                    "quantity"  : quantity,
                    "unit_price" : unitPrice,
                    "unit_name" : unit_name,
                    "amount"    : amount,
                    "total" : total,
                }
                result.push(data);
            
        });
        return result;
    }

    function validate() {
        if(COMMON._isNullOrEmpty($("#name"))){
            alert('Tên khách hàng không được để trống!');
            $("#name").focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($("#phone"))){
            alert('Số điện thoại không được để trống!');
            $("#phone").focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($("#address"))){
            alert('Địa chỉ không được để trống!');
            $("#address").focus();
            return false;
        }

        return true;
    }

    function setCustomer(name,phone,address) {
        $("#name").val(name);
        $("#phone").val(phone);
        $("#address").val(address);
        $("#modal1").modal('hide');
    }

    function getPrintData(printId) {
        return $.ajax({
            url : "{{ url('api/print/info') }}/" + printId,
            type : "GET",
            dataType:"json",
            success : function(data) {
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

    function getTotalPrice() {
        var rows = $("#tb_data tbody tr");
        var total  = 0;
        $(rows).each(function (index,item) {
            total += Number.parseFloat($(item).find('span.rowPriceData').text().replaceAll('.',''));
        });
        $("#totalPrice").text((total+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
    }
</script>
@endsection
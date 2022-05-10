@extends('layout.app')
@section('title','Tạo mới đơn hàng')
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

    .table-data input.form-control-sm,
    .table-data select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 2px);
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
                        <label for="name" class=" form-control-label">Tên khách hàng (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="name" name="name" placeholder="Tên khách hàng" class="form-control">
                    </div>
                    <div class="col col-sm-6">
                        <button id="btnSelect"><i class="fa fa-user"></i></button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="phone" class=" form-control-label">Số điện thoại (<span class="required">*</span>)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="phone" name="phone" placeholder="Số điện thoại" class="form-control">
                    </div>
                    <div class="col col-md-2">
                        <label for="address" class=" form-control-label">Địa chỉ (<span class="required">*</span>)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="address" name="address" placeholder="Địa chỉ" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="payment" class=" form-control-label">Trả trước</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="number" id="payment" name="payment" placeholder="Số tiền trả trước" class="form-control" value="0">
                    </div>
                    <div class="col col-md-2">
                        <label for="release" class=" form-control-label">Ngày hoàn thành</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="date" id="release" name="release" placeholder="Ngày hoàn thành" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="note" class=" form-control-label">Ghi chú</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <textarea name="note" id="note" rows="9" placeholder="Ghi chú..." class="form-control"></textarea>
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
                                <col style="width:5%">
                                <col style="width:15%">
                                <col style="width:15%">
                                <col style="width:15%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:5%">
                              </colgroup>
                            <thead>
                                <tr>
                                    <td>STT</td>
                                    <td>LOẠI IN</td>
                                    <td>GIA CÔNG</td>
                                    <td>HỖ TRỢ</td>
                                    <td>KÍCH THƯỚC</td>
                                    <td>SỐ LƯỢNG</td>
                                    <td>ĐƠN GIÁ</td>
                                    <td>TỔNG</td>
                                    <td>THÀNH TIỀN</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>
                                        <select name="print" class="form-control-sm form-control" onchange="changeData(this);">
                                            <option value=''>Chọn loại in</option>
                                            @foreach ($printes as $pr)
                                            <option value="{{$pr->id}}" data-subtype="{{$pr->price_type}}" data-subunit="{{$pr->type_name}}">{{$pr->name . " / " .$pr->sub_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>                                        
                                        <select name="manufac1" class="form-control-sm form-control" onchange="changeData(this);">
                                            <option value=''>Chọn gia công</option>
                                        </select>
                                    </td>
                                    <td>                                        
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
                                </tr> --}}
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
                        <span class="text-danger text-strong" id="totalPrice">0</span>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdDetail">
                    Open modal
                  </button>
            <button type="button" class="btn btn-outline-primary mr-2" id="btnSaveBack">
                <i class="fa fa-reply"></i>&nbsp; Lưu và quay lại</button>
            <button type="button" class="btn btn-outline-warning mr-2" id="btnReset">
                <i class="fa fa-undo"></i>&nbsp; Reset</button>
            <a class="btn btn-outline-secondary" href="{{url('/order/list')}}">
                <i class="fa fa-times"></i>&nbsp; Hủy</a>
        </div>
    </div>
</div>

<!-- For print type 1-->
<template id="tmpPrintType1">
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine1" class=" form-control-label">Gia công :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine1" name="machine1" class="form-control-sm form-control">
                <option value=''>Chọn gia công</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine2" class=" form-control-label">Hỗ trợ :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine2" name="machine2" class="form-control-sm form-control">
                <option value=''>Chọn hỗ trợ</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="width" class=" form-control-label">Kích thước :</label>
        </div>
        <div class="col-12 col-md-4">
            <input type="number" id="width" name="width" placeholder="Ngang(m2)" class="form-control" onchange="changeDataPr1();">
        </div>
        <div class="col-12 col-md-4">
            <input type="number" id="heigth" name="heigth" placeholder="Dọc(m2)" class="form-control" onchange="changeDataPr1();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="quantity" class=" form-control-label">Số lượng :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" class="form-control" onchange="changeDataPr1();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class=" form-control-label">Đơn giá :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="unitPrice" name="unitPrice" placeholder="Đơn giá (VNĐ/m2)" class="form-control" onchange="changeDataPr1();">
        </div>
    </div>
</template>
<!-- For print type 1-->

<!-- For print type 2-->
<template id="tmpPrintType2">
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine1" class=" form-control-label">Gia công :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine1" name="machine1" class="form-control-sm form-control" onchange="changeDataPr2();">
                <option value=''>Chọn gia công</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine2" class="form-control-label">Hỗ trợ :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine2" name="machine2" class="form-control-sm form-control" onchange="changeDataPr2();">
                <option value=''>Chọn hỗ trợ</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="quantity" class="form-control-label">Số lượng :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" class="form-control" onchange="changeDataPr2();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class="form-control-label">Đơn giá :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="unitPrice" name="unitPrice" placeholder="Đơn giá" class="form-control" onchange="changeDataPr2();">
        </div>
    </div>
</template>
<!-- For print type 2-->

<!-- For print type 3-->
<template id="tmpPrintType3">
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine1" class="form-control-label">Gia công :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine1" name="machine1" class="form-control-sm form-control">
                <option value=''>Chọn gia công</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine2" class=" form-control-label">Hỗ trợ :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine2" name="machine2" class="form-control-sm form-control">
                <option value=''>Chọn hỗ trợ</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="size" class="form-control-label">Kích thước :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="size" name="size" class="form-control-sm form-control">
                <option value=''>Chọn kích thước</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="quantity" class=" form-control-label">Số lượng :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" class="form-control" onchange="changeDataPr2();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class=" form-control-label">Đơn giá :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="unitPrice" name="unitPrice" placeholder="Đơn giá (VNĐ/m2)" class="form-control" onchange="changeDataPr2();">
        </div>
    </div>
</template>
<!-- For print type 3-->

<!-- For print type 4-->
<template id="tmpPrintType3">
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine1" class=" form-control-label">Gia công :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine1" name="machine1" class="form-control-sm form-control">
                <option value=''>Chọn gia công</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="machine2" class=" form-control-label">Hỗ trợ :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine2" name="machine2" class="form-control-sm form-control">
                <option value=''>Chọn hỗ trợ</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="size" class=" form-control-label">Kích thước :</label>
        </div>
        <div class="row form-group">
            <div class="col col-md-4">
                <label for="width" class=" form-control-label">Kích thước :</label>
            </div>
            <div class="col-12 col-md-4">
                <input type="number" id="width" name="width" placeholder="Ngang(m2)" class="form-control">
            </div>
            <div class="col-12 col-md-4">
                <input type="number" id="heigth" name="heigth" placeholder="Dọc(m2)" class="form-control">
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="quantity" class=" form-control-label">Số lượng :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" name="quantity" placeholder="Số lượng" class="form-control" onchange="changeDataPr2();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class=" form-control-label">Đơn giá :</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" name="unitPrice" placeholder="Đơn giá" class="form-control" onchange="changeDataPr2();">
        </div>
    </div>
</template>
<!-- For print type 4-->
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

<!-- modal detail -->
<div class="modal fade" id="mdDetail" tabindex="-1" role="dialog" aria-labelledby="mdDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdDetailLabel">
                    <i class="mr-2 fa fa-align-justify"></i>
                    Chi tiết đơn hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="dPrintType" class=" form-control-label">Tên loại in</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <select id="dPrintType" name="dPrintType" class="form-control-sm form-control" onchange="changePrintType(this);">
                                <option value=''>Chọn loại in</option>
                                @foreach ($printes as $pr)
                                <option value="{{$pr->id}}" data-subtype="{{$pr->price_type}}" data-subunit="{{$pr->type_name}}">{{$pr->name . " / " .$pr->sub_name}}</option>
                                @endforeach
                            </select>
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
    {"data" : "name", "orderable": false,},
    {"data" : "phone", "orderable": false,},
    {"data" : "address", "orderable": false,},
    {"data" : "name", "orderable": false, "render": function ( data, type, row, meta ) {
        return `<a href="#" onclick="setCustomer('${row.name}','${row.phone}','${row.address}')"><i class="fa fa-location-arrow"></i></a>`;
    }},
];

var detailData = [];
    
    var ajax = {
    'url' : '{{url("api/order/customer")}}',
    "type": "GET",
    "data": {
        "value" : function() { return $('#sValue').val() },
        },
    };
    var table;

    $(document).ready(function(){
        $("#addRow").click(function(){
            let template = $("#templateRow");
            $("#tb_data tbody").append(template.html());
        });

        $("#btnReset").click(function(){
            reset();
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

        $("#btnSeach").click(function(){
            table.ajax.reload(null,true);
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
        let print = $(row).find('select[name=print]')[0].value;
        if(print == ''){
            $(row).find('span.rowPriceData').text(0);
        }else{
            let unit = $(row).find('select[name=print] option:selected').data('subtype');
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
        $("#name").val('');
        $("#phone").val('');
        $("#address").val('');
        $("#payment").val(0);
        $("#release").val('');
        $("#note").val('');
        $("#tb_data tbody").empty();
        let template = $("#templateRow");
        $("#tb_data tbody").append(template.html());
        $("#totalPrice").text("0");
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
            type : "POST",
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
            let print_name = $(row).find('select[name=print] option:selected')[0].text;
            let manufac1 = $(row).find('select[name=manufac1]')[0].value;
            let manufac2 = $(row).find('select[name=manufac2]')[0].value;
            let width = COMMON._isNullOrEmpty($(row).find('input[name=width]')) ? 0 :  Number.parseFloat($(row).find('input[name=width]')[0].value);
            let height = COMMON._isNullOrEmpty($(row).find('input[name=height]')) ? 0 : Number.parseFloat($(row).find('input[name=height]')[0].value);
            let quantity = COMMON._isNullOrEmpty($(row).find('input[name=quantity]')) ? 0 : Number.parseInt($(row).find('input[name=quantity]')[0].value);
            let unitPrice = COMMON._isNullOrEmpty($(row).find('input[name=unitPrice]')) ? 0 : Number.parseFloat($(row).find('input[name=unitPrice]')[0].value);

            let amount = Number.parseFloat($(row).find('span.rowPriceData').text().replaceAll('.',''));
            let total = Number.parseInt($(row).find('span.rowQuantity').text());
            let unit = $(row).find('select[name=print] option:selected').data('subtype');

            if(COMMON._isNullOrEmpty($(row).find('select[name=print]'))){
                alert('Vui lòng chọn loại in!');
                $(item).find('select[name=print]')[0].focus();
                result = [];
                return false;
            }

            let unit_name = $(row).find('select[name=print] option:selected').data('subunit');
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
                "unit_type" : unit,
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

    $('#mdDetail').on('shown.bs.modal', function () {
        $("#dPrintType").val("");
        $("#detailWrap").empty();
        $("#spTotal").text("0");
        $("#spunit").text("");
        $("#spAmount").text("0");
    })

    function changePrintType(element) {
        var subtype = $(element).find('option:selected').data('subtype');
        var currentId = element.value;
        switch (subtype) {
            case 1:
                loadSubtype1(currentId);
                break;
            case 2:
                loadSubtype2(currentId);
                break;
            case 3:
                loadSubtype3(currentId);
                break;
            case 4:
                loadSubtype4(currentId);
                break;
            default:
                break;
        }
    }

    function loadSubtype1(id) {
        let template = $("#tmpPrintType1");
        $("#detailWrap").empty().append(template.html());
        $.when(getPrintData(id)).done(data=>{
            var manu1 = data.data.manufac1;
            var manu2 = data.data.manufac2;
            $.each(manu1, ( index, item ) => {
                $('#machine1').append(`<option value="${item.name}">${item.name}</option>`);
            });
            $.each(manu2, ( index, item ) => {
                $('#machine2').append(`<option value="${item.name}">${item.name}</option>`);
            });
        });
    }

    function loadSubtype2(id) {
        let template = $("#tmpPrintType2");
        $("#detailWrap").empty().append(template.html());
        $.when(getPrintData(id)).done(data=>{
            var manu1 = data.data.manufac1;
            var manu2 = data.data.manufac2;
            $.each(manu1, ( index, item ) => {
                $('#machine1').append(`<option value="${item.name}">${item.name}</option>`);
            });
            $.each(manu2, ( index, item ) => {
                $('#machine2').append(`<option value="${item.name}">${item.name}</option>`);
            });
        });
    }

    function loadSubtype3(id) {
        let template = $("#tmpPrintType3");
        $("#detailWrap").empty().append(template.html());
        $.when(getPrintData(id)).done(data=>{
            var manu1 = data.data.manufac1;
            var manu2 = data.data.manufac2;
            var manu3 = data.data.manufac3;
            $.each(manu1, ( index, item ) => {
                $('#machine1').append(`<option value="${item.name}">${item.name}</option>`);
            });
            $.each(manu2, ( index, item ) => {
                $('#machine2').append(`<option value="${item.name}">${item.name}</option>`);
            });
            $.each(manu3, ( index, item ) => {
                $('#size').append(`<option value="${item.name}">${item.name}</option>`);
            });
        });
    }
    
    function loadSubtype4(id) {
        let template = $("#tmpPrintType4");
        $("#detailWrap").empty().append(template.html());
        $.when(getPrintData(id)).done(data=>{
            var manu1 = data.data.manufac1;
            var manu2 = data.data.manufac2;
            $.each(manu1, ( index, item ) => {
                $('#machine1').append(`<option value="${item.name}">${item.name}</option>`);
            });
            $.each(manu2, ( index, item ) => {
                $('#machine2').append(`<option value="${item.name}">${item.name}</option>`);
            });
        });
    }

    function changeDataPr1() {
        if(COMMON._isNullOrEmpty("#width")
        || COMMON._isNullOrEmpty("#heigth")
        || COMMON._isNullOrEmpty("#quantity")
        || COMMON._isNullOrEmpty("#unitPrice")) return;

        var width = Number.parseFloat($("#width").val());
        var heigth = Number.parseFloat($("#heigth").val());
        var quantity = Number.parseInt($("#quantity").val());
        var unitPrice = Number.parseInt($("#unitPrice").val());

        var size = width * heigth * quantity;
        let price = size * unitPrice;

        let priceText = (price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')

        $("#spTotal").text(size);
        $("#spunit").text("m2");
        $("#spAmount").text(priceText);
    }

    function changeDataPr2() {

        if(COMMON._isNullOrEmpty("#quantity")
        || COMMON._isNullOrEmpty("#unitPrice")) return;

        var quantity = Number.parseInt($("#quantity").val());
        var unitPrice = Number.parseInt($("#unitPrice").val());
        var unit = $('#dPrintType option:selected').data('subunit');
        let price = quantity * unitPrice;

        let priceText = (price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')

        $("#spTotal").text(quantity);
        $("#spunit").text(unit);
        $("#spAmount").text(priceText);
    }

    function addPrintDetail() {
        var printType = $("#dPrintType option:selected").data('subtype');
        switch (printType) {
            case 1:
                applyData1();
                break;
            case 2:
                applyData2();
                break;
            case 3:
                applyData3();
                break;
            case 4:
                applyData1();
                break;
            default:
                break;
        }
        loadDetail();
        $("#mdDetail").modal('hide');
    }

    function applyData1() {
        var width = Number.parseFloat($("#width").val());
        var heigth = Number.parseFloat($("#heigth").val());
        var quantity = Number.parseInt($("#quantity").val());
        var unitPrice = Number.parseInt($("#unitPrice").val());
        var machine1 = $("#machine1 option:selected").text();
        var machine2 = $("#machine2 option:selected").text()

        var totalSize = $("#spTotal").text();
        var unit = $("#spunit").text();
        var amount = $("#spAmount").text();

        var object = {
            print_id : $("#dPrintType").val(),
            print_name : $("#dPrintType option:selected").text(),
            machine1 : machine1,
            machine2 : machine2,
            width : $("#dPrintType option:selected").val(),
            height : $("#dPrintType option:selected").val(),
            size : width + unit + ' x ' + heigth + unit,
            quantity : quantity,
            unit_price : unitPrice,
            total_size : totalSize,
            unit : unit,
            amount : amount,
            amount_display : amount,
        }

        detailData.push(object);
    }

    function applyData2() {
        var quantity = Number.parseInt($("#quantity").val());
        var unitPrice = Number.parseInt($("#unitPrice").val());
        var machine1 = $("#machine1 option:selected").text();
        var machine2 = $("#machine2 option:selected").text();

        var totalSize = $("#spTotal").text();
        var unit = $("#spunit").text();
        var amount = $("#spAmount").text();

        var object = {
            print_id : $("#dPrintType").val(),
            print_name : $("#dPrintType option:selected").text(),
            machine1 : machine1,
            machine2 : machine2,
            width : 0,
            height : 0,
            size : '',
            quantity : quantity,
            unit_price : unitPrice,
            total_size : totalSize,
            unit : unit,
            amount : amount,
            amount_display : amount,
        }

        detailData.push(object);
    }

    function applyData3() {
        var quantity = Number.parseInt($("#quantity").val());
        var unitPrice = Number.parseInt($("#unitPrice").val());
        var machine1 = $("#machine1 option:selected").text();
        var machine2 = $("#machine2 option:selected").text();
        var machine3 = $("#size option:selected").text();

        var totalSize = $("#spTotal").text();
        var unit = $("#spunit").text();
        var amount = $("#spAmount").text();

        var object = {
            print_id : $("#dPrintType").val(),
            print_name : $("#dPrintType option:selected").text(),
            machine1 : machine1,
            machine2 : machine2,
            width : 0,
            height : 0,
            size : machine3,
            quantity : quantity,
            unit_price : unitPrice,
            total_size : totalSize,
            unit : unit,
            amount : amount,
            amount_display : amount,
        }

        detailData.push(object);
    }

    function loadDetail() {
        $("#tb_data tbody").empty();
        $.each(detailData, ( index, item ) => {
            $("#tb_data tbody").append(
                `<tr>
                    <td>${index + 1}</td>
                    <td>${item.print_name}</td>
                    <td>${item.machine1}</td>
                    <td>${item.machine2}</td>
                    <td>${item.size}</td>
                    <td>${item.quantity}</td>
                    <td>${item.unit_price}</td>
                    <td>${item.total_size + item.unit}</td>
                    <td>${item.amount_display}&nbsp; VNĐ</td>
                    <td><div class="table-data-feature">
                        <button class="item" onclick="deleteRow(this);">
                            <i class="zmdi zmdi-delete"></i>
                        </button</div>
                    </td>
                </tr>`)
        });
    }

</script>
@endsection
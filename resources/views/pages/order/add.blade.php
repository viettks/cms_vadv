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

    input.form-control-sm {
        border: 1px solid #ced4da;
    }

    .print-size {
        max-width: 50px;
    }

    .print-quant {
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
                <!-- FORM USER INFO -->
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin khách hàng</h5>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="name" class=" form-control-label">Tên khách hàng (<span
                                class="required">*</span>)</label>
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
                        <label for="phone" class=" form-control-label">Số điện thoại (<span
                                class="required">*</span>)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="phone" name="phone" placeholder="Số điện thoại" class="form-control">
                    </div>
                    <div class="col col-md-2">
                        <label for="address" class=" form-control-label">Địa chỉ (<span
                                class="required">*</span>)</label>
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
                        <input type="number" id="payment" name="payment" placeholder="Số tiền trả trước"
                            class="form-control" value="0">
                    </div>
                    <div class="col col-md-2">
                        <label for="release" class=" form-control-label">Ngày hoàn thành</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="date" id="release" name="release" placeholder="Ngày hoàn thành"
                            class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="isVat" class=" form-control-label">VAT (?)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="checkbox" id="isVat" name="isVat">
                    </div>
                    <div class="col col-md-2">
                        <label for="vatFee" class=" form-control-label">Số tiền VAT (10%)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="vatFee" name="release" placeholder="Số tiền VAT" class="form-control"
                            value="0" disabled>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="note" class=" form-control-label">Ghi chú</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <textarea name="note" id="note" rows="9" placeholder="Ghi chú..."
                            class="form-control"></textarea>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Chi tiết đơn hàng (<span class="required">*</span>)</h5>
                </div>
                <div class="table-data__tool">
                    <div class="table-data__tool-left w-100">
                    </div>
                    <div class="table-data__tool-right">
                        <button type="button" class="btn btn-outline-primary btn-sm ml-5" data-toggle="modal"
                            data-target="#mdDetail" data-mode="I">
                            Thêm dòng
                        </button>
                    </div>
                </div>
                <!-- END FORM USER INFO -->

                <!-- TABLE ORDER DETAIL-->
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
                                    <td>HỖ TRỢ (CHẤT LIỆU)</td>
                                    <td>KÍCH THƯỚC</td>
                                    <td>SỐ LƯỢNG</td>
                                    <td>ĐƠN GIÁ</td>
                                    <td>TỔNG</td>
                                    <td>THÀNH TIỀN</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END TABLE ORDER DETAIL-->

                <!-- TOTAL AMOUNT -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left w-100">
                        <span class="text-danger text-strong">
                            <i class="fa fa-dollar"></i>&nbsp; Tổng giá trị : </span>
                        <span class="text-danger text-strong" id="totalPrice">0</span>
                        <span class="text-danger text-strong"> VNĐ.</span>
                    </div>
                    <hr>
                </div>
                <!-- END TOTAL AMOUNT -->
            </form>
        </div>
        <!-- GROUP ACTION -->
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
        <!-- END GROUP ACTION -->
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
            <label for="width" class=" form-control-label">Kích thước (<span class="required">*</span>)</label></label>
        </div>
        <div class="col-12 col-md-4">
            <input type="number" id="width" name="width" placeholder="Ngang(m2)" class="form-control"
                onchange="changeDataPr1();">
        </div>
        <div class="col-12 col-md-4">
            <input type="number" id="heigth" name="heigth" placeholder="Dọc(m2)" class="form-control"
                onchange="changeDataPr1();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="quantity" class=" form-control-label">Số lượng (<span class="required">*</span>)</label></label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" class="form-control"
                onchange="changeDataPr1();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class=" form-control-label">Đơn giá (<span class="required">*</span>)</label></label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="unitPrice" name="unitPrice" placeholder="Đơn giá (VNĐ/m2)" class="form-control"
                onchange="changeDataPr1();">
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
            <label for="quantity" class="form-control-label">Số lượng (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" class="form-control"
                onchange="changeDataPr2();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class="form-control-label">Đơn giá (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="unitPrice" name="unitPrice" placeholder="Đơn giá" class="form-control"
                onchange="changeDataPr2();">
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
            <label for="machine2" class=" form-control-label">Chất liệu :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine2" name="machine2" class="form-control-sm form-control">
                <option value=''>Chọn chất liệu</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="size" class="form-control-label">Kích thước (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="size" name="size" class="form-control-sm form-control">
                <option value=''>Chọn kích thước</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="quantity" class=" form-control-label">Số lượng (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" class="form-control"
                onchange="changeDataPr2();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class=" form-control-label">Đơn giá (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="unitPrice" name="unitPrice" placeholder="Đơn giá" class="form-control"
                onchange="changeDataPr2();">
        </div>
    </div>
</template>
<!-- For print type 3-->

<!-- For print type 4-->
<template id="tmpPrintType4">
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
            <label for="machine2" class=" form-control-label">Chất liệu :</label>
        </div>
        <div class="col-12 col-md-8">
            <select id="machine2" name="machine2" class="form-control-sm form-control">
                <option value=''>Chọn chất liệu</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="width" class=" form-control-label">Kích thước (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-4">
            <input type="number" id="width" name="width" placeholder="Ngang(m2)" class="form-control">
        </div>
        <div class="col-12 col-md-4">
            <input type="number" id="heigth" name="heigth" placeholder="Dọc(m2)" class="form-control">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="quantity" class=" form-control-label">Số lượng (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" class="form-control"
                onchange="changeDataPr2();">
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="unitPrice" class=" form-control-label">Đơn giá (<span class="required">*</span>)</label>
        </div>
        <div class="col-12 col-md-8">
            <input type="number" id="unitPrice" name="unitPrice" placeholder="Đơn giá" class="form-control"
                onchange="changeDataPr2();">
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
                    Danh sách khách hàng
                </h5>
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
                            <select id="dPrintType" name="dPrintType" class="form-control-sm form-control"
                                onchange="changePrintType(this);">
                                <option value=''>Chọn loại in</option>
                                @foreach ($printes as $pr)
                                <option value="{{$pr->id}}" data-subtype="{{$pr->price_type}}"
                                    data-subunit="{{$pr->type_name}}">{{$pr->name . " / " .$pr->sub_name}}</option>
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

    // define local variable
    var table;
    var columns;
    var detailData = [];
    var ajax;

    /* Initialization  */
    $(document).ready(function(){
        initDatatable();
        initialization();
    });


    // Screen Initialization
    function initialization(){
        
        //main actions
        $("#btnReset").click(function(){
            reset();
        });

        $("#btnSave").click(function(){
            save();
        });

        $("#btnSaveBack").click(function(){
            save(true);
        });
        
        //sub actions
        $("#btnSelect").click(function(){
            $("#modal1").modal('show');
        });

        $("#addRow").click(function(){
            let template = $("#templateRow");
            $("#tb_data tbody").append(template.html());
        });

        $("#isVat").change(()=>{loadDetail();});
    }

    function initDatatable(){
        columns = [
                {"data" : "name", "orderable": false,},
                {"data" : "phone", "orderable": false,},
                {"data" : "address", "orderable": false,},
                {"data" : "name", "orderable": false, "render": function ( data, type, row, meta ) {
                return `<a href="#" onclick="setCustomer('${row.name}','${row.phone}','${row.address}')"><i
                        class="fa fa-location-arrow"></i></a>`;
                }},
            ];

        ajax = {
            'url' : '{{url("api/order/customer")}}',
            "type": "GET",
            "data": {
            "value" : function() { return $('#sValue').val() },
            },
        };

        $("#btnSeach").click(function(){
            table.ajax.reload(null,true);
        });

        $('#modal1').on('shown.bs.modal', function (element) {
            if(!table){
                table = CMTBL.init($('#tb_data_sub'),columns,ajax,null);
            }
        });
    }

    // main action
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

        if(detailData.length == 0){
            alert('Vui lòng kiểm tra chi tiết đơn hàng.');
            return;
        }

        var data = {
            "name"   : $("#name").val(),
            "phone"  : $("#phone").val(),
            "address": $("#address").val(),
            "payment": Number.parseInt($("#payment").val()),
            "release": $("#release").val(),
            "note"   : $("#note").val(),
            "detail" : detailData,
            "is_vat"  : $("#isVat").is(":checked") ? '1' : '0',
            "vat_fee"  : $("#vatFee").val().replaceAll('.',''),
            "amount"  : $("#totalPrice").text().replaceAll('.','')
        }

        return $.ajax({
            url : "{{ url('api/order') }}",
            type : "POST",
            dataType:"json",
            data: data,
            success : function(data) {
                debugger
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

    // end main action

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
                var size = Number.parseFloat(width * height * quantity);
                let price = Math.round(size * unitPrice);
                $(row).find('span.rowQuantity').text(size);
                $(row).find('span.rowPriceData').text((price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            }else{
                let price = Math.round(quantity * unitPrice);
                $(row).find('span.rowQuantity').text(quantity);
                $(row).find('span.rowPriceData').text((price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            }
            getTotalPrice();
        }
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

    $('#mdDetail').on('shown.bs.modal', function (element) {
        if(element.relatedTarget){
            $("#dPrintType").val("");
            $("#detailWrap").empty();
            $("#spTotal").text("0");
            $("#spunit").text("");
            $("#spAmount").text("0");
            $("#mode").val('I');
        }
    })

    function changePrintType(element,mode = "L") {
        var subtype = $(element).find('option:selected').data('subtype');
        var unit = $(element).find('option:selected').data('subunit');
        var currentId = element.value;
        switch (subtype) {
            case 1:
                loadSubtype1(currentId,mode);
                break;
            case 2:
                loadSubtype2(currentId,mode);
                break;
            case 3:
                loadSubtype3(currentId,mode);
                break;
            case 4:
                loadSubtype4(currentId,mode);
                break;
            default:
                break;
        }
        $("#spunit").text(unit);
    }

    function loadSubtype1(id,mode="L") {
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
            if (mode =="U" && $("#mode").val() == "U"){
                var mc1 = $("#defmc1").val();
                var mc2 = $("#defmc2").val();
                $('#machine1').val(mc1);
                $('#machine2').val(mc2);
            }
        });
    }

    function loadSubtype2(id,mode = "L") {
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
            if (mode =="U" && $("#mode").val() == "U"){
                var mc1 = $("#defmc1").val();
                var mc2 = $("#defmc2").val();

                $('#machine1').val(mc1);
                $('#machine2').val(mc2);
            }
        });
    }

    function loadSubtype3(id,mode = "L") {
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
            if (mode =="U" && $("#mode").val() == "U"){
                var mc1 = $("#defmc1").val();
                var mc2 = $("#defmc2").val();
                var mc3 = $("#defmc3").val();
                $('#machine1').val(mc1);
                $('#machine2').val(mc2);
                $('#size').val(mc3);
            }
        });
    }
    
    function loadSubtype4(id,mode = "L") {
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
            if (mode =="U" && $("#mode").val() == "U"){
                var mc1 = $("#defmc1").val();
                var mc2 = $("#defmc2").val();

                $('#machine1').val(mc1);
                $('#machine2').val(mc2);
            }
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
        let price = Math.round(size * unitPrice);
        let priceText = (price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')

        $("#spTotal").text(size);
        $("#spAmount").text(priceText);
    }

    function changeDataPr2() {

        if(COMMON._isNullOrEmpty("#quantity")
        || COMMON._isNullOrEmpty("#unitPrice")) return;

        var quantity = Number.parseInt($("#quantity").val());
        var unitPrice = Number.parseInt($("#unitPrice").val());
        var unit = $('#dPrintType option:selected').data('subunit');
        let price = Math.round(quantity * unitPrice);

        let priceText = (price+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')

        $("#spTotal").text(quantity);
        $("#spAmount").text(priceText);
    }

    function addPrintDetail() {
        var printType = $("#dPrintType option:selected").data('subtype');
        if(!validateDetail(printType)) return;
        applyData(printType);
        loadDetail();
        $("#mdDetail").modal('hide');
    }

    function applyData(print_type) {

        var width = 0;
        var heigth = 0;
        var quantity = Number.parseInt($("#quantity").val());
        var unitPrice = Number.parseInt($("#unitPrice").val());
        var machine1 = $("#machine1").val();
        var machine2 = $("#machine2").val()

        var print_id = $("#dPrintType").val();
        var size = '';
        
        var totalSize = $("#spTotal").text();
        var unit = $("#spunit").text();
        var amount = $("#spAmount").text();

        if(print_type == 1){
            width = Number.parseFloat($("#width").val());
            heigth = Number.parseFloat($("#heigth").val());
            size = width + unit + ' x ' + heigth + unit;
        }else if(print_type == 2){
        
        }else if(print_type == 3){
            size = $("#size").val();
        }else if(print_type == 4){
            width = Number.parseFloat($("#width").val());
            heigth = Number.parseFloat($("#heigth").val());
            size = width + 'm2' + ' x ' + heigth + 'm2';
        }

        var object = {
            print_id : $("#dPrintType").val(),
            print_name : $("#dPrintType option:selected").text(),
            print_type : print_type,
            machine1 : machine1,
            machine2 : machine2,
            width : width,
            heigth : heigth,
            size : size,
            quantity : quantity,
            unit_price : unitPrice,
            total_size : totalSize,
            unit : unit,
            amount : amount.replaceAll('.',''),
            amount_display : amount,
        }
        if($("#mode").val() == 'U'){
            index =  $("#index").val();
            detailData[index] = object;
        }else{
            detailData.push(object); 
        }
       
    }

    function validateDetail(print_type) {
        var check = true;
        if(print_type == 1){
            if(COMMON._isNullOrEmpty("#width")){
                alert("Vui lòng nhập chiều rộng.")
                $("#width").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#heigth")){
                alert("Vui lòng nhập chiều dài.")
                $("#heigth").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#quantity")){
                alert("Vui lòng nhập số lượng.")
                $("#quantity").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#unitPrice")){
                alert("Vui lòng nhập đơn giá.")
                $("#unitPrice").focus();
                return false;
            }
        }else if(print_type == 2){
            if(COMMON._isNullOrEmpty("#quantity")){
                alert("Vui lòng nhập số lượng.")
                $("#quantity").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#unitPrice")){
                alert("Vui lòng nhập đơn giá.")
                $("#unitPrice").focus();
                return false;
            }
        }else if(print_type == 3){
            if(COMMON._isNullOrEmpty("#size")){
                alert("Vui lòng chọn kích thước.")
                $("#size").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#quantity")){
                alert("Vui lòng nhập số lượng.")
                $("#quantity").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#unitPrice")){
                alert("Vui lòng nhập đơn giá.")
                $("#unitPrice").focus();
                return false;
            }
        }else if(print_type == 4){
            if(COMMON._isNullOrEmpty("#width")){
                alert("Vui lòng nhập chiều rộng.")
                $("#width").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#heigth")){
                alert("Vui lòng nhập chiều dài.")
                $("#heigth").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#quantity")){
                alert("Vui lòng nhập số lượng.")
                $("#quantity").focus();
                return false;
            }
            if(COMMON._isNullOrEmpty("#unitPrice")){
                alert("Vui lòng nhập đơn giá.")
                $("#unitPrice").focus();
                return false;
            }
        }
        return check;
    }

    function loadDetail() {
        $("#tb_data tbody").empty();
        var sum = 0;
        $.each(detailData, ( index, item ) => {
            sum += Number.parseInt(item.amount);
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
                        <button class="item" onclick="editDetail(${index});">
                            <i class="fa fa-edit"></i>
                        </button</div>
                        <button class="item" onclick="removerDetail(${index});">
                            <i class="zmdi zmdi-delete"></i>
                        </button</div>
                    </td>
                </tr>`)
        });
        var vat = 0;
        if($("#isVat").is(":checked")){
            vat = Number.parseInt(sum * 0.1);
        }

        $("#vatFee").val((vat+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
        var totalAmount = sum + vat;

        $("#totalPrice").text((totalAmount+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
    }

    function removerDetail(idx) {
        detailData.splice(idx, 1);
        loadDetail();
    } 

    function editDetail(idx) {
        var object = detailData[idx];
        $("#dPrintType").val(object.print_id);
        changePrintType($("#dPrintType")[0],"U");
        $("#index").val(idx);

        $("#defmc1").val(object.machine1);
        $("#defmc2").val(object.machine2);
        $("#quantity").val(object.quantity);
        $("#unitPrice").val(object.unit_price);

        $("#spTotal").text(object.total_size);
        $("#spAmount").text(object.amount_display);

        if(object.print_type == 1){
            $("#width").val(object.width);
            $("#heigth").val(object.heigth);

   
        }else if(object.print_type == 2){
        }else if(object.print_type == 3){
            $("#defmc3").val(object.size);
        }else if(object.print_type == 4){
            $("#width").val(object.width);
            $("#heigth").val(object.heigth);
        }
        $("#mode").val('U');
        $('#mdDetail').modal('show');
    }
</script>
@endsection
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
                    <div class="table-responsive table-data">
                        <table class="table" id="tb_data">
                            <thead>
                                <tr>
                                    <td>LOẠI IN</td>
                                    <td>CÁN MÀNG</td>
                                    <td>KÍCH THƯỚC NGANG</td>
                                    <td>KÍCH THƯỚC DỌC</td>
                                    <td>SỐ LƯỢNG</td>
                                    <td>GIÁ TIỀN</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="print" class="form-control-sm form-control" onchange="changeData(this);">
                                            <option disabled>Chọn loại in</option>
                                            @foreach ($printes as $pr)
                                            <option value="{{$pr->id}}">{{$pr->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>                                        
                                        <select name="film" class="form-control-sm form-control" onchange="changeData(this);">
                                        <option disabled>Chọn màng bọc</option>
                                        <option value="1">Không cán màng</option>
                                        <option value="2">Cán màng mờ</option>
                                        <option value="3">Cán màng bóng</option>
                                        </select>
                                    </td>
                                    <td><input type="number" name="width"   placeholder="Chiều ngang" class="form-control-sm" onchange="changeData(this);"></td>
                                    <td><input type="number" name="height" placeholder="Chiều dọc" class="form-control-sm" onchange="changeData(this);"></td>
                                    <td><input type="number" name="quantity" placeholder="Số lượng" class="form-control-sm" onchange="changeData(this);"></td>
                                    <td><input type="number" name="fixPrice" placeholder="Đơn giá" class="form-control-sm" onchange="changeData(this);"></td>
                                    <td><span class="rowPriceData">0</span></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" onclick="deleteRow(this);">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
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
            <select name="print" class="form-control-sm form-control" onchange="changeData(this);">
                <option disabled>Chọn loại in</option>
                @foreach ($printes as $pr)
                <option value="{{$pr->id}}">{{$pr->name}}</option>
                @endforeach
            </select>
        </td>
        <td>                                        
            <select name="film" class="form-control-sm form-control" onchange="changeData(this);">
            <option disabled>Chọn màng bọc</option>
            <option value="1">Không cán màng</option>
            <option value="2">Cán màng mờ</option>
            <option value="3">Cán màng bóng</option>
            </select>
        </td>
        <td><input type="number" name="width"   placeholder="Chiều ngang" class="form-control-sm" onchange="changeData(this);"></td>
        <td><input type="number" name="height" placeholder="Chiều dọc" class="form-control-sm" onchange="changeData(this);"></td>
        <td><input type="number" name="quantity" placeholder="Số lượng" class="form-control-sm" onchange="changeData(this);"></td>
        <td><input type="number" name="fixPrice" placeholder="Đơn giá" class="form-control-sm" onchange="changeData(this);"></td>
        <td><span class="rowPriceData">0</span></td>
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
    const print = @json($details);

    //FOR DATATABLE

var columns = [
    {"data" : "name", "orderable": false,},
    {"data" : "phone", "orderable": false,},
    {"data" : "address", "orderable": false,},
    {"data" : "name", "orderable": false, "render": function ( data, type, row, meta ) {
        return `<a href="#" onclick="setCustomer('${row.name}','${row.phone}','${row.address}')"><i class="fa fa-location-arrow"></i></a>`;
    }},
];
    
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
            //debugger
            if(!table){
                table = CMTBL.init($('#tb_data_sub'),columns,ajax,null);
            }
        });
    });

    function deleteRow(rowIcon) {
        $(rowIcon).closest('tr').remove();
        getPrice();
    }

    function changeData(subRow){
        var row = $(subRow).closest('tr');
        var invalid =    COMMON._isNullOrEmpty($(row).find('select[name=print]')) || COMMON._isNullOrEmpty($(row).find('select[name=film]'))
                    || COMMON._isNullOrEmpty($(row).find('input[name=width]'))  || COMMON._isNullOrEmpty($(row).find('input[name=height]'))
                    || COMMON._isNullOrEmpty($(row).find('input[name=quantity]'));
        if(invalid){
            $(row).find('span.rowPriceData')[0].text = 0;
            getPrice();
            return;
        }
        var quantity = $(row).find('input[name=quantity]')[0].value;
        if(!COMMON._isNullOrEmpty($(row).find('input[name=fixPrice]'))){
            var fixPrice = $(row).find('input[name=fixPrice]').val();
            let amount = Math.round(quantity * fixPrice);
            let amountWithFormat = (amount+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(row).find('.rowPriceData').text(amountWithFormat);
            getPrice();
       
        }else{
            let print_id = $(row).find('select[name=print]')[0].value;
            let film     = $(row).find('select[name=film]')[0].value;
            let width    = $(row).find('input[name=width]')[0].value;
            let height   = $(row).find('input[name=height]')[0].value;


            var size = Number.parseFloat(width) * Number.parseFloat(height) * Number.parseInt(quantity);
            var select = print.filter(function( item ) {
                            return item.id == print_id && item.from <= size;
                        });
            if(select.length == 0){
                select = print.filter(function( item ) {
                            return item.id == print_id;
                        });
            }
            var matching = select[0];
            var priceFilm = film == 1 ? matching.pe_film_1 : (film == 2 ? matching.pe_film_2 : matching.pe_film_3);
            var amount = Math.round(size * (priceFilm + matching.price));
            var amountWithFormat = (amount+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(row).find('.rowPriceData').text(amountWithFormat);
            getPrice();
        }
    }

    function getPrice() {
        var listPrice = $("#tb_data tbody tr td span.rowPriceData");
        var total = 0;
        $(listPrice).each(function(index,item){
            let rawPrice = $(item).text().replaceAll('.','');
            total += Number.parseFloat(rawPrice);
        });
        $("#totalPrice").text((total+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
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
        var details = getDetails();
        if(details.length == 0) return;

        var data = {
            "name"   : $("#name").val(),
            "phone"  : $("#phone").val(),
            "address": $("#address").val(),
            "payment": Number.parseInt($("#payment").val()),
            "release": $("#release").val(),
            "note"   : $("#note").val(),
            "detail" : details
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
        if(rowSize == 0){
            alert('Vui lòng thêm chi tiết đơn hàng!');
            return result;
        }

        $(rows).each(function (index,item) {
            let print_id = $(item).find('select[name=print]')[0].value;
            let film     = $(item).find('select[name=film]')[0].value;
            let width    = $(item).find('input[name=width]')[0].value;
            let height   = $(item).find('input[name=height]')[0].value;
            let quantity = $(item).find('input[name=quantity]')[0].value;

            if(COMMON._isNullOrEmpty($(item).find('select[name=print]'))){
                alert('Vui lòng chọn loại in!');
                $(item).find('select[name=print]')[0].focus();
                return result = [];
            }

            if(COMMON._isNullOrEmpty($(item).find('select[name=film]'))){
                alert('Vui lòng chọn màng!');
                $(item).find('select[name=film]')[0].focus();
                return result = [];
            }

            if(COMMON._isNullOrEmpty($(item).find('input[name=width]'))){
                alert('Vui lòng nhập chiều rộng!');
                $(item).find('input[name=width]')[0].focus();
                return result = [];
            }

            if(COMMON._isNullOrEmpty($(item).find('input[name=height]'))){
                alert('Vui lòng nhập chiều dài!');
                $(item).find('input[name=height]')[0].focus();
                return result = [];
            }

            if(COMMON._isNullOrEmpty($(item).find('input[name=quantity]'))){
                alert('Vui lòng nhập số lượng!');
                $(item).find('input[name=quantity]')[0].focus();
                return result = [];
            }

            var fixPrice = 0;
            var isFixPrice = false;

            if(!COMMON._isNullOrEmpty($(item).find('input[name=fixPrice]'))){
                var fixPrice = $(item).find('input[name=fixPrice]')[0].value;
                var isFixPrice = true;
            }

            var data = {
                "print_id"  : print_id,
                "width"     : width,
                "heigth"    : height,
                "quantity"  : quantity,
                "film_type" : film,
                "is_fix_price" : isFixPrice,
                "fix_price" : fixPrice,
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
        $("#name").val(phone);
        $("#name").val(address);
        $("#modal1").modal('hide');
    }
</script>
@endsection
@extends('layout.app')
@section('title','Cập nhật loại in')
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
            <strong class="card-title" v-if="headerText">Cập nhật loại in</strong>
        </div>
        <div class="card-body">
            <form action="" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin loại in</h5>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="input-normal" class=" form-control-label">Tên loại in (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="name" name="name" disabled value="{{$printing->name}}" placeholder="Tên loại in" class="form-control" maxlength="200">
                        <input type="hidden" id="id" name="id" value="{{$printing->id}}"  placeholder="Tên loại in" class="form-control" maxlength="200">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Cán màng ? (<span class="required">*</span>)</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="number" id="pe_film_1" name="pe_film_1" value="{{$printing->pe_film_1}}" placeholder="Không cán màng" class="form-control">
                        <small class="help-block form-text">Không cán màng</small>
                    </div>
                    <div class="col col-md-6"></div>
                    <div class="col col-md-2"></div>
                    <div class="col-12 col-md-4">
                        <input type="number" id="pe_film_2" name="pe_film_2" value="{{$printing->pe_film_2}}" placeholder="Cán màng bóng" class="form-control">
                        <small class="help-block form-text">Cán màng bóng</small>
                    </div>
                    <div class="col col-md-6"></div>
                    <div class="col col-md-2"></div>
                    <div class="col-12 col-md-4">
                        <input type="number" id="pe_film_3" name="pe_film_3" value="{{$printing->pe_film_3}}" placeholder="Cán màng mờ" class="form-control">
                        <small class="help-block form-text">Cán màng mờ</small>
                    </div>
                    <div class="col col-md-6"></div>
                </div>
                <div class="row form-group">
                    <h6 class="title-5 m-b-30 ml-3">Giá tiền</h6>
                </div>
                <div class="row form-group">
                    <div class="table-responsive table-data">
                        <table class="table" id="tb_price">
                            <thead>
                                <tr>
                                    <td>TỪ</td>
                                    <td>ĐẾN</td>
                                    <td>Giá tiền (m2)</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($printPrices as $price)
                                <tr>
                                    <td><input type="number" name="from" value="{{$price->from}}" placeholder="Từ" class="form-control-sm"></td>
                                    <td><input type="number" name="to" value="{{$price->to}}" placeholder="Đến" class="form-control-sm"></td>
                                    <td><input type="number" name="price" value="{{$price->price}}"  placeholder="Giá tiền" class="form-control-sm"></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" onclick="deleteRow(this);">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
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
            <a type="button" class="btn btn-outline-secondary" href="{{url('/settings/list-print')}}">
                <i class="fa fa-times"></i>&nbsp; Hủy</a>
        </div>
    </div>
</div>
<template id="dataRow">
    <tr>
        <td><input type="number" name="from"  placeholder="Từ" class="form-control-sm"></td>
        <td><input type="number" name="to"    placeholder="Đến" class="form-control-sm"></td>
        <td><input type="number" name="price" placeholder="Giá tiền" class="form-control-sm"></td>
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
@endsection

@endsection
@section('extend_script')
<script>
    $(document).ready(function(){
        $("#addRow").click(function(){
            let template = $("#dataRow");
            $("#tb_price tbody").append(template.html());
        });

        $("#btnReset").click(function(){
            reset();
        });

        $("#btnSave").click(function(){
            savePrint();
        });

        $("#btnSaveBack").click(function(){
            savePrint(true);
        });
    });

    function deleteRow(rowIcon) {
        $(rowIcon).closest('tr').remove();
    }

    function savePrint(isback=false){
        if(!validatePrint()) return;
        var price = getPrice();
        if(!price) return;

        var data = {
            "id" : '{{$printing->id}}',
            "pe_film_1" : Number.parseInt($("#pe_film_1").val()),
            "pe_film_2" : Number.parseInt($("#pe_film_2").val()),
            "pe_film_3" : Number.parseInt($("#pe_film_3").val()),
            "price" : price
        }

        return $.ajax({
            url : "{{ url('api/print') }}",
            type : "PUT",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message);
                if(isback){
                    window.location.href = '{{url("/settings/list-print")}}';
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
        $("#name").val("");
        $("#pe_film_1").val("");
        $("#pe_film_2").val("");
        $("#pe_film_3").val("");
        $("#tb_price tbody").empty();
        let template = $("#dataRow");
        $("#tb_price tbody").append(template.html());
    }

    function getPrice(){
        var rows = $("#tb_price tbody tr");
        var rowSize = rows.length;
        if(rowSize == 0) return false;
        var result = [];
        rowSize --;
        $(rows).each(function (index,item) {
            var from = $(item).find('input[name=from]')[0].value;
            var to = $(item).find('input[name=to]')[0].value;
            var price = $(item).find('input[name=price]')[0].value;

            if(COMMON._isNullOrEmpty($(item).find('input[name=from]'))){
                alert('Giá trị bắt đầu không được để trống!');
                $(item).find('input[name=from]')[0].focus();
                return false;
            }

            var toIsOk = COMMON._isNullOrEmpty($(item).find('input[name=to]'));

            if(index != rowSize && toIsOk){
                alert('Giá trị kết thúc không được để trống!');
                $(item).find('input[name=to]')[0].focus();
                return false;
            }

            if(COMMON._isNullOrEmpty($(item).find('input[name=price]'))){
                alert('Giá tiền không được để trống!');
                $(item).find('input[name=price]')[0].focus();
                return false;
            }

            if(index != 0 && from != $(rows[index-1]).find('input[name=to]')[0].value){
                alert('Giá trị bắt đầu sau phải bằng giá trị kết thúc ở trước!');
                $(item).find('input[name=from]')[0].focus();
                return false;
            }
            to = toIsOk ? 9999 : to;
            var data = {
                "from"      : Number.parseInt(from),
                "to"        : Number.parseInt(to),
                "price"     : Number.parseInt(price),
                "order_num" : index + 1,
            }
            result.push(data);
        });
        return result;
    }

    function validatePrint() {
        if(COMMON._isNullOrEmpty($('#name'))){
            alert('Vui lòng nhập tên loại in!');
            $('#name').focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($('#pe_film_1'))){
            alert('Vui lòng nhập giá không cán màng!');
            $('#pe_film_1').focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($('#pe_film_2'))){
            alert('Vui lòng nhập giá cán màng mờ!');
            $('#pe_film_2').focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($('#pe_film_3'))){
            alert('Vui lòng nhập giá cán màng bóng!');
            $('#pe_film_3').focus();
            return false;
        }
        return true;
    }
</script>
@endsection
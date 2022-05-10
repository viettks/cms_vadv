@extends('layout.app')
@section('title','Tạo mới loại in')
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
</style>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mh-76">
        <div class="card-header">
            <i class="mr-2 fa fa-align-justify"></i>
            <strong class="card-title" v-if="headerText">Tạo mới loại in</strong>
        </div>
        <div class="card-body">
            <form action="" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin loại in</h5>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="input-normal" class=" form-control-label">Tên loại in (<span
                                class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="name" name="name" placeholder="Tên loại in" class="form-control"
                            maxlength="200">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="input-normal" class=" form-control-label">Tên phụ chi tiết</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="subName" name="subName" placeholder="Tên phụ chi tiết" class="form-control" maxlength="200">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="input-normal" class=" form-control-label">Đơn vị tính (<span
                                class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-2">
                        <input type="text" id="typeText" name="typeText" placeholder="Đơn vị" class="form-control"
                            maxlength="50">
                    </div>
                    <div class="col col-sm-2">
                        <label for="handleInput" class=" form-control-label">
                            <input type="checkbox" id="handleInput"/>
                             Tự nhập kích thước?</label>
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div id="subPrintWrap">
                    <div class="row manu-wrap form-group">
                        <div class="col col-sm-2">
                            <label for="subPrint" class=" form-control-label">Kích thước:</label>
                        </div>
                        <div class="col col-sm-4">
                            <input type="text" name="machine3" placeholder="Tên loại" class="form-control"
                                maxlength="100">
                        </div>
                        <div class="col col-sm-6">
                            <button type="button" class="btn btn-outline-success" onclick="addManu(3);">
                                <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div id="groupManu1">
                    <div class="row manu-wrap form-group">
                        <div class="col col-sm-2">
                            <label for="input-normal" class=" form-control-label">Chất liệu</label>
                        </div>
                        <div class="col col-sm-4">
                            <input type="text" name="manufacture1" placeholder="Chất liệu" class="form-control"
                                maxlength="100">
                        </div>
                        <div class="col col-sm-6">
                            <button type="button" class="btn btn-outline-success" onclick="addManu(1);">
                                <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div id="groupManu2">
                    <div class="row manu-wrap form-group">
                        <div class="col col-sm-2">
                            <label for="input-normal" class=" form-control-label">Gia công</label>
                        </div>
                        <div class="col col-sm-4">
                            <input type="text" id="manufacture2" name="manufacture2" placeholder="Gia công"
                                class="form-control" maxlength="100">
                        </div>
                        <div class="col col-sm-6">
                            <button type="button" class="btn btn-outline-success" onclick="addManu(2);">
                                <i class="fa fa-plus"></i></button>
                        </div>
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
            <button type="button" class="btn btn-outline-warning mr-2" id="btnReset">
                <i class="fa fa-undo"></i>&nbsp; Reset</button>
            <a type="button" class="btn btn-outline-secondary" href="{{url('/settings/list-print')}}">
                <i class="fa fa-times"></i>&nbsp; Hủy</a>
        </div>
    </div>
</div>
<template id="dataRow">
    <tr>
        <td><input type="number" name="from" placeholder="Từ" class="form-control-sm"></td>
        <td><input type="number" name="to" placeholder="Đến" class="form-control-sm"></td>
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

<!-- TÊN LOẠI -->
<template id="tmpMaterial">
    <div class="row manu-wrap form-group">
        <div class="col col-sm-2">
        </div>
        <div class="col col-sm-4">
            <input type="text" name="machine3" placeholder="Tên loại" class="form-control" maxlength="100">
        </div>
        <div class="col col-sm-6">
            <button type="button" class="btn btn-outline-danger" onclick="deleteManu(this);">
                <i class="fa fa-trash"></i></button>
        </div>
    </div>
</template>
<!-- END CHẤT LIỆU -->

<!-- GIA CÔNG -->
<template id="tmpManu1">
    <div class="row manu-wrap form-group">
        <div class="col col-sm-2">
        </div>
        <div class="col col-sm-4">
            <input type="text" name="manufacture1" placeholder="Chất liệu" class="form-control" maxlength="100">
        </div>
        <div class="col col-sm-6">
            <button type="button" class="btn btn-outline-danger" onclick="deleteManu(this);">
                <i class="fa fa-trash"></i></button>
        </div>
    </div>
</template>
<!-- END GIA CÔNG -->

<!-- DÀNH CHO HỖ TRỢ -->
<template id="tmpManu2">
    <div class="row manu-wrap form-group">
        <div class="col col-sm-2">
        </div>
        <div class="col col-sm-4">
            <input type="text" name="manufacture2" placeholder="Gia công" class="form-control" maxlength="100">
        </div>
        <div class="col col-sm-6">
            <button type="button" class="btn btn-outline-danger" onclick="deleteManu(this);">
                <i class="fa fa-trash"></i></button>
        </div>
    </div>
</template>
@section('modal')
@endsection

@endsection
@section('extend_script')
<script>
    $(document).ready(function(){
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
    
    $("#handleInput").change(function(){
        if(this.checked){
            $("#subPrintWrap").empty();
            $("#subPrintWrap").append(`
                <div class="row manu-wrap form-group">
                    <div class="col col-sm-2">
                        <label for="subPrint" class=" form-control-label">Kích thước:</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" name="machine3" disabled placeholder="Tên loại" class="form-control"
                            maxlength="100">
                    </div>
                    <div class="col col-sm-6">
                        <button type="button" class="btn btn-outline-success">
                            <i class="fa fa-plus"></i></button>
                        </div>
                </div>`);
        }else{
            $("#subPrintWrap").empty();
            $("#subPrintWrap").append(`
                <div class="row manu-wrap form-group">
                    <div class="col col-sm-2">
                        <label for="subPrint" class=" form-control-label">Kích thước:</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" name="machine3" placeholder="Tên loại" class="form-control"
                            maxlength="100">
                    </div>
                    <div class="col col-sm-6">
                        <button type="button" class="btn btn-outline-success" onclick="addManu(3);">
                            <i class="fa fa-plus"></i></button>
                        </div>
                </div>`);
        }
    });
    function deleteRow(rowIcon) {
        $(rowIcon).closest('tr').remove();
    }

    function savePrint(isback=false){
        if(!validatePrint()) return;

        var dataSet1 = getManufac('machine3');
        var dataSet2 = getManufac('manufacture1');
        var dataSet3 = getManufac('manufacture2');

        var data = {
            "name" : $("#name").val(),
            "price_type" : 1,
            "sub_name" : $("#subName").val(),
            "type_name" : $("#typeText").val(),
            "machine3"  : dataSet1,
            "manufac_1" : dataSet2,
            "manufac_2" : dataSet3,
            "SCID" : "ADDSUBPRINT"
        }

        return $.ajax({
            url : "{{ url('api/print') }}",
            type : "POST",
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
        window.location.reload();
        // $("#name").val("");
        // $("#pe_film_1").val("");
        // $("#pe_film_2").val("");
        // $("#pe_film_3").val("");
        // $("#tb_price tbody").empty();
        // let template = $("#dataRow");
        // $("#tb_price tbody").append(template.html());
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
                result = [];
                return false;
            }

            var toIsOk = COMMON._isNullOrEmpty($(item).find('input[name=to]'));

            if(index != rowSize && toIsOk){
                alert('Giá trị kết thúc không được để trống!');
                $(item).find('input[name=to]')[0].focus();
                result = [];
                return false;
            }

            if(COMMON._isNullOrEmpty($(item).find('input[name=price]'))){
                alert('Giá tiền không được để trống!');
                $(item).find('input[name=price]')[0].focus();
                result = [];
                return false;
            }

            if(index != 0 && from != $(rows[index-1]).find('input[name=to]')[0].value){
                alert('Giá trị bắt đầu sau phải bằng giá trị kết thúc ở trước!');
                $(item).find('input[name=from]')[0].focus();
                result = [];
                return false;
            }
            to = toIsOk ? 9999 : to;
            if(Number.parseInt(to) < Number.parseInt(from)){
                alert('Giá trị kết thúc phải lớn hơn giá trị bắt đầu!');
                $(item).find('input[name=to]')[0].focus();
                result = [];
                return false; 
            }

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

        if(COMMON._isNullOrEmpty($('#typeText'))){
            alert('Vui lòng nhập đơn vị tính!');
            $('#typeText').focus();
            return false;
        }
        return true;
    }

    function addManu(info) {
        if(info == 1){
            let template = $("#tmpManu1");
            $("#groupManu1").append(template.html());
        }else if(info == 2){
            let template = $("#tmpManu2");
            $("#groupManu2").append(template.html());
        }else if(info == 3){
            let template = $("#tmpMaterial");
            $("#subPrintWrap").append(template.html());
        }
    }

    function deleteManu(item){
        $(item).closest('.manu-wrap').remove()
    }

    function getManufac(name) {
        var result = [];
        $('input[name='+ name+']').each((index, item) =>{
            if(item.value != ''){
                result.push({"name" : item.value});
            }
        });
        return result;
    }
</script>
@endsection
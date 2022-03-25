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
            <strong class="card-title" v-if="headerText">Tạo mới loại in</strong>
        </div>
        <div class="card-body">
            <form action="" method="post" class="form-horizontal">
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin loại in</h5>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="input-normal" class=" form-control-label">Tên loại in</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="input-normal" name="input-normal" placeholder="Tên loại in" class="form-control">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Giá tiền/m2</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Trên 1m2" class="form-control">
                        <small class="help-block form-text">Trên 1m2</small>
                    </div>
                    <div class="col col-md-6"></div>
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label"></label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Dưới 1m2" class="form-control">
                        <small class="help-block form-text">Dưới 1m2</small>
                    </div>
                    <div class="col col-md-6"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Cán màng ? </label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Không cán màng" class="form-control">
                        <small class="help-block form-text">Không cán màng</small>
                    </div>
                    <div class="col col-md-6"></div>
                    <div class="col col-md-2"></div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Cán màng bóng" class="form-control">
                        <small class="help-block form-text">Cán màng bóng</small>
                    </div>
                    <div class="col col-md-6"></div>
                    <div class="col col-md-2"></div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Cán màng mờ" class="form-control">
                        <small class="help-block form-text">Cán màng mờ</small>
                    </div>
                    <div class="col col-md-6"></div>
                </div>
            </form>
            <!-- END USER DATA-->
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-outline-primary mr-2">
                <i class="fa fa-save"></i>&nbsp; Lưu</button>
            <button type="button" class="btn btn-outline-primary mr-2">
                <i class="fa fa-reply"></i>&nbsp; Lưu và quay lại</button>
            <button type="button" class="btn btn-outline-warning mr-2">
                <i class="fa fa-undo"></i>&nbsp; Reset</button>
            <button type="button" class="btn btn-outline-secondary">
                <i class="fa fa-times"></i>&nbsp; Hủy</button>
        </div>
    </div>
</div>
@section('modal')
@endsection

@endsection
@section('extend_script')
<script src="js/admin/order.js"></script>
<script>
    $(document).ready(function(){
        init();
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);
        $("#fromDate").val(firstDayOfMonth.toLocaleDateString('en-CA'));
        $("#toDate").val(lastDayOfMonth.toLocaleDateString('en-CA'));
    }
</script>
@endsection
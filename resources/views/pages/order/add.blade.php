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
            <div class="table-data__tool">
                <div class="table-data__tool-left w-100">
                </div>
                {{-- <div class="table-data__tool-right">
                    <button type="button" class="btn btn-outline-primary">
                        <i class="fa fa-download"></i>&nbsp; Xuất file excel</button>
                </div> --}}
                <hr>
            </div>
            <form action="" method="post" class="form-horizontal">
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin khách hàng</h5>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="input-normal" class=" form-control-label">Tên khách hàng</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="input-normal" name="input-normal" placeholder="Tên khách hàng"
                            class="form-control">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Số điện thoại</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Số điện thoại"
                            class="form-control">
                    </div>
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Địa chỉ</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Địa chỉ" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Trả trước</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="text-input" name="text-input" placeholder="Trả trước"
                            class="form-control">
                    </div>
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Ngày hoàn thành</label>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="date" id="text-input" name="text-input" placeholder="Địa chỉ" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="text-input" class=" form-control-label">Ghi chú</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <textarea name="textarea-input" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Chi tiết đơn hàng</h5>
                </div>
                <div class="row form-group">
                    <div class="table-responsive table-data">
                        <table class="table">
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
                                        <select name="selectSm" id="SelectLm" class="form-control-sm form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option>
                                        <option value="4">Option #4</option>
                                        <option value="5">Option #5</option>
                                        </select>
                                    </td>
                                    <td>                                        <select name="selectSm" id="SelectLm" class="form-control-sm form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option>
                                        <option value="4">Option #4</option>
                                        <option value="5">Option #5</option>
                                        </select></td>
                                    <td><input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control-sm"></td>
                                    <td><input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control-sm"></td>
                                    <td><input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control-sm"></td>
                                    <td><span class="total"></span></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-data__tool">
                    <div class="table-data__tool-left w-100">
                        <span class="text-danger text-strong">
                            <i class="fa fa-dollar"></i>&nbsp; Tổng giá trị : </span>
                        <span class="text-danger text-strong">0</span>
                        <span class="text-danger text-strong"> VNĐ.</span>
                    </div>
                    <hr>
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
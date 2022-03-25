@extends('layout.app')
@section('title','Quản lý đơn hàng')
@section('style')
<style>
    .mh-76{
        min-height: 76vh;
    }
    .input-date-wrap{
        width: 185px;
    }
</style>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mh-76">
        <div class="card-header">
            <i class="mr-2 fa fa-align-justify"></i>
            <strong class="card-title" v-if="headerText">Quản lý đơn hàng</strong>
        </div>
        <div class="card-body">
            <div class="table-data__tool">
                <div class="table-data__tool-left w-100">
                    <span class="text-danger text-strong">
                        <i class="fa fa-dollar"></i>&nbsp; Tổng doanh thu : </span>
                    <span class="text-danger text-strong">0</span>
                    <span class="text-danger text-strong"> VNĐ.</span>
                </div>
                <div class="table-data__tool-right">
                    <button type="button" class="btn btn-outline-primary">
                        <i class="fa fa-download"></i>&nbsp; Xuất file excel</button>
                </div>
                <hr>
            </div>
            <div class="m-b-30">
                <div class="filters m-b-45 mr-2">
                    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border input-date-wrap">
                        <label>Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border input-date-wrap">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border input-date-wrap">
                        <label>Tình trạng</label>
                        <select class="js-select2 au-select-dark w-100" name="time">
                            <option selected="selected">Tất cả</option>
                            <option value="">Đang xử lý</option>
                            <option value="">Đã giao hàng</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    @can('ADMIN')
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border input-date-wrap">
                        <label>Nhân viên</label>
                        <select class="js-select2 au-select-dark w-100" name="time">
                            <option selected="selected">Tất cả</option>
                            <option value="">Đang xử lý</option>
                            <option value="">Đã giao hàng</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    @endcan
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border input-date-wrap">
                        <label></label>
                        <input class="form-control" type="text" name="search" placeholder="Tìm kiếm...">
                    </div>
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border input-date-wrap">
                        <label></label>
                        <button type="button" class="btn btn-primary">Tra cứu</button>
                    </div>
                    <button type="button" class="btn btn-danger mb-1" data-toggle="modal" >
                        <i class="fa fa-trash-o"></i>
                        Xóa
                    </button>
                    <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#mdAddUser">
                        <i class="fa fa-plus"></i>
                        Tạo mới
                    </button>
                </div>
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Chi tiết</th>
                                <th>KT ngang</th>
                                <th>KT dọc</th>
                                <th>Số lượng</th>
                                <th>Đơn vị tính</th>
                                <th>Đơn giá</th>
                                <th>Tổng tiền</th>
                                <th>Lưu ý</th>
                                <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ngày</th>
                                <td>Tên khách hàng</td>
                                <td>Số điện thoại</td>
                                <td>Chi tiết</td>
                                <td>KT ngang</td>
                                <td>KT dọc</td>
                                <td>Số lượng</td>
                                <td>Đơn vị tính</td>
                                <td>Đơn giá</td>
                                <td>Tổng tiền</td>
                                <td>Lưu ý</td>
                                <td>Tình trạng</td>
                            </tr>
                            <tr>
                                <td>Ngày</th>
                                <td>Tên khách hàng</td>
                                <td>Số điện thoại</td>
                                <td>Chi tiết</td>
                                <td>KT ngang</td>
                                <td>KT dọc</td>
                                <td>Số lượng</td>
                                <td>Đơn vị tính</td>
                                <td>Đơn giá</td>
                                <td>Tổng tiền</td>
                                <td>Lưu ý</td>
                                <td>Tình trạng</td>
                            </tr>
                            <tr>
                                <td>Ngày</th>
                                <td>Tên khách hàng</td>
                                <td>Số điện thoại</td>
                                <td>Chi tiết</td>
                                <td>KT ngang</td>
                                <td>KT dọc</td>
                                <td>Số lượng</td>
                                <td>Đơn vị tính</td>
                                <td>Đơn giá</td>
                                <td>Tổng tiền</td>
                                <td>Lưu ý</td>
                                <td>Tình trạng</td>
                            </tr>
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
    <div class="modal fade" id="mdAddUser" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">
                        <i class="fa fa-plus"></i>
                        Tạo mới hóa đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="input-normal" class=" form-control-label">Tên khách hàng</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="text" id="input-normal" name="input-normal" placeholder="Tên khách hàng" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="input-normal" class=" form-control-label">Số điện thoại</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="text" id="input-normal" name="input-normal" placeholder="Tên khách hàng" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="input-normal" class=" form-control-label">Tên khách hàng</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="text" id="input-normal" name="input-normal" placeholder="Tên khách hàng" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="input-normal" class=" form-control-label">Tên khách hàng</label>
                            </div>
                            <div class="col col-sm-8">
                                <input type="text" id="input-normal" name="input-normal" placeholder="Tên khách hàng" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal medium -->
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
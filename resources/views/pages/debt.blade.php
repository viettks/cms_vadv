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
                    <span class="text-danger text-strong">1000000</span>
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
                        <span>Ngày bắt đầu</span>
                        <input type="date" class="form-control" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border input-date-wrap">
                        <span>Ngày kết thúc</span>
                        <input type="date" class="form-control" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border input-date-wrap">
                        <span>Tình trạng</span>
                        <select class="js-select2 au-select-dark w-100" name="time">
                            <option selected="selected">Tất cả</option>
                            <option value="">Đang xử lý</option>
                            <option value="">Đã giao hàng</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    @can('ADMIN')
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border input-date-wrap">
                        <span>Nhân viên</span>
                        <select class="js-select2 au-select-dark w-100" name="time">
                            <option selected="selected">Tất cả</option>
                            <option value="">Đang xử lý</option>
                            <option value="">Đã giao hàng</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    @endcan
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border input-date-wrap">
                        <span></span>
                        <button type="button" class="btn btn-primary">Tra cứu</button>
                    </div>
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

@endsection
@section('extend_script')
@endsection
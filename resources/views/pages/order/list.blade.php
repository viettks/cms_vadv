@extends('layout.app')
@section('title','Danh sách đơn hàng')
@section('style')
<style>
    .mh-76 {
        min-height: 76vh;
    }

    .input-date-wrap {
        width: 185px;
    }

    .modal-lg {
        min-width: 80%;
    }

    .switch-label {
        border-color: #ff182b !important;
        background-color: #ff182b !important;
    }
</style>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mh-76">
        <div class="card-header">
            <i class="mr-2 fa fa-align-justify"></i>
            <strong class="card-title" v-if="headerText">Danh sách đơn hàng</strong>
        </div>
        <div class="card-body">
            <div class="table-data__tool">
                <div class="table-data__tool-left w-100">
                    <span class="text-danger text-strong">
                        <i class="fa fa-dollar"></i>&nbsp; Tổng doanh thu : </span>
                    <span class="text-danger text-strong" id="total">0</span>
                    <span class="text-danger text-strong"> VNĐ.</span>
                </div>
                <div class="table-data__tool-right">
                    <button type="button" class="btn btn-outline-primary" id="btnExport" onclick="exportExcel();">
                        <i class="fa fa-download"></i>&nbsp; Xuất file excel</button>
                </div>
                <hr>
            </div>
            <div class="m-b-30">
                <div class="m-b-45 mr-2 seach-box">
                    <div class="form-group mr-2">
                        <label>Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate"
                            placeholder="Ngày bắt đầu">
                    </div>
                    <div class="form-group mr-2">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="form-group mr-2">
                        <label>Tình trạng</label>
                        <select class="form-control" name="sStatus" id="sStatus">
                            <option value="" selected="selected">Tất cả</option>
                            <option value="0">Chưa hoàn thành</option>
                            <option value="1">Hoàn thành</option>
                        </select>
                    </div>
                    @can('ADMIN')
                    <div class="form-group mr-2">
                        <label>Nhân viên</label>
                        <select class="form-control" name="time" name="sStaff" id="sStaff">
                            <option value="" selected="selected">Tất cả</option>
                            @foreach ($memberes as $member)
                            <option value="{{$member->id}}">{{$member->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endcan
                    <div class="form-group mr-2">
                        <label></label>
                        <input class="form-control" type="text" name="sValue" id="sValue" placeholder="Tìm kiếm...">
                    </div>
                    <div class="form-group mr-2">
                        <label></label>
                        <button type="button" class="btn btn-primary" id="btnSeach">Tra cứu</button>
                    </div>
                </div>
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-bordered" id="tb_data">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Chi tiết</th>
                                <th>KT ngang</th>
                                <th>KT dọc</th>
                                <th>Tổng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Tổng tiền</th>
                                <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
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
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">
                    <i class="mr-2 fa fa-align-justify"></i>
                    Chi tiết hóa đơn
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <h5 class="title-5 m-b-30 ml-3">Thông tin khách hàng</h5>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="note" class=" form-control-label">Mã vận đơn</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="billId" name="billId" placeholder="Tên khách hàng"
                                class="form-control">
                        </div>
                        <div class="col col-sm-6">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-2">
                            <label for="name" class=" form-control-label">Tên khách hàng (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-4">
                            <input type="text" disabled id="name" name="name" placeholder="Tên khách hàng"
                                class="form-control">
                            <input type="hidden" id="orderID" />
                        </div>
                        <div class="col col-sm-2">
                            <label for="name" class=" form-control-label">Trạng thái (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-4">
                            <span id="status">
                                <span class="badge badge-success">Hoàn thành</span>
                                <span class="badge badge-danger">Chưa hoàn thành</span>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="phone" class=" form-control-label">Số điện thoại (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="phone" name="phone" placeholder="Số điện thoại"
                                class="form-control">
                        </div>
                        <div class="col col-md-2">
                            <label for="address" class=" form-control-label">Địa chỉ (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="address" name="address" placeholder="Địa chỉ"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="payment" class=" form-control-label">Trả trước</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="number" id="payment" name="payment" placeholder="Số tiền trả trước"
                                class="form-control" value="0" disabled>
                        </div>
                        <div class="col col-md-2">
                            <label for="release" class=" form-control-label">Ngày hoàn thành</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="release" name="release" placeholder="Ngày hoàn thành"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="note" class=" form-control-label">Ghi chú</label>
                        </div>
                        <div class="col-12 col-md-10">
                            <textarea disabled name="note" id="note" rows="9" placeholder="Ghi chú..."
                                class="form-control"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <h5 class="title-5 m-b-30 ml-3">Chi tiết đơn hàng (<span class="required">*</span>)</h5>
                    </div>
                    <div class="row form-group">
                        <div class="table-responsive table-data">
                            <table class="table" id="tb_data_sub">
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
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fa fa-times"></i>&nbsp;Hủy</button>
                @can('ADMIN', null)
                <button type="button" class="btn btn-danger" onclick="deleteOrder();"><i
                        class="fa fa-trash"></i>&nbsp;Xóa</button>
                @endcan
                <a type="button" class="btn btn-primary" href="#" onclick="updateOrder();"><i
                        class="fa fa-pencil"></i>&nbsp;Chỉnh sửa</a>
            </div>
        </div>
    </div>
</div>
<!-- end modal medium -->

<!-- MODAL HISTORY -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">
                    <i class="mr-2 fa fa-align-justify"></i>
                    Lịch sử đặt hàng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <h5 class="title-5 m-b-30 ml-3">Thông tin khách hàng</h5>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="hisName" class=" form-control-label">Tên khách hàng</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="hisName" name="hisName" placeholder="Tên khách hàng"
                                class="form-control">
                        </div>
                        <div class="col col-md-2">
                            <label for="hisPhone" class=" form-control-label">Tên khách hàng</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" disabled id="hisPhone" name="hisPhone" placeholder="Số điện thoại"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label for="hisAdd" class=" form-control-label">Địa chỉ</label>
                        </div>
                        <div class="col-12 col-md-10">
                            <input type="text" disabled id="hisAdd" name="hisAdd" placeholder="Địa chỉ"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <h5 class="title-5 m-b-30 ml-3">Danh sách đơn hàng</h5>
                    </div>
                    <div class="row form-group">
                        <div class="table-responsive table-data">
                            <table class="table" id="tb_data_his">
                                <thead>
                                    <tr>
                                        <td>MÃ ĐƠN</td>
                                        <td>NGÀY ĐẶT</td>
                                        <td>TỔNG TIỀN</td>
                                        <td>TÌNH TRẠNG</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left w-100">
                        </div>
                        <hr>
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
@endsection

@endsection
@section('extend_script')
<script>
    //FOR DATATABLE

    var columns = [
            {"data" : "create_date", "orderable": false, "render": function ( data, type, row, meta ) {
                if(meta.row > 0 && meta.settings.aoData[meta.row-1]._aData.id == row.id){
                    return "";
                }else{
                    return data;
                }
            }},
            {"data" : "customer", "orderable": false, "render": function ( data, type, row, meta ) {
                if(meta.row > 0 && meta.settings.aoData[meta.row-1]._aData.id == row.id){
                    return "";
                }else{
                    return '<a href="#" onclick="showHistory(\''+row.phone+'\')">'+ data + '</a>';
                }

            }},
            {"data" : "phone", "orderable": false, "render": function ( data, type, row, meta ) {
                if(meta.row > 0 && meta.settings.aoData[meta.row-1]._aData.id == row.id){
                    return "";
                }else{
                    return data;
                }
            }},
            {"data" : "width", "orderable": false, "render": function ( data, type, row, meta ) {
                let text = '';
                text += row.manufac1 ? row.manufac1 + ',':'';
                text += row.manufac2 ? row.manufac2 :'';
                text = text == '' ? row.name : row.name + '(' + text + ')';
                return text;
            }},
            {"data" : "width", "orderable": false, "render": function ( data, type, row, meta ) {
                return data == 0 ? "" : data;
            }},
            {"data" : "heigth", "orderable": false, "render": function ( data, type, row, meta ) {
                return data == 0 ? "" : data;
            }},
            {"data" : "unit_total", "orderable": false, "render": function ( data, type, row, meta ) {
                return data + ' ' + row.unit_name;
            }},
            {"data" : "unit_price", "orderable": false,},
            {"data" : "amount", "orderable": false,},
            {"data" : "total", "orderable": false, "render": function ( data, type, full, meta ) {
                if(meta.row > 0 && meta.settings.aoData[meta.row-1]._aData.id == meta.settings.aoData[meta.row]._aData.id){
                    return "";
                }else{
                    return (data+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' VNĐ';
                }
            }},
            {"data" : "status", "orderable": false, "render": function ( data, type, full, meta ) {
                if(meta.row > 0 && meta.settings.aoData[meta.row-1]._aData.id == meta.settings.aoData[meta.row]._aData.id){
                    return "";
                }else{
                    if(data == 1){
                        return '<span class="badge badge-success">Hoàn thành</span>';
                    }else{
                        return '<span class="badge badge-danger">Chưa hoàn thành</span>';
                    }
                    return data;
                }
            }},
        ];

    var ajax = {
            'url' : '{{url("api/order/list")}}',
            "type": "GET",
            "data": {
                "fromDate" : function() { return $('#fromDate').val() },
                "toDate" : function() { return $('#toDate').val() },
                "status" : function() { return $('#sStatus').val() },
                "staff" : function() { return $('#sStaff').val() },
                "value" : function() { return $('#sValue').val() },
            }
        };

    function callback(settings){
        var total = (settings.json.total+"").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        $("#total").text(total);

        $('#tb_data').on('click dblclick', 'td', function () {
            var id = table.row(this).data().id;
            var row = this._DT_CellIndex;
            if(row.column == 1) return;
            showInfo(id);
        })
    }
    var table ;
    $(document).ready(function(){
        init();

        $("#btnSeach").click(function(){
            if(COMMON._isNullOrEmpty($("#fromDate"))||COMMON._isNullOrEmpty($("#toDate"))){
                alert('Vui lòng kiểm tra ngày bắt đầu và ngày kết thúc!');
            }else{
                table.ajax.reload(null,true);
            }
        });

        table = CMTBL.init($('#tb_data'),columns,ajax,callback);
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);
        $("#fromDate").val(firstDayOfMonth.toLocaleDateString('en-CA'));
        $("#toDate").val(lastDayOfMonth.toLocaleDateString('en-CA'));
    }

    function showInfo(id) {
        $.ajax({
            type: "GET",
            url: "{{url('/api/order')}}",
            data: {
                'id': id,
            },
            dataType: "json",
            success: function(data) {
                if(data.length > 0){
                    $('#billId').val(data[0].bill_code);
                    $('#name').val(data[0].customer);
                    $('#phone').val(data[0].phone);
                    $('#address').val(data[0].address);
                    $('#payment').val(data[0].payment);
                    $('#release').val(data[0].release_dt);
                    $('#note').val(data[0].note);
                    $("#totalPrice").text((data[0].total+ "").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
                    $("#orderID").val(data[0].id)
                    $("#tb_data_sub tbody").empty();
                    data.forEach((element,index) => {
                        let amountTemp = (element.amount+ "").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
                        var row = `<tr> <td>${element.print_name}</td>
                                        <td>${element.manufac1 ? '' : element.manufac1}</td>
                                        <td>${element.manufac2 ? '' : element.manufac2}</td>
                                        <td>${element.width == 0 ? '' : element.width}</td>
                                        <td>${element.heigth == 0 ? '' : element.heigth}</td>
                                        <td>${element.quantity}</td>
                                        <td>${element.unit_price}</td>
                                        <td>${element.unit_total}</td>
                                        <td>${amountTemp} VNĐ</td></tr>`;
                        $("#tb_data_sub tbody").append(row);
                    });

                    if(data[0].status == 1){
                        $('#status .badge-success').show();
                        $('#status .badge-danger ').hide();
                    }else{
                        $('#status .badge-success').hide();
                        $('#status .badge-danger ').show();
                    }
                    $('#modal1').modal('show');
                }else{
                    alert('Đã xảy ra lỗi!')
                }
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi!')
            },
        });
    }

    function showHistory(phone) {
        $.ajax({
            type: "GET",
            url: "{{url('/api/order/history')}}",
            data: {
                'phone': phone,
            },
            dataType: "json",
            success: function(data) {
                var dataSet = data.data;
                $("#tb_data_his tbody").empty();
                if(dataSet.length > 0){
                    $('#hisName').val(dataSet[0].customer);
                    $('#hisPhone').val(dataSet[0].phone);
                    $('#hisAdd').val(dataSet[0].address);

                    dataSet.forEach((element,index) => {
                        var status = "";
                        if(element.status == 1){
                            status = '<span class="badge badge-success">Hoàn thành</span>';
                        }else{
                            status = '<span class="badge badge-danger">Chưa hoàn thành</span>';
                        }
                        let amountTemp = (element.amount+ "").replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
                        var row = `<tr><td><a href='{{url('order/info')}}/${element.id}'>${element.bill_code}</a></td>
                                        <td>${element.create_date}</td>
                                        <td>${element.amount} VNĐ</td>
                                        <td>${status}</td></tr>`;
                        $("#tb_data_his tbody").append(row);
                    });

                    $('#modal2').modal('show');
                }else{
                    alert('Đã xảy ra lỗi!')
                }
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi!')
            },
        });
    }

    function update() {
        $.ajax({
            type: "PATCH",
            url: "{{url('/api/order')}}",
            data: {
                'id': $("#orderID").val(),
                'status' : $("#status").prop("checked")===true ? 1 : 0,
                'note': $("#note").val(),
                'payment' : $("#payment").val(),
            },
            dataType: "json",
            success: function(data) {
                alert('Lưu thành công!')
                $('#modal1').modal('hide');
                $('#btnSeach').click();
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi!')
            },
        });
    }

    function exportExcel() {
        var data = {
                "fromDate" : $('#fromDate').val(),
                "toDate" : $('#toDate').val(),
                "status" : $('#sStatus').val(),
                "staff" : $('#sStaff').val(),
                "value" : $('#sValue').val()
            };
        window.open('{{url('order/download')}}?' + $.param(data), '_blank').focus();
    }

    function updateOrder() {
        window.location.href = '{{url('order/info')}}' + "/" + $("#orderID").val();
    }

</script>
@can('ADMIN', null)
<script>
    function deleteOrder() {
    if(confirm("Bạn có muốn xóa hóa đơn hiện tại?")){
        $.ajax({
            type: "DELETE",
            url: "{{url('/api/order')}}",
            data: {
                'id': $("#orderID").val(),
            },
            dataType: "json",
            success: function(data) {
                alert('Xóa thành công!')
                $('#modal1').modal('hide');
                $('#btnSeach').click();
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi!')
            },
        });
    }
}
</script>
@endcan
@endsection
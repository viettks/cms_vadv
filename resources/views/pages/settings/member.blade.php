@extends('layout.app')
@section('title','Quản lý thành viên')
@section('style')
<style>
    .mh-76 {
        min-height: 76vh;
    }

    .input-date-wrap {
        width: 185px;
    }

    .modal-lg {
        min-width: 60%;
    }

    .modal-md {
        min-width: 40%;
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
            <strong class="card-title" v-if="headerText">Quản lý thành viên</strong>
        </div>
        <div class="card-body">
            <div class="m-b-30">
                <div class="m-b-45 mr-2 seach-box">
                    <div class="form-group mr-2">
                        <label></label>
                        <input class="form-control" type="text" name="sValue" id="sValue" placeholder="Tìm kiếm...">
                    </div>
                    <div class="form-group mr-2">
                        <label></label>
                        <button type="button" class="btn btn-primary" id="btnSeach">Tra cứu</button>
                    </div>
                    <div class="form-group mr-2 w-100 d-flex justify-content-end">
                        <label></label>
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal1"
                            id="btnCreate">
                            <i class="fa fa-plus"></i> Thêm mới</button>
                    </div>
                </div>
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-bordered" id="tb_data">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col class="text-center">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>TÊN THÀNH VIÊN</th>
                                <th>TÊN ĐĂNG NHẬP</th>
                                <th>QUYỀN HẠN</th>
                                <th>NGÀY TẠO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END CONTENT DATA-->
        </div>
    </div>
</div>
@section('modal')
<!-- MODAL CREATE -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">
                    <i class="mr-2 fa fa-align-justify"></i>
                    Tạo mới thành viên
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="crForm" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="name" class=" form-control-label">Tên thành viên (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <input type="text" id="crName" name="name" placeholder="Tên thành viên"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="crUserName" class=" form-control-label">Tên đăng nhập (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <input type="text" id="crUserName" name="crUserName" placeholder="Tên đăng nhập"
                                class="form-control" maxlength="20">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="crPassword" class=" form-control-label">Mật khẩu (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <input type="text" id="crPassword" name="crPassword" placeholder="Mật khẩu"
                                class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="crRole" class=" form-control-label">Quyền hạn (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <select id="crRole" name="crRole" class="form-control-sm form-control">
                                <option disabled>Chọn quyền</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->decription}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>&nbsp;Hủy</button>
                <button type="button" class="btn btn-primary" onclick="create();">
                    <i class="fa fa-save"></i>&nbsp;Lưu</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL CREATE -->

<!-- MODAL INFO -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">
                    <i class="mr-2 fa fa-align-justify"></i>
                    Thông tin thành viên
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="upForm" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="upName" class=" form-control-label">Tên thành viên (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <input type="text" id="upName" name="upName" placeholder="Tên thành viên"
                                class="form-control" disabled>
                            <input type="hidden" id="upId" name="upId">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="upUserName" class=" form-control-label">Tên đăng nhập (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <input type="text" id="upUserName" name="upUserName" placeholder="Tên đăng nhập"
                                class="form-control" maxlength="20" disabled>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="upPassword" class=" form-control-label">Mật khẩu (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <input type="text" id="upPassword" name="upPassword" placeholder="Mật khẩu"
                                class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-sm-4">
                            <label for="upRole" class=" form-control-label">Quyền hạn (<span
                                    class="required">*</span>)</label>
                        </div>
                        <div class="col col-sm-8">
                            <select id="upRole" name="upRole" class="form-control-sm form-control">
                                <option disabled>Chọn quyền</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->decription}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>&nbsp;Hủy</button>
                <button type="button" class="btn btn-primary" onclick="update();">
                    <i class="fa fa-save"></i>&nbsp;Lưu</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL INFO -->
@endsection

@endsection
@section('extend_script')
<script>

/*
 * SETTINGS DATATABLE
 */

var columns = [
        
        {"data" : "name", "orderable": false,"render": function ( data, type, row, meta ) {
            return `<a href="#" onclick="showInfo('${row.id}')">${data}</a>`;
        }},
        {"data" : "user_name", "orderable": false,},
        {"data" : "role_name", "orderable": false,},
        {"data" : "create_date", "orderable": false,},
        {"data" : "id", "className" : "text-center", "orderable": false,"render": function ( data, type, row, meta ) {
            return `<div class="table-data-feature text-center">
                        <button class="item" onclick="deleteUser(${data});">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                    </div>`;
        }},
    ];

var ajax = {
        'url' : '{{url("api/member/list")}}',
        "type": "GET",
        "data": {
            "value" : function() { return $('#sValue').val() },
        },
};

function callback(settings){
    $("#total").text(settings.json.total);
}

/*
 * END SETTINGS DATATABLE
 */
 var table;
$(document).ready(function(){

    table = CMTBL.init($('#tb_data'),columns,ajax,callback);

    $("#btnSeach").click(function(){
        table.ajax.reload(null,true);
    });
});

function showInfo(id) {
    return $.ajax({
                type: "GET",
                url: "{{url('/api/member/info')}}",
                data: {
                'id': id,
                },
                dataType: "json",
                success: function(data) {
                    var user = data.data;
                    if(user){
                        $('#upName').val(user.name);
                        $('#upId').val(user.id);
                        $('#upUserName').val(user.user_name);
                        $('#upPassword').val('');
                        $('#upRole').val(user.role_id);
                        $('#modal2').modal('show');
                    }
                },
                error: function(xhr) { alert('Đã xảy ra lỗi!') }, 
    }); 
}

function create() {
    if(!validateCreate()) return;

    var data = {
            "name" : $("#crName").val(),
            "user_name" : $("#crUserName").val(),
            "password" : $("#crPassword").val(),
            "role_id" : $("#crRole").val(),
        }

    return $.ajax({
            url : "{{ url('api/member') }}",
            type : "POST",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message);
                $('#modal1').modal('hide');
                $("#btnSeach").click();
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

function update() {
    if(!validateUpdate()) return;

    var data = {
            "id" : $("#upId").val(),
            "password" : $("#upPassword").val(),
            "role_id" : $("#upRole").val(),
        }

    return $.ajax({
            url : "{{ url('api/member') }}",
            type : "PATCH",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message);
                $('#modal2').modal('hide');
                $("#btnSeach").click();
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

function deleteUser(id) {
    if(confirm('Bạn có muốn xóa thành viên đã chọn?')){
        
        var data = {
            "id" : id,
        }
        return $.ajax({
            url : "{{ url('api/member') }}",
            type : "DELETE",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message);
                $("#btnSeach").click();
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
}

function validateCreate() {
    if(COMMON._isNullOrEmpty($('#crName'))){
        alert('Vui lòng nhập tên thành viên!');
        $('#crName').focus();
        return false;
    }
    if(COMMON._isNullOrEmpty($('#crUserName'))){
        alert('Vui lòng nhập tên đăng nhập!');
        $('#crUserName').focus();
        return false;
    }
    if(COMMON._isNullOrEmpty($('#crPassword'))){
        alert('Vui lòng nhập mật khẩu!');
        $('#crPassword').focus();
        return false;
    }

    return true;
}

function validateUpdate() {
    if(COMMON._isNullOrEmpty($('#upId'))){
        alert('Vui lòng kiểm tra thành viên!');
        $('#upId').focus();
        return false;
    }

    if(COMMON._isNullOrEmpty($('#upPassword'))){
        alert('Vui lòng nhập mật khẩu!');
        $('#upPassword').focus();
        return false;
    }

    return true;
}

$('#modal1').on('show.bs.modal', function (event) {
    $('#crName').val('');
    $('#crUserName').val('');
    $('#crPassword').val('');
    $('#crRole').val('2');
});
</script>
@endsection
@extends('layout.app')
@section('title','Cập nhật mật khẩu')
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
            <strong class="card-title" v-if="headerText">Cập nhật mật khẩu</strong>
        </div>
        <div class="card-body">
            <form action="" method="post" class="form-horizontal"  autocomplete="off">
                <div class="row form-group">
                    <h5 class="title-5 m-b-30 ml-3">Thông tin</h5>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="name" class=" form-control-label">Tên nhân viên (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="name" name="name" placeholder="Tên nhân viên" value="{{auth()->user()->name}}" class="form-control" disabled>
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="oldPw" class=" form-control-label">Mật khẩu cũ (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="password" id="oldPw" name="oldPw" placeholder="Mật khẩu cũ" class="form-control" autocomplete="off">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="newPW" class=" form-control-label">Mật khẩu mới (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="newPW" name="newPW" placeholder="Mật khẩu mới" class="form-control">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-sm-2">
                        <label for="rePW" class=" form-control-label">Nhập lại mật khẩu (<span class="required">*</span>)</label>
                    </div>
                    <div class="col col-sm-4">
                        <input type="text" id="rePW" name="rePW" placeholder="Nhập lại mật khẩu" class="form-control">
                    </div>
                    <div class="col col-sm-6">
                    </div>
                </div>
        <div class="card-footer">
            <button type="button" class="btn btn-outline-primary mr-2" id="btnSave" onclick="save();">
                <i class="fa fa-save"></i>&nbsp; Lưu</button>
            <a class="btn btn-outline-secondary" href="{{url('')}}">
                <i class="fa fa-times"></i>&nbsp; Hủy</a>
        </div>
    </div>
</div>
@section('modal')
@endsection

@endsection
@section('extend_script')
<script>
    $(document).ready(function(){
    });

    function save() {
        if(!validate()) return;

        var data = {
            "oldPW"   : $("#oldPw").val(),
            "newPW"  : $("#newPW").val(),
        }

        return $.ajax({
            url : "{{ url('api/password') }}",
            type : "POST",
            dataType:"json",
            data: data,
            success : function(data) {
                alert(data.message)
                window.location.href = "{{url('/logout')}}";
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
        if(COMMON._isNullOrEmpty($("#oldPw"))){
            alert('Vui lòng kiểm tra mật khẩu!');
            $("#oldPw").focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($("#newPW"))){
            alert('Vui lòng kiểm tra mật khẩu!');
            $("#newPW").focus();
            return false;
        }

        if(COMMON._isNullOrEmpty($("#rePW"))){
            alert('Vui lòng kiểm tra mật khẩu!');
            $("#rePW").focus();
            return false;
        }

        if($("#newPW").val() != $("#rePW").val()){
            alert('Mật khẩu không khớp!');
            $("#rePW").focus();
            return false;
        }

        return true;
    }
</script>
@endsection
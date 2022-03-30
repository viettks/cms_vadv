(function ($) {
    // USE STRICT
    "use strict";

    $('#btnCloseArlert').click(function(){
        $('#btnCloseArlert').closest('.alert').removeClass('show').addClass('fade');
    });

    function login() {
        if(!validate()) return;
        $.ajax({
            type: "POST",
            url: "/api/auth/login",
            data: {
                'user_name': $('#userName').val(),
                'password' :  $('#password').val(),
            },
            dataType: "json",
            success: function(data) {
                    window.location.href = "/";
            },
            error: function(xhr) {
                $('#spAlert').text('Sai tên đăng nhập hoặc mật khẩu.');
                $('#btnCloseArlert').closest('.alert').removeClass('fade').addClass('show');
            },
        });
    };

    function validate(){
        $('#btnCloseArlert').closest('.alert').removeClass('show').addClass('fade');
        if(COMMON._isNullOrEmpty($('#userName'))){
            $('#spAlert').text('Vui lòng nhập tên đăng nhập');
            $('#btnCloseArlert').closest('.alert').removeClass('fade').addClass('show');
            return false;
        }
        if(COMMON._isNullOrEmpty($('#password'))){
            $('#spAlert').text('Vui lòng nhập mật khẩu.');
            $('#btnCloseArlert').closest('.alert').removeClass('fade').addClass('show');
            return false;
        }
        return true;
    };
    $("#btnLogin").click(function(){
        login();
    });
})(jQuery);
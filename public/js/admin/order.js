(function ($) {
    // USE STRICT
    "use strict";
    $(document).ready(function(){
        init();
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);
        $("#fromDate").val(firstDayOfMonth.toLocaleDateString('en-CA'));
        $("#todate").val(lastDayOfMonth.toLocaleDateString('en-CA'));
    }
});
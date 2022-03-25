var COMMON = {
    _isNullOrEmpty : function(element){
        return element == null || $.trim($(element).val()) === '';
    },
}
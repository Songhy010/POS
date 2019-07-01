function isNumber(event){
    var keycode = event.keyCode;
    if(keycode>47 && keycode<58){
        return true;
    }
        return false;
}
function isDecimal(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode

    if (
        
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57))
        return false;

    return true;
}
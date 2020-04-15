

function UpdateTglAkhirUji(tglUji){
    var dt = $.datepicker.parseDate('yy-mm-dd', $(tglUji).val());
    if(dt == null)
        return;
    dt.setMonth(dt.getMonth() +6);
    var tglAkhir = dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
    $("#tglAkhirUji").val(tglAkhir);
}
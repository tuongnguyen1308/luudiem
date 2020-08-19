/**
 * Created by nqhuy on 13-Aug-16.
 */

function Toast(toastType, title, msg) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    this.show = toastr[toastType](msg, title); // Wire up an event handler to a button in the toast, if it exists
};

$(document).ready(function(){
    $('.horizontal-table').DataTable({
        "paging":false,
        "scrollX": true,
        "info": false,
        "ordering": false,
        "searching": false
    });
    /* thêm và xóa */
    Delete_add();

    customTableQuymo();

    /* bắt ký tự không cho nhập chữ */
    keyPress();
    /* Init DataTables */
    var oTable = $('#editable').DataTable();
    /* hiện tổng usd và vnđ */
    //SumUsdVnd();
    SUM_USD();
    $('.datepicker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $("input[name='ODA_USD[]']").on('change', function () {
       console.log($(this).val());
    });
});


function SUM_USD()
{
    var ODA_USD = 0;
    var DU_USD = 0;
    $('#tableId tbody tr').each(function() {
        ODA_USD = ($(this).find('input[name^=ODA_USD]').val());
        DU_USD = ($(this).find('input[name^=DU_USD]').val());
        ODA_VND = ($(this).find('input[name^=ODA_VND]').val());
        DU_VND = ($(this).find('input[name^=DU_VND]').val());
        if((ODA_USD == '' || ODA_VND == '')){
            $(this).find('input[name="USD"]').val('');
        }else{
            var tong_usd = parseInt(DU_USD)+parseInt(ODA_USD);
            var tong_vnd = parseInt(ODA_VND)+parseInt(DU_VND);
            $(this).find('input[name="USD"]').val(tong_usd);
            $(this).find('input[name="VND"]').val(tong_vnd);
        }
    });
}

function customTableQuymo() {
    var add_button = $(".add"); //Add button ID

    $(add_button).click(function(){ //on add input button click
        if($(this).val() == 'quymo')
        {
            var row = $("#xaydung").html();
            $("#tableIdQuymo tbody tr:last").after("<tr class='table_row'></tr>");
            $("#tableIdQuymo tbody tr:last").html(row);
            /* bắt ký tự không cho nhập chữ */
            keyPress();
        }
        else if($(this).val() == 'tuyensinh')
        {
            var row = $("#xaydung").html();
            $("#tableIdTuyensinh tbody tr:last").after("<tr class='table_row'></tr>");
            $("#tableIdTuyensinh tbody tr:last").html(row);
            /* bắt ký tự không cho nhập chữ */
            keyPress();
        }
        else if($(this).val() == 'totnghiep')
        {
            var row = $("#xaydung").html();
            $("#tableIdTotnghiep tbody tr:last").after("<tr class='table_row'></tr>");
            $("#tableIdTotnghiep tbody tr:last").html(row);
            /* bắt ký tự không cho nhập chữ */
            keyPress();
        }
    });

    $(document).on('click', '.delete',function(){
        if($(this).hasClass('active')){
        } else {
            $(this).addClass('active').siblings().removeClass('active');
        }
        $(this).closest('table tr').remove();
    });
}

// thêm dòng và xóa dòng
function Delete_add() {
    var add_button = $("#add"); //Add button ID

    $(add_button).click(function(){ //on add input button click
        var row = $("#xaydung").html();
        $("#tableId tbody tr:last").after("<tr class='table_row context-menu-one' style='height: 90px;'></tr>");
        $("#tableId tbody tr:last").html(row);
        /* bắt ký tự không cho nhập chữ */
        keyPress();
    });
    $('#tableId').on('click', '.table_row', function(event) {
        if($(this).hasClass('active')){
//			$('#delete').click(function () {
////				$(this).removeClass('active');
//			});
        } else {
            $(this).addClass('active').siblings().removeClass('active');
        }
    });
    $(document).on('click', '.delete',function(){
        if($(this).hasClass('active')){
        } else {
            $(this).addClass('active').siblings().removeClass('active');
        }

        //alert('AAA');
        var ID = $(this).closest('tr').data("id");
        var thietbi_ct = window.location.href;
        if(ID){
            $.ajax({
                url: thietbi_ct,
                type: 'POST',
                data: {
                    'action' : 'deleteDetail',
                    ID_Basic: ID
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    //alert(1);
                    if(result>0){
                        $('#tableId tr').each(function() {
                            if($(this).hasClass('active')){
                                $(this).closest('#tableId tr').remove();
                            }
                        });
                    }
                }

            });// end ajax
        }else {
            $(this).closest('#tableId tr').remove();
        }
        //alert(fruitCount);
    });
}
// bắt ký tự chỉ cho nhập số của biếu mẫu thiết bi,
function keyPress() {
    $("input[name='soluong[]']").keypress(function (e) {

        if (/\d+|,+|[/b]+|-+/i.test(e.key) ){

            // alert("character accepted: " + e.key);
        } else {
            //alert("illegal character detected: "+ e.key);
            return false;
        }

    });
    $("input[name='ODA_USD[]").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $("input[name='ODA_VND[]").keydown(function (e) {

        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

    });
    $("input[name='DU_USD[]").keydown(function (e) {

        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

    });
    $("input[name='DU_VND[]").keydown(function (e) {

        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

    });

}


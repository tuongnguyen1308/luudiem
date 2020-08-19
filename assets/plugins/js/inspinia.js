/*
 *
 *   INSPINIA - Responsive Admin Theme
 *   version 2.4
 *
 */

function standardized_name(name) {
    let hoTen = name.trim().toLowerCase();
    var i = 0;
    while(i < hoTen.length){
        if (hoTen[i] == ' ' && hoTen[i+1] == ' '){
            hoTen = hoTen.replace('  ', ' ');
        }
        else{
            i++;
        }
    }
    var newHoTen = '';
    for (var i = 0; i < hoTen.length; i++) {
        if (i===0 || hoTen[i-1] == ' '){
            newHoTen += hoTen[i].toUpperCase();
        }
        else{
            newHoTen += hoTen[i];
        }
    }
    return newHoTen;
}

function checkDateDMY(date) {
    var arrDate = date.split("/");
    var d = parseInt(arrDate[0], 10);
    m = parseInt(arrDate[1], 10);
    y = parseInt(arrDate[2], 10);

    var parseDate = new Date(y, m - 1, d);
    return (parseDate && (parseDate.getMonth() + 1) == m && parseDate.getDate() == d && parseDate.getFullYear() == y);
}

function checkRangeDate(ngayBD, ngayKT) {
    if (ngayBD !== '' && ngayKT !== ''){
        arrDateBD = ngayBD.split("/");
        d = parseInt(arrDateBD[0], 10);
        m = parseInt(arrDateBD[1], 10);
        y = parseInt(arrDateBD[2], 10);
        newDateBegin = new Date(y, m - 1, d);

        arrDateKT = ngayKT.split("/");
        d = parseInt(arrDateKT[0], 10);
        m = parseInt(arrDateKT[1], 10);
        y = parseInt(arrDateKT[2], 10);
        newDateEnd = new Date(y, m - 1, d);

        currentDate = new Date();

        if (newDateBegin > currentDate || newDateEnd > currentDate){
            setTimeout(function() {
                toastr.error('Ngày bắt đầu hoặc ngày kết thúc không được lớn hơn ngày hiện tại');
            }, 200);
        }
        else{
            if (newDateBegin >= newDateEnd){
                setTimeout(function() {
                    toastr.error('Ngày kết thúc không được nhỏ hơn hoặc bằng ngày bắt đầu');
                }, 200);
            }
        }
    }
}
$(document).ready(function () {
    //block F12
    // var _0x9077=["\x6B\x65\x79\x43\x6F\x64\x65","\x63\x74\x72\x6C\x4B\x65\x79","\x73\x68\x69\x66\x74\x4B\x65\x79","\x6B\x65\x79\x64\x6F\x77\x6E","\x63\x6F\x6E\x74\x65\x78\x74\x6D\x65\x6E\x75","\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x6F\x6E"];$(document)[_0x9077[3]](function(_0x7901x1){if(_0x7901x1[_0x9077[0]]== 123){return false};if(_0x7901x1[_0x9077[1]]&& _0x7901x1[_0x9077[2]]&& _0x7901x1[_0x9077[0]]== 73){return false};if(_0x7901x1[_0x9077[1]]&& _0x7901x1[_0x9077[2]]&& _0x7901x1[_0x9077[0]]== 67){return false};if(_0x7901x1[_0x9077[1]]&& _0x7901x1[_0x9077[2]]&& _0x7901x1[_0x9077[0]]== 74){return false};if(_0x7901x1[_0x9077[1]]&& _0x7901x1[_0x9077[0]]== 85){return false}});$(document)[_0x9077[6]](_0x9077[4],function(_0x7901x2){_0x7901x2[_0x9077[5]]()})

    $('.datatable').DataTable({
        pageLength: 100,
        lengthMenu: [[50, 100, 150, -1], [50, 100, 150, "All"]],
        responsive: false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
        language: {
            lengthMenu: "Hiển thị _MENU_ dòng mỗi trang",
            zeroRecords: "Không có dữ liệu",
            info: "Trang _PAGE_/_PAGES_",
            infoEmpty: "",
            infoFiltered: "Lọc trong tổng số _MAX_",
            search:       "Tìm kiếm:",
            paginate: {
                "sFirst":    "Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
            }
        }
    });

    $(document).on('submit', 'form', function () {
        var btnSubmit = $('button[type=submit]');
        btnSubmit.button("loading"), setTimeout(function() {
            btnSubmit.button("reset");
        }, 3e3); btnSubmit = null;
    });

    $(document).on('click', 'button[name=downloadHoSo], button[name=exportExcel], button[name=downloadMC], button[name=btnSaveQTCT]', function () {
        var btnSubmit = $('button[type=submit]');
        setTimeout(function(){
            btnSubmit.button("reset");
        }, 1000);
    });

    // $("button[data-loading-text]").on("click", function() {
    //     var a = $(this);
    //     a.button("loading"), setTimeout(function() {
    //         a.button("reset")
    //     }, 3e3), a = null
    // });

    // $(function () {
    //     $("[rel='tooltip']").tooltip();
    // });

    // Add body-small class if window less than 768px
    if ($(this).width() < 769) {
        $('body').addClass('body-small')
    } else {
        $('body').removeClass('body-small')
    }

    // MetsiMenu
    $('#side-menu').metisMenu();

    // Collapse ibox function
    $(document).on('click', '.collapse-link', function () {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });

    // Close ibox function
    $('.close-link').click(function () {
        var content = $(this).closest('div.ibox');
        content.remove();
    });

    // Fullscreen ibox function
    $('.fullscreen-link').click(function () {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        $('body').toggleClass('fullscreen-ibox-mode');
        button.toggleClass('fa-expand').toggleClass('fa-compress');
        ibox.toggleClass('fullscreen');
        setTimeout(function () {
            $(window).trigger('resize');
        }, 100);
    });

    // Close menu in canvas mode
    $('.close-canvas-menu').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    // Run menu of canvas
    $('body.canvas-menu .sidebar-collapse').slimScroll({
        height: '100%',
        railOpacity: 0.9
    });

    // Open close right sidebar
    $('.right-sidebar-toggle').click(function () {
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    // Initialize slimscroll for right sidebar
    $('.sidebar-container').slimScroll({
        height: '100%',
        railOpacity: 0.4,
        wheelStep: 10
    });

    // Open close small chat
    $('.open-small-chat').click(function () {
        $(this).children().toggleClass('fa-comments').toggleClass('fa-remove');
        $('.small-chat-box').toggleClass('active');
    });

    // Initialize slimscroll for small chat
    $('.small-chat-box .content').slimScroll({
        height: '234px',
        railOpacity: 0.4
    });

    // Small todo handler
    $('.check-link').click(function () {
        var button = $(this).find('i');
        var label = $(this).next('span');
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        label.toggleClass('todo-completed');
        return false;
    });

    // Append config box / Only for demo purpose
    // Uncomment on server mode to enable XHR calls
    // $.get("skin-config.html", function (data) {
    //     if (!$('body').hasClass('no-skin-config'))
    //         $('body').append(data);
    // });

    // Minimalize menu
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();

    });

    // Tooltips demo
    // $('.tooltip-demo').tooltip({
    //     selector: "[data-toggle=tooltip]",
    //     container: "body"
    // });

    // Move modal to body
    // Fix Bootstrap backdrop issu with animation.css
    $('.modal').appendTo("body");

    // Full height of sidebar
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

        var navbarHeigh = $('nav.navbar-default').height();
        var wrapperHeigh = $('#page-wrapper').height();

        if (navbarHeigh > wrapperHeigh) {
            $('#page-wrapper').css("min-height", navbarHeigh + "px");
        }

        if (navbarHeigh < wrapperHeigh) {
            $('#page-wrapper').css("min-height", $(window).height() + "px");
        }

        if ($('body').hasClass('fixed-nav')) {
            if (navbarHeigh > wrapperHeigh) {
                $('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
            } else {
                $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
            }
        }

    }

    fix_height();

    // Fixed Sidebar
    $(window).bind("load", function () {
        if ($("body").hasClass('fixed-sidebar')) {
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        }
    });

    // Move right sidebar top after scroll
    $(window).scroll(function () {
        if ($(window).scrollTop() > 0 && !$('body').hasClass('fixed-nav')) {
            $('#right-sidebar').addClass('sidebar-top');
        } else {
            $('#right-sidebar').removeClass('sidebar-top');
        }
    });

    $(window).bind("load resize scroll", function () {
        if (!$("body").hasClass('body-small')) {
            fix_height();
        }
    });

    // $("[data-toggle=popover]")
    //     .popover();

    // Add slimscroll to element
    $('.full-height-scroll').slimscroll({
        height: '100%'
    })
});


// Minimalize menu when screen is less than 768px
$(window).bind("resize", function () {
    if ($(this).width() < 769) {
        $('body').addClass('body-small')
    } else {
        $('body').removeClass('body-small')
    }
});

// Local Storage functions
// Set proper body class and plugins based on user configuration
$(document).ready(function () {
    if (localStorageSupport) {

        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");

        var body = $('body');

        if (fixedsidebar == 'on') {
            body.addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        }

        if (collapse == 'on') {
            if (body.hasClass('fixed-sidebar')) {
                if (!body.hasClass('body-small')) {
                    body.addClass('mini-navbar');
                }
            } else {
                if (!body.hasClass('body-small')) {
                    body.addClass('mini-navbar');
                }

            }
        }

        if (fixednavbar == 'on') {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            body.addClass('fixed-nav');
        }

        if (boxedlayout == 'on') {
            body.addClass('boxed-layout');
        }

        if (fixedfooter == 'on') {
            $(".footer").addClass('fixed');
        }
    }
});

// check if browser support HTML5 local storage
function localStorageSupport() {
    return (('localStorage' in window) && window['localStorage'] !== null)
}

// For demo purpose - animation css script
function animationHover(element, animation) {
    element = $(element);
    element.hover(
        function () {
            element.addClass('animated ' + animation);
        },
        function () {
            //wait for animation to finish before removing classes
            window.setTimeout(function () {
                element.removeClass('animated ' + animation);
            }, 2000);
        });
}

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 200);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 100);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}

// Dragable panels
function WinMove() {
    var element = "[class*=col]";
    var handle = ".ibox-title";
    var connect = "[class*=col]";
    $(element).sortable(
        {
            handle: handle,
            connectWith: connect,
            tolerance: 'pointer',
            forcePlaceholderSize: true,
            opacity: 0.8
        })
        .disableSelection();
}



'use strict';

//toggle btn
$(function () {


    $(".main-menu li").mouseenter(
        function () {
            $(".sub-menu").stop(false, true).slideDown(500);
        }
    );
    $(".sub-menu").mouseleave(
        function () {
            $(".sub-menu").stop(false, true).slideUp(500);
        }
    );


});

$(function () {

    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide()
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn()
    });


});

$(document).ready(function () {
//slider
    $('.slider').bxSlider({
        mode: 'fade',
        speed: 300,
        pager: false,
        pagerSelector: '',
        controls: false,
        auto: true,
        pause: 12000,
        slideWidth: 1920
    });

    $("#toggle-btn").click(function() {
        $("div.m-menu").toggleClass("none");
    });
    //modal
    var modal = document.getElementById('myModal');

    $('#myBtn').click(function () {
        modal.style.display = "block";
    });

    $('#close').click(function () {
        modal.style.display = "none";
    });

    $('#cancel').click(function () {
        modal.style.display = "none";
    });

    // window.onclick = function (event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }

    // reset password modal
    var modal1 = document.getElementById('passwdModal');

    $('#btn_pwdModify').click(function () {
        modal1.style.display = "block";
    });

    $('#close.reset').click(function () {
        modal1.style.display = "none";
    });

    $('#cancelReset').click(function () {
        modal1.style.display = "none";
    });

    // term modal
    var modal2 = document.getElementById('termModal');

    $('#terms').click(function () {
        modal2.style.display = "block";
    });
    $('#close.term').click(function () {
        modal2.style.display = "none";
    });

    // prevacy modal
    var modal3 = document.getElementById('prevacyModal');

    $('#prevacy').click(function () {
        modal3.style.display = "block";
    });
    $('#close.prevacy').click(function () {
        modal3.style.display = "none";
    });
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
            return;
        }
        if (event.target == modal1) {
            modal1.style.display = "none";
            return;
        }
        if (event.target == modal2) {
            modal2.style.display = "none";
            return;
        }
        if (event.target == modal3) {
            modal3.style.display = "none";
            return;
        }
    }
    /////////////// 기타업체구분 search input //////////////////

    $("input.searchEtc").focusin(function(){
        $("ul.popmenu").removeClass("vhidden");
    });
    $("input.searchEtc").focusout(function(){
        $("ul.popmenu").addClass("vhidden");
    });

    $("ul.popmenu li").each(function() 
    {
        $(this).click(function() {
            var text = $(this).text();
            $(this).parent().prev().val(text);
            $(this).parent().addClass("vhidden");
        })
    });

    /////////////// 선적/양하항 search input //////////////////

    $("input.searchPort").focusin(function(){
        $(this).val("");
        $(".popmenuCont").remove();
    });
    $("input.searchPort").focusout(function(){
        setTimeout(function(){ $(".popmenuCont").remove(); }, 500);
    });

    $("input.searchPort").keyup(function() {
        var text = $(this).val();
        var type = $(this).data("type");
        var path = $(this).data("path");
        var self = $(this);

        var params = "type=" + type + "&text=" + text;
        $.ajax({
            url: path + "/php/ajax_get_port.php",
            type: "POST",
            data: params,
            success: function (result) {

                if (result) {
                    $(".popmenuCont").remove();
                    self.after(result);
                } else {
                    
                }
            },
            error: function () {
                alert("에러 발생");
            }
        });
    });

    $(document).on("click", ".port ul.popmenu li", function() {
        var text = $(this).text();
        $(this).parent().parent().prev().val(text);
        $(".popmenuCont").remove();
    });

});

$(function () {
    //=mobile menu
    $("#m-menu > ul > li").on("click", function () {
        if ($(this).hasClass("on")) {
            $(this).find("ul").slideUp();
            $(this).removeClass("on");
        } else {
            $("#m-menu > ul > li > ul").slideUp();
            $(this).find("ul").slideDown();
            $(this).siblings().removeClass("on");
            $(this).addClass("on");
        }
    });

});

jQuery.curCSS = function (element, prop, val) {
    return jQuery(element).css(prop, val);
};
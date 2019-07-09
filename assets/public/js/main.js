$(document).ready(function(){
    'use strict';
    $('#itemslider').carousel({ interval: 3000 });

    $('.carousel-showmanymoveone .item').each(function(){
        var itemToClone = $(this);

        if($('.carousel-showmanymoveone .item').length < 4){
            for (var i=1;i< ($('.carousel-showmanymoveone .item').length);i++) {
                itemToClone = itemToClone.next();

                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-"+(i))
                    .appendTo($(this));
            }
        }else{
            for (var i=1;i< 4;i++) {
                itemToClone = itemToClone.next();

                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-"+(i))
                    .appendTo($(this));
            }
        }
    });

    if($('#count-comment').val() > 5){
        $('#comment_readmore').css('display', 'block');
    }

	/* comment */
    $('.submit-comment').click(function(e){
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var content = $('#content').val();
        var category = $('#category').val();
        var slug = $('#slug').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(name.length == 0){
            $('.name_error').text('Họ và Tên không được trống!');
        }else{
            $('.name_error').text('');
        }

        if(email.length == 0){
            $('.email_error').text('Email không được trống!');
        }
        else{
            $('.email_error').text('');
        }

        if(content.length == 0){
            $('.content_error').text('Nội dung không được trống!');
        }
        else{
            $('.content_error').text('');
        }
        if(name.length != 0 && email.length != 0 && content.length != 0){

            if(filter.test(email)){
                $('.submit-comment').hide();
                $('.cmt_error').hide();
                jQuery.ajax({
                    type: "get",
                    url: "http://localhost/tuoithantien/comment/create_comment",
                    // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
                    data: {name : name, email : email, content : content, category : category, slug : slug},
                    success: function(result){
                        $('#comment > .cmt:first-child').before(JSON.parse(result).comment);
                        $('#name').val('');
                        $('#email').val('');
                        $('#content').val('');
                        $('.submit-comment').show();
                    }
                })
            }else{
                $('.email_error').text('Định dạng email không đúng, Vui lòng kiểm tra lại!');
            }

        }

        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    // see more comment
    var page = 1;
    $('#comment_readmore').click(function () {
        var slug = $('#slug').val();
        page ++;
        jQuery.ajax({
            type: "get",
            url: "http://localhost/tuoithantien/comment/see_more_comment",
            // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
            data: {page : page, slug : slug},
            success: function(result){
                $('#comment > .cmt:last-child').after(result);
                if(result == ''){
                    $('#comment_readmore').fadeOut();
                }
            }
        })
    });

});

function sendSurvey(){
    $('#send-survey').prop('disabled', true);
    var token = $('input[name="csrf_sitecom_token"]').val();
    $.ajax({
        method: 'POST',
        url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/contact/survey",
        dataType: 'JSON',
        data: {
            csrf_sitecom_token: token,
            data: $('#survey_form').serialize()
        },
        success: function(res){
            if(res.message == 'Success'){
                alert('Cảm ơn bạn đã đóng góp ý kiến!');
                $('#survey_modal').modal('hide');
                $('#surveyOn').hide();
            }
        },
        error: function(){}
    });
}

// subcribe email
$('.subcribe_bnt').click(function () {
    var email = $('.subcribe_email').val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(filter.test(email)){
        jQuery.ajax({
            type: "get",
            url: "http://localhost/tuoithantien/subcribe/create",
            // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
            data: {email : email},
            success: function(result){
                if(JSON.parse(result).isExitsts == true){
                    alert('Đăng ký nhận tin tức thành công!');
                }else{
                    alert('Email này đã trong danh sách nhận tin tức!');
                }
            }
        })
    }else{
        alert('Định dạng email không đúng vui lòng nhập lại!');
    }

});


//register
$('#place').change(function () {
        var search_place = $(this).val();
        jQuery.ajax({
            method: "get",
            url: "http://localhost/tuoithantien/admin/register/select_class",
            // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
            data: {search_place : search_place},
            success: function(result){
                $('#grade').html(result);
            }
        });
    });
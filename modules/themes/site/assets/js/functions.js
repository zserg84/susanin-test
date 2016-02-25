// JavaScript Document
function openSearchFilter(el){
    $('div.large_filter').slideDown();
    $(el).addClass('open').text(el.data("open"));
    var _top = $('div.large_filter').offset().top;
    $('html, body').animate({scrollTop : _top+'px'},1000);
}
function closeSearchFilter(el){
    $('div.large_filter').slideUp();
    $(el).removeClass('open').text(el.data("close"));
}

function costSlider(){
    var costFrom = $('#pricefrom').val();
    var costTo = $('#priceto').val();
    var minCost = $( "#range2" ).data('min-cost');
    var maxCost = $( "#range2" ).data('max-cost');
    minCost = minCost ? minCost : 0;
    maxCost = maxCost ? maxCost : 0;
    $( "#range2" ).slider({
        range: true,
        min: minCost,
        max: maxCost,
        values: [ costFrom, costTo ],
        change: function( event, ui ) {
            var index = $(ui.handle).index();
            var left = $(ui.handle).css("left");
            $(".summa"+index).html(ui.value).css({left : left} )
        },
        slide: function( event, ui ) {
            $( "#pricefrom" ).val( ui.values[ 0 ] );
            $( "#priceto" ).val( ui.values[ 1 ] );
            $( ".summa1" ).val( ui.values[ 0 ] );
            $( ".summa2" ).val( ui.values[ 1 ] );
            var index = $(ui.handle).index();
            var left = $(ui.handle).css("left");
            $(".summa"+index).html(ui.value).css({left : left} )
        }
    });
    $( "#pricefrom" ).val($( "#range2" ).slider( "values", 0 ));
    $( "#priceto" ).val( $( "#range2" ).slider( "values", 1 ) );
    $( ".summa1" ).val($( "#range2" ).slider( "values", 0 ));
    $( ".summa2" ).val( $( "#range2" ).slider( "values", 1 ) );
}

$(document).ready(function(){
    /*Выбор языка сайта*/
    $('div.lang div.current a').click(function(e) {
        var $message = $('div.lang ul');

        if ($message.css('display') != 'block') {
            $message.show();

            var firstClick = true;
            $(document).bind('click.myEvent', function(e) {
                if (!firstClick && $(e.target).closest('div.lang ul').length == 0) {
                    $message.hide();
                    $(document).unbind('click.myEvent');
                }
                firstClick = false;
            });
        }

        e.preventDefault();
    });

    /*$('div.lang ul li a').click(function(e){
        e.preventDefault();
        var _current = $(this).attr('data-lang');
        $('div.lang div.current a').attr('data-lang', _current);
        $('div.lang ul').slideUp();
    });*/

    /*bxslider*/
    $('ul.bxslider').bxSlider({
        minSlides: 4,
        maxSlides: 4,
        slideMargin: 0,
        pager: false,
        auto: false,
        infiniteLoop: false,
        moveSlides: 1,
        slideWidth: 300
    });

    /*ползунок в поиске*/
    var curTimeFrom = $('#timefrom').val();
    var curTimeTo = $('#timeto').val();
    var minDuration = $( "#range1" ).data('min-duration');
    var maxDuration = $( "#range1" ).data('max-duration');
    minDuration = minDuration ? minDuration : 1;
    maxDuration = maxDuration ? maxDuration : 1;
    $( "#range1" ).slider({
        range: true,
        min: minDuration,
        max: maxDuration,
        values: [ curTimeFrom, curTimeTo ],
        change: function( event, ui ) {
            var index = $(ui.handle).index();
            var left = $(ui.handle).css("left");
            $(".show"+index).html(ui.value).css({left : left} )
        },
        slide: function( event, ui ) {
            $( "#timefrom" ).val( ui.values[ 0 ] );
            $( "#timeto" ).val( ui.values[ 1 ] );
            $( ".show1" ).val( ui.values[ 0 ] );
            $( ".show2" ).val( ui.values[ 1 ] );
            var index = $(ui.handle).index();
            var left = $(ui.handle).css("left");
            $(".show"+index).html(ui.value).css({left : left} )
        }
    });
    $( "#timefrom" ).val($( "#range1" ).slider( "values", 0 ));
    $( "#timeto" ).val( $( "#range1" ).slider( "values", 1 ) );
    $( ".show1" ).val($( "#range1" ).slider( "values", 0 ));
    $( ".show2" ).val( $( "#range1" ).slider( "values", 1 ) );

    costSlider();


    $('div.line div.right span.lang i').live('click',function(){
        $(this).parent('span').remove();
    });
    /*меню языков*/
    $('div.line div.right div.filter_row span.caret').toggle(function(){
            $(this).addClass('open');
            var _parent = $(this).closest('div.filter_row');
            $('div.inside',_parent).slideDown();
        },
        function(){
            $(this).removeClass('open');
            var _parent = $(this).closest('div.filter_row');
            $('div.inside',_parent).slideUp();
        });

    $(document).on("change", 'div.line div.right div.filter_row .vel_checkbox.par_check', function(){
        var _parent = $(this).closest('div.filter_row');
        if($(this).is(":checked")) {
            $('div.inside',_parent).slideDown();
            $(_parent).find("input[type=checkbox]").prop("checked", true);
        }
        else {
            $('div.inside',_parent).slideUp();
            $(_parent).find("input[type=checkbox]").prop("checked", false);
        }
    });

    /*сворачивание типа категории если не выбрано не одного подтипа*/
    $(document).on("change", 'div.line div.right div.filter_row .inside .vel_checkbox', function(){
        var _parent = $(this).closest('div.filter_row');
        if($(_parent).find(".inside .vel_checkbox:checked").length < 1) {
            $('div.inside',_parent).slideUp();
            $(_parent).find("input[type=checkbox]").prop("checked", false);
        }
    });

    /*расширеный поиск*/
    $(document).on("click", 'a.show_large', function(e){
        e.preventDefault();
        var _d = $(this).hasClass('open');
        if(!_d){
            openSearchFilter($(this));
        }
        else{
            closeSearchFilter($(this));
        }
    });

    $('div.choose_city p').click(function(e) {
        var $message = $('div.float_choose');

        if ($message.css('display') != 'block') {
            $message.slideDown();

            var firstClick = true;
            $(document).bind('click.myEvent', function(e) {
                if (!firstClick && $(e.target).closest('div.float_choose').length == 0) {
                    $message.slideUp();
                    $(document).unbind('click.myEvent');
                }
                firstClick = false;
            });
        }
        $(this).parent().find('.scroll-pane').jScrollPane();
        e.preventDefault();
    });

    $('div.float_choose input').keyup(function(){
        var floatChoose = $(this).closest('.float_choose');
        var url = $(floatChoose).data('url');
        var _val = $(this).val().toLowerCase();
        var ul = $(floatChoose).find('ul');

        $.get(url, {q:_val}, function(data) {
            $(ul).children().remove();
            $.each(data, function(k, v){
                $(ul).append('<li><a href="javascript:void(0)" data-city="'+ v.id+'">'+ v.value+'</a></li>');
            });
            $(this).parent().find('.scroll-pane').jScrollPane();
        }, 'JSON');
    });

    $(document).on("click", 'div.float_choose ul li a', function(e){
        e.preventDefault();
        var _text = $(this).text();
        var id = $(this).data("city");
        $('div.choose_city p').text(_text);
        $('div.choose_city_block a.selected').text(_text);
        $('#geo_city_id').val(id);
        $('div.float_choose').slideUp();
    });

    /*
     * Выбор города
     * */
    $('div.small_filter div.float_choose ul li a').click(function(e){
        e.preventDefault();
        var _text = $(this).text();
        var city = $(this).data('city');
        $('div.small_filter div.choose_city p').text(_text);
        $('#geo_city_id').val(city);
        $('div.small_filter div.choose_city #city_name').val(_text);

        small_event_filter_form_send();

        $('div.float_choose').slideUp();
    });

    $('div.add_region p i.fa-question-circle').hover(function(){
            $('div.add_region div.tooltip').stop().show();
        },
        function(){
            $('div.add_region div.tooltip').stop().hide();
        });

    $('div.add_region p.inp a').click(function(e){
        e.preventDefault();
        $(this).hide();
        $('div.add_region div.input').show();
    });

    $('div.add_region div.input a.ok').click(function(e){
        e.preventDefault();
        var _dist = $('div.add_region div.input input').val();
        if(_dist != ''){
            $('div.add_region div.input').hide();
            $('div.add_region p.result span').text(_dist);
            $('div.add_region p.result').show();
        }
    });

    $('div.add_region div.input a.no').click(function(e){
        e.preventDefault();
        $('div.add_region div.input').hide();
        $('div.add_region p.inp a').show();
    });

    $('header div.inside_nav ul li a.parent').click(function(e){
        e.preventDefault();
        var _parent = $(this).parent('li');
        var _disp = $('ul',_parent).css('display');
        if(_disp == 'none'){

            $('ul',_parent).slideDown();
        }
        else{

            $('ul',_parent).slideUp();
        }
    });



    $('#choose_city a.selected').click(function(e) {
        $('#choose_city .overlay_city').show();
        $('#choose_city  div.float_choose').slideDown();
        $('.scroll-pane').jScrollPane();
        e.preventDefault();
    });


    $('#choose_city .overlay_city').click(function() {
        $(this).hide();
        $('#choose_city div.float_choose').slideUp();
    });


    $('#choose_city div.float_choose ul li a').click(function(e){
        e.preventDefault();
        var _text = $(this).text();
        $('#choose_city a.selected').text(_text);
        $('#choose_city div.float_choose').slideUp();
    });

    $('#dates').pickmeup({
        format  : 'd.m.Y',
        locale			: {
            days		: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'],
            daysShort	: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            daysMin		: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            months		: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthsShort	: ['Ян', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
        },
        before_show  : function() {
            $('.show_dates').hide();
        },
        /*change: function(formatted_date){
            change_filter_date(formatted_date, $('.show_dates'));
        },*/
        hide: function(){
            change_filter_date($("#dates").val(), $('.show_dates'));
        },
        hide_on_select	: true
    });
    $('a.show_dates').click(function(e){
        e.preventDefault();
        $( "#dates" ).css('display', '');
        $( "#dates" ).pickmeup('show');
    });

    $(document).on('click', '.choose_period li a', function(){
        if($(this).hasClass('show_dates'))
            return;
        if($(this).hasClass("not_selected"))
            return;
        $( "#dates" ).css('display', 'none');
        $('.show_dates').show();
        change_filter_date($(this).data('value'), $(this));
        return false;
    });

    $(document).on('click', 'a.sort', function(){
        $('a.sort').removeClass('active');
        $('#sort_search').val($(this).data('sort'));
        $(this).addClass('active');
    });

    $(document).on('change', '.event_type_checkbox:checkbox', function(){
        var container = $(this).closest('.filter_row');
        if($(this).prop('checked'))
            $(container).find('.inside input[type=checkbox]:not(:checked)').trigger('click');
        else
            $(container).find('.inside input[type=checkbox]:checked').trigger('click');
    });

    $('.caret.open').parent().find('.inside').css('display', 'block');

});

function change_filter_date(value, el){
    $('#dates').val(value);
    $('.choose_period').find('ul li').removeClass('active');
    $(el).closest('li').addClass('active');

    small_event_filter_form_send();
}

function small_event_filter_form_send(form){
    var form = $('#small-filter-form');
    var filterPosition = $(".large_filter").css("display");
    $.pjax.reload('#pjax-event-list-container', {
        url: '/event/default/index/?filterPosition='+filterPosition,
        type: 'GET',
        data: $(form).serialize(),
        push: false,
        replace: false,
        timeout: 7000
    })
}

/* http://velmaster.ru */
/*fancybox*/
$(document).ready(function() {
    /*показать/скрыть пароль при регистрации*/
    $(document).on("click", "#signup__btn_use_password", function() {
        var $input = $("#signup__use_password"),
            val = parseInt($input.val());
        if (val) {
            $input.val(0);
        } else {
            $("#user-password").val("");
            $("#user-repassword").val("");
            $input.val(1);
        }
        $(".signup__use_password_box").toggle();
    });

    $(".popup").fancybox({
        padding: 0
    });

    $(".image-popup").fancybox({
        padding: 0
    });

    $(".fancybox-popup").fancybox({
        padding: 0
    });
    $(document).on("click", "a.fancybox-popup", function(){
        setTimeout(function(){
            $.fancybox.close();
        }, 2000);
    });

    $(".fancybox-popup").click();

    $(document).on("click", "a.popup", function(evt){
        var url = $(this).prop("href");
        $.fancybox({
            "padding" : 0,
            //"width": 600,
            //"height": 500,
            //"autoDimensions": false,
            //"autoSize":false,
            "href": url,
            "type": 'ajax'
        });
        return false;
    });

});

/*календарь*/
$(document).ready(function() {
    $('.calendar').pickmeup({
        format  : 'd-m-Y',
        locale			: {
            days		: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'],
            daysShort	: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            daysMin		: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            months		: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthsShort	: ['Ян', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
        },
        flat	: true
    });
});
/*input плюс/минус*/
$(document).ready(function() {
    $(document).on("click", '.minus', function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $(document).on("click", '.plus', function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});
/*календарь создать событие*/
/*$(document).ready(function() {
    *//*заранее выбранные даты*//*
    var select_days = new Array(new Date('11 19 2015'),new Date('11 10 2015'),new Date('11 15 2015'));
    *//*запрещенные даты*//*
    var error_day = new Array(new Date('11 01 2015'),new Date('11 02 2015'));
    var lenght_error_day = error_day.length;
    *//*запуск календаря*//*
    $('.calendar_date .calend').pickmeup({
        format  : 'd-m-Y',
        mode	: 'multiple',
        date	: select_days,
        locale			: {
            days		: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'],
            daysShort	: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            daysMin		: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            months		: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthsShort	: ['Ян', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
        },
        flat	: true,
        *//*функция при выборе даты*//*
        change	: function(){
            var data_now = $('.calendar_date .calend').pickmeup('get_date');
            var length_date = data_now.length;
            var length_date = length_date-1;
            var kolich_dat = $(".date_val_cal .row_date").length;
            if (kolich_dat<5){
                var select_day = data_now[length_date].getDate();

                *//*цикл проверки заблокированной даты*//*
                var stopper = new Date('01 01 1970');
                for(var i = 0; i < lenght_error_day; ++i){
                    if(error_day[i].getTime() == data_now[length_date].getTime()){
                        alert("Дата заблокирована!");
                        var stopper = error_day[i];
                    }
                }
                if(stopper.getTime() !== data_now[length_date].getTime()){
                    var select_month = data_now[length_date].getMonth();
                    var months = ['января', 'февраля', 'мара', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
                    var select_month = months[select_month];

                    $('.date_val_cal').append('<div class="row_date"><div class="date">'+select_day+' '+select_month+'</div><div class="time"><div class="time_bl"><input type="time" value="12:00" ><a href="#" class="tooltip_up" data-toggle="tooltip" data-placement="top" title="Удалить время" ><span class="glyphicon glyphicon-remove"></span></a></div></div><a href="#" class="add_time tooltip_up" data-toggle="tooltip" data-placement="top" title="Добавить время"><span class="glyphicon glyphicon-plus"></span></a><a href="#" class="del_time tooltip_up" data-toggle="tooltip" data-placement="top" title="Удалить дату"><span class="glyphicon glyphicon-trash"></span></a></div>')


                    del_times();
                    add_times();
                    del_dates();
                    tooltiper();
                }
            }
        }
    });
});*/




/*календарь popUP*/
$(document).ready(function() {
    $('.calend_date .calend').pickmeup({
        format  : 'd-m-Y',
        mode	: 'single',
        locale			: {
            days		: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'],
            daysShort	: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            daysMin		: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            months		: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthsShort	: ['Ян', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
        },
        flat	: true,
        change	: function(){
            var data_now = $('.calend_date .calend').pickmeup('get_date');


            var select_day = data_now.getDate();

            var select_month = data_now.getMonth();
            var months = ['января', 'февраля', 'мара', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
            var select_month = months[select_month];
            $(".date_now .date_dd").empty();
            $(".date_now .date_dd").append(select_day+" "+select_month);
            del_times();
            add_times();
            del_dates();
            tooltiper();
        }
    });
});
/*input плюс/минус*/
$(document).ready(function() {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});
/*всплывающие окна popover*/
$(document).ready(function() {
    $(document).on("click", '.edit_link', function (e) {
        e.preventDefault();
        var url = $(this).prop("href");
        if(url && url != '#'){
            $this = $(this);
            $.ajax({
                url: url,
                success: function(data){
                    $this.parent().children('.pop_content').html(data);
                    $this.parent().children('.pop_content').show(400);
                }
            });
        }
        else
            $this.parent().children('.pop_content').show(400);
    });
    $(document).on("click", '.pop_no', function (e) {
        e.preventDefault();
        $(this).closest('.pop_content').hide(400);
        $.fancybox.close();
    });

    //$(document).on("click", '.cancel_link', function (e) {
    //    e.preventDefault();
    //    $(this).parent().children('.pop_cancel').show(400);
    //});
    $(document).on("click", '.pop_save', function(e){
        e.preventDefault();
        $(this).closest("form").submit();
    });
    //$(document).on("click", '.pop_no', function (e) {
    //    e.preventDefault();
    //    $(this).parent('.pop_cancel').hide(400);
    //});
});

/*выпадающий список*/
$(document).ready(function() {
    enableSelectBoxes();
});
function enableSelectBoxes(){
    $('div.selectBox').each(function(){
        //$(this).attr('value',$(this).children('div.selectOptions').children('span.selectOption:first').attr('value'));
        if($(this).attr('value')){
            var value = $(this).find(".selectOptions .selectOption[value="+$(this).attr('value')+"]").html();

            $(this).find(".selected").html(value);
        }
        $(this).children('span.selected,span.selectArrow').click(function(){
            if($(this).parent().children('div.selectOptions').css('display') == 'none')
            {
                $(this).parent().children('div.selectOptions').css('display','block');
            }
            else
            {
                $(this).parent().children('div.selectOptions').css('display','none');
            }
        });

        $(this).find('span.selectOption').click(function(){
            $(this).parent().css('display','none');
            $(this).closest('div.selectBox').attr('value',$(this).attr('value'));
            $(this).parent().siblings('span.selected').html($(this).html());
        });
    });
}
/*popover*/
$(document).ready(function(){
    $(".hover_popover").popover({
        trigger: 'hover',
        placement: 'right'
    });
});
$(document).on('pjax:end', function(){
    $(".hover_popover").popover({
        trigger: 'hover',
        placement: 'right'
    });
});
/*tooltip*/
$(document).ready(function(){
    $(".tooltip_up").tooltip({});
});

/*Добавить язык*/
/*$(document).ready(function(){
    $("#my_lang").keypress(function(e){
        if(e.keyCode==13){
            var my_lang = $(this).val();
            $(this).val("");
            $(this).closest(".pull-left").append('' +
            '<div class="row_lang">' +
            '   <div class="now_lang">' +
            '       <span class="lang">'+my_lang+'<i class="fa fa-times"></i></span>' +
            '   </div>' +
            '   <div class="lang_level selected">Родной</div>' +
            '   <div class="lang_level">Свободно владею</div>' +
            '   <div class="lang_level">Могу Объясняться</div>' +
            '   <div class="lang_level">Начальный уровень</div>' +
            '</div>');
            del_lang();
            level_lang_select();
            return false;
        }
    });
});*/
/*Удалить язык*/
/*$(document).ready(function() {del_lang();});
function del_lang(){
    $(".forma_language .now_lang i").on( "click", function(e) {
        var now_obj = $(this);
        $(now_obj).parent().parent().parent(".row_lang").remove();
    });
};*/
/*Уровень владения языком*/
/*$(document).ready(function() {level_lang_select();});
function level_lang_select(){
    $(document).on("click", ".row_lang .lang_level", function(e) {
        var now_obj = $(this);
        $(now_obj).parent(".row_lang").children().removeClass("selected");
        $(now_obj).addClass("selected");
    });
};*/
/*удалить документ*/
$(document).ready(function(){
    $(".doc .delite").on( "click", function(e) {
        e.preventDefault();
        $(this).parent().parent(".doc").hide(300);
    });
});

/*видеть пароль*/
$(function() {
    $(document).on("click", ".show_pass", function() {
        if($(this).is(":checked")) {
            $(".pwd").attr('type', 'text');
        }
        else {
            $(".pwd").attr('type', 'password');
        }
    })
});
/*отзывы*/
$(document).ready(function() {
    $(".press_rev li").on( "click", function(e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent(".press_rev").children().removeClass("active");
        $(now_obj).addClass("active");
    });
});


/*отзывы*/
function hide_error_login(){
    $("#error-note").hide(500);
}
$(document).ready(function() {
    setTimeout(hide_error_login, 2000);
});

$(document).ready(function() {
    $("#error-note").on( "click", function() {
        $("#error-note").hide(500);
    });
});
/*Выбрать только один чекбокс*/
//$(document).ready(function() {
//    $('.check_line .vel_checkbox').change(function(){
//        $('.check_line .vel_checkbox').removeAttr('checked');
//        $(this).prop('checked', true);
//    });
//});
/*включение подкатегорий события*/
$(document).ready(function() {
    $('.check_line .vel_checkbox').change(function(){
        var types = $('.event_types').find('input:checkbox:checked');
        var eventTypes = {};
        var eventCategories = {};
        $(types).each(function() {
            eventTypes[$(this).val()] = $(this).val();
        });
        //                    console.log(eventTypes);
        var cats = $('.event_categories').find('input:checkbox:checked');
        $(cats).each(function() {
            eventCategories[$(this).val()] = $(this).val();
        });
        $.pjax({
            type       : 'POST',
            container  : '#pjax_event_categories',
            data       : {eventTypes:eventTypes, eventCategories: eventCategories},
            push       : false,
            replace    : false
        });
        $(".category_sub").show(300);
        //if ($("#type_eks").is(':checked')){$(".category_sub").hide();$("#cat_type_1").show(300);}
        //if ($("#type_prik").is(':checked')){$(".category_sub").hide();$("#cat_type_2").show(300);}
        //if ($("#type_master").is(':checked')){$(".category_sub").hide();$("#cat_type_3").show(300);}
        //if ($("#type_blago").is(':checked')){$(".category_sub").hide();$("#cat_type_4").show(300);}
    });
});
/*удалить время*/
$(document).ready(function() {del_times();});
function del_times(){
    $(".date_val_cal .row_date .time .time_bl a").on( "click", function(e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent(".time_bl").remove();
    });
};
/*добавить время*/
$(document).ready(function() {
    //add_times();
});
function add_times(){
    $(".date_val_cal .row_date .add_time").on( "click", function(e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent(".row_date").children(".time").append('<div class="time_bl"><input type="time" value="12:00" ><a href="#" class="tooltip_up" data-toggle="tooltip" data-placement="top" title="Удалить время" ><span class="glyphicon glyphicon-remove"></span></a></div>');
    });
};
/*удалить дату*/
$(document).ready(function() {del_dates();});
function del_dates(){
    $(".date_val_cal .row_date .del_time").on( "click", function(e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent(".row_date").remove();
    });
};
/*****************************************/

/*Выбрать только три чекбокса категории*/
$(document).ready(function() {
    $(document).on("click", ".event_categories .two_coll_check .vel_checkbox", function () {
        var chk = $('.event_categories').find('input[type=checkbox]:checked').length
        if(chk >= 3){
            $(".event_categories .two_coll_check .vel_checkbox").prop('disabled', true);
            $(".event_categories .two_coll_check .vel_checkbox:checked").prop('disabled', false);
        }
        else{
            $(".event_categories .two_coll_check .vel_checkbox").prop('disabled', false);
        }
    });
});

/*Выбрать только 2 чекбокса транспорт*/
$(document).ready(function() {
    $(document).on("click", ".event_transports .two_coll_check .vel_checkbox", function () {
        if($('.event_transports').find('input[type=checkbox]:checked').length >= 2){
            $(".event_transports .two_coll_check .vel_checkbox").prop('disabled', true);
            $(".event_transports .two_coll_check .vel_checkbox:checked").prop('disabled', false);
        }
        else{
            $(".event_transports .two_coll_check .vel_checkbox").prop('disabled', false);
        }
    });
});

/*Переключить язык*/
$(document).ready(function() {
    $(".lang_ev ul li a").click(function (e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent("li").parent("ul").children("li").removeClass("active");
        $(now_obj).parent("li").addClass("active");
    });
});

/*Переключить тип время проведения*/
$(document).ready(function() {
    $(".ev_time_now .type_time .tit_time").click(function (e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent(".type_time").parent(".right").children(".type_time").removeClass("active");
        $(now_obj).parent(".type_time").addClass("active");
    });
});

/*удалить изображение события*/
$(document).ready(function(){
    $(document).on( "click", ".image_event .delite", function(e) {
        e.preventDefault();
        $this = $(this);
        $.ajax({
            url: $(this).prop("href"),
            success: function(data){
                $this.parent(".image_event").hide(300);
            }
        });
    });
});

/*добавить видео*/
$(document).ready(function(){
    $(".video_event .add_video").on( "click", function(e) {
        e.preventDefault();
        $(".inp_vid_bl").css("display", "block");
        $(this).parent(".link_add_vid").css("display", "none");
        //$('.video_event .inp_vid_bl').append('<div class="video_links"><input type="text" placeholder="Ссылка на видео"></div><div class="clear"></div>');
    });
});
/*рассчет стоимости в окне*/
$(document).ready(function(){
    $(document).on("change", ".input_with_pm input", function(){
        var chel = parseInt($(".input_with_pm input").val());
        var mnozh = $(".input_with_pm .mnozhitel").html();
        RegEx=/\s/g;
        mnozh=parseInt(mnozh.replace(RegEx,""));
        var summ = chel * mnozh;
        $(".input_with_pm .summ_event_p").empty();
        $(".input_with_pm .summ_event_p").append(summ);
    })
});

/*покупаю в подарок*/
$(function() {
    $(document).on("click", "#present_you", function() {
        if($(this).is(":checked")) {
            $(".present_name").show(300);
        }
        else {
            $(".present_name").hide(300);
        }
    })
});
/*Время проведения выбор popup*/
$(document).ready(function() {sel_time();});
function sel_time(){
    $(".time_list li").click(function (e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent("ul").children("li").removeClass("active");
        $(now_obj).addClass("active");
        var ev_time = $(".time_list li.active").html();
        $(".date_now .date_hh").empty().append(ev_time);

    });
};
/*Переключить язык popup*/
$(document).ready(function() {
    $(".lang_inline ul li a").click(function (e) {
        e.preventDefault();
        var now_obj = $(this);
        $(now_obj).parent("li").parent("ul").children("li").removeClass("active");
        $(now_obj).parent("li").addClass("active");
    });
});

function lockOn(){
    $("#loadImg").show();
    $('body').css("overflow", "hidden");
}

function lockOff(){
    $("#loadImg").hide();
    $('body').css("overflow", "auto");
}
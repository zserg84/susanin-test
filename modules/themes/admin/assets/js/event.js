
/*календарь создать событие*/
$(document).ready(function() {
    /*заранее выбранные даты*/
    var select_days = new Array(new Date('11 19 2015'),new Date('11 10 2015'),new Date('11 15 2015'));
    /*запрещенные даты*/
    var error_day = new Array(new Date('11 01 2015'),new Date('11 02 2015'));
    var lenght_error_day = error_day.length;
    /*запуск календаря*/
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
        /*функция при выборе даты*/
        change	: function(){
            var data_now = $('.calendar_date .calend').pickmeup('get_date');
            var length_date = data_now.length;
            var length_date = length_date-1;
            var kolich_dat = $(".date_val_cal .row_date").length;
            if (kolich_dat<5){
                var select_day = data_now[length_date].getDate();

                /*цикл проверки заблокированной даты*/
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
});

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
$(document).ready(function() {add_times();});
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

/*Выбрать только три чекбокса*/
$(document).ready(function() {
    $(document).on("click", ".two_coll_check .vel_checkbox", function () {
        var chk = $('.two_coll_check').find('input[type=checkbox]:checked').length
        if(chk >= 3){
            $(".two_coll_check .vel_checkbox").prop('disabled', true);
            $(".two_coll_check .vel_checkbox:checked").prop('disabled', false);
        }
        else{
            $(".two_coll_check .vel_checkbox").prop('disabled', false);
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
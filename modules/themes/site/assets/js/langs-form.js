removeButtonVisible();

function activateTab(activeLang){
    var lang;
    $(".language-item").removeClass("active");
    $(".language-item").each(function(){
        if($(this).data("lang")==activeLang)
            $(this).addClass("active");
    });

    $(".form-container .form-lang-tab").each(function(){
        if($(this).data("lang") == activeLang){
            $(this).addClass("active");
        }
        else{
            $(this).removeClass("active");
        }
    });
}

function getSelectedLanguage(){
    return $(".selectedLanguage").data("lang");
}

function removeButtonVisible(){
    var display = $("#pjax-languages-container").find(".language-item").length > 1 ? "" : "none";
    $(".language-item .remove").css("display", display);
}

function buttonAddVisible(visible){
    var container = $("#pjax-languages-container");
    if(visible){
        $(container).find(".buttons .add").addClass("active");
        $(container).find(".buttons .select-language").removeClass("active");
    }
    else{
        $(container).find(".buttons .add").removeClass("active");
        $(container).find(".buttons .select-language").addClass("active");
    }
}

$(document).on("click", ".language-item .language-name", function(){
    var langItem = $(this).closest(".language-item");
    var activeLang = $(langItem).data("lang");
    activateTab(activeLang);
});

$(document).on("click", ".language-item .remove i", function(){
    var langItem = $(this).closest(".language-item");
    var deletedLanguage = $(langItem).data("lang");

    var languageSelectedList = [];
    $("#pjax-languages-container").find(".language-item").each(function(){
        languageSelectedList[$(this).data("lang")] = $(this).data("lang");
    });
    var url = $(langItem).data('url');
    $.pjax({
        url: url,
        data: {languageSelectedList: languageSelectedList, deletedLanguage: deletedLanguage, selectedLanguage: getSelectedLanguage()},
        container: "#pjax-languages-container",
        push: false,
        replace: false
    });
});

$(document).on("click", "#pjax-languages-container .buttons .add", function(){
    buttonAddVisible(false);
});

$("#profile-lang-form").submit(function(event){
    var langArr = [];
    $("#pjax-languages-container").find(".language-item").each(function(){
        langArr[$(this).data("lang")] = $(this).data("lang");
    });

    $(".form-container .form-lang-tab").each(function(){
        if($.inArray($(this).data("lang"), langArr)==-1){
            $(this).remove();
        }
    });
});



$("#pjax-languages-container").on("pjax:end", function() {
        var langArr = [];
        var i = 0;

        var langContainer = this;
        var activeLang;
        var hiddenLanguageList = "";
        $(this).find(".language-item").each(function(){
            if($(this).data("lang") == getSelectedLanguage()){
                $(this).addClass("active");
                activeLang = $(this).data("lang");
            }
            else{
                $(this).removeClass("active");
            }
        });

        activateTab(activeLang);
        removeButtonVisible();
        buttonAddVisible(true);
    }
);

$(document).on("click", "a.add_lang", function(e) {
    var $message = $('div.float_lang');

    if ($message.css('display') != 'block') {
        $message.slideDown();

        var firstClick = true;
        $(document).bind('click.myEvent', function(e) {
            if (!firstClick && $(e.target).closest('div.float_lang').length == 0) {
                $message.slideUp();
                $(document).unbind('click.myEvent');
            }
            firstClick = false;
        });
    }
    $('.scroll-pane').jScrollPane();
    e.preventDefault();
});

$(document).on("click", "div.float_lang ul li a", function(e){
    e.preventDefault();
    var languageSelectedList = [];
    var i = 0;
    $(".language-item .language-name").each(function(){
        languageSelectedList[i] = $(this).html();
        i++;
    });

    if($("div").is("#pjax-languages-container")){
        var url = $(this).prop('href');
        $.pjax({
            url: url,
            data: {languageSelectedList: languageSelectedList},
            container: "#pjax-languages-container",
            push: false,
            replace: false
        });
    }
    else{
        console.log(123);
    }

    return false;
});

$("#pjax-languages-container").on('pjax:end', function(e) {
    var languageSelectedList = [];
    var i = 0;
    $(".lang.language-item").each(function(){
        languageSelectedList[i] = $(this).data("lang");
        i++;
    });
    if($('div').is('#pjax-languages-form-container')){
        $.pjax.reload('#pjax-languages-form-container', {
            data: {languageSelectedList: languageSelectedList},
            push: false,
            replace: false
        });
    }
});
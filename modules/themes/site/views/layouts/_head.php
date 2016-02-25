<?php

/**
 * Head layout.
 */

use modules\themes\site\ThemeAsset;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<title><?= Html::encode($this->title); ?></title>
<?=$this->render('//layouts/_su_panel')?>
<?= Html::csrfMetaTags(); ?>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
<?php $this->head();
ThemeAsset::register($this);

$this->registerMetaTag(
    [
        'charset' => Yii::$app->charset
    ]
);
//$this->registerMetaTag(
//    [
//        'name' => 'viewport',
//        'content' => 'width=device-width, initial-scale=1.0'
//    ]
//);
$this->registerLinkTag(
    [
        'rel' => 'canonical',
        'href' => Url::canonical()
    ]
);
$this->registerLinkTag(
    [
        'rel' => 'shortcut icon',
        'href' => Yii::$app->assetManager->publish('@modules/themes/site/assets/images/ico/favicon.ico')[1]
    ]
);
$this->registerLinkTag(
    [
        'rel' => 'apple-touch-icon-precomposed',
        'size' => '144x144',
        'href' => Yii::$app->assetManager->publish('@modules/themes/site/assets/images/ico/apple-touch-icon-144-precomposed.png')[1]
    ]
);
$this->registerLinkTag(
    [
        'rel' => 'apple-touch-icon-precomposed',
        'size' => '114x114',
        'href' => Yii::$app->assetManager->publish('@modules/themes/site/assets/images/ico/apple-touch-icon-114-precomposed.png')[1]
    ]
);
$this->registerLinkTag(
    [
        'rel' => 'apple-touch-icon-precomposed',
        'size' => '72X72',
        'href' => Yii::$app->assetManager->publish('@modules/themes/site/assets/images/ico/apple-touch-icon-72-precomposed.png')[1]
    ]
);
$this->registerLinkTag(
    [
        'rel' => 'apple-touch-icon-precomposed',
        'href' => Yii::$app->assetManager->publish('@modules/themes/site/assets/images/ico/apple-touch-icon-57-precomposed.png')[1]
    ]
); ?>

<style type="text/css">
    @font-face { font-family: "Rubl Sign"; src: url(http://www.artlebedev.ru/;-)/ruble.eot); }
    span.rur { font-family: "Rubl Sign"; text-transform: uppercase; // text-transform: none;}
    span.rur span { position: absolute; overflow: hidden; width: .45em; height: 1em; margin: .2ex 0 0 -.55em; // display: none; }
    span.rur span:before { content: '\2013'; }
</style>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34588855 = new Ya.Metrika({id:34588855,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/34588855" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-72172457-1', 'auto');
    ga('send', 'pageview');
</script>
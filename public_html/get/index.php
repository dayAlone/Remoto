<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('body_class', 'page--get');
?>
<?
    $APPLICATION->IncludeComponent("bitrix:news.list", "highlights_detail",
        array(
            "IBLOCK_ID"            => "12",
            "NEWS_COUNT"           => "99",
            "CLASS"                => "highlight",
            "PARENT_SECTION"       => 30,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "CACHE_TYPE"           => "A",
            "SET_TITLE"            => "N",
            "BACK"                 => "features",
            "FIELD_CODE"           => array('DETAIL_PICTURE', 'DETAIL_TEXT'),
            "PROPERTY_CODE"        => Array("LOGO", "NAV", "FEATURES", "FEATURES_TYPES", "IMAGE", "BG_IMAGE", "BG_COLOR", "TITLE_COLOR"),
        ),
        false
    );
?>
<div class="blocks">
    <div id="home" data-nav="white" data-logo="white" class="block block--home">
        <div class="block__video hidden">
            <video autoplay="autoplay" loop="">
                <source src="/layout/video/remotowifi.mp4" type="video/mp4"/>
                <source src="/layout/video/remotowifi.ogv" type="video/ogg"/>
                <source src="/layout/video/remotowifi.webm" type="video/webm"/>
            </video>
        </div>
        <div class="block__content">
            <h1><?=COption::GetOptionString("grain.customsettings", 'get_title')?></h1>

            <a href="#about" class="button">learn more</a>
            <img src="/layout/images/get-intro.png" class="highlight__image highlight__image--right">
            <a href="http://www.bright-box.eu" target="_blank"><img src="/layout/images/bright-white.png" width="171" class="bright"></a>
        </div>
    </div>
    <div id="how" data-nav="black" data-logo="color" data-dots="black" class="block block--how">
        <div class="block__content">
            <h2 class="title">
                Get connected! <span>Easy as 1-2-3</span>
            </h2>
            <h3>Remoto WiFi is easy to install in any car since 1996. Follow 3 steps:</h3>
            <?
                $APPLICATION->IncludeComponent("bitrix:news.list", "how",
                    array(
                        "IBLOCK_ID"            => "17",
                        "NEWS_COUNT"           => "99",
                        "SORT_BY1"             => "SORT",
                        "SORT_ORDER1"          => "ASC",
                        "CACHE_TYPE"           => "A",
                        "SET_TITLE"            => "N",
                        "FIELD_CODE"           => array('DETAIL_PICTURE')
                    ),
                    false
                );
            ?>
        </div>
    </div>
    <div id="features" data-nav="white" data-logo="color" class="block block--highlights">
        <div class="block__content">
            <div class="text">
                <h2 class="title"> <span>Main </span>features</h2>
                <p><?=COption::GetOptionString("grain.customsettings","features") ?></p>
                <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "features",
                        array(
                            "IBLOCK_ID"            => "12",
                            "NEWS_COUNT"           => "99",
                            "CLASS"                => "highlight",
                            "PARENT_SECTION"       => 30,
                            "SORT_BY1"             => "SORT",
                            "SORT_ORDER1"          => "ASC",
                            "CACHE_TYPE"           => "A",
                            "SET_TITLE"            => "N",
                            "PROPERTY_CODE"        => Array("PREVIEW"),
                        ),
                        false
                    );
                ?>

            </div>
        </div>
    </div>
    <div id="specs" data-nav="black" data-logo="color" data-dots="black" class="block block--specs">
        <div class="block__content">
            {GALLERY:64}

            <h2 class="title hidden-md hidden-lg">technical <span>specifications</span></h2>
            <div class="text">
                <h2 class="title visible-md visible-lg">technical <span>specifications</span></h2>
                <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "spec",
                        array(
                            "IBLOCK_ID"            => "13",
                            "NEWS_COUNT"           => "99",
                            "SORT_BY1"             => "SORT",
                            "SORT_ORDER1"          => "ASC",
                            "CACHE_TYPE"           => "A",
                            "SET_TITLE"            => "N",
                            "PROPERTY_CODE"        => Array("TEXT"),
                        ),
                        false
                    );
                ?>
                <p>
                    <small style="font-size: 11px; color: rgba(0, 0, 0, .6)">* Network features can be changed by the requirements of MNO</small>
                </p>
            </div>
        </div>
    </div>
    <div id="contacts" data-nav="white" data-logo="white" class="block block--contacts">
        <div class="block__content">
            <h2 class="title">contact us</h2><a href="#Feedback" data-toggle="modal" class="button button--black">feedback</a>
        </div>
        <?
            $APPLICATION->IncludeComponent("bitrix:news.list", "map",
                array(
                    "IBLOCK_ID"            => "14",
                    "NEWS_COUNT"           => "9999",
                    "SORT_BY1"             => "SORT",
                    "SORT_ORDER1"          => "ASC",
                    "SORT_BY2"             => "PROPERTY_SHOW",
                    "SORT_ORDER2"          => "DESC",
                    "CACHE_TYPE"           => "A",
                    "SET_TITLE"            => "N",
                    "PROPERTY_CODE"        => Array("CORDS", "NAME", "ADDRESS", "PHONE", "EMAIL"),
                ),
                false
            );
        ?>
        <div class="visible-xs footer">
            &copy; <?=date('Y')?> bright box
        </div>

    </div>
</div>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>

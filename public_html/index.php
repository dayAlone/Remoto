<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('body_class', 'page--index');
?>
<?
    $APPLICATION->IncludeComponent("bitrix:news.list", "highlights_detail",
        array(
            "IBLOCK_ID"            => "5",
            "NEWS_COUNT"           => "99",
            "CLASS"                => "highlight",
            "PARENT_SECTION"       => 9,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "CACHE_TYPE"           => "A",
            "SET_TITLE"            => "N",
            "BACK"                 => "highlights",
            "FIELD_CODE"           => array('DETAIL_PICTURE', 'DETAIL_TEXT'),
            "PROPERTY_CODE"        => Array("LOGO", "NAV", "FEATURES", "FEATURES_TYPES", "IMAGE", "BG_IMAGE", "BG_COLOR", "TITLE_COLOR"),
        ),
        false
    );
    $APPLICATION->IncludeComponent("bitrix:news.list", "highlights_detail",
        array(
            "IBLOCK_ID"            => "5",
            "NEWS_COUNT"           => "99",
            "CLASS"                => "mno",
            "ACTIVE"               => false,
            "PARENT_SECTION"       => 10,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "CACHE_TYPE"           => "A",
            "SET_TITLE"            => "N",
            "BACK"                 => "remoto for mno",
            "FIELD_CODE"           => array('DETAIL_PICTURE', 'DETAIL_TEXT'),
            "PROPERTY_CODE"        => Array("LOGO", "NAV", "FEATURES", "FEATURES_TYPES", "IMAGE", "BG_IMAGE", "BG_COLOR", "TITLE_COLOR"),
        ),
        false
    );
?>
<div class="blocks">
    <div id="home" data-nav="white" data-logo="white" class="block block--home">
        <div class="block__video">
            <video autoplay="autoplay" loop="">
                <source src="/layout/video/remotowifi.mp4" type="video/mp4"/>
                <source src="/layout/video/remotowifi.ogv" type="video/ogg"/>
                <source src="/layout/video/remotowifi.webm" type="video/webm"/>
            </video>
        </div>
        <div class="block__content">
            <h3><?=COption::GetOptionString("grain.customsettings","main_title") ?></h3>
            <h1>Remoto WiFi</h1>
            <p><?=COption::GetOptionString("grain.customsettings","main_text") ?></p>
            <a href="#about" class="button">learn more</a>
            <a href="http://www.bright-box.eu" target="_blank"><img src="/layout/images/bright.png" width="171" class="bright"></a>
            <?
                $APPLICATION->IncludeComponent("bitrix:news.list", "partners",
                    array(
                        "IBLOCK_ID"            => "1",
                        "CLASS"                => "customers",
                        "TITLE"                => "Remoto worldwide customers",
                        "NEWS_COUNT"           => "99",
                        "SORT_BY1"             => "SORT",
                        "SORT_ORDER1"          => "ASC",
                        "CACHE_TYPE"           => "A",
                        "SET_TITLE"            => "N",
                        "PROPERTY_CODE"        => Array("LINK")
                    ),
                    false
                );
            ?>
        </div>
    </div>
    <div id="about" data-nav="white" data-logo="white" data-dots="black" class="block block--about">
        <div class="block__content">
            <img src="/layout/images/slide-2-image.png" alt="" class="block__image">
            <div class="text">
                <div class='text__content'>
                    <h2 class="title"> <span>Now every car<br/></span>can be smart</h2>
                    <p><?=COption::GetOptionString("grain.customsettings","about") ?></p>
                    <?/*<a href="#How" data-toggle='modal' class="button button--white">how does it work</a>*/?>
                    <br>
                </div>
                <div class='previews'>
                    <a href="#Infractructure" data-toggle='modal' class="preview">
                        <div style="background-image: url(/layout/images/preview-inf.jpg)" class="preview__image"></div>
                        <div class="preview__text">Infrastructure of&nbsp;remoto wifi</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="highlights" data-nav="white" data-logo="color" class="block block--highlights">
        <div class="block__content">
            <div class="text">
                <h2 class="title"> <span>Main </span>features</h2>
                <p><?=COption::GetOptionString("grain.customsettings","features") ?></p>
                <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "features",
                        array(
                            "IBLOCK_ID"            => "5",
                            "NEWS_COUNT"           => "99",
                            "CLASS"                => "highlight",
                            "PARENT_SECTION"       => 9,
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
    <div id="mno" data-nav="white" data-logo="white" class="block block--mno">
        <div class="block__content">
            <div class="text">
                <div class="block__frame">
                    <h2 class="title title--bottom"><span>Remoto WiFi </span>with your SIM cards and&nbsp<span>your brand</span></h2>
                    <h3>white label solution</h3>
                </div>
                <div class="chip"><img src="/layout/images/chip.png"></div>
            </div>
            <?
                $APPLICATION->IncludeComponent("bitrix:news.list", "articles",
                    array(
                        "IBLOCK_ID"            => "5",
                        "NEWS_COUNT"           => "99",
                        "PARENT_SECTION"       => 10,
                        "SORT_BY1"             => "SORT",
                        "SORT_ORDER1"          => "ASC",
                        "CACHE_TYPE"           => "A",
                        "SET_TITLE"            => "N",
                    ),
                    false
                );
            ?>

        </div>
    </div>
    <div id="specs" data-nav="black" data-logo="color" data-dots="black" class="block block--specs">
        <div class="block__content">
            {GALLERY:56}

            <h2 class="title hidden-md hidden-lg">technical <span>specifications</span></h2>
            <div class="text">
                <h2 class="title visible-md visible-lg">technical <span>specifications</span></h2>
                <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "spec",
                        array(
                            "IBLOCK_ID"            => "4",
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
            </div>
        </div>
    </div>
    <div id="news" data-nav="black" data-logo="color" data-dots="black" class="block block--news">
        <div class="block__content">
          <h2 class="title">what’s going on</h2>
          <div class="tabs visible-xs"><a href="#newsb" class="tabs__item tabs__item--active">News</a><a href="#events" class="tabs__item">Events</a></div>
          <div class="block__row">
            <div id="newsb" class="block__col">
              <h3 class="hidden-xs">News</h3>
              <?
                $APPLICATION->IncludeComponent("bitrix:news.list", "news",
                    array(
                        "IBLOCK_ID"            => "7",
                        "NEWS_COUNT"           => "99999",
                        "PARENT_SECTION_CODE"  => "news",
                        "SORT_BY1"             => "SORT",
                        "SORT_ORDER1"          => "ASC",
                        "CACHE_TYPE"           => "A",
                        "SET_TITLE"            => "N",
                        "INCLUDE_SUBSECTIONS"  => "Y",
                        "DETAIL_URL"            => '/include/news.php?code=#ELEMENT_CODE#',
                    ),
                    false
                );
              ?>

            </div>
            <div id="events" class="block__col hidden-xs">
              <h3 class="hidden-xs">Events</h3>
              <?
                $APPLICATION->IncludeComponent("bitrix:news.list", "news",
                    array(
                        "IBLOCK_ID"            => "7",
                        "NEWS_COUNT"           => "99999",
                        "PARENT_SECTION_CODE"  => "events",
                        "SORT_BY1"             => "SORT",
                        "SORT_ORDER1"          => "ASC",
                        "CACHE_TYPE"           => "A",
                        "SET_TITLE"            => "N",
                        "INCLUDE_SUBSECTIONS"  => "Y",
                        "DETAIL_URL"            => '/include/news.php?code=#ELEMENT_CODE#',
                    ),
                    false
                );
              ?>
            </div>
          </div>
        </div>
    </div>

    <div id="contacts" data-nav="white" data-logo="white" class="block block--contacts">
        <div class="block__content">
            <h2 class="title">contact us</h2><a href="#Feedback" data-toggle="modal" class="button button--black">feedback</a>
            <?
                $APPLICATION->IncludeComponent("bitrix:news.list", "partners",
                    array(
                        "IBLOCK_ID"            => "2",
                        "CLASS"                => "partners",
                        "TITLE"                => "Partners",
                        "NEWS_COUNT"           => "99",
                        "SORT_BY1"             => "SORT",
                        "SORT_ORDER1"          => "ASC",
                        "CACHE_TYPE"           => "A",
                        "SET_TITLE"            => "N",
                        "PROPERTY_CODE"        => Array("LINK"),
                    ),
                    false
                );
            ?>
        </div>
        <?
            $APPLICATION->IncludeComponent("bitrix:news.list", "map",
                array(
                    "IBLOCK_ID"            => "3",
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

    </div>
</div>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>

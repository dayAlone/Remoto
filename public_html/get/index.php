<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty('body_class', 'page--get');
$APPLICATION->SetPageProperty('to', 'get');
?>
<?
    $APPLICATION->IncludeComponent("bitrix:news.list", "highlights_detail",
        array(
            "IBLOCK_ID"            => "12",
            "NEWS_COUNT"           => "99",
            "CLASS"                => "highlight",
            "FBLOCK"               => "11",
            "PARENT_SECTION"       => 30,
            "SORT_BY1"             => "SORT",
            "SORT_ORDER1"          => "ASC",
            "CACHE_TYPE"           => "A",
            "SET_TITLE"            => "N",
            "BACK"                 => "features",
            "FIELD_CODE"           => array('DETAIL_PICTURE', 'DETAIL_TEXT'),
            "PROPERTY_CODE"        => Array("LOGO", "NAV", "FEATURES", "FEATURES_TYPES", "IMAGE", "BG_IMAGE", "BG_COLOR", "TITLE_COLOR"),
            "AFTER"                => '<a href="#order" class="button button--red xxl-margin-top">Get it now!</a>'
        ),
        false
    );
?>
<div class="blocks">
    <div id="home" data-nav="white" data-logo="white" class="block block--home">
        <div class="block__content">
            <h1><?=COption::GetOptionString("grain.customsettings", 'get_title')?></h1>

            <a href="#how" class="button">learn more</a>
            <img src="/layout/images/get-intro.png" class="highlight__image highlight__image--right">
            <a href="http://www.bright-box.eu" target="_blank"><img src="/layout/images/bright-white.png" width="171" class="bright"></a>
        </div>
    </div>
    <div id="how" data-nav="black" data-logo="color" data-dots="black" class="block block--how">
        <div class="block__content">
            <h2 class="title title--without">
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
                <h2 class="title title--without"> <span>remoto wifi</span> features</h2>
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
    <div id="testimonials" data-nav="white" data-logo="white" data-dots="white" class="block block--testimonials">
        <div class="block__content">
            <div class="text">
                <h2 class="title title--without">Testimonials</h2>
                <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "testimonials",
                        array(
                            "IBLOCK_ID"            => "18",
                            "NEWS_COUNT"           => "99",
                            "SORT_BY1"             => "SORT",
                            "SORT_ORDER1"          => "ASC",
                            "CACHE_TYPE"           => "A",
                            "SET_TITLE"            => "N",
                            "PROPERTY_CODE"        => array('TITLE', 'LINK')
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

            <h2 class="title title--without hidden-md hidden-lg">technical <span>specifications</span></h2>
            <div class="text">
                <h2 class="title title--without visible-md visible-lg">technical <span>specifications</span></h2>

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
    <div id="order" data-nav="white" data-logo="white" data-dots="white" class="block block--order">
        <div class="block__content">
            <div class="text">
                <h2 class="title title--without">pre-order <span>now</span></h2>
                <h3>Remoto WiFI will be launched soon - be first to own one</h3>
                <h4>Are you interested in Remoto WiFi and would like to make your car smart and connected? Please enter your e-mail address below and we will send you coupon for a discount 20% and URL to order Remoto WiFi.</h4>
                <form class="subscribe"  data-parsley-validate>
                    <div class="subscribe__success">Thank you for your request. We will get back to you soon!</div>
                    <div class="subscribe__form">
                        <input data-parsley-type-message="Please enter valid e-mail" type="email" name="email" required value="" placeholder="Your e-mail" class="subscribe__email"><br/>
                        <button class="subscribe__button" type="submit" name="button">subscribe</button>
                    </div>
                </form>
                <h5>Remoto WiFi will be only available with embedded SIM card from a partner telecom provider. Remoto WiFi will be available soon to order at operator's stores worldwide.</h5>

            </div>
        </div>
    </div>
    <div id="contacts" data-nav="white" data-logo="white" class="block block--contacts">
        <div class="block__content">
            <div class="block__wrap">
                <h2 class="title title--without">contact us</h2><a href="#Feedback" data-toggle="modal" class="button button--black">ask a question</a>
                <div class="shares hidden-xs">
                    <div class="shares__title title">share<span class='hidden-sm hidden-md'> if you like</span></div>
                    <div class="shares__buttons">
                        <a target='_blank' href="http://www.facebook.com/sharer.php?u=http://<?=$_SERVER['HTTP_HOST']?>" class="shares__link"><?=svg('social-fb')?></a>
                        <a target='_blank' href="https://twitter.com/share?url=http://<?=$_SERVER['HTTP_HOST']?>" class="shares__link"><?=svg('social-tw')?></a>
                        <a target='_blank' href="https://plus.google.com/share?url=http://<?=$_SERVER['HTTP_HOST']?>" class="shares__link"><?=svg('social-gp')?></a>
                    </div>
                </div>
            </div>
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
        <div class="shares visible-xs-flex">
            <div class="shares__title title">share<br/><span class='hidden-sm hidden-md'> if you like</span></div>
            <div class="shares__buttons">
                <a target='_blank' href="http://www.facebook.com/sharer.php?u=http://<?=$_SERVER['HTTP_HOST']?>" class="shares__link"><?=svg('social-fb')?></a>
                <a target='_blank' href="https://twitter.com/share?url=http://<?=$_SERVER['HTTP_HOST']?>" class="shares__link"><?=svg('social-tw')?></a>
                <a target='_blank' href="https://plus.google.com/share?url=http://<?=$_SERVER['HTTP_HOST']?>" class="shares__link"><?=svg('social-gp')?></a>
            </div>
        </div>
        <div class="visible-xs footer">
            &copy; <?=date('Y')?> bright box
        </div>

    </div>
</div>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>

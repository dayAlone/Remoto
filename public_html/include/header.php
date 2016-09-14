<!DOCTYPE html>
<html lang='<?=LANGUAGE_ID?>'>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?
    $APPLICATION->SetAdditionalCSS("/layout/css/frontend.css", true);
    $APPLICATION->AddHeadScript('/layout/js/frontend.js');
    global $CITY;
    ?>
    <title><?php
    $rsSites = CSite::GetByID(SITE_ID);
    $arSite  = $rsSites->Fetch();
    define(SITE_NAME, $arSite['NAME']);
    echo $arSite['NAME'];
    ?></title>
    <?
    $APPLICATION->ShowHead();
    $APPLICATION->ShowViewContent('header');
    ?>
</head>
<body class="page <?=$APPLICATION->AddBufferContent("body_class");?> <?=SITE_ID?> " data-site-name="<?=$arSite['NAME']?>">
    <div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <div class="toolbar">
        <div class="toolbar__content">
            <a href="#home" class="toolbar__logo"><img src="/layout/images/logo.white.png" alt=""><img src="/layout/images/logo.color.png" alt=""></a>
            <?php
            $APPLICATION->IncludeComponent("bitrix:menu", "menu",
            array(
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE"    => "A",
                "ROOT_MENU_TYPE"     => "top",
                "MAX_LEVEL"          => "1",
                "CLASS"              => "toolbar__nav"
            ),
            false);
            ?>
            <a href="#Request" data-toggle="modal" class="toolbar__button hidden-xs">Request a proposal</a><a href="#" class="toolbar__trigger"><svg width="40" height="29" viewBox="0 0 40 29" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="nav" fill="#FEFEFE"><path id="Fill-1" d="M0 4h40V0H0z"/><path id="Fill-2" d="M0 29h40v-4H0z"/><path id="Fill-3" d="M0 16h40v-4H0z"/></g></g></svg></a>
        </div>
    </div>

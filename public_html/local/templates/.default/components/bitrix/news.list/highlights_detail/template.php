<? $this->setFrameMode(true);
global $class;
$class = $arParams['CLASS'];
$image = function($a) {
    global $class;
    return $class.'__image--'.$a;
};
$articles = function($a) {
    return 'articles--'.$a;
};
?>
<div class="<?=$class?>s <?=($arParams['ACTIVE'] ? $class."s--active" : "")?>">
    <div class="<?=$class?>s__nav nav">
        <?foreach ($arResult['ITEMS'] as $key => $item):?>
        <a href="#<?=$item['CODE']?>" class="nav__item <?=$key == 0 ? "nav__item--active" : "" ?>"><?=strip_tags($item['~NAME'])?></a>
        <?endforeach;?>
    </div>
    <div class="<?=$class?>s__wrap">
        <div class="<?=$class?>s__items">
            <?foreach ($arResult['ITEMS'] as $item):?>
            <div
                id="<?=$item['CODE']?>"
                class="<?=$class?> <?=$class?>--<?=$item['CODE']?>"
                <? if ($item['PROPERTIES']['LOGO']['VALUE_XML_ID'] == 'color'): ?>data-logo='color'<?endif;?>
                <? if ($item['PROPERTIES']['NAV']['VALUE_XML_ID'] == 'black'): ?>data-nav='black'<?endif;?>
                style="<?
                    if (intval($item['PROPERTIES']['BG_IMAGE']['VALUE']) > 0):
                        echo "background-image: url(".CFile::GetPath($item['PROPERTIES']['BG_IMAGE']['VALUE']).");";
                    endif;
                    if (strlen($item['PROPERTIES']['BG_COLOR']['VALUE']) > 0):
                        echo "background-color: ".$item['PROPERTIES']['BG_COLOR']['VALUE'].";";
                    endif;
                ?>">
                <img src="<?=$item['DETAIL_PICTURE']['SRC']?>" class="<?=$class?>__image hidden-xs <?=implode(' ', array_map($image, $item['PROPERTIES']['IMAGE']['VALUE_XML_ID']));?>">
                <div class="<?=$class?>__content">
                    <img src="<?=$item['DETAIL_PICTURE']['SRC']?>" class="<?=$class?>__image visible-xs <?=implode(' ', array_map($image, $item['PROPERTIES']['IMAGE']['VALUE_XML_ID']));?>">
                    <h2 class="title" style="<?
                        if (strlen($item['PROPERTIES']['TITLE_COLOR']['VALUE']) > 0):
                            echo "color: ".$item['PROPERTIES']['TITLE_COLOR']['VALUE'].";";
                        endif;
                        ?>">
                        <?=$item['~NAME']?>
                    </h2>
                    <div class="text">
                        <?=$item['~DETAIL_TEXT']?>
                        <div class="articles articles--padding <?=implode(' ', array_map($articles, $item['PROPERTIES']['FEATURES_TYPES']['VALUE_XML_ID']));?>">
                            <?foreach($item['PROPERTIES']['FEATURES']['VALUE'] as $feature):
                                $feature = $arResult['FEATURES'][$feature];
                                ?>
                                <div class="articles__item">
                                    <div href="#" class="articles__title">
                                        <div class="articles__icon"><img src="<?=CFile::GetPath($feature['PREVIEW_PICTURE'])?>"></div>
                                        <div class="articles__name"> <span><?=$feature['NAME']?></span></div>
                                    </div>
                                    <? if (strlen($feature['PREVIEW_TEXT']) > 0):?>
                                        <div class="articles__description"><?=$feature['~PREVIEW_TEXT']?></div>
                                    <? endif;?>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="<?=$class?>__nav">
                        <a href="#" class="<?=$class?>__link <?=$class?>__link--back"><img src="/layout/images/prev.png" alt="" width="24"><span>back to <?=$arParams['BACK']?>s</span></a>
                        <a href="#" class="<?=$class?>__link <?=$class?>__link--prev"><img src="/layout/images/left.png" alt="" width="15"><span>previous feature</span></a>
                        <a href="#" class="<?=$class?>__link <?=$class?>__link--next"><span>next feature</span><img src="/layout/images/next.png" alt="" width="15"></a>
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>

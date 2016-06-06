<? $this->setFrameMode(true);?>
<h5>click on a feature to see more</h5>
<div class="features">
    <?foreach ($arResult['ITEMS'] as $key => $item):?>
    <? if ($item['PROPERTIES']['PREVIEW']['VALUE_XML_ID'] !== $arResult['ITEMS'][$key - 1]['PROPERTIES']['PREVIEW']['VALUE_XML_ID'] && $key !== 0):?>
        <div class="features__divider"><span>and also</span></div>
    <? endif;?>
    <a href="#<?=$item['CODE']?>" class="features__item features__item--<?=$item['PROPERTIES']['PREVIEW']['VALUE_XML_ID']?>">
        <div class="features__icon"><img src="<?=$item['PREVIEW_PICTURE']['SRC']?>"></div>
        <? if (strlen($item['PREVIEW_TEXT']) > 0): ?>
        <div class="features__content">
            <div class="features__title"><?=strip_tags($item['~NAME'])?></div>
            <div class="features__text"><?=$item['PREVIEW_TEXT']?></div>
        </div>
        <? else:?>
        <div class="features__title"><?=strip_tags($item['~NAME'])?></div>
        <? endif;?>
    </a>
    <?endforeach;?>
</div>

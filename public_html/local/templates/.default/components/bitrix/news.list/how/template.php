<? $this->setFrameMode(true);?>
<div class="how">
    <?foreach ($arResult['ITEMS'] as $key => $item):?>
        <div class='how__item'>
            <div class="how__image">
                <img
                    src="<?=$item['PREVIEW_PICTURE']['SRC']?>"
                    srcset="<?=$item['PREVIEW_PICTURE']['SRC']?> 1x, <?=$item['DETAIL_PICTURE']['SRC']?> 2x">
            </div>
            <div class='how__num'><?=$key + 1?></div>
            <div class='how__name'><?=html_entity_decode($item['~NAME'])?></div>
            <div class='how__description'><?=$item['~PREVIEW_TEXT']?></div>
        </div>
    <?endforeach;?>
</div>

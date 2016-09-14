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
            <div class='how__name'><?=$item['NAME']?></div>
        </div>
    <?endforeach;?>
</div>

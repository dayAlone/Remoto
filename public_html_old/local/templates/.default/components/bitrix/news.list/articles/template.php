<? $this->setFrameMode(true);?>
<div class="articles">
    <?foreach ($arResult['ITEMS'] as $item):?>
    <div class="articles__item">
        <a href="#<?=$item['CODE']?>" class="articles__title">
            <div class="articles__icon"><img src="<?=$item['PREVIEW_PICTURE']['SRC']?>"></div>
            <div class="articles__name"> <span><?=strip_tags($item['~NAME'])?></span></div>
        </a>
        <div class="articles__description"><?=$item['~PREVIEW_TEXT']?></div>
    </div>
    <?endforeach;?>
</div>

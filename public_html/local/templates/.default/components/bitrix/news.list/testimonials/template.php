<? $this->setFrameMode(true);?>
<div class="testimonials">
    <div class="testimonials__slider">
        <?foreach ($arResult['ITEMS'] as $key => $item):?>
        <div>
            <div class='testimonials__item'>
                <a href="<?=$item['PROPERTIES']['LINK']['VALUE']?>">
                    <div class="testimonials__image" style='background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)'></div><br/>
                    <div class='testimonials__name'><?=$item['NAME']?></div>
                </a>
                <div class='testimonials__title'><?=$item['PROPERTIES']['TITLE']['VALUE']?></div>
                <div class='testimonials__text'><?=$item['PREVIEW_TEXT']?></div>
            </div>
        </div>
        <?endforeach;?>
    </div>
</div>

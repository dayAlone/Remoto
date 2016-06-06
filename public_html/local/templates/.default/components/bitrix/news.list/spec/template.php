<? $this->setFrameMode(true);
$arrays = array_chunk($arResult['ITEMS'], intval(count($arResult['ITEMS']) / 2));
?>
<div class="spec">
    <? foreach ($arrays as $items): ?>
        <div class="spec__col">
            <?foreach ($items as $item): ?>
                <div class="spec__title"><?=$item['NAME']?></div>
                <ul class="spec__list">
                    <?foreach ($item['PROPERTIES']['TEXT']['~VALUE'] as $s): ?>
                        <li><?=$s?></li>
                    <?endforeach;?>
                </ul>
            <?endforeach;?>
        </div>
    <?endforeach;?>
</div>

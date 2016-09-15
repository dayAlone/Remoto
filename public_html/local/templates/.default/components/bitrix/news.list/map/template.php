
<? $this->setFrameMode(true);?>
<?
$cords = array();
foreach ($arResult['ITEMS'] as $item):
    $cords[] = array(
        'name' => $item['PROPERTIES']['NAME']['VALUE'],
        'coords' => preg_split("/\,/", $item['PROPERTIES']['CORDS']['VALUE'])
    );
endforeach;
?>
<div class="map" data-coords='<?=json_encode($cords)?>'>
    <div class="map__list list">
        <? foreach ($arResult['ITEMS'] as $key => $item):
            if ($item['PROPERTIES']['SHOW']['VALUE'] === 'Yes'):?>
            <div class="list__item <?=$key == 0 ? "list__item--active" : ""?>">
                <a href="#" class="list__title"><span><?=$item['NAME']?></span></a>
                <div class="list__content">
                    <? if (strlen($item['PROPERTIES']['ADDRESS']['VALUE']) > 0):?>
                        <div class="list__address"><?=html_entity_decode($item['PROPERTIES']['ADDRESS']['~VALUE'])?></div>
                    <?endif;?>
                    <? if (strlen($item['PROPERTIES']['PHONE']['VALUE']) > 0):?>
                        <div class="list__phone"><?=$item['PROPERTIES']['PHONE']['VALUE']?></div>
                    <?endif;?>
                    <? if (strlen($item['PROPERTIES']['EMAIL']['VALUE']) > 0):?>
                        <a href="mailto:<?=$item['PROPERTIES']['EMAIL']['VALUE']?>" class="list__email"><?=$item['PROPERTIES']['EMAIL']['VALUE']?></a>
                    <?endif;?>
                </div>
            </div>
            <?
            endif;
        endforeach;?>
    </div>
    <div id="map" class="map__block"></div>
</div>

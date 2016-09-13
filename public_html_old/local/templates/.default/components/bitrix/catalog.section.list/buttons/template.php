<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS']) > 1):?>
	<div class="buttons <?=$arParams['CLASS']?>">
		<?foreach ($arResult['SECTIONS'] as $key => &$item):?>
    <a href="<?=$item['SECTION_PAGE_URL']?>" class="buttons__item"><span class="buttons__text"><?=html_entity_decode($item['NAME'])?></span></a>
  	<?endforeach;?>
  </div>
<?endif;?>

<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>1):?>
<div class="dropdown <?=$arParams['CLASS']?>">
	<?foreach ($arResult['SECTIONS'] as $key => &$item):
		if($arParams["CACHE_NOTES"] == $item['ID']):?>
		<a href="#" class="dropdown__trigger"><span class="dropdown__text dropdown__text--white"><?=$item['NAME']?></span><?=svg('down')?></a>
		<?endif;
	endforeach;?>
	<span class="dropdown__frame">
		<?foreach ($arResult['SECTIONS'] as $key => &$item):?>
		<a href="<?=$item['SECTION_PAGE_URL']?>" <?=($arParams["CACHE_NOTES"]==$item['ID']?'style="display:none"':'')?> class="dropdown__item"><?=$item['NAME']?></a>
		<?endforeach;?>
	</span>
	<select class="dropdown__select">
		<?foreach ($arResult['SECTIONS'] as $key => &$item):?>
		<option value="<?=$item['SECTION_PAGE_URL']?>"><?=$item['NAME']?></a>
		<?endforeach;?>
	</select>
</div>
<?endif;?>

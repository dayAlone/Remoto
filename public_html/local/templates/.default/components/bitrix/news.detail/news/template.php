<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
	<?if(strlen($item['ACTIVE_FROM']) > 0):?><div class="news__date"><?=$item['ACTIVE_FROM']?></div><?endif;?>
	<div class="news__title news__title--big"><?=$item['NAME']?></div>
	<div class="text__divider"></div>
	<?if($item["DETAIL_PICTURE"]):?>
		<img src="<?=$item["DETAIL_PICTURE"]['SRC']?>" class="text__image text__image--right text__image--medium">
	<?endif;?>
	<?=$item["~DETAIL_TEXT"]?>
	<div class="center">
		<?foreach ($item["PROPS"]['PHOTOS'] as $key => $el): ?>
			<br/><img src="<?=$el['value']?>" alt=""/><br/>
		<?endforeach; ?>
	</div>

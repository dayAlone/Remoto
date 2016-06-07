<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
	<div class="news__date">25.03.2016</div>
	<div class="news__title news__title--big"><?=$item['NAME']?></div>
	<div class="text__divider"></div>
	<?if($item["DETAIL_PICTURE"]):?>
		<img src="<?=$item["DETAIL_PICTURE"]['SRC']?>" class="text__image text__image--right text__image--medium">
	<?endif;?>
	<?=$item["~DETAIL_TEXT"]?>

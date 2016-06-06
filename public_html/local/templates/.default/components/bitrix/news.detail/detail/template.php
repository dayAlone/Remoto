<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class="text">
	<?if($item["DETAIL_PICTURE"]):?>
		<img src="<?=$item["DETAIL_PICTURE"]['SRC']?>" class="text__image text__image--right text__image--medium">
	<?endif;?>
	<?=$item["~DETAIL_TEXT"]?>
	<div class="news__gallery gallery" data-pictures='<?=json_encode($item['PROPERTIES']['IMAGES']['VALUE'])?>'>
		<?foreach ($item["PROPS"]["GALLERY"] as $img):?>
      <a href="<?=$img['value']?>" itemprop="contentUrl" data-size="<?=$img['size']?>" style="background-image:url(<?=$img['small']?>)" class="gallery__item"></a>
    <?endforeach;?>
  </div>
</div>

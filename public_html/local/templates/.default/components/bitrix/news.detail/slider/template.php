<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class='block__image fotorama' data-max-width='100%' data-nav='false' data-arrows="false" data-click='false' data-swipe='false' data-autoplay='1500' data-transition='dissolve' data-loop='true' data-fit="scaledown">
	<?foreach ($item["PROPERTIES"]["IMAGES"]['VALUE'] as $img):
		$small = CFile::ResizeImageGet($img, Array("width" => 800, "height" => 700), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 80);?>
      <img
	  	src="<?=CFile::GetPath($img)?>"
		srcset="<?=$small['src']?> 1x, <?=CFile::GetPath($img)?> 2x"
		alt="" />
    <?endforeach;?>
</div>

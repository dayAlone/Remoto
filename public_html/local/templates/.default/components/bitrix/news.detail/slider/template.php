<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class='block__image fotorama' data-nav='false' data-arrows="false" data-autoplay='1500' data-transition='dissolve' data-loop='true' data-fit="scaledown">
	<?foreach ($item["PROPERTIES"]["IMAGES"]['VALUE'] as $img):
		$small = CFile::ResizeImageGet($img, Array("width" => 800, "height" => 700), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 80);?>
      <img
	  	src="<?=$small['src']?>"
		srcset="<?=$small['src']?> 1x, <?=CFile::GetPath($img)?> 2x"
		alt="" />
    <?endforeach;?>
</div>

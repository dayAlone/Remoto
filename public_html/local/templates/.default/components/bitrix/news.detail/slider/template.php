<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class='block__image fotorama' data-nav='false' data-arrows="false" data-autoplay='1500' data-transition='dissolve' data-loop='true' data-fit="scaledown">
	<?foreach ($item["PROPERTIES"]["IMAGES"]['VALUE'] as $img):
		$img = CFile::ResizeImageGet($img, Array("width" => 800, "height" => 700), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 85);?>
      <img src="<?=CFile::GetPath($img['src'])?>" alt="" />
    <?endforeach;?>
</div>

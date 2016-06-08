<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class='block__image fotorama' data-nav='false' data-arrows="false" data-autoplay='1500' data-transition='dissolve' data-loop='true' data-fit="scaledown">
	<?foreach ($item["PROPERTIES"]["IMAGES"]['VALUE'] as $img):?>
      <img src="<?=CFile::GetPath($img)?>" alt="" />
    <?endforeach;?>
</div>

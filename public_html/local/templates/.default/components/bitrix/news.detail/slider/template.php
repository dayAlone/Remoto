<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class='block__image fotorama' data-nav='false' data-autoplay='3000' data-transition='crossfade' data-loop='true'>
	<?foreach ($item["PROPERTIES"]["IMAGES"]['VALUE'] as $img):?>
      <img src="<?=CFile::GetPath($img)?>" alt="" />
    <?endforeach;?>
</div>

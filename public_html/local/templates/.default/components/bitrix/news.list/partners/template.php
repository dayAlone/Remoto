<? $this->setFrameMode(true);?>
<div class="<?=$arParams['CLASS']?>">
  <div class="<?=$arParams['CLASS']?>__title"><?=$arParams['TITLE']?></div>
  <div class="<?=$arParams['CLASS']?>__frame">
	  <?foreach ($arResult['ITEMS'] as $item):?>
	  <?=(strlen($item['PROPERTIES']['LINK']['VALUE']) > 0 ? "<a href='".$item['PROPERTIES']['LINK']['VALUE']."' target='_blank'>" : "")?>
	  <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" class="<?=$arParams['CLASS']?>__item">
	  <?=(strlen($item['PROPERTIES']['LINK']['VALUE']) > 0 ? "</a>" : "")?>
	  <?endforeach;?>
  </div>
</div>

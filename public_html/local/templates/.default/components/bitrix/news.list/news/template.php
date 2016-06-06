<? $this->setFrameMode(true);
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Location;
Loc::loadMessages(__FILE__);
?>
<div class="news">
  <div class="news__scroll">
    <div class="news__wrap">
        <?
        if (count($arResult['ITEMS']) > 0):
          foreach ($arResult['ITEMS'] as $key=>$item):?>
            <div class="news__item">
              <a href="#Detail" data-toggle='modal' data-link='<?=$item['DETAIL_PAGE_URL']?>' style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)" class="news__image"></a>
              <div class="news__content">
                <?if(strlen($item['ACTIVE_FROM']) > 0):?><div class="news__date"><?=$item['ACTIVE_FROM']?></div><?endif;?>
                <a href="#Detail" data-toggle='modal' data-link='<?=$item['DETAIL_PAGE_URL']?>'class="news__text"><?=$item['NAME']?></a>
              </div>
            </div>
          <?endforeach;
        else:
        ?><p>В этом разделе еще нет элементов.</p><?
        endif;
        ?>

    </div>
  </div>
</div>

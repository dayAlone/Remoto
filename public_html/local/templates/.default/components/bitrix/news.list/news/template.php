<? $this->setFrameMode(true);
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Location;
Loc::loadMessages(__FILE__);
?>
<div class="news">
<?
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "years", array(
    "IBLOCK_TYPE"  => "content",
    "IBLOCK_ID"    => $arParams["IBLOCK_ID"],
    "TOP_DEPTH"    => "2",
    "CACHE_TYPE"   => "A",
    "CACHE_TIME"   => "36000",
    "CACHE_NOTES"  => $arParams["PARENT_SECTION"],
    "CLASS"        => "news__dropdown hidden-lg"
),
false);
?>
<?
if (count($arResult['ITEMS']) > 0):
  foreach ($arResult['ITEMS'] as $key=>$item):?>

    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="news__item">
      <?if(isset($item['ACTIVE_FROM'])):?><div class="news__date"><?=$item['ACTIVE_FROM']?></div><?endif;?>
      <div class="news__title"><?=$item['NAME']?></div>
    </a>

  <?endforeach;
else:
?><p>В этом разделе еще нет новостей.</p><?
endif;
?>
</div>
<?if($arParams['SHOW_YEARS']=="Y"):
	$this->SetViewTarget('toolbar');
		$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "years", array(
		    "IBLOCK_TYPE"  => "content",
		    "IBLOCK_ID"    => $arParams["IBLOCK_ID"],
		    "TOP_DEPTH"    => "2",
		    "CACHE_TYPE"   => "A",
		    "CACHE_TIME"   => "36000",
		    "CACHE_NOTES"  => $arParams["PARENT_SECTION"],
        "CLASS"        => "toolbar__dropdown visible-lg"
		),
		false);
	$this->EndViewTarget();
endif;?>

<?=($arParams["DISPLAY_BOTTOM_PAGER"]=="Y" ? $arResult["NAV_STRING"]:"")?>

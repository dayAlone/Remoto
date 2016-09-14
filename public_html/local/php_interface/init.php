<?
function svg($value='')
{
	$path = $_SERVER["DOCUMENT_ROOT"]."/layout/images/svg/".$value.".svg";
	return file_get_contents($path);
}
function page_title() {
	global $APPLICATION;
	if($APPLICATION->GetPageProperty('page_title'))
		return $APPLICATION->GetPageProperty('page_title');
	else
		return $APPLICATION->GetTitle();
}

function sub_title() {
	global $APPLICATION;
	if($APPLICATION->GetPageProperty('sub_title'))
		return "<h3 class='page__sub-title'>".$APPLICATION->GetPageProperty('sub_title')."</h3>";
}
function body_class()
{
	global $APPLICATION;
	if($APPLICATION->GetPageProperty('body_class')) {
		return $APPLICATION->GetPageProperty('body_class');
	}
}
function footer_class()
{
	global $APPLICATION;
	if($APPLICATION->GetPageProperty('footer_class')) {
		return $APPLICATION->GetPageProperty('footer_class');
	}
}

function toolbar_class()
{
	global $APPLICATION;
	if($APPLICATION->GetPageProperty('toolbar_class')) {
		return $APPLICATION->GetPageProperty('toolbar_class');
	} else {
		return 'toolbar--black';
	}
}
function r_date($date = '', $showday = true) {
	$date = strtotime($date);
	if(LANGUAGE_ID == "ru"):


		$treplace = array (
			"Январь"   => "января",
			"Февраль"  => "февраля",
			"Март"     => "марта",
			"Апрель"   => "апреля",
			"Май"      => "мая",
			"Июнь"     => "июня",
			"Июль"     => "июля",
			"Август"   => "августа",
			"Сентябрь" => "сентября",
			"Октябрь"  => "октября",
			"Ноябрь"   => "ноября",
			"Декабрь"  => "декабря",
			"January"   => "января",
			"February"  => "февраля",
			"March"     => "марта",
			"April"   => "апреля",
			"May"      => "мая",
			"June"     => "июня",
			"July"     => "июля",
			"August"   => "августа",
			"September" => "сентября",
			"October"  => "октября",
			"November"   => "ноября",
			"December"  => "декабря",
			"*"        => "",
			"th"       => "",
			"st"       => "",
			"nd"       => "",
			"rd"       => ""
		);
	   	return strtr(date('d F Y', $date), $treplace);
	else:
		return date('d F Y', $date);
		endif;
}

function IBlockElementsMenu($IBLOCK_ID)
{
	$obCache       = new CPHPCache();
	$cacheLifetime = 86400;
	$cacheID       = 'IBlockElementsMenu_'.$IBLOCK_ID;
	$cachePath     = '/'.$cacheID;
	if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
	{
	   $vars = $obCache->GetVars();
	   return $vars['NAV'];
	}
	elseif( $obCache->StartDataCache()  )
	{
		CModule::IncludeModule("iblock");

		$arNav    = array();
		$arSort   = array("NAME" => "DESC");
		$arFilter = array("IBLOCK_ID" => $IBLOCK_ID, 'ACTIVE'=>'Y');
		$rs       = CIBlockElement::GetList($arSort, $arFilter, false, false);
		//$rs->SetUrlTemplates("/catalog/#SECTION_CODE#/#ELEMENT_CODE#.php");
		while ($item = $rs->GetNext()):
			$arNav[] = Array(
				$item['NAME'],
				$item['DETAIL_PAGE_URL'],
				Array(),
				Array(),
				""
			);
		endwhile;
		$obCache->EndDataCache(array('NAV' => $arNav));
		return $arNav;
	}
}

# Background image
if(!strstr($_SERVER['SCRIPT_NAME'], 'bitrix/admin')):
	$obCache       = new CPHPCache();
	$cacheLifetime = 86400;
	$cacheID       = 'BG_IMAGE_'.md5($APPLICATION->GetCurDir());
	$cachePath     = '/';
	if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) ):
	   $vars = $obCache->GetVars();
	   $_GLOBALS['BG_IMAGE'] = $vars['BG_IMAGE'];
	elseif( $obCache->StartDataCache() ):
		CModule::IncludeModule("iblock");

		$arSelect = Array("ID", "PREVIEW_PICTURE", "PROPERTY_PAGE");
		$path     = preg_split('/\//', $APPLICATION->GetCurDir(), false, PREG_SPLIT_NO_EMPTY);
		$urls     = array();
		for ($i=0; $i < count($path); $i++)
			$urls[] = (isset($urls[$i-1])?$urls[$i-1]:"/").$path[$i].'/';

		$arFilter = Array("IBLOCK_ID" => 7, "PROPERTY_PAGE" => $urls);
		$res      = CIBlockElement::GetList(Array("PROPERTY_PAGE"=>"ASC"), $arFilter, false, false, $arSelect);

		global $CACHE_MANAGER;
		$CACHE_MANAGER->StartTagCache($cachePath);

		while($ob = $res->Fetch())
			if(strlen($APPLICATION->GetCurDir())>=strlen($ob["PROPERTY_PAGE_VALUE"]))
				$_GLOBALS['BG_IMAGE'] = CFile::GetPath($ob['PREVIEW_PICTURE']);

		$CACHE_MANAGER->RegisterTag($cacheID);
		$CACHE_MANAGER->EndTagCache();
		$obCache->EndDataCache(array('BG_IMAGE' => $_GLOBALS['BG_IMAGE']));
	endif;

endif;

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "OnBeforeIBlockElementAddHandler");
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "OnBeforeIBlockElementAddHandler");
function OnBeforeIBlockElementAddHandler(&$arFields)
{
	if($arFields['IBLOCK_ID'] == 7):

		global $CACHE_MANAGER;

		$db_props = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], array("sort" => "asc"), Array("CODE"=>"PAGE"));
		while($ar_props = $db_props->Fetch())
			$CACHE_MANAGER->ClearByTag('/BG_'.md5($ar_props['VALUE']));

		foreach ($arFields['PROPERTY_VALUES'] as $values)
			foreach ($values as $value)
				if(strlen($value['VALUE'])>0)
					$CACHE_MANAGER->ClearByTag('/BG_'.md5($value['VALUE']));

	endif;
	return true;
}

AddEventHandler("main", "OnEndBufferContent", "OnEndBufferContentHandler");
function OnEndBufferContentHandler(&$content)
{
	if(!strstr($_SERVER['SCRIPT_NAME'], 'bitrix/admin')):
		$pattern = '/{GALLERY:(\d*|\s\d*)}/i';

		if(preg_match($pattern, $content, $matches, false, false)):
			ob_start();
				global $APPLICATION;
				$APPLICATION->IncludeComponent("bitrix:news.detail","slider", Array(
					"IBLOCK_ID"     => SITE_ID === 's1' ? "8" : '9',
					"ELEMENT_ID"    => $matches[1],
					"CHECK_DATES"   => "N",
					"IBLOCK_TYPE"   => SITE_ID === 's1' ? "content" : 'get',
					"SET_TITLE"     => "N",
					"PROPERTY_CODE" => Array("IMAGES"),
					"CACHE_TYPE"    => "A",
					"CACHE_TIME"    => "3600",
				));
				$gallery = ob_get_contents();
		ob_end_clean();
			$content = str_replace($matches[0], $gallery, $content);
		endif;
	endif;
}
?>

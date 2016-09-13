<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent("bitrix:news.detail","news",Array(
	"IBLOCK_ID"     => 7,
	"ELEMENT_CODE"  => $_REQUEST['code'],
	"CHECK_DATES"   => "N",
	"IBLOCK_TYPE"   => "content",
	"SET_TITLE"     => "N",
	"CACHE_TYPE"    => "A",
	"CACHE_TIME"    => "36000",
	"PROPERTY_CODE" => Array("PHOTOS"),
));
?>

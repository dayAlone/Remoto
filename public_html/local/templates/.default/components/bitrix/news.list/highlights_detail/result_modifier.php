<?
$items = array();
foreach ($arResult['ITEMS'] as $item) array_merge($items, $item['PROPERTIES']['FEATURES']['VALUE']);
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>6, 'ID' => $items);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
$arResult['FEATURES'] = array();
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arResult['FEATURES'][$arFields['ID']] = $arFields;
}?>

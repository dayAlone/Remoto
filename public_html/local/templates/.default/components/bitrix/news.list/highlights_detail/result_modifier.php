<?
$items = array();

foreach ($arResult['ITEMS'] as &$item) {
    array_merge($items, $item['PROPERTIES']['FEATURES']['VALUE']);
    $item['DETAIL_PICTURE']['SMALL'] = CFile::ResizeImageGet($item['DETAIL_PICTURE']['ID'], Array("width" => 800, "height" => 700), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 80);
}
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>6, 'ID' => $items);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
$arResult['FEATURES'] = array();
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arResult['FEATURES'][$arFields['ID']] = $arFields;
}?>

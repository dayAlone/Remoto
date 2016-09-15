<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (check_email($_REQUEST['email'])) {
    CModule::IncludeModule("iblock");
    $el = new CIBlockElement;
    $props = Array(
        "NAME" => $_REQUEST['email'],
        "CODE" => $_REQUEST['email'],
        "IBLOCK_ID" => 19
    );
    $el->Add($props);
}

?>

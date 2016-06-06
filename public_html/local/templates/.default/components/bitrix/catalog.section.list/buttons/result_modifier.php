<?
    function buttons_sort($a, $b)
    {
        return ($a['SORT'] <= $b['SORT']) ? -1 : 1;
    }
    uasort($arResult['SECTIONS'], "buttons_sort");
?>

<?
$arResult["PROPS"] = array();
$props = &$arResult["PROPS"];
function images_sort($a, $b)
{
    if($a['sort']=='' && $b['sort']>0)
        return 1;

    if($b['sort']=='' && $a['sort']>0)
        return -1;

    if($a['sort']=='' && $b['sort']=='')
        return ($a['value'] < $b['value']) ? -1 : 1;

    if ($a['sort'] == $b['sort'])
        return 0;

    return ($a['sort'] < $b['sort']) ? -1 : 1;
}
foreach ($arResult["PROPERTIES"] as $key => $prop):
    switch ($prop['CODE']):
        case "PHOTOS":
            $gallery     = array();
            $description = $prop['DESCRIPTION'];
            if(is_array($prop['VALUE'])):
                foreach ($prop['VALUE'] as $key => $value):
                      $file = CFile::GetByID($value)->Fetch();
                      $small = CFile::ResizeImageGet($value, Array("width" => 312, "height" => 312), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 100);
                      $big = CFile::ResizeImageGet($value, Array("width" => 800, "height" => 700), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 100);
                      $gallery[] = array('sort'=>$description[$key], 'value'=> $big['src'], 'src'=>"/upload/".$file['SUBDIR']."/".$file['FILE_NAME'], 'small'=> $small['src'], 'w'=>$file['WIDTH'], "h" => $file['HEIGHT']);
                endforeach;
                usort($gallery, "images_sort");
                $props[$prop["CODE"]] = $gallery;
            endif;
        break;
        default:
            if(strlen($prop["VALUE"])>0)
                $props[$prop["CODE"]] = $prop["VALUE"];
        break;
    endswitch;
endforeach;
?>

<?foreach ($arResult['ITEMS'] as $key=>&$item):
	
	if(intval($item['PROPERTIES']['FILE']['VALUE'])>0):
		$item['ACTIVE_FROM'] = FormatDate("f Y", strtotime($item['ACTIVE_FROM']));
		$file = CFile::GetFileArray($item['PROPERTIES']['FILE']['VALUE']);
		$item['DETAIL_PAGE_URL'] = $file['SRC'];
		$item['TARGET'] = "target='_blank'";
		$item['PREVIEW_TEXT'] .= "<br> Формат ".strtoupper(end(explode('.', $file['SRC']))).". ".($file['FILE_SIZE']/1000000>1?number_format($file['FILE_SIZE']/1000000,2)." Мб":number_format($file['FILE_SIZE']/1000)." Кб");
	else:
		if(isset($item['ACTIVE_FROM']))
			$item['ACTIVE_FROM'] = r_date($item['ACTIVE_FROM']);
	endif;
endforeach;?>
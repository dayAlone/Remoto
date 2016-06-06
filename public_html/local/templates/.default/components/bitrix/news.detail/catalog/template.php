<?
$item = $arResult;
$s = end($arResult['SECTION']['PATH']);
?>
<div class="text">
	<?if($item["DETAIL_PICTURE"]):?>
		<img src="<?=$item["DETAIL_PICTURE"]['SRC']?>" class="text__image text__image--right text__image--medium">
	<?endif;?>
	<?=$item["~DETAIL_TEXT"]?>
	<div class="params">
        <div class="params__frame">
        <?
        foreach ($item['PROPERTIES']['TABLE']['VALUE'] as $key => $row):?>
            <div class="param <?=($row['prop_title'] == "Y"?"param--title":"")?>">
            <?
            if(isset($row['prop_title'])) unset($row['prop_title']);
            foreach ($row as $k => $el) if(strlen($el) == 0) unset($row[$k]);
            foreach ($row as $k => $el):
            ?>
                <div class="param__col" style="width: <?=100/count($row)?>%"><span><?=html_entity_decode($el)?></span></div>
            <?
            endforeach;?>
            </div>
            <?
        endforeach;
        ?>
        </div>
    </div>
</div>
<?$this->SetViewTarget('page_footer');?><div class="content__footer">
	<? foreach ($item["PROPERTIES"]["FILES"]["VALUE"] as $key => $file) {?>
		<a href='<?=CFile::GetPath($file)?>' class='file'>
			<?=svg('file')?>
			<span class='file__name'>
				<span><?=$item["PROPERTIES"]["FILES"]["DESCRIPTION"][$key]?></span>
			</span>
		</a>
	<?}?>
	<? if(count($item["PROPS"]["GALLERY"]) > 0):?>
		<a href="#" class="button button--gallery button--small" data-pictures='<?=json_encode($item["PROPS"]["GALLERY"])?>'>фотогалерея</a>
	<? endif;?>

</div><?$this->EndViewTarget();?>

////////////////////////
// товары без детальной 
///////////////////////
$IBLOCK_ID = 33;
$col = 0;
$filt = array("IBLOCK_ID"=>$IBLOCK_ID, "DETAIL_PICTURE" => false, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("ID"=>"ASC"), $filt, false, false, array("ID", "NAME"));
$props = CIBlockElement::GetProperty("IBLOCK_ID", $tov["ID"],array("sort"=>"ASC"));

while($tov = $res->fetch())
{
	if($proper = $props->fetch()) 
	{
		echo($proper["VALUE"]."<pre>");
	}
	//$col++;
	echo '<br>Порядковый номер - '. $tov['ID'];
	echo '<pre>';
    print_r($tov);
	echo '</pre>';
}
/////////////////////////////////
// товары без дополнительных фото
/////////////////////////////////
$IBLOCK_ID = 33;
$col = 0;
$filt = array("IBLOCK_ID"=>$IBLOCK_ID, "MORE_PHOTO" => false, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("ID"=>"ASC"), $filt, false, false, array("NAME"));
$props = CIBlockElement::GetProperty("IBLOCK_ID", $tov["ID"],array("sort"=>"ASC"));

while($tov = $res->fetch())
{
	if($proper = $props->fetch()) 
	{
		echo($proper["VALUE"]."<pre>");
	}
	$col++;
	echo '<br>Порядковый номер - '. $col;//$tov['ID'];
	echo '<pre>';
    print_r($tov);
	echo '</pre>';
}
//////////////////////////
// Сортировка товара по ID
//////////////////////////
$prod = CCatalogProduct::Getlist ([
		'filter' => ['ID' => 'ASC']
]);

while($info = $prod->fetch()){
	echo '<pre>';
	print_r($info);
	echo '</pre>';
}
//////////////////////////
// Сортировка товара по ID
//////////////////////////
$prod = CCatalogProduct::Getlist ([
		'filter' => ['ID' => 'ASC']
]);

while($info = $prod->fetch()){
	echo '<pre>';
	print_r($info);
	echo '</pre>';
}
/////////////////
$IBLOCK_ID = 33;

$product = CIBlockElement::GetList(
		array('SORT'=>'ASC')
	);

while($pok = $product->fetch()){
	echo '<pre>';
	print_r($pok);
	echo '</pre>';
}
/////////////////////////
// все товары и свойства
/////////////////////////
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader;
use \Bitrix\Main\Loader::IncludeModule("catalog");
use \Bitrix\Main\Loader::IncludeModule('iblock');

$IBLOCK_ID = 33;

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM",);
$arFilter = Array("IBLOCK_ID"=>33);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>500), $arSelect);

while($ob = $res->GetNextElement()){
	$arFields = $ob->GetFields();
		echo '<pre>';
		print_r($arFields);
		echo '</pre>';
        $arProps = $ob->GetProperties();
		echo '<pre>';
		print_r($arProps);
		echo '</pre>';
}

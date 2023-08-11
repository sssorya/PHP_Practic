////////////////////////
// товары без детальной 
///////////////////////
$IBLOCK_ID = 33;
$col = 0;
$filt = array("IBLOCK_ID"=>$IBLOCK_ID, "DETAIL_PICTURE" => false, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("ID"=>"ASC"), $filt, false, false, array("ID", "NAME", "CODE"));
$props = CIBlockElement::GetProperty("IBLOCK_ID", $tov["ID"],array("sort"=>"ASC"));

while($tov = $res->fetch()) {
	$col++;
	echo 'Общее количество:'. $res->SelectedRowsCount().'<br>';
	echo '<br>Порядковый номер - '. $col;
	echo '<pre>';
    print_r($tov);
	echo '</pre>';

}
exit;
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
	echo '<br>Порядковый номер - '. $col;
	echo '<pre>';
    print_r($tov);
	echo '</pre>';
}
///////////////////////////////////////////
// товары активные привязанные к складу (2) 
///////////////////////////////////////////
$sklad = CIBlockElement::GetList(
			array(),
			array('IBLOCK_ID'=>33, '<=STORE_AMOUNT'=>7, '>=STORE_AMOUNT'=>5, 'STORE_NUMBER'=>2),
			false,
			false,
			array('ID', 'NAME', 'ACTIVE'=>'Y','IBLOCK_ID')
								);
while ($inf = $sklad->fetch()){
	echo '<pre>';
	print_r($inf);
	echo 'Кол-во:'. $sklad->SelectedRowsCount().'<br>';
}
//////////////////////////////////////////
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
/////////////////////
/// получить свойства
/////////////////////
$IBLOCK_ID = 33;
$proper = CIBlockProperty::GetList(
		[
			"sort" => "asc", 
			"name" => "asc"
		], 
		[
			//"ACTIVE" => "Y", 
			"IBLOCK_ID" => $IBLOCK_ID
		]
	);
	while ($propfields = $proper->fetch()) {
		$ListProps[] = $propfields;
	}
	echo '<pre>';
	print_r($ListProps);
	echo '</pre>';
////////////////////////////////////
/// список всех заказов товара по ID
////////////////////////////////////

$res = \Bitrix\Sale\Order::getList([
	'select' => array('ACCOUNT_NUMBER', 'DATE_INSERT', 'DATE_UPDATE', 'DATE_CANCELED', 'PRICE', 'PAYED', 'SEARCH_CONTENT'),
	'filter' => ['BASKET.PRODUCT_ID' => 210133],
	//'filter' => ['BASKET.PRODUCT_ID' => 205766 / 210133],
	'order' => ['ID' => 'ASC']
]); 

while ($order = $res->fetch()){
	echo '<pre>';
	print_r($order);
	echo '<pre>';
}

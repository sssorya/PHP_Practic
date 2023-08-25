/////////////////////
// Created by Sssorya /
/////////////////////




////////////////////////
// товары без детальной 
///////////////////////
$IBLOCK_ID = 33;
$col = 0;
$filt = array("IBLOCK_ID"=>$IBLOCK_ID, "DETAIL_PICTURE" => false, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("ID"=>"ASC"), $filt, false, false, array("ID", "NAME", "CODE", "vin_filter"));
$props = CIBlockElement::GetProperty("IBLOCK_ID", $tov["ID"],array("sort"=>"ASC"));

while($tov = $res->fetch()) {
	$col++;
	echo 'Общее количество:'. $res->SelectedRowsCount().'<br>';
	echo '<br>Порядковый номер - '. $col;
	echo '<pre>';
    print_r($tov);
	echo '</pre>';

}
//1739
//1667
//1673
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
//7280
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
/////////////////////////////////
// проверка на измененные товары
////////////////////////////////
	$filt = array(33, "MODIFIED_BY"=>1338);
	$res = CIBlockElement::GetList(array("ID"=>"ASC"), $filt, false, false, array("ID", "NAME", "modified_by", "TIMESTAMP_X"));

if($col = $res->SelectedRowsCount())
	echo 'Товары измененные учетной записью Климов С.Л.:'.' '. $col.' '.'позиций.';
while($tov = $res->fetch()) {
	$arList = implode('|', $tov);
	echo '<pre>';
	print_r($arList);
	echo '</pre>';
}
//////////////
// section ALL
//////////////
$IBLOCK_ID = 33;
$filt = array("IBLOCK_ID"=>$IBLOCK_ID, "DETAIL_PICTURE" => false, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("ID"=>"ASC"), $filt, false, false, array("ID", "NAME", "CODE", "DETAIL_TEXT"));
$props = CIBlockElement::GetProperty("IBLOCK_ID", array("sort"=>"ASC"));

if($col = $res->SelectedRowsCount())
	echo 'Без фото:'. $col;
while($tov = $res->fetch()) {
	echo '<pre>';
    print_r($tov);
	echo '</pre>';
}
/////////////////////////////////////////////
/// список всех заказов товара по ID товара /
/////////////////////////////////////////////

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
////////////////////////////////////////////////////////
// Сергей Климов - скрипт проверки изменений товаров (?)
////////////////////////////////////////////////////////
<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

?> 
<title><? $APPLICATION->ShowTitle() ?></title>
<?	$id_user = 1338;
	$filt = array(33, "MODIFIED_BY"=>$id_user);
	$res = CIBlockElement::GetList(array("order"=>"asc"), $filt, false, false, array("ID", "NAME", "modified_by", "TIMESTAMP_X", "ACTIVE"));

if($col = $res->SelectedRowsCount())
	echo 'Товары измененные учетной записью'.' '.$id_user.' '.' — '.' '. $col.' '.'позиций.';
while($tov = $res->fetch()) {
	$arList = implode('|', $tov);
	echo '<pre>';
	print_r($arList);
	echo '</pre>';
}
/773
/797
/2050 - 9 шт
////////////////////////////////////////////////////////
// Сергей Климов - скрипт проверки изменений категорий (?)
////////////////////////////////////////////////////////
	$filt = array(33, "MODIFIED_BY"=>1338);
	$res = CIBlockElement::GetList(array("order"=>"asc"), $filt, false, false, array("ID", "NAME", "modified_by", "TIMESTAMP_X", "ACTIVE"));
	$sect = CIBlockSection::GetList(array("SORT"=>"asc"), $filt,false, array("ID", "NAME", "modified_by", "TIMESTAMP_X"), false);
if($col = $sect->SelectedRowsCount())
	echo 'Категории измененные учетной записью Климов С.Л.:'.' '. $col.' '.'позиций:';
while($section = $sect->fetch()) {
	$arList = implode('|', $section);
	echo '<pre>';
	print_r($arList);
	echo '</pre>';
}
/211
/211 - климов
/1 - в црм сервис
/////////////////////
/// Весь заказ по ID;
/////////////////////
$res = CSaleOrder::getList(array(), array("ID" => 6662));

while ($arOrder = $res->fetch()){
	//$ListOrder = implode("|", $order);
	echo '<pre>';
	print_r($arOrder);
	echo '<pre>';
}
/////////////////////////////////
// вариант, как объект
/////////////////////////////////
	$order = \Bitrix\Sale\Order::load($order_id);
	$order->getFields();
	echo '<pre>';
	print_r($order);
	echo '</pre>';
////////////////
// Св-ва заказа
///////////////
	$arListProps = CSaleOrderPropsValue::GetOrderProps($orderId);
	while ($row = $arListProps->fetch()){
		echo '<pre>';
		print_r($row);
		echo '<pre>';
}
///////////////
// method #1 //
///////////////
$order_id = 6441;

$arOrderProps = [];

$dbRes = CSaleOrderPropsValue::getList([
    'select' => ['*'],
    'filter' => ['ORDER_ID' => $order_id]

]);
while($arRes = $dbRes->fetch()) {
	$arOrderProps[$arRes['CODE']] = $arRes['VALUE'];
}
	echo '<pre>';
	print_r($arOrderProps);
	echo '</pre>';
///////////////
// method #2 //
///////////////
$order_id = 6441;

$arOrderProps = [];

$dbRes = \Bitrix\Sale\PropertyValue::getList([
    'select' => ['*'],
    'filter' => ['ORDER_ID' => $order_id]

]);
while($arRes = $dbRes->fetch()) {
	$arOrderProps[$arRes['CODE']] = $arRes['VALUE'];
}
	echo '<pre>';
	print_r($arOrderProps);
	echo '</pre>';
//////////
<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<title>Получение заказа</title>
<?
$order_id = 6509;

$arOrderProps = [];

$basketOrList = [];

$OrderList = \Bitrix\Sale\PropertyValue/*CSaleOrderPropsValue*/::getList([
    'select' => ['*'],
    'filter' => ['ORDER_ID' => $order_id]

]);

$basketProduct = \Bitrix\Sale\Basket::getList([
		'select' => ['*'],
		'filter' => ['ORDER_ID' => $order_id]
]);

while($BasketInfo = $basketProduct->fetch()) 
{
	$arOrderProps[] = $BasketInfo;
}

foreach($arOrderProps as $BasketInfo){
	$arOrderProps[$BasketInfo['CODE']] = $BasketInfo['NAME'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['PRICE'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['DETAIL_PAGE_URL'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['CAN_BUY'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['DISCOUNT_PRICE'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['PRODUCT_XML_ID'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['QUANTITY'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['DIMENSIONS'];
	$basketOrList[$BasketInfo['CODE']] = $BasketInfo['DATE_INSERT'];
}

while($arRes = $OrderList->fetch()) {
	$arOrderProps[$arRes['CODE']] = $arRes['VALUE'];
}
	echo '<pre>';
	print_r($arOrderProps);
	echo '</pre>';
	exit;
?>
////////////////
<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

?>
<title>Получение заказа</title>
<?
$order_id = 6441;

$orderProperties = CSaleOrderPropsValue::GetOrderProps($order_id);

while ($property = $orderProperties->Fetch()) {
	echo '<pre>';
    $propertyName = $property['NAME'];
    $propertyValue = $property['VALUE'];
    
	echo "Основное свойство: {$propertyName} - {$propertyValue}\n";
}
$arOrderProps = CSaleOrderProps::GetList(
    [],
    ['PERSON_TYPE_ID' => $personTypeId]
);
 
while ($orderProp = $arOrderProps->Fetch()) {
echo '<pre>';
    $propertyId = $orderProp['ID'];
    $propertyName = $orderProp['NAME'];
    
    $arValues = CSaleOrderPropsVariant::GetList(
        [],
        ['ORDER_PROPS_ID' => $propertyId]
    );
     
    while ($value = $arValues->Fetch()) {
        echo "Дополнительное свойство: {$propertyName} - {$value['VALUE']}\n";
    }
}

CModule::IncludeModule('sale');

$order = CSaleOrder::GetByID($orderId);

if (!$order) {
    echo "Заказ не найден";
    return;
}

$items = CSaleBasket::GetList(
    [],
    ['ORDER_ID' => $orderId]
);

while ($item = $items->Fetch()) {
	echo '<pre>';
    $productName = $item['NAME'];
    $productPrice = $item['PRICE'];
    
    echo "Товар: {$productName}\n";
    echo "Цена: {$productPrice}\n";
}

?>
//////////
delevery /
//////////
DATE_INSERT
DELIVERY_NAME
STATUS_ID
PRICE_DELIVERY
XML_ID
/////////
/ ORDER /
/////////
PRODUCT_ID
DISCOUNT_PRICE
<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$order_id = 6667;

$orderProps = [];

$snipment = \Bitrix\Sale\ShipmentCollection::getList([
	'select' => ['DATE_INSERT','DELIVERY_NAME', 'STATUS_ID', 'PRICE_DELIVERY', 'XML_ID'],
	'filter' => ['ORDER_ID' => $order_id]

]);

$payment = \Bitrix\Sale\PaymentCollection::getList([
	'select' => ['PAID', 'PAY_SYSTEM_ID', 'PAY_SYSTEM_NAME', 'PS_SUM', 'PS_STATUS_DESCRIPTION', 'PS_RESPONSE_DATE'],
	'filter' => ['ORDER_ID' => $order_id]
]);

$OrderList = CSaleOrderPropsValue::getList([
    'select' => ['*'],
    'filter' => ['ORDER_ID' => $order_id]

]);

$basketProduct = \Bitrix\Sale\Basket::getList([
	'select' => ['*'],
	'filter' => ['ORDER_ID' => $order_id]
]);

while($BasketInfo = $basketProduct->fetch()) 
{
	$orderProps[] = $BasketInfo;
}

foreach($orderProps as $BasketInfo){
	$orderProps['Product']['NAME'] = $BasketInfo['NAME'];
	$orderProps['Product']['PRICE'] = $BasketInfo['PRICE'];
	$orderProps['Product']['DETAIL_PAGE_URL'] = $BasketInfo['DETAIL_PAGE_URL'];
	$orderProps['Product']['CAN_BUY'] = $BasketInfo['CAN_BUY'];
	$orderProps['Product']['DISCOUNT_PRICE'] = $BasketInfo['DISCOUNT_PRICE'];
	$orderProps['Product']['PRODUCT_XML_ID'] = $BasketInfo['PRODUCT_XML_ID'];
	$orderProps['Product']['QUANTITY'] = $BasketInfo['QUANTITY'];
	$orderProps['Product']['DIMENSIONS'] = $BasketInfo['DIMENSIONS'];
	$orderProps['Product']['DATE_INSERT'] = $BasketInfo['DATE_INSERT'];
}

while($arSnip = $snipment->fetch()) {
	$orderProps['Delivery']['DATE_INSERT'] = $arSnip['DATE_INSERT'];
	$orderProps['Delivery']['DELIVERY_NAME'] = $arSnip['DELIVERY_NAME'];
	$orderProps['Delivery']['STATUS_ID'] = $arSnip['STATUS_ID'];
	$orderProps['Delivery']['PRICE_DELIVERY'] = $arSnip['PRICE_DELIVERY'];
	$orderProps['Delivery']['XML_ID'] = $arSnip['XML_ID'];
	}
while($pay = $payment->fetch()){
	$orderProps['Payment']['PAID'] = $pay['PAID'];
	$orderProps['Payment']['PAY_SYSTEM_ID'] = $pay['PAY_SYSTEM_ID'];
	$orderProps['Payment']['PAY_SYSTEM_NAME'] = $pay['PAY_SYSTEM_NAME'];
	$orderProps['Payment']['PS_SUM'] = $pay['PS_SUM'];
	$orderProps['Payment']['PS_STATUS_DESCRIPTION'] = $pay['PS_STATUS_DESCRIPTION'];
	$orderProps['Payment']['PS_RESPONSE_DATE'] = $pay['PS_RESPONSE_DATE'];
}
	echo '<pre>';
	print_r($orderProps);
	echo '</pre>';
?>
///
select * from kisu_data where 'c0499728

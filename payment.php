<?$APPLICATION->IncludeComponent(
    "veselyostrov:main.buyonline.success",
    "",
    Array(
        "IBLOCK_ID" => 12,
        "CACHE_TYPE" => 'N'
    )
);?>

<?

}

$orderId = $_GET['orderId'];
if($orderId && !$_SESSION[$orderId])
{
    $_SESSION[$orderId] = 1;
    CModule::IncludeModule("iblock");
    $arElement = CIBlockElement::GetList(
        array("ID" => "ASC"),
        array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "PROPERTY_PAYMENT_ORDER_ID" => $orderId),
        false,
        false,
        array('NAME',"ID", "IBLOCK_ID", "ACTIVE_FROM", "DATE_CREATE", "PROPERTY_CHILDREN3", "PROPERTY_CHILDREN14", "PROPERTY_CHILDREN18", "PROPERTY_ADULTS",
            "PROPERTY_ADDCHILDREN3", "PROPERTY_ADDCHILDREN14", "PROPERTY_ADDCHILDREN18", "PROPERTY_ADDADULTS",
            "PROPERTY_TOTAL", "PROPERTY_PAID", "PROPERTY_ROOM.NAME", "PROPERTY_EMAIL", "PROPERTY_FIO", "PROPERTY_PHONE"))->Fetch();
    // global $USER; if($USER->IsAdmin())echo '<pre>'.print_r($arElement,1).'</pre>'.__FILE__.' # '.__LINE__;
 if ($arElement) {
// echo '<pre>'.print_r($arElement,1).'</pre>'.__FILE__.' # '.__LINE__;
 $productId = intval($arElement['PROPERTY_CHILDREN3_VALUE']).intval($arElement['PROPERTY_CHILDREN14_VALUE']).intval($arElement['PROPERTY_CHILDREN18_VALUE']);

$script = "
<script>

dataLayer.push({
 'ecommerce': {
   'purchase': {
     'actionField': {
       'id': '".$arElement['ID']."',
       'revenue': '".$arElement['PROPERTY_TOTAL_VALUE']."',
             },
     'products': [{
       'name': '".$arElement['NAME']."',
       'id': '".$productId."',
       'price': '".$arElement['PROPERTY_TOTAL_VALUE']."'
      }]
   }
 },
 'event': 'gtm-ee-event',
 'gtm-ee-event-category': 'Enhanced Ecommerce',
 'gtm-ee-event-action': 'Purchase',
 'gtm-ee-event-non-interaction': 'False',
});

</script>

" ;
//echo $script;
$APPLICATION->SetPageProperty("ecommerc",$script);
    }
}
?>

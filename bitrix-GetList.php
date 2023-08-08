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

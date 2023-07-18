<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Сравнение массивов");
$APPLICATION->SetTitle("Сравнение массивов и вывод новых с изменениями");?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сравнение массивов и вывод новых с изменениями");?><!DOCTYPE html>
<?php
	$fileCsv = fopen("Книга3.csv", "r");
	$csvy = array();
	$value = 0;
				while($csv = fgetcsv($fileCsv, 0, ";")){
					 $csvy[$value]['ID'] = $csv[0];
					 $csvy[$value]['NAME'] = $csv[1];
				$value++;
				}
	fclose($fileCsv);
	
	$CSV_VAL = array_column($csvy, 'NAME');

	$xml = simplexml_load_file("element.xml");
	$json = json_encode($xml);
	$xmly = json_decode($json, true);

	$ArrDiff = array();
	$leghtXml = count($xml); //8335
	for ($i = 0; $i < $leghtXml; $i++) {
		if($isExistcsvy == $isExistxmly){
			$ArrDiff[] = $xmly['product'][$i]['key'];
			$ArrDiff[] = $xmly['product'][$i]['deficit'];
		}
	}



	echo '<pre>';
#		print_r($ArrDiff);
	echo '</pre>';
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

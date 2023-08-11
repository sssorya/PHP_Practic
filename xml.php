<?php
use Ymz\Dictionary\Delivery;
use Ymz\RestApi;
use Bitrix\Sale;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");


$ArrayCategiry = array();
$ArraySubCategiry = array();
$i = 0;
$resSection = CIBlockSection::GetList([], ['IBLOCK_ID' => 33]);

while($row = $resSection->Fetch()) {

    if($row['IBLOCK_SECTION_ID'] == '')
        {
        $ArrayCategiry[$i][id] = $row[ID];
        $ArrayCategiry[$i][name] = $row[NAME];
        $ArrayCategiry[$i][url] = $row[CODE];
    }
	else
	{
	$ArraySubCategiry[$i][id] = $row[ID];
	$ArraySubCategiry[$i][Cat_id] = $row[IBLOCK_SECTION_ID];
	$ArraySubCategiry[$i][name] = $row[NAME];
	$ArraySubCategiry[$i][url] = $row[CODE];
	}

	$i++;

	}	

	$res = \CIBlockElement::GetList([], ['IBLOCK_ID' => 33, 'ID' => '']);
    $productList = [];
    $MyLs = array();
    $k=0;
    while($row = $res->Fetch()) {

        $productList[$row['ID']] = $row;
        if($productList[$row['ID']][ACTIVE] == 'Y'){
        $resPrice = \CPrice::GetList([],
        array(
                "PRODUCT_ID" => $productList[$row['ID']]['ID']
            ));
            
        $rowPrice = $resPrice->Fetch();

		$PriceProperty = CIBlockElement::GetPropertyValues(
			33,
			['ID' => $productList[$row['ID']]['ID']],
			false,
			['ID' => 663]
		);
		$rowPriceProp = $PriceProperty->Fetch();

        if($productList[$row['ID']]['IBLOCK_SECTION_ID'] != ''){
        $resSection = \CIBlockSection::GetList([], ['IBLOCK_ID' => 33, 'ID' => $productList[$row['ID']]['IBLOCK_SECTION_ID']]);
        $rowSection = $resSection->Fetch();
        }

        $img_path = '';
        $resImages = CIBlockElement::GetList([], array("IBLOCK_ID" => 33, 'ID' => $productList[$row['ID']]['ID']));
        $rowImages = $resImages->Fetch();
        if($rowImages["DETAIL_PICTURE"] != '')
        {
            $img_path = CFile::GetPath($rowImages["DETAIL_PICTURE"]);
        }
        else
        {
            $TempArrayZaglyhka = explode('.', $productList[$row['ID']]['NAME']);

            if(stristr($TempArrayZaglyhka[0],'534'))
            {
                if(stristr($TempArrayZaglyhka[1],'1000140'))
                {
                    $img_path = '534_zagl_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000146'))
                {
                    $img_path = '534_zagl_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000147'))
                {
                    $img_path = '534_zagl_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000175'))
                {
                    $img_path = '534_zagl_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000186'))
                {
                    $img_path = '534_zagl_001.jpg';
                }

            }

            if(stristr($TempArrayZaglyhka[0],'536'))
            {
                if(stristr($TempArrayZaglyhka[1],'1000010'))
                {
                    $img_path = '536_zagl_kpp_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000016'))
                {
                    $img_path = '536_zagl_kpp_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000140'))
                {
                    $img_path = '536_zagl_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000146'))
                {
                    $img_path = '536_zagl_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000175'))
                {
                    $img_path = '536_zagl_001.jpg';
                }

                if(stristr($TempArrayZaglyhka[1],'1000186'))
                {
                    $img_path = '536_zagl_001.jpg';
                }

            }
			
           if($img_path != '')
            {
                $img_path = '/upload/content/'.$img_path;
            }
            else
            {
                $img_path = '/upload/sotbit.origami/no_photo_big.svg';
            }
            

        }
		
        $productList[$row['ID']]['DETAIL_PAGE_URL'] = str_replace('#SITE_DIR#', 'https://ymzmarket.ru', $productList[$row['ID']]['DETAIL_PAGE_URL']);
        $productList[$row['ID']]['DETAIL_PAGE_URL'] = str_replace('#CODE#', $productList[$row['ID']]['CODE'], $productList[$row['ID']]['DETAIL_PAGE_URL']);

        if($rowSection['CODE'] == '' or $rowSection['CODE'] == 'test')
        {
            $rowSection['CODE'] = 'raznoe';
        }

        $productList[$row['ID']]['DETAIL_PAGE_URL'] = str_replace('#SECTION_CODE#', $rowSection['CODE'], $productList[$row['ID']]['DETAIL_PAGE_URL']);

        $MyLs[$k]['ID'] = $productList[$row['ID']]['ID'];
        $MyLs[$k]['SubCategory'] = $rowSection['CODE'];
        $MyLs[$k]['title'] = $productList[$row['ID']]['NAME'];
        $MyLs[$k]['URL'] = $productList[$row['ID']]['DETAIL_PAGE_URL'];
        $MyLs[$k]['URLTovar'] = $productList[$row['ID']]['CODE'];
$MyLs[$k]['IBLOCK_SECTION_ID'] = $productList[$row['ID']]['IBLOCK_SECTION_ID'];


if($rowPriceProp[663] != '0')
{
    $MyLs[$k]['PROld'] = '';
    $rowPrice['PRICE'] = $rowPrice['PRICE'];
}
else
{
    //$MyLs[$k]['PROld'] = $rowPrice['PRICE'];
    $PriceOLD = $rowPrice['PRICE'];

	if(($rowPrice['PRICE']>= 10000)&($rowPrice['PRICE']<= 50000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*4);}
	if(($rowPrice['PRICE']>= 50001)&($rowPrice['PRICE']<= 70000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*5);}
	if(($rowPrice['PRICE']>= 70001)&($rowPrice['PRICE']<= 100000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*7);}
	if(($rowPrice['PRICE']>= 100001)&($rowPrice['PRICE']<= 150000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*8);}
	if(($rowPrice['PRICE']>= 150001)&($rowPrice['PRICE']<= 300000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*9);}
	if(($rowPrice['PRICE']>= 300001)&($rowPrice['PRICE']<= 600000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*10);}
	if(($rowPrice['PRICE']>= 600001)&($rowPrice['PRICE']<= 900000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*11);}
	if(($rowPrice['PRICE']>= 900001)&($rowPrice['PRICE']<= 1200000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*12);}
	if(($rowPrice['PRICE']>= 1200001)&($rowPrice['PRICE']<= 1500000)){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*14);}
	if($rowPrice['PRICE']>= 1500001){$rowPrice['PRICE'] = $rowPrice['PRICE'] - (($rowPrice['PRICE']/100)*16);}
    if($PriceOLD != $rowPrice['PRICE']){
        $MyLs[$k]['PROld'] = $PriceOLD;
    }
}
        $MyLs[$k]['PR'] = $rowPrice['PRICE'];
        $MyLs[$k]['Images'] = 'https://ymzmarket.ru'.$img_path;
        $k++;
    }
    }
    $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
    $out .= '<yml_catalog date="' . date('Y-m-d H:i') . '">' . "\r\n";
    $out .= '<shop>' . "\r\n";
    $out .= '<name>YmzMarket</name>' . "\r\n";
    $out .= '<company>ООО «ЯМЗ Маркет»</company>' . "\r\n";
    $out .= '<url>https://ymzmarket.ru/</url>' . "\r\n";
    $out .= '<currencies>' . "\r\n";
    $out .= '<currency id="RUR" rate="1"/>' . "\r\n";
    $out .= '</currencies>' . "\r\n";
	$out .= '<categories>' . "\r\n";

	$ArrayCategiry = array_values($ArrayCategiry);
	$ArraySubCategiry = array_values($ArraySubCategiry);

	for ($i = 0; $i < count($ArrayCategiry); $i++) 
		{

	$out .= '<category id="'.$ArrayCategiry[$i][id].'">'.$ArrayCategiry[$i][name].'</category>' . "\r\n";
		}
	for ($i = 0; $i < count($ArraySubCategiry); $i++) 
		{
	$out .= '<category id="'.$ArraySubCategiry[$i][id].'" parentId="'.$ArraySubCategiry[$i][Cat_id].'">'.$ArraySubCategiry[$i][name].'</category>' . "\r\n";
		}
	$out .= '</categories>' . "\r\n";
	$out .= '<offers>' . "\r\n";
    
    for ($i = 0; $i < count($MyLs); $i++) 
    {
        if($MyLs[$i][PR] != ''){
        $URLTranslite = '';
        $TransliteTovar = '';
        
        $ImagesFull = '';
        
        if($MyLs[$i][SubCategory] != ''){$URLTranslite = $MyLs[$i][SubCategory];} else{$URLTranslite = 'raznoe';}
        if($MyLs[$i][URLTovar] != ''){$TransliteTovar = $MyLs[$i][URLTovar].'.html';}  
        if($MyLs[$i][Images] != 'https://ymzmarket.ru'){$ImagesFull = $MyLs[$i][Images];} else{$ImagesFull = '';}       
        
        $out .= '<offer id="'.$MyLs[$i][ID].'">'. "\r\n";
        $out .= '<name>'.$MyLs[$i][title].'</name>'. "\r\n";
        $out .= '<url>https://ymzmarket.ru/catalog/'.$URLTranslite.'/'.$TransliteTovar.'</url>'. "\r\n";
        $out .= '<price>'.$MyLs[$i][PR].'</price>'. "\r\n";

        if($MyLs[$i][PROld] != '')
        {
            $out .= '<oldprice>'.$MyLs[$i][PROld].'</oldprice>'. "\r\n";
        }

				$out .= '<currencyId>RUR</currencyId>'. "\r\n";
		if($MyLs[$i][IBLOCK_SECTION_ID] != '')
		{
			if($MyLs[$i][IBLOCK_SECTION_ID] == '2107')
			{
				$out .= '<categoryId>2110</categoryId>'. "\r\n";
			}
			else
			{
				$out .= '<categoryId>'.$MyLs[$i][IBLOCK_SECTION_ID].'</categoryId>'. "\r\n";
			}
		}
		else
		{
			$out .= '<categoryId>2110</categoryId>'. "\r\n";
		}

        $out .= '<picture>'.$ImagesFull.'</picture>'. "\r\n";
    
        $out .= '</offer>' . "\r\n";
        
        }
    }

	$out .= '</offers>' . "\r\n";
	$out .= '</shop>' . "\r\n";
	$out .= '</yml_catalog>' . "\r\n";
	 
	header('Content-Type: text/xml; charset=utf-8');
	echo $out;

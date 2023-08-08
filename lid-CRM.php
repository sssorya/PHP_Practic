/////////////
// лиды с CRM
/////////////

$res = CRest::call(
	'crm.lead.list',
[
	'filter' => [
		'>DATE_CREATE' => '2022-01-01T00:00:00',
		'>DATE_CREATE' => '2023-08-08T00:00:00'
	],
	'select' => ['ID', 'DATE_CREATE']
]);
while($info = $res->fetch()){
	echo '<pre>';
	print_r($info);
	echo '</pre>';
}

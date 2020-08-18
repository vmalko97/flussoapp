<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/resources/libs/phpoffice/vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/num_to_string.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/date_to_string.php';

$async = json_decode(filter_input(INPUT_POST, 'async')); // Async JSON input

$async_function = $async->{'function'}; //Async execute function
if($async_function == "download_invoice"){
    $async_request = $async->{'async_request'};
    $obj_invoice = new Invoices();
    $json = $obj_invoice->getAsyncDataJsonById($async_request->{'id'});
    $async_dat = json_decode($json);
    $async_data = $async_dat->{'async_data'};
}else {
    $async_data = $async->{'async_data'}; //Async data
    $async_data_json = json_encode($async_data);
}

$obj_provider = new Providers();
$obj_customer = new Customers();
$obj_payer = new Customers();
$obj_invoice = new Invoices();
$obj_config = new Configuration();

$provider = $obj_provider->getById($async_data->{'provider'});
$customer = $obj_customer->getById($async_data->{'customer'});
$payer = $obj_payer->getById($async_data->{'payer'});
$dataTable = $async_data->{'dataTable'};
$config = $obj_config->getConfig();


/** GENERATOR **/

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->setDefaultFontName('Arial');
$phpWord->setDefaultFontSize(10);

$properties = $phpWord->getDocInfo();

$properties->setCreator($config->app_name);
$properties->setCompany($async_data->{'provider'});
//$properties->setTitle('My title');
//$properties->setDescription('My description');
//$properties->setCategory('My category');
//$properties->setLastModifiedBy('My name');
$properties->setCreated(mktime(0, 0, 0, 3, 12, 2020));
$properties->setModified(mktime(0, 0, 0, 3, 14, 2020));
//$properties->setSubject('My subject');
//$properties->setKeywords('my, key, word');

$sectionStyle = array(
    'orientation' => 'portrait',
    'marginLeft' => 600,
    'marginRight' => 600,
    'colsNum' => 1,
    'pageNumberStart' => 1,
    'size' => 10,
    'gutter' => 1,
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
);

//$tableStyle = array();

$headerStyle = array(
    'bgColor' => 'CDCDCD',
    'valign' => 'center',
    'borderColor' => '000000',
    'borderSize' => 6
);
$cellStyle = array(
    'borderColor' => '000000',
    'borderSize' => 6,
);
$headerTextStyle = array('name' => 'Arial', 'size' => 10, 'bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
$cellTextStyleLeft = array('name' => 'Arial', 'size' => 10, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT);
$cellTextStyleCenter = array('name' => 'Arial', 'size' => 10, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
$cellTextStyleRight = array('name' => 'Arial', 'size' => 10, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);
//$phpWord->addTableStyle('invoice', $tableStyle);

$section = $phpWord->addSection($sectionStyle);

$table = $section->addTable(['cellMarginRight' => 500]);
$table->addRow();
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.92));
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText("Постачальник", ['bold' => true, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText($provider[0]['name']);
$cell->addTextRun($cellTextStyleLeft)->addText($provider[0]['legal_address']);
$cell->addTextRun($cellTextStyleLeft)->addText("П/р " . $provider[0]['current_account'] . " в " . $provider[0]['bank_name'] . " МФО " . $provider[0]['bank_code']);
$cell->addTextRun($cellTextStyleLeft)->addText("ІПН " . $provider[0]['tax_number'] . " № свідоцтва " . $provider[0]['certificate_number'] . " ЄДРПОУ " . $provider[0]['code']);
$cell->addTextRun($cellTextStyleLeft)->addText($provider[0]['website'] . " e-mail: " . $provider[0]['email']);
$cell->addTextBreak();

$table->addRow();
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.92));
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText("Одержувач", ['bold' => true, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText($customer[0]['name']);
$cell->addTextRun($cellTextStyleLeft)->addText($customer[0]['legal_address']);
$cell->addTextRun($cellTextStyleLeft)->addText("П/р " . $customer[0]['current_account'] . " в " . $customer[0]['bank_name'] . " МФО " . $customer[0]['bank_code']);
$cell->addTextRun($cellTextStyleLeft)->addText("ІПН " . $customer[0]['tax_number'] . " № свідоцтва " . $customer[0]['certificate_number'] . " ЄДРПОУ " . $customer[0]['code']);
$cell->addTextRun($cellTextStyleLeft)->addText($customer[0]['website'] . " e-mail: " . $customer[0]['email']);
$cell->addTextBreak();
$table->addRow();
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.92));
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText("Платник", ['bold' => true, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$cell = $table->addCell();
if ($async_data->{'same'} == 0) {
    $cell->addTextRun($cellTextStyleLeft)->addText($payer[0]['name']);
    $cell->addTextRun($cellTextStyleLeft)->addText($payer[0]['legal_address']);
    $cell->addTextRun($cellTextStyleLeft)->addText("П/р " . $payer[0]['current_account'] . " в " . $payer[0]['bank_name'] . " МФО " . $payer[0]['bank_code']);
    $cell->addTextRun($cellTextStyleLeft)->addText("ІПН " . $payer[0]['tax_number'] . " № свідоцтва " . $payer[0]['certificate_number'] . " ЄДРПОУ " . $payer[0]['code']);
    $cell->addTextRun($cellTextStyleLeft)->addText($payer[0]['website'] . " e-mail: " . $payer[0]['email']);
    $cell->addTextBreak();
} else {
    $cell->addTextRun($cellTextStyleLeft)->addText("той самий");
    $cell->addTextBreak();
}

$section->addTextRun($cellTextStyleCenter)->addText('Рахунок-фактура № ' . $async_data->{'invoice'}, ['size' => 12, 'bold' => true]);
$section->addTextRun($cellTextStyleCenter)->addText('від ' . dateToString($async_data->{'date'}) . ' р.', ['size' => 12, 'bold' => true]);


$table = $section->addTable('invoice');

$table->addRow();
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.92), $headerStyle);
$cell->addTextRun($cellTextStyleCenter)->addText("№", $headerTextStyle);
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(8.1), $headerStyle);
$cell->addTextRun($cellTextStyleCenter)->addText("Повна назва товару", $headerTextStyle);
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.57), $headerStyle);
$cell->addTextRun($cellTextStyleCenter)->addText("Од.вим.", $headerTextStyle);
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2.02), $headerStyle);
$cell->addTextRun($cellTextStyleCenter)->addText("К-ть", $headerTextStyle);
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(3.08), $headerStyle);
$cell->addTextRun($cellTextStyleCenter)->addText("Ціна без ПДВ", $headerTextStyle);
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(3.08), $headerStyle);
$cell->addTextRun($cellTextStyleCenter)->addText("Сума без ПДВ", $headerTextStyle);

for ($i = 0; $i < count($dataTable); $i++) {
    $table->addRow();
    $cell = $table->addCell(null, $cellStyle);
    $cell->addTextRun($cellTextStyleCenter)->addText($i + 1);
    $cell = $table->addCell(null, $cellStyle);
    $cell->addTextRun($cellTextStyleLeft)->addText($dataTable{$i}->{'name'});
    $cell = $table->addCell(null, $cellStyle);
    $cell->addTextRun($cellTextStyleCenter)->addText($dataTable{$i}->{'units'});
    $cell = $table->addCell(null, $cellStyle);
    $cell->addTextRun($cellTextStyleRight)->addText(number_format($dataTable{$i}->{'quantity'}, 2, ',', ' '));
    $cell = $table->addCell(null, $cellStyle);
    $cell->addTextRun($cellTextStyleRight)->addText(number_format($dataTable{$i}->{'price'}, 2, ',', ' '));
    $cell = $table->addCell(null, $cellStyle);
    $cell->addTextRun($cellTextStyleRight)->addText(number_format($dataTable{$i}->{'sum'}, 2, ',', ' '));
}
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleRight)->addText("Разом без ПДВ:&#0160;", ['bold' => true]);
$cell = $table->addCell(NULL, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText(number_format($async_data->{'total_without_vat'}, 2, ',', ' '));

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleRight)->addText("ПДВ:&#0160;", ['bold' => true]);
$cell = $table->addCell(NULL, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText(number_format($async_data->{'total_vat'}, 2, ',', ' '));

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleRight)->addText("Всього з ПДВ:&#0160;", ['bold' => true]);
$cell = $table->addCell(NULL, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText(number_format($async_data->{'total_with_vat'}, 2, ',', ' '));


$table->addRow();
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleLeft)->addText("Всього на суму:", ['bold' => true]);
$cell->addTextRun($cellTextStyleLeft)->addText(num2str($async_data->{'total_with_vat'}), ['bold' => true]);
$cell->addTextBreak();


$table->addRow();
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleLeft)->addText("ПДВ: " . number_format($async_data->{'total_vat'}, 2, ',', ' ') . " грн.", ['bold' => true]);
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleRight)->addText("Виписав(ла):", ['bold' => true]);
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleLeft)->addText($async_data->{'written_by'}, ['underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$section->addTextBreak();
$section->addTextRun($cellTextStyleLeft)->addText("Для перевірки справжності документу  перейдіть за посиланням:");
$section->addTextRun($cellTextStyleLeft)->addLink("https://workflow.vladyslav.pro/verify.php?control=" . hash('md5', $async_data_json), "https://workflow.vladyslav.pro/verify.php?control=" . hash('md5', $async_data_json));
$section->addTextRun($cellTextStyleLeft)->addText("або перевірте справжність документу завантаживши його за посиланням:");
$section->addTextRun($cellTextStyleLeft)->addLink("https://workflow.vladyslav.pro/verify_file.php", "https://workflow.vladyslav.pro/verify_file.php");

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="document.docx"');
header('Cache-Control: max-age=0');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save($_SERVER['DOCUMENT_ROOT'].'/temp/'.'Рахунок '.$async_data->{'invoice'}.' TEMP.docx');

/**FINALIZE**/
if ($async_data->{'finalize'} == 0) {
    $finalize = [
        'invoice_number' => $async_data->{'invoice'},
        'company_id' => $async_data->{'provider'},
        'receiver_customer_id' => $async_data->{'customer'},
        'payer_customer_id' => $async_data->{'payer'},
        'same' => $async_data->{'same'},
        'date' => $async_data->{'date'},
        'total_without_vat' => $async_data->{'total_without_vat'},
        'total' => $async_data->{'total_with_vat'},
        'vat' => $async_data->{'total_vat'},
        'written_by' => $async_data->{'written_by'},
        'finalize' => 0
    ];
} elseif ($async_data->{'finalize'} == 1) {
    $finalize = [
        'invoice_number' => $async_data->{'invoice'},
        'company_id' => $async_data->{'provider'},
        'receiver_customer_id' => $async_data->{'customer'},
        'payer_customer_id' => $async_data->{'payer'},
        'same' => $async_data->{'same'},
        'date' => $async_data->{'date'},
        'total_without_vat' => $async_data->{'total_without_vat'},
        'total' => $async_data->{'total_with_vat'},
        'vat' => $async_data->{'total_vat'},
        'written_by' => $async_data->{'written_by'},
        'finalize' => 1,
        'security_hash' => hash('md5', $async_data_json),
        'file_hash' => hash_file('md5', $_SERVER['DOCUMENT_ROOT'].'/temp/'.'Рахунок '.$async_data->{'invoice'}.' TEMP.docx')
    ];
}
$dataArr = array();

for ($j = 0; $j < count($dataTable); $j++) {
    array_push($dataArr, [
        'product_name' => $dataTable{$j}->{'name'},
        'units' => $dataTable{$j}->{'units'},
        'quantity' => $dataTable{$j}->{'quantity'},
        'price_without_vat' => $dataTable{$j}->{'price'},
        'vat' => ($dataTable{$j}->{'price'} / 100) * ($async_data->{'vat'}),
        'sum' => $dataTable{$j}->{'sum'},
        'position' => $j + 1,
    ]);
}
if ($async_data->{'finalize'} == 0) {
    $obj_invoice->create($finalize['invoice_number'], $finalize['company_id'], $finalize['receiver_customer_id'],
        $finalize['payer_customer_id'], $finalize['same'], $finalize['date'], $finalize['total_without_vat'],
        $finalize['total'], $finalize['vat'], $finalize['written_by'], $finalize['finalize'], $dataArr);
} elseif ($async_data->{'finalize'} == 1) {
    $obj_invoice->createAndFinalize($finalize['invoice_number'], $finalize['company_id'], $finalize['receiver_customer_id'],
        $finalize['payer_customer_id'], $finalize['same'], $finalize['date'], $finalize['total_without_vat'],
        $finalize['total'], $finalize['vat'], $finalize['written_by'], $finalize['finalize'], $finalize['security_hash'], $finalize['file_hash'], $dataArr);
}
/** Download file link**/
//var_dump($dataArr);
$tempFile = 'Рахунок '.$async_data->{'invoice'}.' TEMP.docx';
$response = [
    'response' => "success",
    'download' => '/temp/'.$tempFile,
    'tempFile' => $tempFile,
    'finalized' => false
];
echo json_encode($response);
//unlink($_SERVER['DOCUMENT_ROOT'].'/temp/'.'Рахунок '.$async_data->{'invoice'}.' TEMP.docx');



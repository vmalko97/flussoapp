<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/resources/libs/phpoffice/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/num_to_string.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/date_to_string.php';

$async = json_decode(filter_input(INPUT_POST, 'async')); // Async JSON input

$async_function = $async->{'function'}; //Async execute function
if ($async_function == "download_specification") {
    $async_request = $async->{'async_request'};
    $obj_specification = new Specifications();
    $json = $obj_specification->getAsyncDataJsonById($async_request->{'id'});
    $async_dat = json_decode($json);
    $async_data = $async_dat->{'async_data'};
} elseif ($async_function == "finalize_specification") {
    $async_request = $async->{'async_request'};
    $obj_specification = new Specifications();
    $json = $obj_specification->getFinalizeAsyncDataJsonById($async_request->{'id'});
    $async_dat = json_decode($json);
    $async_data = $async_dat->{'async_data'};
} else {
    $async_data = $async->{'async_data'}; //Async data
    $async_data_json = json_encode($async_data);
}
$obj_contract = new Contracts();
$obj_provider = new Companies();
$obj_customer = new Customers();
$obj_specification = new Specifications();
$obj_config = new Configuration();
$obj_secure = new Secure();

$contract = $obj_contract->getById($async_data->{'contract_id'});
$provider = $obj_provider->getById($contract[0]['provider_id']);
$customer = $obj_customer->getById($contract[0]['customer_id']);
$dataTable = $async_data->{'dataTable'};
$config = $obj_config->getConfig();


/** GENERATOR **/

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->setDefaultFontName('Arial');
$phpWord->setDefaultFontSize(10);

$properties = $phpWord->getDocInfo();

$properties->setCreator("35");
$properties->setCompany('test');
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
//$phpWord->addTableStyle('specification', $tableStyle);

$section = $phpWord->addSection($sectionStyle);

$section->addTextRun($cellTextStyleCenter)->addText('Специфікація № ' . $async_data->{'specification'}, ['size' => 12, 'bold' => true]);
$section->addTextBreak();
$section->addTextRun($cellTextStyleCenter)->addText('до договору № ' . $contract[0]['contract_number'] . '                                                  від ' . dateToString($async_data->{'date'}) . ' р.', ['size' => 12, 'bold' => true]);

$section->addTextBreak();
$section->addTextBreak();

$table = $section->addTable('specification');

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
$cell = $table->addCell(null, ['gridSpan' => 5, 'borderColor' => '000000',
    'borderSize' => 6]);
$cell->addTextRun($cellTextStyleCenter)->addText("Разом без ПДВ:&#0160;");
$cell = $table->addCell(NULL, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText(number_format($async_data->{'total_without_vat'}, 2, ',', ' '));
//
//$table->addRow();
//$cell = $table->addCell(null, ['gridSpan' => 5]);
//$cell->addTextRun($cellTextStyleRight)->addText("ПДВ:&#0160;", ['bold' => true]);
//$cell = $table->addCell(NULL, $cellStyle);
//$cell->addTextRun($cellTextStyleRight)->addText(number_format($async_data->{'total_vat'}, 2, ',', ' '));
//
//$table->addRow();
//$cell = $table->addCell(null, ['gridSpan' => 5]);
//$cell->addTextRun($cellTextStyleRight)->addText("Всього з ПДВ:&#0160;", ['bold' => true]);
//$cell = $table->addCell(NULL, $cellStyle);
//$cell->addTextRun($cellTextStyleRight)->addText(number_format($async_data->{'total_with_vat'}, 2, ',', ' '));

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 6]);
$table->addRow();
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleLeft)->addText("Всього на суму:", ['bold' => true]);
$cell->addTextBreak();
$cell->addTextRun($cellTextStyleLeft)->addText(num2str($async_data->{'total_with_vat'}), ['bold' => true]);

$table->addRow();
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleLeft)->addText("ПДВ: " . number_format($async_data->{'total_vat'}, 2, ',', ' ') . " грн.", ['bold' => true]);
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextBreak();
$cell->addTextBreak();
//$cell->addTextRun($cellTextStyleRight)->addText("Виписав(ла):", ['bold' => true]);
//$cell = $table->addCell(null, ['gridSpan' => 2]);
//$cell->addTextRun($cellTextStyleLeft)->addText($async_data->{'written_by'}, ['underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$table->addRow();
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleLeft)->addText("_______________" . $contract[0]['provider_person'], ['bold' => true]);
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 3]);
$cell->addTextRun($cellTextStyleLeft)->addText("_______________" . $contract[0]['customer_person'], ['bold' => true]);
//$cell->addTextRun($cellTextStyleRight)->addText("Виписав(ла):", ['bold' => true]);
//$cell = $table->addCell(null, ['gridSpan' => 2]);
//$cell->addTextRun($cellTextStyleLeft)->addText($async_data->{'written_by'}, ['underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$section->addTextBreak();
$section->addTextRun($cellTextStyleLeft)->addText("Для перевірки справжності документу  перейдіть за посиланням:");
$section->addTextRun($cellTextStyleLeft)->addLink(VERIFIER_URL . "?page=check&verify=" . hash('md5', $async_data_json), VERIFIER_URL . "?page=check" . htmlspecialchars("&") . "verify=" . hash('md5', $async_data_json));
$section->addTextRun($cellTextStyleLeft)->addText("або перевірте справжність документу завантаживши його за посиланням:");
$section->addTextRun($cellTextStyleLeft)->addLink(VERIFIER_URL . "?page=verify_file", VERIFIER_URL . "?page=verify_file");


//header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
//header('Content-Disposition: attachment;filename="document.docx"');
//header('Cache-Control: max-age=0');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//$objWriter->save($_SERVER['DOCUMENT_ROOT'] . '/temp/' . 'Специфікація ' . $async_data->{'specification'} . ' до договору № ' . $contract[0]['contract_number'] . ' TEMP.docx');

/**FINALIZE**/
if ($async_data->{'finalize'} == 0) {
    $finalize = [
        'specification_number' => $async_data->{'specification'},
        'contract_id' => $async_data->{'contract_id'},
        'date' => $async_data->{'date'},
        'total_without_vat' => $async_data->{'total_without_vat'},
        'total' => $async_data->{'total_with_vat'},
        'vat' => $async_data->{'total_vat'},
        'finalize' => 0
    ];
    $objWriter->save($_SERVER['DOCUMENT_ROOT'] . '/temp/' . 'Специфікація ' . $async_data->{'specification'} . ' до договору № ' . $contract[0]['contract_number'] . ' TEMP.docx');

} elseif ($async_data->{'finalize'} == 1) {
    $objWriter->save($_SERVER['DOCUMENT_ROOT'] . '/app/resources/finalized/specifications/' . 'Специфікація ' . $async_data->{'specification'} . ' до договору № ' . $contract[0]['contract_number'] . ' FINALIZED.docx');

    $finalize = [
        'specification_number' => $async_data->{'specification'},
        'contract_id' => $async_data->{'contract_id'},
        'date' => $async_data->{'date'},
        'total_without_vat' => $async_data->{'total_without_vat'},
        'total' => $async_data->{'total_with_vat'},
        'vat' => $async_data->{'total_vat'},
        'finalize' => 1,
        'security_hash' => hash('md5', $async_data_json),
        'file_hash' => hash_file('md5', $_SERVER['DOCUMENT_ROOT'] . '/app/resources/finalized/specifications/' . 'Специфікація ' . $async_data->{'specification'} . ' до договору № ' . $contract[0]['contract_number'] . ' FINALIZED.docx'),
        'finalized_path' => '/app/resources/finalized/specifications/' . 'Специфікація ' . $async_data->{'specification'} . ' до договору № ' . $contract[0]['contract_number'] . ' FINALIZED.docx'
    ];
}
$dataArr = array();
if ($async_function == "finalize_specification") {
    $obj_specification->finalize($async_data->{'id'}, $finalize['security_hash'], $finalize['file_hash'], $finalize['finalized_path']);
    $obj_secure->add($finalize['security_hash'], $finalize['file_hash'], "specification", $async_data->{'id'});
    echo "success";
} else {
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
    if ($async_function != "download_specification") {
        if ($async_data->{'finalize'} == 0) {
            $obj_specification->create($finalize['specification_number'], $finalize['contract_id'], $finalize['date'], $finalize['total_without_vat'],
                $finalize['total'], $finalize['vat'], $finalize['finalize'], $dataArr);
        } elseif ($async_data->{'finalize'} == 1) {
            $specification = $obj_specification->createAndFinalize($finalize['specification_number'], $finalize['contract_id'], $finalize['date'], $finalize['total_without_vat'],
                $finalize['total'], $finalize['vat'], $finalize['finalize'], $finalize['security_hash'], $finalize['file_hash'], $finalize['finalized_path'], $dataArr);
            $obj_secure->add($finalize['security_hash'], $finalize['file_hash'], "specification", $specification);
        }
    }

    /** Download file link**/

    if ($async_data->{'finalize'} == 1) {

        $tempFile = 'Специфікація ' . $async_data->{'specification'} . ' до договору № ' . $contract[0]['contract_number'] . ' FINALIZED.docx';
        $response = [
            'response' => "success",
            'download' => '/app/resources/finalized/specifications/' . $tempFile,
            'tempFile' => $tempFile,
            'finalized' => true
        ];
        echo json_encode($response);
    } else {
        $tempFile = 'Специфікація ' . $async_data->{'specification'} . ' до договору № ' . $contract[0]['contract_number'] . ' TEMP.docx';
        $response = [
            'response' => "success",
            'download' => '/temp/' . $tempFile,
            'tempFile' => $tempFile,
            'finalized' => false
        ];
        echo json_encode($response);
    }
}




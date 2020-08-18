<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/resources/libs/phpoffice/vendor/autoload.php';

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->setDefaultFontName('Arial');
$phpWord->setDefaultFontSize(10);

$properties = $phpWord->getDocInfo();

$properties->setCreator('WORKFLOW');
$properties->setCompany('Workflow');
$properties->setTitle('My title');
$properties->setDescription('My description');
$properties->setCategory('My category');
$properties->setLastModifiedBy('My name');
$properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
$properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
$properties->setSubject('My subject');
$properties->setKeywords('my, key, word');

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
$cell->addTextRun($cellTextStyleLeft)->addText("ТзОВ \"Моя Фірма\"");
$cell->addTextRun($cellTextStyleLeft)->addText("01001 м.Київ вул. Волгоградська б.23 оф.214 т. 245-54-87");
$cell->addTextRun($cellTextStyleLeft)->addText("П/р 260085784474 в КБ \"ЗАХІДІНКОМБАНК\", філія, м.Київ МФО 320951");
$cell->addTextRun($cellTextStyleLeft)->addText("ІПН 123456789012 № свідоцтва 78945214 ЄДРПОУ 29759781");
$cell->addTextRun($cellTextStyleLeft)->addText("www.myfirma.com.ua e-mail: myemail@myfirma.com.ua");
$cell->addTextBreak();

$table->addRow();
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.92));
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText("Одержувач", ['bold' => true, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText("ТзОВ \"Моя Фірма\"");
$cell->addTextRun($cellTextStyleLeft)->addText("01001 м.Київ вул. Волгоградська б.23 оф.214 т. 245-54-87");
$cell->addTextRun($cellTextStyleLeft)->addText("П/р 260085784474 в КБ \"ЗАХІДІНКОМБАНК\", філія, м.Київ МФО 320951");
$cell->addTextRun($cellTextStyleLeft)->addText("ІПН 123456789012 № свідоцтва 78945214 ЄДРПОУ 29759781");
$cell->addTextRun($cellTextStyleLeft)->addText("www.myfirma.com.ua e-mail: myemail@myfirma.com.ua");
$cell->addTextBreak();
$table->addRow();
$cell = $table->addCell(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(0.92));
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText("Платник", ['bold' => true, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);
$cell = $table->addCell();
$cell->addTextRun($cellTextStyleLeft)->addText("той самий");
$cell->addTextBreak();


$section->addTextRun($cellTextStyleCenter)->addText('Рахунок-фактура № 1', ['size' => 12, 'bold' => true]);
$section->addTextRun($cellTextStyleCenter)->addText('від 31 березня 2020 р.', ['size' => 12, 'bold' => true]);


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

//for ($i = 1; $i < 10; $i++) {
$table->addRow();
$cell = $table->addCell(null, $cellStyle);
$cell->addTextRun($cellTextStyleCenter)->addText(1);
$cell = $table->addCell(null, $cellStyle);
$cell->addTextRun($cellTextStyleLeft)->addText("Товар");
$cell = $table->addCell(null, $cellStyle);
$cell->addTextRun($cellTextStyleCenter)->addText("шт");
$cell = $table->addCell(null, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText("1,00");
$cell = $table->addCell(null, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText("30,00");
$cell = $table->addCell(null, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText("30,00");
//}
$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleRight)->addText("Разом без ПДВ:&#0160;", ['bold' => true]);
$cell = $table->addCell(NULL, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText("0,00");

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleRight)->addText("ПДВ:&#0160;", ['bold' => true]);
$cell = $table->addCell(NULL, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText("0,00");

$table->addRow();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleRight)->addText("Всього з ПДВ:&#0160;", ['bold' => true]);
$cell = $table->addCell(NULL, $cellStyle);
$cell->addTextRun($cellTextStyleRight)->addText("0,00");


$table->addRow();
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 5]);
$cell->addTextRun($cellTextStyleLeft)->addText("Всього на суму:", ['bold' => true]);
$cell->addTextRun($cellTextStyleLeft)->addText("Сто двадцять гривень 00 копійок", ['bold' => true]);
$cell->addTextBreak();


$table->addRow();
$cell = $table->addCell();
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleLeft)->addText("ПДВ: 20,00 грн.", ['bold' => true]);
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleRight)->addText("Виписав(ла):", ['bold' => true]);
$cell = $table->addCell(null, ['gridSpan' => 2]);
$cell->addTextRun($cellTextStyleLeft)->addText(" Іванов І.І.", ['underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE]);


header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="document.docx"');
header('Cache-Control: max-age=0');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');
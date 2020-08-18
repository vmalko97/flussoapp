<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/resources/libs/phpoffice/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/num_to_string.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/date_to_string.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/services/micro/dk_021_2015.php';
$async = json_decode(filter_input(INPUT_POST, 'async')); // Async JSON input

$async_function = $async->{'function'}; //Async execute function
if ($async_function == "download_contract") {
    $async_request = $async->{'async_request'};
    $obj_contract = new Contracts();
    $json = $obj_contract->getAsyncDataJsonById($async_request->{'id'});
    $async_dat = json_decode($json);
    $async_data = $async_dat->{'async_data'};
} elseif ($async_function == "finalize_contract") {
    $async_request = $async->{'async_request'};
    $obj_contract = new Contracts();
    $json = $obj_contract->getFinalizeAsyncDataJsonById($async_request->{'id'});
    $async_dat = json_decode($json);
    $async_data = $async_dat->{'async_data'};
} else {
    $async_data = $async->{'async_data'}; //Async data
    $async_data_json = json_encode($async_data);
}

$obj_provider = new Companies();
$obj_customer = new Customers();
$obj_contract = new Contracts();
$obj_config = new Configuration();
$obj_secure = new Secure();

$provider = $obj_provider->getById($async_data->{'provider'});
$customer = $obj_customer->getById($async_data->{'customer'});
$config = $obj_config->getConfig();

$provider_requisites = $provider[0]['legal_address'] . "<w:br/>" .
    "П/р " . $provider[0]['current_account'] . " в " . $provider[0]['bank_name'] . " МФО " . $provider[0]['bank_code'] . "<w:br/>" .
    "ІПН " . $provider[0]['tax_number'] . " № свідоцтва " . $provider[0]['certificate_number'] . "<w:br/>" .
    " ЄДРПОУ " . $provider[0]['code'] . "<w:br/>" .
    $provider[0]['website'] . "<w:br/>" .
    " e-mail: " . $provider[0]['email'];

$customer_requisites = $customer[0]['legal_address'] . "<w:br/>" .
    "П/р " . $customer[0]['current_account'] . " в " . $customer[0]['bank_name'] . " МФО " . $customer[0]['bank_code'] . "<w:br/>" .
    "ІПН " . $customer[0]['tax_number'] . " № свідоцтва " . $customer[0]['certificate_number'] . "<w:br/>" .
    " ЄДРПОУ " . $customer[0]['code'] . "<w:br/>" .
    $customer[0]['website'] . "<w:br/>" .
    " e-mail: " . $customer[0]['email'];


/** GENERATOR **/

if($async_data->{'finalize'} == 1) {
    /** FILALIZE **/
    $finaldoc = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/app/resources/doc_blanks/dohovir_postavky_tpl.docx');

    $finaldoc->setValue('contract_number', $async_data->{'contract_number'});
    $finaldoc->setValue('city', $async_data->{'city'});
    $finaldoc->setValue('date', dateToString($async_data->{'date'}));
    $finaldoc->setValue('provider', $provider[0]['name']);
    $finaldoc->setValue('provider_position', $async_data->{'provider_position'});
    $finaldoc->setValue('provider_person', $async_data->{'provider_person'});
    $finaldoc->setValue('provider_basis', $async_data->{'provider_basis'});
    $finaldoc->setValue('customer', $customer[0]['name']);
    $finaldoc->setValue('customer_position', $async_data->{'customer_position'});
    $finaldoc->setValue('customer_person', $async_data->{'customer_person'});
    $finaldoc->setValue('customer_basis', $async_data->{'customer_basis'});
    $finaldoc->setValue('classificatory_code', getObjDK_021_2015ValueUA($async_data->{'classificatory_code'}));
    $finaldoc->setValue('contract_sum', number_format($async_data->{'contract_sum'}, 2, ',', ' '));
    $finaldoc->setValue('contract_sum_string', num2str($async_data->{'contract_sum'}));
    $finaldoc->setValue('paying_form', $async_data->{'paying_form'});
    $finaldoc->setValue('condition_of_calculation', $async_data->{'condition_of_calculation'});
    $finaldoc->setValue('terms_of_delivery', $async_data->{'terms_of_delivery'});
    $finaldoc->setValue('provider_tax_status', $async_data->{'provider_tax_status'});
    $finaldoc->setValue('provider_requisites', $provider_requisites);
    $finaldoc->setValue('customer_requisites', $customer_requisites);
    $finaldoc->setValue('expire_date', dateToDMY($async_data->{'expire_date'}));
    $finaldoc->saveAs($_SERVER['DOCUMENT_ROOT'] . '/app/resources/finalized/contracts/Договір ' . $async_data->{'contract_number'} . ' FINALIZED.docx');
}else{
    $document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/app/resources/doc_blanks/dohovir_postavky_tpl.docx');

    $document->setValue('contract_number', $async_data->{'contract_number'});
    $document->setValue('city', $async_data->{'city'});
    $document->setValue('date', dateToString($async_data->{'date'}));
    $document->setValue('provider', $provider[0]['name']);
    $document->setValue('provider_position', $async_data->{'provider_position'});
    $document->setValue('provider_person', $async_data->{'provider_person'});
    $document->setValue('provider_basis', $async_data->{'provider_basis'});
    $document->setValue('customer', $customer[0]['name']);
    $document->setValue('customer_position', $async_data->{'customer_position'});
    $document->setValue('customer_person', $async_data->{'customer_person'});
    $document->setValue('customer_basis', $async_data->{'customer_basis'});
    $document->setValue('classificatory_code', getObjDK_021_2015ValueUA($async_data->{'classificatory_code'}));
    $document->setValue('contract_sum', number_format($async_data->{'contract_sum'}, 2, ',', ' '));
    $document->setValue('contract_sum_string', num2str($async_data->{'contract_sum'}));
    $document->setValue('paying_form', $async_data->{'paying_form'});
    $document->setValue('condition_of_calculation', $async_data->{'condition_of_calculation'});
    $document->setValue('terms_of_delivery', $async_data->{'terms_of_delivery'});
    $document->setValue('provider_tax_status', $async_data->{'provider_tax_status'});
    $document->setValue('provider_requisites', $provider_requisites);
    $document->setValue('customer_requisites', $customer_requisites);
    $document->setValue('expire_date', dateToDMY($async_data->{'expire_date'}));

    $document->saveAs($_SERVER['DOCUMENT_ROOT'] . '/temp/Договір '.$async_data->{'contract_number'}.' TEMP.docx');
}
if($async_function == "create_contract" && $async_data->{'finalize'} == 0) {
    $finalize = [
        'contract_number' => $async_data->{'contract_number'},
        'city' => $async_data->{'city'},
        'date' => $async_data->{'date'},
        'provider_id' => $async_data->{'provider'},
        'provider_position' => $async_data->{'provider_position'},
        'provider_person' => $async_data->{'provider_person'},
        'provider_basis' => $async_data->{'provider_basis'},
        'customer_id' => $async_data->{'customer'},
        'customer_position' => $async_data->{'customer_position'},
        'customer_person' => $async_data->{'customer_person'},
        'customer_basis' => $async_data->{'customer_basis'},
        'classificatory_code' => $async_data->{'classificatory_code'},
        'contract_sum' => $async_data->{'contract_sum'},
        'paying_form' => $async_data->{'paying_form'},
        'condition_of_calculation' => $async_data->{'condition_of_calculation'},
        'terms_of_delivery' => $async_data->{'terms_of_delivery'},
        'provider_tax_status' => $async_data->{'provider_tax_status'},
        'expire_date' => $async_data->{'expire_date'},
        'contract_type' => 0,
        'finalize' => 0
    ];

    $obj_contract->create(
        $finalize['contract_number'],
        $finalize['city'],
        $finalize['date'],
        $finalize['provider_id'],
        $finalize['provider_position'],
        $finalize['provider_person'],
        $finalize['provider_basis'],
        $finalize['customer_id'],
        $finalize['customer_position'],
        $finalize['customer_person'],
        $finalize['customer_basis'],
        $finalize['classificatory_code'],
        $finalize['contract_sum'],
        $finalize['paying_form'],
        $finalize['condition_of_calculation'],
        $finalize['terms_of_delivery'],
        $finalize['provider_tax_status'],
        $finalize['expire_date'],
        $finalize['contract_type'],
        $finalize['finalize']
    );
}elseif($async_function == "create_contract" && $async_data->{'finalize'} == 1) {
    $finalize = [
        'contract_number' => $async_data->{'contract_number'},
        'city' => $async_data->{'city'},
        'date' => $async_data->{'date'},
        'provider_id' => $async_data->{'provider'},
        'provider_position' => $async_data->{'provider_position'},
        'provider_person' => $async_data->{'provider_person'},
        'provider_basis' => $async_data->{'provider_basis'},
        'customer_id' => $async_data->{'customer'},
        'customer_position' => $async_data->{'customer_position'},
        'customer_person' => $async_data->{'customer_person'},
        'customer_basis' => $async_data->{'customer_basis'},
        'classificatory_code' => $async_data->{'classificatory_code'},
        'contract_sum' => $async_data->{'contract_sum'},
        'paying_form' => $async_data->{'paying_form'},
        'condition_of_calculation' => $async_data->{'condition_of_calculation'},
        'terms_of_delivery' => $async_data->{'terms_of_delivery'},
        'provider_tax_status' => $async_data->{'provider_tax_status'},
        'expire_date' => $async_data->{'expire_date'},
        'contract_type' => 0,
        'finalize' => 1,
        'security_hash' => hash('md5', $async_data_json),
        'file_hash' => hash_file('md5', $_SERVER['DOCUMENT_ROOT'].'/app/resources/finalized/contracts/Договір '.$async_data->{'contract_number'}.' FINALIZED.docx'),
        'finalized_path' => '/app/resources/finalized/contracts/Договір '.$async_data->{'contract_number'}.' FINALIZED.docx'
    ];

    $contract = $obj_contract->createAndFinalize(
        $finalize['contract_number'],
        $finalize['city'],
        $finalize['date'],
        $finalize['provider_id'],
        $finalize['provider_position'],
        $finalize['provider_person'],
        $finalize['provider_basis'],
        $finalize['customer_id'],
        $finalize['customer_position'],
        $finalize['customer_person'],
        $finalize['customer_basis'],
        $finalize['classificatory_code'],
        $finalize['contract_sum'],
        $finalize['paying_form'],
        $finalize['condition_of_calculation'],
        $finalize['terms_of_delivery'],
        $finalize['provider_tax_status'],
        $finalize['expire_date'],
        $finalize['contract_type'],
        $finalize['finalize'],
        $finalize['security_hash'],
        $finalize['file_hash'],
        $finalize['finalized_path']
    );
    $obj_secure -> add($finalize['security_hash'],$finalize['file_hash'],"contract", $contract);
}elseif ($async_function == "finalize_contract") {
    $finalize = [
        'contract_number' => $async_data->{'contract_number'},
        'city' => $async_data->{'city'},
        'date' => $async_data->{'date'},
        'provider_id' => $async_data->{'provider'},
        'provider_position' => $async_data->{'provider_position'},
        'provider_person' => $async_data->{'provider_person'},
        'provider_basis' => $async_data->{'provider_basis'},
        'customer_id' => $async_data->{'customer'},
        'customer_position' => $async_data->{'customer_position'},
        'customer_person' => $async_data->{'customer_person'},
        'customer_basis' => $async_data->{'customer_basis'},
        'classificatory_code' => $async_data->{'classificatory_code'},
        'contract_sum' => $async_data->{'contract_sum'},
        'paying_form' => $async_data->{'paying_form'},
        'condition_of_calculation' => $async_data->{'condition_of_calculation'},
        'terms_of_delivery' => $async_data->{'terms_of_delivery'},
        'provider_tax_status' => $async_data->{'provider_tax_status'},
        'expire_date' => $async_data->{'expire_date'},
        'contract_type' => 0,
        'finalize' => 1,
        'security_hash' => hash('md5', $async_data_json),
        'file_hash' => hash_file('md5', $_SERVER['DOCUMENT_ROOT'].'/app/resources/finalized/contracts/Договір '.$async_data->{'contract_number'}.' FINALIZED.docx'),
        'finalized_path' => '/app/resources/finalized/contracts/Договір '.$async_data->{'contract_number'}.' FINALIZED.docx'
    ];
    $obj_contract->finalize($async_data->{'id'}, $finalize['security_hash'], $finalize['file_hash'], $finalize['finalized_path']);
    $obj_secure->add($finalize['security_hash'], $finalize['file_hash'], "contract", $async_data->{'id'});
    echo "success";
}


/** Download file link**/
//var_dump($dataArr);
if($async_data->{'finalize'} == 1) {
    $tempFile = 'Договір '.$async_data->{'contract_number'}.' FINALIZED.docx';
    $response = [
        'response' => "success",
        'download' => '/app/resources/finalized/contracts/' . $tempFile,
        'tempFile' => $tempFile,
        'finalized' => true
    ];
    echo json_encode($response);
}else{
    $tempFile = 'Договір ' . $async_data->{'contract_number'} . ' TEMP.docx';
    $response = [
        'response' => "success",
        'download' => '/temp/' . $tempFile,
        'tempFile' => $tempFile,
        'finalized' => false
    ];
    echo json_encode($response);
}
















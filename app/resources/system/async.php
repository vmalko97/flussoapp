<?php
require_once('init.php');
/* License verify*/

//$server = $_SERVER['HTTP_HOST'];
//$key = $_POST['key'];
//$response = file_get_contents("https://license.helindev.com/wf_activate.php?server=".$server."&key=".$key);
//echo $response;

$async = json_decode(filter_input(INPUT_POST, 'async')); // Async JSON input
$async_function = $async->{'function'}; //Async execute function
$async_data = $async->{'async_data'}; //Async data
switch ($async_function) {

    /** Async delete company */

    case "delete_company":
        $obj_company = new Companies();
        $id = $async_data->{'id'};
        $obj_company->deleteById($id);
        echo "success";
        break;

    /** Async adding company */

    case "add_company":
        $obj_company = new Companies();
        $name = $async_data->{'name'};
        $legal_address = $async_data->{'legal_address'};
        $actual_address = $async_data->{'actual_address'};
        $telephones = $async_data->{'telephones'};
        $code = $async_data->{'code'};
        $tax_number = $async_data->{'tax_number'};
        $certificate_number = $async_data->{'certificate_number'};
        $director = $async_data->{'director'};
        $chief_accountant = $async_data->{'chief_accountant'};
        $current_account = $async_data->{'current_account'};
        $bank_code = $async_data->{'bank_code'};
        $bank_name = $async_data->{'bank_name'};
        $civil_contract_type = $async_data->{'civil_contract_type'};
        $vat = $async_data->{'vat'};
        $email = $async_data->{'email'};
        $website = $async_data->{'website'};
        $additional_field_0 = $async_data->{'additional_field_0'};
        $additional_field_1 = $async_data->{'additional_field_1'};
        $additional_field_2 = $async_data->{'additional_field_2'};
        $additional_field_3 = $async_data->{'additional_field_3'};
        $additional_field_4 = $async_data->{'additional_field_4'};
        $obj_company->add($name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
            $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4);
        echo "success";
        break;

    /** Async updating company */

    case "update_company":
        $obj_company = new Companies();
        $id = $async_data->{'id'};
        $name = $async_data->{'name'};
        $legal_address = $async_data->{'legal_address'};
        $actual_address = $async_data->{'actual_address'};
        $telephones = $async_data->{'telephones'};
        $code = $async_data->{'code'};
        $tax_number = $async_data->{'tax_number'};
        $certificate_number = $async_data->{'certificate_number'};
        $director = $async_data->{'director'};
        $chief_accountant = $async_data->{'chief_accountant'};
        $current_account = $async_data->{'current_account'};
        $bank_code = $async_data->{'bank_code'};
        $bank_name = $async_data->{'bank_name'};
        $civil_contract_type = $async_data->{'civil_contract_type'};
        $vat = $async_data->{'vat'};
        $email = $async_data->{'email'};
        $website = $async_data->{'website'};
        $additional_field_0 = $async_data->{'additional_field_0'};
        $additional_field_1 = $async_data->{'additional_field_1'};
        $additional_field_2 = $async_data->{'additional_field_2'};
        $additional_field_3 = $async_data->{'additional_field_3'};
        $additional_field_4 = $async_data->{'additional_field_4'};
        $obj_company->update($id, $name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
            $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4);
        echo "success";
        break;

    /** Async delete customer */

    case "delete_customer":
        $obj_customer = new Customers();
        $id = $async_data->{'id'};
        $obj_customer->deleteById($id);
        echo "success";
        break;

    /** Async adding customer */

    case "add_customer":
        $obj_customer = new Customers();
        $name = $async_data->{'name'};
        $legal_address = $async_data->{'legal_address'};
        $actual_address = $async_data->{'actual_address'};
        $telephones = $async_data->{'telephones'};
        $code = $async_data->{'code'};
        $tax_number = $async_data->{'tax_number'};
        $certificate_number = $async_data->{'certificate_number'};
        $director = $async_data->{'director'};
        $chief_accountant = $async_data->{'chief_accountant'};
        $current_account = $async_data->{'current_account'};
        $bank_code = $async_data->{'bank_code'};
        $bank_name = $async_data->{'bank_name'};
        $civil_contract_type = $async_data->{'civil_contract_type'};
        $vat = $async_data->{'vat'};
        $email = $async_data->{'email'};
        $website = $async_data->{'website'};
        $additional_field_0 = $async_data->{'additional_field_0'};
        $additional_field_1 = $async_data->{'additional_field_1'};
        $additional_field_2 = $async_data->{'additional_field_2'};
        $additional_field_3 = $async_data->{'additional_field_3'};
        $additional_field_4 = $async_data->{'additional_field_4'};
        $obj_customer->add($name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
            $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4);
        echo "success";
        break;

    /** Async updating customer */

    case "update_customer":
        $obj_customer = new Customers();
        $id = $async_data->{'id'};
        $name = $async_data->{'name'};
        $legal_address = $async_data->{'legal_address'};
        $actual_address = $async_data->{'actual_address'};
        $telephones = $async_data->{'telephones'};
        $code = $async_data->{'code'};
        $tax_number = $async_data->{'tax_number'};
        $certificate_number = $async_data->{'certificate_number'};
        $director = $async_data->{'director'};
        $chief_accountant = $async_data->{'chief_accountant'};
        $current_account = $async_data->{'current_account'};
        $bank_code = $async_data->{'bank_code'};
        $bank_name = $async_data->{'bank_name'};
        $civil_contract_type = $async_data->{'civil_contract_type'};
        $vat = $async_data->{'vat'};
        $email = $async_data->{'email'};
        $website = $async_data->{'website'};
        $additional_field_0 = $async_data->{'additional_field_0'};
        $additional_field_1 = $async_data->{'additional_field_1'};
        $additional_field_2 = $async_data->{'additional_field_2'};
        $additional_field_3 = $async_data->{'additional_field_3'};
        $additional_field_4 = $async_data->{'additional_field_4'};
        $obj_customer->update($id, $name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
            $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4);
        echo "success";
        break;

    /** Async delete provider */

    case "delete_provider":
        $obj_provider = new Providers();
        $id = $async_data->{'id'};
        $obj_provider->deleteById($id);
        echo "success";
        break;

    /** Async adding provider */

    case "add_provider":
        $obj_provider = new Providers();
        $name = $async_data->{'name'};
        $legal_address = $async_data->{'legal_address'};
        $actual_address = $async_data->{'actual_address'};
        $telephones = $async_data->{'telephones'};
        $code = $async_data->{'code'};
        $tax_number = $async_data->{'tax_number'};
        $certificate_number = $async_data->{'certificate_number'};
        $director = $async_data->{'director'};
        $chief_accountant = $async_data->{'chief_accountant'};
        $current_account = $async_data->{'current_account'};
        $bank_code = $async_data->{'bank_code'};
        $bank_name = $async_data->{'bank_name'};
        $civil_contract_type = $async_data->{'civil_contract_type'};
        $vat = $async_data->{'vat'};
        $email = $async_data->{'email'};
        $website = $async_data->{'website'};
        $additional_field_0 = $async_data->{'additional_field_0'};
        $additional_field_1 = $async_data->{'additional_field_1'};
        $additional_field_2 = $async_data->{'additional_field_2'};
        $additional_field_3 = $async_data->{'additional_field_3'};
        $additional_field_4 = $async_data->{'additional_field_4'};
        $obj_provider->add($name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
            $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4);
        echo "success";
        break;

    /** Async updating provider */

    case "update_provider":
        $obj_provider = new Providers();
        $id = $async_data->{'id'};
        $name = $async_data->{'name'};
        $legal_address = $async_data->{'legal_address'};
        $actual_address = $async_data->{'actual_address'};
        $telephones = $async_data->{'telephones'};
        $code = $async_data->{'code'};
        $tax_number = $async_data->{'tax_number'};
        $certificate_number = $async_data->{'certificate_number'};
        $director = $async_data->{'director'};
        $chief_accountant = $async_data->{'chief_accountant'};
        $current_account = $async_data->{'current_account'};
        $bank_code = $async_data->{'bank_code'};
        $bank_name = $async_data->{'bank_name'};
        $civil_contract_type = $async_data->{'civil_contract_type'};
        $vat = $async_data->{'vat'};
        $email = $async_data->{'email'};
        $website = $async_data->{'website'};
        $additional_field_0 = $async_data->{'additional_field_0'};
        $additional_field_1 = $async_data->{'additional_field_1'};
        $additional_field_2 = $async_data->{'additional_field_2'};
        $additional_field_3 = $async_data->{'additional_field_3'};
        $additional_field_4 = $async_data->{'additional_field_4'};
        $obj_provider->update($id, $name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
            $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4);
        echo "success";
        break;

    /** Async add product category */

    case "add_category":
        $obj_category = new Service();
        $name = $async_data->{'name'};
        $obj_category->addProductCategory($name);
        echo "success";
        break;

    /** Async update product category */

    case "update_category":
        $obj_category = new Service();
        $id = $async_data->{'id'};
        $name = $async_data->{'name'};
        $obj_category->updateProductCategory($id, $name);
        echo "success";
        break;

    /** Async delete product category */

    case "delete_category":
        $obj_category = new Service();
        $id = $async_data->{'id'};
        $obj_category->deleteProductCategoryById($id);
        echo "success";
        break;

    /** Async add unit */

    case "add_unit":
        $obj_unit = new Service();
        $name = $async_data->{'name'};
        $obj_unit->addUnit($name);
        echo "success";
        break;

    /** Async update unit */

    case "update_unit":
        $obj_unit = new Service();
        $id = $async_data->{'id'};
        $name = $async_data->{'name'};
        $obj_unit->updateUnit($id, $name);
        echo "success";
        break;

    /** Async delete unit */

    case "delete_unit":
        $obj_unit = new Service();
        $id = $async_data->{'id'};
        $obj_unit->deleteUnitById($id);
        echo "success";
        break;

    /** Async add vat */

    case "add_vat":
        $obj_vat = new Service();
        $name = $async_data->{'name'};
        $percent = $async_data->{'percent'};
        $obj_vat->addVatType($name, $percent);
        echo "success";
        break;

    /** Async update vat */

    case "update_vat":
        $obj_vat = new Service();
        $id = $async_data->{'id'};
        $name = $async_data->{'name'};
        $percent = $async_data->{'percent'};
        $obj_vat->updateVatType($id, $name, $percent);
        echo "success";
        break;

    /** Async delete vat */

    case "delete_vat":
        $obj_vat = new Service();
        $id = $async_data->{'id'};
        $obj_vat->deleteVatTypeById($id);
        echo "success";
        break;

    /** Async add product */

    case "add_product":
        $obj_product = new Products();
        $name = $async_data->{'name'};
        $unit_id = $async_data->{'unit_id'};
        $price = $async_data->{'price'};
        $count = $async_data->{'count'};
        $infinity = $async_data->{'infinity'};
        $vat_type_id = $async_data->{'vat_type_id'};
        $category_id = $async_data->{'category_id'};
        $obj_product->add($name, $unit_id, $price, $count, $infinity, $vat_type_id, $category_id);
        echo "success";
        break;

    /** Async update product */

    case "update_product":
        $obj_product = new Products();
        $id = $async_data->{'id'};
        $name = $async_data->{'name'};
        $unit_id = $async_data->{'unit_id'};
        $price = $async_data->{'price'};
        $count = $async_data->{'count'};
        $infinity = $async_data->{'infinity'};
        $vat_type_id = $async_data->{'vat_type_id'};
        $category_id = $async_data->{'category_id'};
        $obj_product->update($id, $name, $unit_id, $price, $count, $infinity, $vat_type_id, $category_id);
        echo "success";
        break;

    /** Async get complex product */

    case "get_product":
        $obj_product = new Products();
        $product_id = $async_data->{'product_id'};
        $data = $obj_product->getComplexById($product_id);
        $response = json_encode($data);
        echo $response;
        break;


    /** Async delete product */

    case "delete_product":
        $obj_product = new Products();
        $id = $async_data->{'id'};
        $obj_product->deleteById($id);
        echo "success";
        break;

    /** Async delete invoice */

    case "delete_invoice":
        $obj_invoice = new Invoices();
        $id = $async_data->{'id'};
        $obj_invoice->deleteById($id);
        echo "success";
        break;

    /** Async generate invoice */

    case "generate_invoice":
        $obj_invoice = new Invoices();
        $id = $async_data->{'id'};
        $response = $obj_invoice->getAsyncDataJsonById($id);
        echo $response;
        break;

    /** Async finalize invoice */

    case "finalize_invoice":
        $obj_invoice = new Invoices();
        $id = $async_data->{'id'};
        $obj_invoice->finalize($id);
        echo "success";
        break;

    /** Async add user */

    case "add_user":
        $obj_user = new Users();
        $full_name = $async_data->{'full_name'};
        $username = $async_data->{'username'};
        $password = md5($async_data->{'password'});
        $status = $async_data->{'status'};
        $obj_user->add($full_name, $username, $password, $status);
        echo "success";
        break;

    /** Async add user */

    case "edit_user":
        $obj_user = new Users();
        $id = $async_data->{'id'};
        $full_name = $async_data->{'full_name'};
        $username = $async_data->{'username'};
        if (!empty($async_data->{'password'})) {
            $password = md5($async_data->{'password'});
        } else {
            $password = null;
        }
        $status = $async_data->{'status'};
        $obj_user->update($id, $full_name, $username, $password, $status);
        echo "success";
        break;

    /** Async delete user */

    case "delete_user":
        $obj_user = new Users();
        $id = $async_data->{'id'};
        $obj_user->delete($id);
        echo "success";
        break;

    /** Async delete contract */

    case "delete_contract":
        $obj_contract = new Contracts();
        $id = $async_data->{'id'};
        $obj_contract->deleteById($id);
        echo "success";
        break;

    /** Async delete specification */

    case "delete_specification":
        $obj_specification = new Specifications();
        $id = $async_data->{'id'};
        $obj_specification->deleteById($id);
        echo "success";
        break;

    /** Async delete incoming waybill */

    case "delete_incoming_waybill":
        $obj_waybill = new IncomingWaybills();
        $id = $async_data->{'id'};
        $obj_waybill->deleteById($id);
        echo "success";
        break;

    /** Async delete waybill */

    case "delete_waybill":
        $obj_waybill = new Waybills();
        $id = $async_data->{'id'};
        $obj_waybill->deleteById($id);
        echo "success";
        break;

    /** Async update contract */

    case "update_contract":
        $obj_contract = new Contracts();
        $id = $async_data->{'id'};
        $contract_number = $async_data->{'contract_number'};
        $city = $async_data->{'city'};
        $date = $async_data->{'date'};
        $provider_id = $async_data->{'provider_id'};
        $provider_position = $async_data->{'provider_position'};
        $provider_person = $async_data->{'provider_person'};
        $provider_basis = $async_data->{'provider_basis'};
        $customer_id = $async_data->{'customer_id'};
        $customer_position = $async_data->{'customer_position'};
        $customer_person = $async_data->{'customer_person'};
        $customer_basis = $async_data->{'customer_basis'};
        $classificatory_code = $async_data->{'classificatory_code'};
        $contract_sum = $async_data->{'contract_sum'};
        $paying_form = $async_data->{'paying_form'};
        $condition_of_calculation = $async_data->{'condition_of_calculation'};
        $terms_of_delivery = $async_data->{'terms_of_delivery'};
        $provider_tax_status = $async_data->{'provider_tax_status'};
        $expire_date = $async_data->{'expire_date'};
        $contract_type = $async_data->{'contract_type'};
        $finalize = $async_data->{'finalize'};
        $obj_contract->update(
            $id,
            $contract_number,
            $city,
            $date,
            $provider_id,
            $provider_position,
            $provider_person,
            $provider_basis,
            $customer_id,
            $customer_position,
            $customer_person,
            $customer_basis,
            $classificatory_code,
            $contract_sum,
            $paying_form,
            $condition_of_calculation,
            $terms_of_delivery,
            $provider_tax_status,
            $expire_date,
            $contract_type,
            $finalize
        );
        echo "success";
        break;

    /** Async update contract */

    case "update_configuration":
        $obj_service = new Service();
        $app_name = $async_data->{'app_name'};
        $app_description = $async_data->{'app_description'};
        $verifier_url = htmlspecialchars($async_data->{'verifier_url'});
        $license_key = $async_data->{'license_key'};
        $company_id = $async_data->{'company_id'};
        $obj_service->updateConfiguration($app_name, $app_description, $verifier_url, $license_key, $company_id);
        echo "success";
        break;

    /** Async update invoice */

    case "update_invoice":
        $obj_invoice = new Invoices();
        $id = $async_data->{'id'};
        $provider = $async_data->{'provider'};
        $customer = $async_data->{'customer'};
        $payer = $async_data->{'payer'};
        $same = $async_data->{'same'};
        $invoice = $async_data->{'invoice'};
        $date = $async_data->{'date'};
        $dataTable = $async_data->{'dataTable'};
        $total_without_vat = $async_data->{'total_without_vat'};
        //$vat = $async_data->{'vat'};
        $total_vat = $async_data->{'total_vat'};
        $total_with_vat = $async_data->{'total_with_vat'};
        $written_by = $async_data->{'written_by'};
        $finalize = $async_data->{'finalize'};
        $app_name = $async_data->{'app_name'};
        $app_description = $async_data->{'app_description'};
        $verifier_url = htmlspecialchars($async_data->{'verifier_url'});
        $license_key = $async_data->{'license_key'};
        $company_id = $async_data->{'company_id'};

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
        $obj_invoice->deleteDataTableById($id);
        $obj_invoice->update($id, $invoice, $company_id, $customer, $payer, $same, $date,
            $total_without_vat, $total_with_vat, $total_vat, $written_by, $finalize, $dataArr);
        echo "success";
        break;

    /** Async update invoice */

    case "update_waybill":
        $obj_waybill = new Waybills();
        $id = $async_data->{'id'};
        $provider = $async_data->{'provider'};
        $customer = $async_data->{'customer'};
        $payer = $async_data->{'payer'};
        $same = $async_data->{'same'};
        $condition_of_sale = $async_data->{'condition_of_sale'};
        $waybill = $async_data->{'waybill'};
        $date = $async_data->{'date'};
        $dataTable = $async_data->{'dataTable'};
        $total_without_vat = $async_data->{'total_without_vat'};
        //$vat = $async_data->{'vat'};
        $total_vat = $async_data->{'total_vat'};
        $total_with_vat = $async_data->{'total_with_vat'};
        $finalize = $async_data->{'finalize'};
        $app_name = $async_data->{'app_name'};
        $app_description = $async_data->{'app_description'};
        $verifier_url = htmlspecialchars($async_data->{'verifier_url'});
        $license_key = $async_data->{'license_key'};
        $company_id = $async_data->{'company_id'};

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
        $obj_waybill->deleteDataTableById($id);
        $obj_waybill->update($id, $waybill, $provider, $customer, $payer, $same, $condition_of_sale, $date,
            $total_without_vat, $total_with_vat, $total_vat, $finalize, $dataArr);
        echo "success";
        break;

    /** Async update invoice */

    case "update_incoming_waybill":
        $obj_waybill = new IncomingWaybills();
        $id = $async_data->{'id'};
        $provider = $async_data->{'provider'};
        $customer = $async_data->{'customer'};
        $payer = $async_data->{'payer'};
        $same = $async_data->{'same'};
        $condition_of_sale = $async_data->{'condition_of_sale'};
        $waybill = $async_data->{'waybill'};
        $date = $async_data->{'date'};
        $dataTable = $async_data->{'dataTable'};
        $total_without_vat = $async_data->{'total_without_vat'};
        //$vat = $async_data->{'vat'};
        $total_vat = $async_data->{'total_vat'};
        $total_with_vat = $async_data->{'total_with_vat'};
        $finalize = $async_data->{'finalize'};
        $app_name = $async_data->{'app_name'};
        $app_description = $async_data->{'app_description'};
        $verifier_url = htmlspecialchars($async_data->{'verifier_url'});
        $license_key = $async_data->{'license_key'};
        $company_id = $async_data->{'company_id'};

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
        $obj_waybill->deleteDataTableById($id);
        $obj_waybill->update($id, $waybill, $provider, $customer, $payer, $same, $condition_of_sale, $date,
            $total_without_vat, $total_with_vat, $total_vat, $finalize, $dataArr);
        echo "success";
        break;

    /** Async update contract */

    case "update_specification":
        $obj_specification = new Specifications();
        $id = $async_data->{'id'};
        $contract_id = $async_data->{'contract_id'};
        $specification = $async_data->{'specification'};
        $date = $async_data->{'date'};
        $dataTable = $async_data->{'dataTable'};
        $total_without_vat = $async_data->{'total_without_vat'};
        //$vat = $async_data->{'vat'};
        $total_vat = $async_data->{'total_vat'};
        $total_with_vat = $async_data->{'total_with_vat'};
        $finalize = $async_data->{'finalize'};

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
        $obj_specification->deleteDataTableById($id);
        $obj_specification->update($id, $contract_id, $specification, $date, $total_without_vat, $total_vat, $total_with_vat, $finalize, $dataArr);
        echo "success";
        break;

    /** Async delete API key */

    case "delete_key":
        $obj_api = new Service();
        $id = $async_data->{'id'};
        $obj_api->deleteAPIKeyById($id);
        echo "success";
        break;

    /** Async generate API key */

    case "generate_key":
        $obj_api = new Service();
        $obj_api->generateAPIKey();
        echo "success";
        break;

    /** Async activate API key */

    case "activate_key":
        $obj_api = new Service();
        $id = $async_data->{'id'};
        $obj_api->updateStatusAPIKeyById(1,$id);
        echo "success";
        break;

    /** Async deactivate API key */

    case "deactivate_key":
        $obj_api = new Service();
        $id = $async_data->{'id'};
        $obj_api->updateStatusAPIKeyById(0,$id);
        echo "success";
        break;

    default:
        echo $async_function;
        break;
}


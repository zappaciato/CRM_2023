<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AddressController extends Controller
{

    public function index () {
        
        Log::info('I am showing all the addresses.');
        $addresses = CompanyAddress::all();
        $title = "Addresses";
        $breadcrumb = "Addresses list";
        return view('companies.list', compact('title', 'breadcrumb', 'addresses'));
    }

    protected function validator($data)
    {
        Log::info('I am validating the the address data.');
        Log::debug($data);
        
        $validated =  Validator::make($data, [
            'company_id' => 'required',
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'province' => 'required',
            'country' => 'required',
            'notes' => 'required',
        ])->validate();

        Log::info('Address has been validated??');

        return $validated;
    }

    public function create() {
        Log::info('I am creating the view form for a new address');
        return view('pages.addresses.address-add');
    }

    public function store(Request $request) {
        Log::info('I am trying to store the new address');

        $data = $this->validator($request->all());

        Log::info('This is COMPANY data after validation and creation');
        // Log::debug($data);

        $address = CompanyAddress::create($data);

        $company = Company::findOrFail($address->company_id);

        Log::debug($address);

        Alert::alert('Gratulacje!', 'Nowy firma: ' . $company->name . ' ' . $company->nip . ' została dodana do bazy! Adres firmy o nazwie:' . ' ' . $address->name . ' dodano!' , 'success');

        return redirect(route('company.list'));



        
    }
}

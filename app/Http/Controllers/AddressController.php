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

        $addresses = CompanyAddress::all();
        $title = "Addresses";
        $breadcrumb = "Addresses list";
        return view('companies.list', compact('title', 'breadcrumb', 'addresses'));

    }

    protected function validator($data) {

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

        Log::info('Address has been validated!!');

        return $validated;
    }

    public function create() {

        $title = 'Dodaj adres firmy';
        $breadcrumb = 'Dodawanie adresu';
        return view('pages.addresses.address-add', compact('title', 'breadcrumb'));
    }

    public function createWithinCompany() {

        $title = 'Dodaj adres firmy';
        $breadcrumb = 'Dodawanie adresu';
        $companies = Company::all()->pluck('name', 'id')->prepend(trans('Wybierz FIRMĘ'), '');
        return view('pages.addresses.address-add-inCompany', compact('title', 'breadcrumb', 'companies'));
    }

    public function store(Request $request) {

        $data = $this->validator($request->all());

        $address = CompanyAddress::create($data);

        $company = Company::findOrFail($address->company_id);

        Alert::alert('Gratulacje!', 'Nowy firma: ' . $company->name . ' ' . $company->nip . ' została dodana do bazy! Adres firmy o nazwie:' . ' ' . $address->name . ' dodano!' , 'success');

        return redirect(route('company.list'));

    }
}

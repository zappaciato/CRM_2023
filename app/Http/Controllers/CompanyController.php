<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderChanged;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\CodeUnit\FunctionUnit;

class CompanyController extends Controller
{
    public function index() {

        $title = "Companies";
        $breadcrumb = "Companies list";
        $companies = Company::all();

        return view('pages.companies.company-list', compact('title', 'breadcrumb', 'companies'));
    }


    protected function validator($data) {

        $validated =  Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'nip' => 'required',
            'www' => 'required',
            'notes' => 'required',
            'email' => 'required',
        ])->validate();

        Log::info('Record has been validated!!');

        return $validated;
    }

    public function create () {
        Log::info('I am creating the view for adding a neew company');
        $title = "Dodaj firmę";
        $breadcrumb = "Dodaj nową firmę";
        return view('pages.companies.company-add', compact('title', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $this->validator($request->all());

        $company = Company::create($data);
        
        $title = 'Dodaj nowy adress';
        $breadcrumb = 'Nowy Adress';

        return view('pages.addresses.address-add', compact('company', 'title', 'breadcrumb'));
    }



    public function show($id) {

        $title = "Firma";
        $breadcrumb = "Wybrana firma";

        $company = Company::where('id', $id)->firstOrFail();
        $addresses = $company->addresses; //tak mozemy zapisac ze wzgledu na realcje ustawiona w Modelu; Bardzo ważne zeby tak robic TTR
        $contacts = $company->contacts;
        $orders = $company->orders; 
 
        return view('pages.companies.company', compact('title', 'breadcrumb', 'company', 'addresses', 'contacts', 'orders'));
    }



    public function edit($id) {

        $company = Company::findOrFail($id);
        $title = 'Edycja firmy';
        $breadcrumb = 'Eduycja firmy '.$company->name;

        return view('pages.companies.company-edit', compact('title', 'breadcrumb', 'company'));
    }


    public function update(Request $request, $id)
    {

        $company = Company::findOrFail($id);

        $data = $this->validator($request->all());
        $company->update($data);

        Alert::alert('Gratulacje!', 'Dane firmy zostały zaktualizowane!', 'success');
        return redirect(route('single.company', $company->id))->with('message', 'Your have finished editing and the selected company is now updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $company = Company::findOrFail($id);

        $company->delete();

        Alert::alert('Gratulacje!', 'Dane firmy zostały usnięte!', 'success');

        return redirect(route('company.list'));
    }

}

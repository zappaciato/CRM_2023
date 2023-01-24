<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\CodeUnit\FunctionUnit;

class CompanyController extends Controller
{
    public function index() {
        Log::info('I am showing all the records.');
        $title = "Companies";
        $breadcrumb = "Companies list";

        $companies = Company::all();

        return view('pages.companies.company-list', compact('title', 'breadcrumb', 'companies'));
    }


    protected function validator($data)
    {
        Log::info('I am validating the record.');
        Log::debug($data);
        $validated =  Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'nip' => 'required',
            'www' => 'required',
            'notes' => 'required',
            'email' => 'required',
        ])->validate();

        Log::info('Record has been validated??');

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

        Log::info('This is COMPANY data after validation and creation');
        // Log::debug($data);

        $company = Company::create($data);

        
        Log::debug($company);
        $title = 'Dodaj nowy adress';
        $breadcrumb = 'Nowy Adress';
        // return redirect(route('address.add', $company->id));
        // return redirect()->route('address.add')->with('company', $company);
        return view('pages.addresses.address-add', compact('company', 'title', 'breadcrumb'));
    }



    public function show($id)
    {
        Log::info('I am showing the record of a single Company and blow is the ID value');
        // $address = CompanyAddress::where('company_id', $id)->get();

        $title = "Firma";
        $breadcrumb = "Wybrana firma";

        $company = Company::where('id', $id)->firstOrFail();
        $address = $company->addresses; //tak mozemy zapisac ze wzgledu na realcje ustawiona w Modelu;
        $employees = $company->contacts;

        Log::debug($id);
        Log::info('This is the address of a chosen comapny');
        Log::debug($address);
        Log::info('This is the workers of a chosen comapny');
        Log::debug($employees);
        Log::info('This is the comapny');
        Log::debug($company);
        // dd($company);
        return view('pages.companies.company', compact('title', 'breadcrumb', 'company', 'address', 'employees'));
    }



    public function edit($id) {
        Log::info('I am editing the record.');
        $company = Company::findOrFail($id);

        $title = 'Edycja firmy';
        $breadcrumb = 'Eduycja firmy '.$company->name;

        return view('pages.companies.company-edit', compact('title', 'breadcrumb', 'company'));
    }


    public function update(Request $request, $id)
    {
        Log::info('I am beginning to update the record.');
        $company = Company::findOrFail($id);

        // $oldImage = $post->image;

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
    public function destroy($id)
    {
        //mozna zrobic tak: 

        $company = Company::findOrFail($id);

        $company->delete();

        //caly czas mamy dostep do instancji $post; 

        // Storage::delete($company->image);//do wykasowanie palików ze storage;

        //przekierowujemy na strone główną

        Alert::alert('Gratulacje!', 'Dane firmy zostały usnięte!', 'success');

        return redirect(route('company.list'));
    }


    // public function addresses()
    // {
    //     return $this->hasMany('App\FirmsAddress', 'firm_id');
    // }

    // public function persons()
    // {
    //     return $this->hasMany('App\Persons', 'firms_id')->orderBy('created_at', 'desc');
    // }


    // // for the RESTful API test
    // public function showAllCompanies()
    // {
    //     return CompaniesResource::collection(Company::all());
    // }
}

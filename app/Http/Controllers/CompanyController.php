<?php

namespace App\Http\Controllers;

use App\Models\Company;
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



    public function show($id)
    {
        Log::info('I am showing the record.');
        Log::debug($id);
        $title = "Firma";
        $breadcrumb = "Wybrana firma";

        $company = Company::where('id', $id)->firstOrFail();
        Log::debug($company);
        // dd($company);
        return view('pages.companies.company', compact('title', 'breadcrumb', 'company'));
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





    // // for the RESTful API test
    // public function showAllCompanies()
    // {
    //     return CompaniesResource::collection(Company::all());
    // }
}

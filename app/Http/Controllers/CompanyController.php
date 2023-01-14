<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $title = "Companies";
        $breadcrumb = "Companies list";

        $companies = Company::all();

        return view('pages.dashboard.company-list', compact('title', 'breadcrumb', 'companies'));
    }


    // public function create()
    // {
    //     Log::info('show the create company form');
    //     return view('pages.companies.add-company');
    // }

    // protected function validator(array $data)
    // {
    //     Log::info('Trying to validate company data');
    //     Log::debug($data);
    //     $validated = Validator::make($data, [
    //         'created_by' => 'required',
    //         'name' => 'required',
    //         'phone' => 'required',
    //         'country' => 'required',
    //         'nip' => 'required',
    //         'email' => 'required',
    //         'www' => 'required',
    //         'notes' => 'required',
    //     ])->validate();


    //     return $validated;
    // }

    // public function store(Request $request)
    // {

    //     $data = $this->validator($request->all());

    //     Log::info('Comapny data validated!!');

    //     Company::create([
    //         'name' => $data['name'],
    //         'created_by' => $data['created_by'],
    //         'phone' => $data['phone'],
    //         'country' => $data['country'],
    //         'nip' => $data['nip'],
    //         'email' => $data['email'],
    //         'www' => $data['www'],
    //         'notes' => $data['notes'],
    //     ]);

    //     Log::info('created a new company');

    //     ModelsLog::create([
    //         'name' => 'New Company ' . $request->name . ' added.',
    //         'type' =>  'New company added',
    //     ]);

    //     Log::info('Log added a new company!');

    //     session()->flash('message', 'Nowa firma została dodana!');

    //     return redirect(route('createCompany'));
    // }

    // public function show(Company $company)
    // {
    //     // return response()->json([
    //     //     'data' => [
    //     //         'id' => $company->id,
    //     //         'created_by' => $company->created_by,
    //     //         'attributes' => [
    //     //             'name' => $company->name,
    //     //             'phone' => $company->phone,
    //     //             'email' => $company->email,
    //     //             ]

    //     //     ]
    //     // ]);
    //     return new CompaniesResource($company);
    // }

    // // for the RESTful API test
    // public function showAllCompanies()
    // {
    //     return CompaniesResource::collection(Company::all());
    // }
}

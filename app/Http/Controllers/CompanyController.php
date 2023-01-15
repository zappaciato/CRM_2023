<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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

        // $validated = Arr::add($validated, 'published', 0);
        // $validated = Arr::add($validated, 'premium', 0);

        return $validated;
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

        // if (isset($data['image'])) {
        //     $path = $request->file('image')->store('/public/photos');

        //     $data['image'] = $path;
        // }

        // sprawdzamy czy sa jakie tagi dodane? 
        // if (isset($data['tags'])) {
        //     $tags = TagsParsingService::parse($data['tags']);
        //     $post->tags()->sync($tags); //synchronizuje nam tagi z tymi ktore są? 
        // }

        $company->update($data);
Log::info('I am updating the record.');
        //jak juz image uaktualniony to kasujemy stary: ale tez upewnimy sie ze ten image tam jest bo inaczej wyskoczy blad;
        // if (isset($data['image'])) {
        //     // dd($data['image']);
        //     Storage::delete($oldImage);
        // }

        // session()->flash('message', 'Your have finished editing the selected post!'); tego nie potrzeba robi w ten sposob caly czas. patrz nizej;

        //metoda back jest juz defaultowa
        // return back()->with('message', 'Your have finished editing and the selected post is now updated!');
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

        return redirect('/')->with('message', 'The company has been deleted!');
    }





    // // for the RESTful API test
    // public function showAllCompanies()
    // {
    //     return CompaniesResource::collection(Company::all());
    // }
}

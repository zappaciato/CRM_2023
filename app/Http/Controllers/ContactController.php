<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function index() {

        $title = "Contacts";
        $breadcrumb = "New Contacts";
        $contacts = Contact::all();
        return view('pages.contacts.contacts-list', compact('title', 'breadcrumb', 'contacts'));
    }


    protected function validator($data)
    {
        Log::info('I am validating the contact record.');
        Log::debug($data);
        
        $validated =  Validator::make($data, [
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'position' => 'required|min:3',
            'email' => 'required',
            'phone' => 'required',
            'phone_business' => 'required',
            'notes' => 'required',
            'company_id' => 'required',
        ])->validate();


        Log::info('Contact Record has been validated!!');

        // $validated = Arr::add($validated, 'published', 0);
        // $validated = Arr::add($validated, 'premium', 0);

        return $validated;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create() {
        $title = "Dodaj kontakt";
        $breadcrumb = "Dodaj nowy kontakt";

        $companies = Company::select('id', 'name')->get();
        // foreach($companies as $company) {
        //     Log::info($company->id);
        // }
        return view('pages.contacts.contact-add', compact('title', 'breadcrumb', 'companies'));
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

        Log::info('This is contact data after validation');
        Log::debug($data);

        $contact = Contact::create($data);

        Alert::alert('Gratulacje!', 'Nowy kontakt: ' . $contact->name . ' ' . $contact->surname . ' został dodany do bazy!', 'success');

        return redirect(route('contact.list', $contact->id));
    }








    public function show($id)
    {
        Log::info('I am showing the record -> contact.');
        Log::debug($id);
        
        $contact = Contact::where('id', $id)->firstOrFail();
        // $company = Company::select() $contact->company_id;
        $company = Company::where('id', $contact->id)->get('name');

        $title = "Osoba kontaktowa";
        $breadcrumb = "Kontakt:  " . $contact->name . '' . $contact->surname;

        Log::info('This is contact detals in contact controller;');
        Log::debug($contact);

        Log::info('This is company detals in contact controller for this contact only');
        Log::debug($company[0]->name);
        // dd($company);
        return view('pages.contacts.contact', compact('title', 'breadcrumb', 'contact', 'company'));
    }


    public function edit($id)
    {
        Log::info('I am editing the record.-> Contact');
        $contact = Contact::findOrFail($id);
        

        $title = 'Edycja kontaktu';
        $breadcrumb = 'Eduycja kontaktu ' . $contact->name . '' . $contact->surname;

        return view('pages.contacts.contact-edit', compact('title', 'breadcrumb', 'contact'));
    }


    public function update(Request $request, $id)
    {
Log::info('I am in update contact method');
        $contact = Contact::findOrFail($id);



        $data = $this->validator($request->all());


        $contact->update($data);
        Log::info('I am updating the record.');

Alert::alert('Gratulacje!', 'Kontakt: ' . $contact->name . ' ' . $contact->surname . ' został zaktualizowany!', 'success');
        
        return redirect(route('contact.list'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact= Contact::findOrFail($id);

        $contact->delete();

        Alert::alert('Gratulacje!', 'Dane osoby kontaktowej zostały usnięte!', 'success');

        return redirect(route('contact.list'));
    }

}

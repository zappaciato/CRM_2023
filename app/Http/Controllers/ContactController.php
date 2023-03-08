<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Contact;
use App\Models\Order;
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
        $companies = Company::select('id','name')->get();

        return view('pages.contacts.contacts-list', compact('title', 'breadcrumb', 'contacts', 'companies', ));
    }


    protected function validator($data) {

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
        $contact = Contact::create($data);

        Alert::alert('Gratulacje!', 'Nowy kontakt: ' . $contact->name . ' ' . $contact->surname . ' został dodany do bazy!', 'success');

        return redirect(route('contact.list', $contact->id));
    }


    public function show($id) {

        $title = "Osoba kontaktowa";
        $breadcrumb = "Kontakt:  ";

        $singleContact = Contact::where('id', $id)->firstOrFail();
        $company = Company::where('id', $singleContact->company_id)->firstOrFail();
        $companyAddress = CompanyAddress::where('company_id', $company['id'])->firstOrFail();
        $contactOrders = Order::where('contact_person', $singleContact->id)->get();

        return view('pages.contacts.contact', compact('title', 'breadcrumb', 'singleContact', 'company', 'companyAddress', 'contactOrders'));
    }


    public function edit($id) {

        $contact = Contact::findOrFail($id);

        $title = 'Edycja kontaktu';
        $breadcrumb = 'Eduycja kontaktu ' . $contact->name . '' . $contact->surname;

        return view('pages.contacts.contact-edit', compact('title', 'breadcrumb', 'contact'));
    }


    public function update(Request $request, $id) {

        $contact = Contact::findOrFail($id);
        $data = $this->validator($request->all());

        $contact->update($data);

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

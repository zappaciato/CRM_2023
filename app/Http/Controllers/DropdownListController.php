<?php

namespace App\Http\Controllers;

use App\Models\CompanyAddress;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DropdownListController extends Controller
{
    public function fetchContacts(Request $request) {
        Log::info("I am showing you the request from fetch contacts!");
        Log::debug($request);

        if (!$request->company_id) {
            $html = '<option value="">' . 'Brak kontaktu do wybranej firmy!' . '</option>';
        } else {
            $html = '';
            $contacts = Contact::where('company_id', $request->company_id)->get();
            if($contacts->isNotEmpty()) {
                foreach ($contacts as $contact) {
                    $html .= '<option value="' . $contact->id . '">' . $contact->name . ' ' . $contact->surname . '</option>';
                }
            } else {
                $html = '<option value="">' . 'Brak kontaktu do wybranej firmy!' . '</option>';

            }
        }
        
Log::debug($html);
        return response()->json(['html' => $html]);

    }

    public function fetchAdresses(Request $request) {

            $html = '';
            $addresses = CompanyAddress::where('company_id', $request->company_id)->get();
            Log::info('Below I am debugging addresses from the original query and cheking if it isn\'t empty');

            if ($addresses->isNotEmpty()) {
                foreach ($addresses as $address) {
                    $html .= '<option value="' . $address->id . '">' . $address->name . '</option>';
                    
                }
                
            } else {
                $html = '<option value="">' . 'Brak adresu do wybranej firmyyy!' . '</option>';
                Log::debug($addresses);
            }

        return response()->json(['html' => $html]);

    }

    public function fetchUsers() {
        $html = '';
        $users = User::select('id', 'name')->get();
        foreach ($users as $user) {
            $html .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }

        Log::info('These are the users with AJAX');
        Log::debug($users);
        Log::info('This the html for users in AJAX');
        Log::debug($html);
        return response()->json(['html' => $html]);
    }




}
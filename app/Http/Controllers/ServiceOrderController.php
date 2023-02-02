<?php

namespace App\Http\Controllers;

use App\Mail\OrderChanged;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceOrderController extends Controller
{
    public function index() {
        $title = "Zgłoszenia serwisowe";
        $breadcrumb = "Zgłoszenia serwisowe";
        // tutaj ma wyciagnac ordersy ale tylko te z statusem otearte czy przyjęte;
        $orders = Order::all();
        $companies = Company::select('id', 'name')->get();
        $users = User::select('id', 'name')->get(); 
        
        Log::debug($orders);

        Log::debug($companies);
        

        return view('pages.orders.orders-service-list', compact('title', 'breadcrumb', 'orders', 'companies', 'users'));
    }

    protected function validator($data)
    {
        Log::info('I am validating the user record.');
        Log::debug($data);
        $validated =  Validator::make($data, [
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ])->validate();


        Log::info('User Record has been validated!!');

        // $validated = Arr::add($validated, 'published', 0);
        // $validated = Arr::add($validated, 'premium', 0);

        return $validated;
    }

    public function show($id)
    {
        // $singleOrder = Order::where('id', $id)->get();  to nie daje mi kolekcji we wlasciwym formacie
        $singleOrder = Order::findOrFail($id);
        Log::debug($singleOrder);
        $users = User::select('id', 'name')->get();
        $company = Company::where('id', $singleOrder->company_id)->firstOrFail();
        $title = 'Zgłoszenie nr: ' . $singleOrder->id;
        $breadcrumb = 'Zgłoszenie nr: ' . $singleOrder->id;

        return view('pages.orders.order-single-service', compact('title', 'breadcrumb', 'singleOrder', 'users', 'company'));
    }


    public function edit($id)
    {
        $singleOrder = Order::findOrFail($id);


        $title = 'Edycja zgłoszenia';
        $breadcrumb = 'Edycja zgłoszenia ' . $singleOrder->title;

        return view('pages.orders.order-single-service-edit', compact('title', 'breadcrumb', 'singleOrder'));
    }

    public function cancelOrder($id) {
                    Log::info('I am cancelling the order!');
                    $singleOrder = Order::findOrFail($id);
                    $data['status'] = 'anulowane';
                    $singleOrder->update($data);

                    Alert::alert('Gratulacje!', 'Zgłoszenie zostało anulowane!', 'success');

                    // do kogo email?
                    // to lead person involved and the email from the contact for this particular order
                    $usersEmails = User::whereIn('id', [$singleOrder->lead_person, $singleOrder->involved_person])->get();
                    // $contactEmails = Contact::whereIn('id', [$singleOrder->contact_person])->firstOrFail();
                    $contactEmails = Contact::select('email')->where('id', $singleOrder->contact_person)->get();

                    // $usersEmails = User::select('email')->where('id', $singleOrder->lead_person)->get();        // $recipients = ['k@k.pl', 'test@go.pl'];
                    // $recipients = [$usersEmails->email, $contactEmails];

                    $recipients = [];
            foreach($usersEmails as $email){
                Log::debug($email);
                        array_push($recipients, $email);
            }

            foreach ($contactEmails as $email) {
                Log::debug($email);
                    array_push($recipients, $email);

            }
                    

                    // $recipients['email'] =+  $usersEmails->email;
                    // $recipients['email'] =+ $contactEmails->email;
            Log::info('Below the RECIPIENTS ALL');
                    Log::debug($recipients); 
                    // Log::debug($contactEmails->email);
            foreach ($recipients as $recipient) {
                        Log::info('Below the RECIPIENTS ine by ONE');
                        Log::debug($recipient->email); 
                        Mail::to($recipient->email)->send(new OrderChanged());

            }
        

        // Log::debug(new OrderChanged(['status' => $data['status']]));
        return redirect(route('single.service.order', $singleOrder->id))->with('message', 'Your have finished editing and the selected company is now updated!');
    }


    public function update(Request $request, $id)
    {
        Log::info('This is data order being updated');
        $singleOrder = Order::findOrFail($id);

        // $data = $this->validator($request->all());
        $data['status'] = $request->status;
        
        Log::debug($data);

        $singleOrder->update($data);


        Alert::alert('Gratulacje!', 'Dane zgłoszenia zostały zaktualizowane!', 'success');
        return redirect(route('single.service.order', $singleOrder->id))->with('message', 'Your have finished editing and the selected company is now updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singleOrder = Order::findOrFail($id);

        $singleOrder->delete();

        Alert::alert('Gratulacje!', 'Dane zgłoszenia zostały usnięte!', 'success');

        return redirect(route('service.orders'));
    }
    
}

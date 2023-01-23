<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceOrderController extends Controller
{
    public function index() {
        $title = "New Orders";
        $breadcrumb = "Nowe zamówienia";
        // tutaj ma wyciagnac ordersy ale tylko te z statusem otearte czy przyjęte;
        $orders = Order::where('status', 'new')->get();
        

        return view('pages.orders.orders-service', compact('title', 'breadcrumb', 'orders'));
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
        Log::debug($singleOrder->id);
        $title = 'Zgłoszenie nr: ' . $singleOrder->id;
        $breadcrumb = 'Zgłoszenie nr: ' . $singleOrder->id;

        return view('pages.orders.order-single-service', compact('title', 'id', 'breadcrumb', 'singleOrder'));
    }


    public function edit($id)
    {
        $singleOrder = Order::findOrFail($id);


        $title = 'Edycja zgłoszenia';
        $breadcrumb = 'Edycja zgłoszenia ' . $singleOrder->title;

        return view('pages.orders.order-single-service-edit', compact('title', 'breadcrumb', 'singleOrder'));
    }


    public function update(Request $request, $id)
    {
        $singleOrder = Order::findOrFail($id);

        $data = $this->validator($request->all());


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

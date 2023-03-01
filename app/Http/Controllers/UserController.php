<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function index() {
        $title = "New Orders";
        $breadcrumb = "Nowe zamówienia";

        $users = User::all();

        return view('pages.user.user-list', compact('title', 'breadcrumb', 'users'));
    }


    protected function validator($data)
    {
        Log::info('I am validating the user record.');
        Log::debug($data); 
        $validated =  Validator::make($data, [
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'image' => 'nullable|image|max:1024',
            'password' => 'required',
        ])->validate();
        
        return $validated;
    }


    public function show($id)
    {
        Log::info('I am showing the record user.');
        Log::debug($id);
        $user = User::where('id', $id)->firstOrFail();
        $userCurrentOrders = Order::whereNotIn('status', ['anulowane'])->where('lead_person', $user->id)->orWhere('involved_person', $user->id)->get();
        $title = "Użytkownik";
        $breadcrumb = "Użytkownik ".$user->name;

        $avatar = $user->getFirstMedia('avatars');

        if($avatar !== null) {
            $linkToAvatar = $avatar->getUrl();
        } else {
            $linkToAvatar = '#';
        }

        return view('pages.user.user', compact('title', 'breadcrumb', 'user', 'userCurrentOrders', 'linkToAvatar'));
    }




    public function edit($id)
    {
        Log::info('I am editing the record USER.');
        $user = User::findOrFail($id);

        $title = 'Edycja Użytkownika';
        $breadcrumb = 'Eduycja użytkownika: ' . $user->name;

        return view('pages.user.user-edit', compact('title', 'breadcrumb', 'user'));
    }


    public function update(Request $request, $id)
    {
        Log::info('I am beginning to update the User record.');
        $user = User::findOrFail($id);

        $data = $this->validator($request->all());

        if (isset($data['image'])) {
            $user->addMediaFromRequest('image')->toMediaCollection('avatars');
        }

        $user->update($data);

        Log::info('I am updating the record.');

        Alert::alert('Gratulacje!', 'Konto użytkownika zostało zaktualizowane', 'success');

        return redirect(route('single.user', $user->id));
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //mozna zrobic tak: 

    //     $company = Company::findOrFail($id);

    //     $company->delete();


    //     return redirect('/')->with('message', 'The company has been deleted!');
    // }


}

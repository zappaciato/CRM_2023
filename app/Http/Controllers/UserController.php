<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            'name' => 'required',
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
        Log::info('I am showing the record user.');
        Log::debug($id);
        $user = User::where('id', $id)->firstOrFail();
        $title = "Użytkownik";
        $breadcrumb = "Użytkownik ".$user->name;


        Log::debug($user);
        // dd($company);
        return view('pages.user.user', compact('title', 'breadcrumb', 'user'));
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

        // $oldImage = $post->image;

        $data = $this->validator($request->all());

  

        $user->update($data);
        Log::info('I am updating the record.');

        return redirect(route('single.user', $user->id))->with('message', 'Your have finished editing and the selected user is now updated!');
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

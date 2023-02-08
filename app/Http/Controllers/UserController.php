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
        $userCurrentOrders = Order::whereNotIn('status', ['anulowane'])->where('lead_person', $user->id)->orWhere('involved_person', $user->id)->get();
        $title = "Użytkownik";
        $breadcrumb = "Użytkownik ".$user->name;

        $userFiles = UserFile::where('user_id', $id)->get();
Log::info('Grabbbing user files');
        Log::debug($userFiles);
        Log::info('Display beloow all current orders for this particular user which are not cancelled');
        Log::debug($userCurrentOrders);
        // dd($company);
        return view('pages.user.user', compact('title', 'breadcrumb', 'user', 'userFiles', 'userCurrentOrders'));
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


Log::debug(isset($data['image']));//gives true
Log::info('Before uploading an image');


        if (isset($data['image'])) {
Log::info('Checked and the image file is uploaded fine');            
            // $path = $request->file('image')->store('/public/photos');

// zapisuje za kazdym razem trzeba zrobic sprawdzenie czy rekord juz istnieje
            $userFile = new UserFile();
            Log::info('No i have creaded new UserFile instance and now collecting the data for the image: name, path');
            // $userFile->path = $path;
            // dd($request->file());
            $imageFile = $request->file('image');
            $name = time() . '_' . $imageFile->getClientOriginalName();
            Log::debug($name);
            // $path = public_path() . '/uploads/images/'.$user->id;
            $path = $imageFile->storeAs('uploads', $name, 'public');
            Log::info("Image is set so we create the path");
            Log::debug($path);
            $userFile->path = $path;
            $userFile->name = $name;
            $userFile->user_id = $id;
            Log::info("userfile path below: ");
            Log::debug($path);
            $userFile->save();

Log::info('Below debugged image name object');
            // Log::debug($data['image'][0]);
        }


        Log::info('Below debug of data in update method for user with or WITHOUT image or file!');
Log::debug($data);


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

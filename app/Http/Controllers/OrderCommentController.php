<?php

namespace App\Http\Controllers;

use App\Models\OrderComment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class OrderCommentController extends Controller
{
    public function store(Request $request)
    {
        Log::info('This is comment request:');
        Log::debug($request);
        $data = $request->validate([
            'order_id' => 'required|numeric|exists:orders,id',
            'content' => 'required|min:3', //minimum 3 znaki w komentarzu wymagane;
        ]);

        OrderComment::create(Arr::add($data, 'user_id', $request->user()->id));

        Log::info('Below is the comment data after validation and upload to db.');
        Log::debug($data);
        
Alert::alert('Gratulacje!', 'Komentarz został dodany!', 'success');
        return back()->with('messsage', 'Your comment has been added!');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faqs\contact;

class ContactController extends Controller
{
    public function index(Request $req)
    {
        $all_cart=$this->final_data[2];
        $category_featured=$this->final_data[3];
        $wishlist=$this->final_data[4];
        $all_products=$this->final_data[5];
        return view('frontend_user.contact')->with([
            'wishlist'=>$wishlist,
            'all_cart'=>$all_cart,
            'category_featured'=>$category_featured,
            'all_products'=>$all_products
        ]);
    }
    public function storeContact(Request $req)
    {
        $input = $req->except('_token');
        //dd($input);
        $contact = new contact;
        $contact->name = $input['name'];
        $contact->email = $input['email'];
        $contact->subject = $input['subject'];
        $contact->message = $input['message'];
        if($contact->save())
        {
            $contact_save = 'set';
            return redirect()->route('frontend.index')->with([
                'contact_save'=>$contact_save
            ]);
        }
    }
}

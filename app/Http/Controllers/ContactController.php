<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Contact;

class ContactController extends Controller
{
    public function index (){
        $contacts = Contact::all();
        return view('admincontact')->with('contacts',$contacts);
    }


    public function store(Request $request) {
        $contact = new Contact();

        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->save();

        return redirect('/')->with('success' , 'Submitted Successfully
                                            , Thank you for Inquiring !');
    }

    public function edit ($id) {

    }


    public function destroy($id) {

        $contacts =  Contact::destroy($id);
        return redirect('/aadmin')->with('contacts',$contacts)->with('error' ,'', 'Deleted succesfully! ');
    }
}

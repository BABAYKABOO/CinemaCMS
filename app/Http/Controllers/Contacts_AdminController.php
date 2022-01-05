<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class Contacts_AdminController extends Controller
{
    public function showContacts()
    {
        $contacts = Contact::join('images', 'images.image_id', '=', 'contacts.logo')->get();

        return view('admin.contacts', [
            'contact' => $contacts
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Seo;
use Illuminate\Http\Request;

class Contacts_AdminController extends Controller
{
    public function showContacts()
    {
        $contacts = Contact::join('images', 'images.image_id', '=', 'contacts.logo')->get();
        $seo = Seo::where('seo_id', $contacts[0]->seo)->first();
        return view('admin.contacts', [
            'contacts' => $contacts,
            'seo' => $seo
        ]);
    }

    public function save(Request $request)
    {
        Contact::saveContacts($request);
        return redirect(route('admin-contacts-edit'));
    }
}

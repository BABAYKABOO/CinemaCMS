<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Image;
use App\Models\Seo;
use Illuminate\Http\Request;

class Contacts_AdminController extends Controller
{
    public function showContacts()
    {
        $contacts = Contact::join('images', 'images.image_id', '=', 'contacts.logo')->get();
        $mainimg[] = array();
        foreach ($contacts as $contact)
            $mainimg[$contact->contact_id] = Image::where('image_id', $contact->mainimg)->first()->image_url;

        $seo = Seo::where('seo_id', $contacts[0]->seo)->first();
        return view('admin.contacts', [
            'contacts' => $contacts,
            'mainimg' => $mainimg,
             'seo' => $seo
        ]);
    }

    public function save(Request $request)
    {
        Contact::saveContacts($request);
        return redirect(route('admin-contacts-edit'));
    }
}

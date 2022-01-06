<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Image;
use App\Models\Seo;
use Illuminate\Http\Request;

class Contacts_Controller extends Controller
{
    public function showContacts()
    {
        $contacts = Contact::join('images', 'images.image_id', '=', 'contacts.logo')->get();

        $mainimg[] = array();
        foreach ($contacts as $contact)
            $mainimg[$contact->contact_id] = Image::where('image_id', $contact->mainimg)->first()->image_url;

        return view('contacts', [
            'contacts' => $contacts,
            'mainimg' => $mainimg
        ]);
    }
}

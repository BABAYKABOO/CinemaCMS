<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'status',
        'name_cinema',
        'address',
        'coordinates',
        'logo',
        'seo'
    ];

    static function deleteContacts(array $new_contacts, $old_contacts)
    {
        foreach($old_contacts as $old_contact)
        {
            $isDelete = true;
            foreach($new_contacts as $id => $new_contact)
            {
                if ($old_contact->contact_id == $id) {
                    $isDelete = false;
                    break;
                }
            }
            if ($isDelete) {
                Image::deleteImg($old_contact->logo);
                Contact::where('contact_id', $old_contact->contact_id)->delete();
            }
        }
    }

    static function saveContacts(Request $request)
    {
        $old_contacts = Contact::get();
        if (count($request->Contact) < count($old_contacts))
            Contact::deleteContacts($request->Contact, $old_contacts);

        foreach($request->Contact as $id => $contact)
        {
            if($request->hasFile('Contact_' . $id . '_logo')) {
                Contact::where('contact_id', $id)->update([
                    'logo' => Image::saveImg($request,
                        'Contact_' . $id . '_logo',
                        Contact::where('contact_id', $id)->first()->logo)
                ]);
                $request->files->remove('Contact_' . $id . '_logo');
            }
            else if($request->hasFile('Contact_' . $id . '_mainimg')) {
                Contact::where('contact_id', $id)->update([
                    'mainimg' => Image::saveImg($request,
                        'Contact_' . $id . '_mainimg',
                        Contact::where('contact_id', $id)->first()->mainimg)
                ]);
                $request->files->remove('Contact_' . $id . '_mainimg');
            }
            foreach ($contact as $col => $value)
                Contact::where('contact_id', $id)->update([
                    $col => $col == 'status' ? $value == 'on' ? 1 : 0 : $value,
                ]);
        }

        if (isset($request->newContact))
        {
            foreach($request->newContact as $id => $contact)
            {
                Contact::insert([
                    'status' => $contact['status'] == 'on' ? 1 : 0,
                    'name_cinema' => $contact['name_cinema'],
                    'address' => $contact['address'],
                    'coordinates' => $contact['coordinates'],
                    'logo' => Image::saveImg($request,
                        'newContact_' . $id . '_logo'),
                    'seo' => Contact::first()->seo
                ]);
                $request->files->remove('newContact_'.$id.'_img');
            }
        }
    }
}

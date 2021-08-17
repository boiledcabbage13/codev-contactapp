<?php

namespace App\Services\Contact;

use App\Models\Contact;

class UpdateContact {

    /**
     * @param $data
     * @param $contact Contact
     */
    public function execute($contact, array $data) : Contact
    {
        try {
            $contact->name = isset($data['name']) ? $data['name'] : $contact->name;
            $contact->contact_number = isset($data['contact_number']) ? $data['contact_number'] : $contact->contact_number;
            $contact->email = isset($data['email']) ? $data['email'] : $contact->email;
    
            $contact->save();
            $contact->fresh();
    
            return $contact;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

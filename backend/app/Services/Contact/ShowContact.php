<?php

namespace App\Services\Contact;

use App\Models\Contact;

class ShowContact {

    /**
     * @param $data
     */
    public function execute($contact) : Contact
    {
        try {
            return $contact;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

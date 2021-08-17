<?php

namespace App\Services\Contact;

use App\Models\Contact;

class DestroyContact {

    /**
     * @param $data
     */
    public function execute($contact) : bool
    {
        try {
            return $contact->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

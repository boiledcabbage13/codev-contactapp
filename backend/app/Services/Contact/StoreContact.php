<?php

namespace App\Services\Contact;

use App\Models\Contact;
use Exception;

class StoreContact {

    /**
     * @param $data [name, contact_number, email]
     */
    public function execute(array $data)
    {
        try {
            if(!$data['name']) {
                throw new Exception('Name is required.');
            }

            if(!$data['contact_number']) {
                throw new Exception('Contact number is required.');
            }

            if(!$data['email']) {
                throw new Exception('Email is required.');
            }

            return Contact::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

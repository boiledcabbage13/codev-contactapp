<?php

namespace App\Services\Contact;

use App\Models\Contact;

class GetContacts {

    /**
     * @param $data
     */
    public function execute(array $data)
    {
        try {
            $limit = isset($data['limit']) ? $data['limit'] : 15;

            $search = isset($data['search']) ? $data['search'] : null;

            $model = new Contact;

            if ($search) {
                $model = $model->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('contact_number', 'LIKE', "%$search%");
            }

            $model = $model->orderBy('created_at', 'DESC');

            if ($limit === 'All') {
                return $model->get();
            }

            return $model->paginate($limit);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

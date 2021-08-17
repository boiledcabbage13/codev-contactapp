<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\Contact\GetContacts;
use App\Services\Contact\StoreContact;
use App\Services\Contact\UpdateContact;
use App\Services\Contact\ShowContact;
use App\Services\Contact\DestroyContact;
use App\Http\Resources\Contact as ContactResource;
use App\Http\Requests\Contact\StoreContact as StoreContactRequest;
use App\Http\Requests\Contact\UpdateContact as UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GetContacts $action)
    {
        try {
            $contact = $action->execute($request->all());

            return response()->json([
                'data' => ContactResource::collection($contact),
                'message' => 'Successfully get contacts.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request, StoreContact $action)
    {
        try {
            $contact = $action->execute($request->all());

            return response()->json([
                'data' => new ContactResource($contact),
                'message' => 'Successfully store contact.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact, UpdateContact $action)
    {
        try {
            $contact = $action->execute($contact, $request->all());

            return response()->json([
                'data' => new ContactResource($contact),
                'message' => 'Successfully update contact.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact, DestroyContact $action)
    {
        try {
            $contact = $action->execute($contact);

            return response()->json([
                'data' => null,
                'message' => 'Successfully delete contact.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

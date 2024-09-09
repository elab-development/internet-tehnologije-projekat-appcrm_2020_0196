<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactCollection;
use App\Models\Contact;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public static $wrap = 'contact';
    public function index()
    {
        $contacts = Contact::with('company')->get();
        return new ContactCollection($contacts);
    }

    public function show(Contact $contact)
    {
        return new ContactResource($contact->load('company'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'company_id' => 'required|exists:companies,id',
        ]);

        $contact = Contact::create($validated);
        return new ContactResource($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:contacts,email,' . $contact->id,
            'company_id' => 'sometimes|required|exists:companies,id',
        ]);

        $contact->update($validated);
        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(null, 204);
    }
}

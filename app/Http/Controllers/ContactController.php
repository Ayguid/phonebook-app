<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::paginate(10);
        return Inertia::render('Phonebook', [
            'contacts' => $contacts,
            'query' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $contact = Contact::create($validated);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $contacts = Contact::where('name', 'like', "%{$query}%")
            ->orWhere('phone_number', 'like', "%{$query}%")
            ->paginate(10);
        
        return Inertia::render('Phonebook', [
            'contacts' => $contacts,
            'query' => $query
        ]);
    }
}

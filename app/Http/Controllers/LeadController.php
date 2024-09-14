<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeadResource;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $transactions = Lead::all();
        return response()->json($transactions, 200);
    }

    public function show($id)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }
        return response()->json($lead);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'status' => 'required|string|max:255',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'contact_id' => 'required|exists:contacts,id',
        ]);
        $lead = Lead::create($validated);
        return response()->json($lead, 201);
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }

        $validated = $request->validate([
            'status' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'user_id' => 'sometimes|required|exists:users,id',
            'contact_id' => 'sometimes|required|exists:contacts,id',
        ]);

        $lead->update($validated);
        return response()->json($lead);
    }

    public function destroy($id)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }

        $lead->delete();
        return response()->json(['message' => 'Lead deleted']);
    }

    public function getLeadsByUserId($userId)
    {
        $leads = Lead::where('user_id', $userId)->get();
        return response()->json($leads, 200);
    }

    public function getLeadsByContactId($contactId)
    {
        $leads = Lead::where('contact_id', $contactId)->get();
        return response()->json($leads, 200);
    }
}

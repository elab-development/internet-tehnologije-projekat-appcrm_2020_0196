<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeadResource;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $leads = $query->paginate($request->input('per_page', 5));

        return response()->json($leads);
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
}

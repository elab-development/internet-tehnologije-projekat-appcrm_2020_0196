<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\Contact;
use App\Models\Company;

class DashboardController extends Controller
{
    public function getStats()
    {
        $stats = [
            'usersCount' => User::count(),
            'leadsCount' => Lead::count(),
            'contactsCount' => Contact::count(),
            'companiesCount' => Company::count(),
        ];

        return response()->json($stats);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProblemDescription;
use Illuminate\Http\Request;

class ProblemDescriptionController extends Controller
{
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        $results = ProblemDescription::where('description', 'LIKE', "%{$search}%")
            ->select('id', 'description as label', 'description')
            ->orderBy('description')
            ->take(10)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->description,
                    'value' => $item->description
                ];
            });

        return response()->json($results);
    }

    public function store(Request $request)
    {
        $description = ProblemDescription::create([
            'description' => $request->description
        ]);
        
        return response()->json($description);
    }
}
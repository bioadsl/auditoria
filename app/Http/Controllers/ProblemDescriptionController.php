<?php

namespace App\Http\Controllers;

use App\Models\ProblemDescription;
use Illuminate\Http\Request;

class ProblemDescriptionController extends Controller
{
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        
        $descriptions = ProblemDescription::where('description', 'LIKE', "%{$search}%")
            ->select('id', 'description')
            ->orderBy('description')
            ->limit(10)
            ->get()
            ->map(function($desc) {
                return [
                    'id' => $desc->id,
                    'name' => $desc->description,
                    'label' => $desc->description
                ];
            });
        
        return response()->json($descriptions);
    }
}
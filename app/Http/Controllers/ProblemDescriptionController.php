<?php

namespace App\Http\Controllers;

use App\Models\ProblemDescription;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


/**
 * @OA\Tag(
 *     name="Descrições de Problemas",
 *     description="Endpoints para gerenciamento de descrições de problemas"
 * )
 */

class ProblemDescriptionController extends Controller
{
    public function index()
    {
        $problem_descriptions = ProblemDescription::all();
        return view('problem_descriptions.index', compact('problem_descriptions'));
    }

    public function create()
    {
        return view('problem_descriptions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255|unique:problem_descriptions',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean'
        ]);

        ProblemDescription::create($validated);
        return redirect()->route('problem-descriptions.index')
            ->with('success', 'Descrição de problema criada com sucesso!');
    }

    public function edit(ProblemDescription $problemDescription)
    {
        return view('problem_descriptions.edit', compact('problemDescription'));
    }

    public function update(Request $request, ProblemDescription $problemDescription)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255|unique:problem_descriptions,description,'.$problemDescription->id,
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean'
        ]);

        $problemDescription->update($validated);
        return redirect()->route('problem-descriptions.index')
            ->with('success', 'Descrição de problema atualizada com sucesso!');
    }

    public function destroy(ProblemDescription $problemDescription)
    {
        $problemDescription->delete();
        return redirect()->route('problem-descriptions.index')
            ->with('success', 'Descrição de problema excluída com sucesso!');
    }

    public function autocomplete(Request $request): JsonResponse
    {
        $search = $request->get('term');
        
        $descriptions = ProblemDescription::active()
            ->where('description', 'LIKE', "%{$search}%")
            ->select('id', 'description')
            ->orderBy('description')
            ->limit(10)
            ->get()
            ->map(function($desc) {
                return [
                    'id' => $desc->id,
                    'value' => $desc->description,
                    'label' => $desc->description
                ];
            });
        
        return response()->json($descriptions);
    }
}
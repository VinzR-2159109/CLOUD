<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NutritionEntry;

class NutritionController extends Controller
{

    public function index()
    {
        $entries = NutritionEntry::all();
        return response()->json($entries);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'food_name' => 'required',
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbohydrates' => 'required|integer',
            'fat' => 'required|integer',
        ]);

        $entry = NutritionEntry::create($data);
        return response()->json($entry, 201);
    }

    public function show($id)
    {
        $entry = NutritionEntry::findOrFail($id);
        return response()->json($entry);
    }

    public function update(Request $request, $id)
    {
        $entry = NutritionEntry::findOrFail($id);

        $data = $request->validate([
            'food_name' => 'required',
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbohydrates' => 'required|integer',
            'fat' => 'required|integer',
        ]);

        $entry->update($data);
        return response()->json($entry, 200);
    }

    public function destroy($id)
    {
        $entry = NutritionEntry::findOrFail($id);
        $entry->delete();
        return response()->json(null, 204);
    }
    
    public function showSearchForm()
    {
        return view('nutrition.search-form');
    }

    public function showByFoodName(Request $request)
    {
        $request->validate([
            'food_name' => 'required|string',
        ]);

        $foodName = $request->input('food_name');
        $entry = NutritionEntry::where('food_name', $foodName)->first();

        return view('nutrition.search', ['entry' => $entry]);
    }
}

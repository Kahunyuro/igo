<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\drug;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = drug::where('searchable_field', 'like', "%{$query}%")
                             ->get();

        return response()->json($results);
    }
}
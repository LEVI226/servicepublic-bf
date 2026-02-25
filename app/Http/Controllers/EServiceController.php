<?php
 
namespace App\Http\Controllers;
 
use App\Models\EService;
use App\Models\Category;
use Illuminate\Http\Request;
 
class EServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = EService::query()->active()->ordered();
 
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
 
        $eservices = $query->paginate(12);
        $categories = Category::whereHas('eservices')->get();
 
        return view('pages.eservices.index', compact('eservices', 'categories'));
    }
}

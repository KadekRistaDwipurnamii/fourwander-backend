<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller {
    public function index(Request $request){
        $q = $request->query('q');
        $category = $request->query('category');
        $query = Package::where('status','published');

        if($category) $query->where('category', $category);
        if($q) $query->where(function($s) use($q){
            $s->where('name','like',"%$q%")->orWhere('description','like',"%$q%");
        });

        $perPage = $request->query('per_page', 12);
        $data = $query->paginate($perPage);
        return response()->json($data);
    }

    public function show($id){
        $package = Package::where('slug', $id)->orWhere('id',$id)->firstOrFail();
        return response()->json($package);
    }
}

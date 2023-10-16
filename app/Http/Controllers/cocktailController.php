<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cocktail;
use Illuminate\Support\Facades\Validator;

class cocktailController extends Controller
{
    public function index(){
        $cocktail = Cocktail::with('ingredients')->get();

        return response()->json([
            'message' => 'Cocktails displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line" . __LINE__ . "" . basename(__LINE__),
            'results' => $cocktail,
        ]);
    }

    public function getCocktailbyID($id){
        $cocktail = Cocktail::with('ingredients')->find($id);

        if(!$cocktail){
            abort(
                response()->json([
                    'message' => 'Cocktail not Found!',
                    'status' => 'NOT FOUND',
                    'code' => 404
                ], 404)
            );
        }

        return response()->json([
            'message' => 'Cocktail Displayed Successfully!',
            'status' => 'OK',
            'code' => '200',
            'results' => $cocktail 
        ]);
    }


    public function getCocktailByLetter($letter) {
        $cocktails = Cocktail::with('ingredients')->where('name', 'like', $letter . '%')->get();
    
        if(!$cocktails) {
            return response()->json([
                'message' => 'Cocktail not found',
                'code' => 404,
                'status' => 'NOT FOUND',
            ], 404);
        }
    
        return response()->json([
            'message' => 'Cocktails displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'results' => $cocktails,
        ]);
    }

    public function getCocktailByName($name){
        $cocktail = Cocktail::with('ingredients')->where('name', 'LIKE', $name)
        ->orWhere('name', 'LIKE', $name)
        ->first();

            if(!$cocktail){
                abort(
                    response()->json([
                        'message' => 'Cocktail not found',
                        'code' => 404,
                        'status' => 'NOT FOUND',
                        'line' => "line " . __LINE__ . " " . basename(__LINE__),
                    ], 404)
                );
            }

        return response()->json([
            'message' => 'Cocktail displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line " . __LINE__ . " " . basename(__LINE__),
            'results' => $cocktail,
        ]);
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|unique:cocktail',
            'brand' => 'required',
            'image' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([$validator->errors(), 404]);
        }

        $data = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'image' => 'nullable',
        ]);

        $cocktail = Cocktail::create($data);

        if ($request->hasFile('image')) {

            $request->image->store('public/cocktail/');
            $cocktail->image = $request->image->hashName();

            $cocktail->save();
        }

        return response()->json([
            'message' => 'Cocktail displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line" . __LINE__ . "" . basename(__LINE__),
            'results' => $cocktail,
        ]);
    }

    public function RandomCocktail(){
        $cocktail = Cocktail::with('ingredients')->inRandomOrder()->first();

        return response()->json([
            'message' => 'Random cocktail displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line " . __LINE__ . " " . basename(__LINE__),
            'result' => $cocktail,
        ]);
    }

    public function TenRandomCocktails(){
        $cocktails = Cocktail::with('ingredients')->inRandomOrder()->take(10)->get();

        return response()->json([
            'message' => '10 random cocktails displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line " . __LINE__ . " " . basename(__LINE__),
            'results' => $cocktails,
        ]);
    }

    public function fileCocktailImage($fileName){
        $path = public_path('storage').'/cocktail/'.$fileName;
        // return Response::display($path);        

        return response()->file($path);
    }

    public function getCocktailByAlcoholType($alcoholType) {
        $cocktails = Cocktail::with('ingredients')->where('alcohol', $alcoholType)->get();
    
        if (!$cocktails) {
            abort(response()->json([
                'message' => 'Cocktails not Found!',
                'status' => 'NOT FOUND',
                'code' => 404
            ], 404));
        }
    
        return response()->json([
            'message' => 'Cocktails Displayed Successfully!',
            'status' => 'OK',
            'code' => '200',
            'results' => $cocktails
        ]);
    }

    public function getCocktailByCategory($category) {
        $cocktails = Cocktail::with('ingredients')->where('category', $category)->get();
    
        if (!$cocktails) {
            abort(response()->json([
                'message' => 'Cocktails not Found!',
                'status' => 'NOT FOUND',
                'code' => 404
            ], 404));
        }
    
        return response()->json([
            'message' => 'Cocktails Displayed Successfully!',
            'status' => 'OK',
            'code' => '200',
            'results' => $cocktails
        ]);
    }

    public function getCocktailByGlass($glass) {
        $cocktails = Cocktail::with('ingredients')->where('glass', $glass)->get();
    
        if (!$cocktails) {
            abort(response()->json([
                'message' => 'Cocktails not Found!',
                'status' => 'NOT FOUND',
                'code' => 404
            ], 404));
        }
    
        return response()->json([
            'message' => 'Cocktails Displayed Successfully!',
            'status' => 'OK',
            'code' => '200',
            'results' => $cocktails
        ]);
    }

    public function category(){
        $categories = Cocktail::distinct()->pluck('category')->all();

        $categories = array_filter($categories, function ($category) {
            return !is_null($category);
        });

        return response()->json([
            'message' => 'Cocktail categories displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line" . __LINE__ . "" . basename(__LINE__),
            'results' => $categories,
        ]);
    }

    public function glass(){
        $glasses = Cocktail::distinct()->pluck('glass')->all();

        $glasses = array_filter($glasses, function ($glass) {
            return !is_null($glass);
        });

        return response()->json([
            'message' => 'Cocktail glasses displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line" . __LINE__ . "" . basename(__LINE__),
            'results' => $glasses,
        ]);
    }

    public function alcohol(){
        $alcoholic = Cocktail::distinct()->pluck('alcohol')->all();

        $alcoholic = array_filter($alcoholic, function ($alcohol) {
            return !is_null($alcohol);
        });

        return response()->json([
            'message' => 'Cocktail glasses displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line" . __LINE__ . "" . basename(__LINE__),
            'results' => $alcoholic,
        ]);
    }

    public function getLatestCocktails(){
        $cocktails = Cocktail::orderBy('created_at', 'desc')
                            ->take(2)
                            ->get();
    
        return response()->json([
            'message' => 'Latest cocktails displayed successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line " . __LINE__ . " " . basename(__LINE__),
            'results' => $cocktails,
        ]);
    }

    public function getPopularCocktail(){
        $popularCocktail = Cocktail::where('popular', 1)->get();
    
        return response()->json([
            'message' => 'Popular cocktail retrieved successfully',
            'code' => 200,
            'status' => 'OK',
            'line' => "line " . __LINE__ . " " . basename(__LINE__),
            'results' => $popularCocktail,
        ]);
    }
}

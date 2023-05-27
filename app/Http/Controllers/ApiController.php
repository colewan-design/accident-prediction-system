<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\PredictionColor;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Validator;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    
    public function dashboard(){
        return view('dashboard')->with([
            'searches'  =>  UserSearch::orderBy('count','desc')->paginate(10),
            'sort'  =>  'desc',
            'type'  =>  'count'
        ]);
    }

    public function tutorial(){
        return view('tutorial');
    }


    public function predictions()
    {
        // Fetch data from the predictions table and group by direction
        $predictions = DB::table('predictions')
            ->select('direction', DB::raw('SUM(total_accidents) as total_accidents'))
            ->groupBy('direction')
            ->get();

        // Return the data as JSON
        return response()->json(['data' => $predictions]);
    }

    public function total_accidents_per_location()
        {
            // Fetch data from the predictions table and group by location
            $predictions = DB::table('predictions')
                ->select('location', DB::raw('SUM(total_accidents) as total_accidents'))
                ->groupBy('location')
                ->get();

            // Return the data as JSON
            return response()->json(['data' => $predictions]);
        }

    public function user_searches()
    {
        // Fetch data from the user_searches table and group by fields and created_at
        $searches = DB::table('user_searches')
            ->select('count', 'created_at')
            ->groupBy('count', 'created_at')
            ->get();
    
        // Return the data as JSON
        return response()->json(['data' => $searches]);
    }
    
    
    public function sortCount(Request $request){

        $sort = $request->sort; 
        $type = $request->type;
        
        if($sort == 'desc'){
            $sort = 'asc';
        }else{
            $sort = 'desc';
        }

        if($request->has('search')){
            if($sort == 'desc'){
                $userSearch = Search::add(UserSearch::class, 'keyword',$type)
                ->orderByDesc($type)
                ->beginWithWildcard()
                ->endWithWildcard()
                ->paginate($perPage = 10)
                ->search($request->search);
            }else{
                $userSearch = Search::add(UserSearch::class, 'keyword',$type)
                ->orderByAsc($type)
                ->beginWithWildcard()
                ->endWithWildcard()
                ->paginate($perPage = 10)
                ->search($request->search);
            }

            return view('dashboard')->with([
                'searches'  =>  $userSearch,
                'sort'  =>  $sort,
                'search'    =>  $request->search,
                'type'  =>  $type
            ]);

        }else{
            $userSearch = UserSearch::orderBy($type,$sort)->paginate(10);

            return view('dashboard')->with([
                'searches'  =>  $userSearch,
                'sort'  =>  $sort,
                'type'  =>  $type
            ]);
        }

    }

    public function search(Request $request){

        $searches = Search::add(UserSearch::class, 'keyword','count')
        ->beginWithWildcard()
        ->endWithWildcard()
        ->orderByDesc('count')
        ->paginate($perPage = 10)
        ->search($request->search);
       

        return view('dashboard')->with([
            'searches'  => $searches,
            'sort'  =>  $request->sort,
            'type'  =>  $request->type,
            'search'    =>  $request->search
        ]);

          
    }

    public function twitter(Request $request)
    {   
        $map = Setting::where('feature','google_map_api')->first();    
        
        //custom message for validation error message
        $messages = array(
            
        );

        //request validation
        $rules = array(
            'search' => 'required|string',    
        );

        //validator
        $validator = Validator::make($request->all(),$rules ,$messages);

        //checking if validation passes
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        //checking if API setting is enabled
        if(!$map->is_active){
            return response()->json(['status'=>2, 'error_message'=>'Map has been disabled. Please contact your system administrator.']);
        }
                      

        //fetching google API
        $response = Http::GET('https://maps.googleapis.com/maps/api/geocode/json?', [
        
            'address'   =>  $request->search,
            'key'   => config('api.google_api_key') // check .env file for google api key
        ]);

        //Storing search keyword if google API has values
        $checkResponse = json_decode($response->body(),true);
        $arr = (array) $checkResponse;
        $arrCount = count($arr['results']);
        
        $html3 = view('render-landing')->render();
        
        if($request->trigger == 'user' && $arrCount > 0){

            $this->storeSearch($request->search);
        }

        if($request->trigger == 'user'){
            $prediction = Prediction::where('location', 'LIKE', "%{$request->search}%")
                ->orderByDesc('accident_prediction')
                ->first();
            $predictions = collect([$prediction]);
            $html3 = view('render-predict')->with([
                'predictions' => $predictions,
                'colors' => PredictionColor::all(),
            ])->render();
        }
        

        //render of div
        $html = view('render')->with('data',$response)->render();
        $html2 = view('render-taps-api')->render();
        
        $data = array(
            'html'  =>  $html,
            'result'    =>  $response->json(),
            'html2' =>  $html2,
            'html3' =>  $html3
        );
        
        return response()->json($data);
    }

    public function syncTapsApi(Request $request){
        
        $response = Http::GET('http://192.168.68.113:8080/predict_v1');

        $data = array(
            'message'   =>  'Sync Successfully.',
            'body'  => $response,
        );

        $checkResponse = json_decode($response->body(),true);

        $arr = (array) $checkResponse;
        $arrCount = count($arr);

        Prediction::truncate();

        foreach($arr as $location){
            $prediction = new Prediction();
            $prediction->location = $location['Location'];
            $prediction->direction = $location['direction'];
            $prediction->total_accidents = $location['total_accidents'];;
            $prediction->accident_prediction = $location['accident_prediction'];
            $prediction->save();
        }        
    }

    public function storeSearch($keyword){
        $check = UserSearch::where('keyword',$keyword)->first();

        if($check){
            $check->count = $check->count + 1;
            $check->save();
        }else{
            $new = new UserSearch();
            $new->keyword = $keyword;
            $new->count = 1;
            $new->save();
        }
    }

    public function test(){
        $response = Http::GET('http://192.168.68.113:8080/predict_v1');

        echo '<pre>';
        echo $response;exit;
    }
    

    
}

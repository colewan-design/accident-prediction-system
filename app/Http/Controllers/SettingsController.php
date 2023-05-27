<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){

        $map = Setting::where('feature','google_map_api')->first();

        return view('settings')->with([
            'googleMapApi'  =>  $map->is_active,
        ]);
    }

    public function enableGoogleMap(Request $request){
        
        $messages = array(
            
        );
        $rules = array(
            'google_map' => 'required|boolean',    
        );

        $validator = Validator::make($request->all(),$rules ,$messages);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        
        $map = Setting::where('feature','google_map_api')->first();
        $map->is_active = $request->google_map;
        $map->save();

        $message = '';

        if($request->google_map == 1){
            $message = 'Google map API has been ENABLED!';
        }elseif($request->google_map == 0){
            $message = 'Google map API has been DISABLED!';
        }else{
            $message = 'Something went wrong!';
        }
        return response()->json(['status'=>1, 'message'=>$message]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\LocationExport;
use App\Imports\LocationImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class LocationController extends Controller
{
    public function uploadLocation(Request $request){
        
        $messages = array(
            
        );

        //request validation
        $rules = array(
            'file' => 'required',    
        );

        //validator
        $validator = Validator::make($request->all(),$rules ,$messages);

        //checking if validation passes
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
       
   
        $file = $request->file('file');
    
        $import = new LocationImport;
        $import = $import->onlySheets('Sheet1');
        $import->import($file);
        

        $html = view('render-download-coordinates')->render();
        
        $data = array(
            'html'  =>  $html,
        );
        
        return response()->json($data);
    }

    public function exportLocation() {
        return Excel::download(new LocationExport, 'coordinates.csv');
    }
}

<?php

namespace App\Imports;


use App\Models\Coordinate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class FirstSheetImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithValidation
{   
    public function collection(Collection $rows)
    {
        
        
        foreach($rows as $row){

            $response = Http::GET('https://maps.googleapis.com/maps/api/geocode/json?', [
        
                'address'   =>  $row['location'],
                'key'   =>  config('api.google_api_key') // check .env file for google api key
            ]);

            $data = json_decode($response->body(),true);

            $arr = (array) $data;
            $arrCount = count($arr['results']);
            
            if($arrCount > 0){
                $geo = ($arr['results'][0]['geometry']);
                $lat = ($geo['location']['lat']);
                $lng = ($geo['location']['lng']);
            
            }else{
                $lat = 'undefine';
                $lng = 'undefine';
            }
            
            $loc = Coordinate::create([
              
                'latitude'  =>  $lat,
                'longitude' =>  $lng,
                'location'  =>  $row['location']

            ]);

          
        }
    }

    public function rules(): array{

        return [
          
        ];
    }


}

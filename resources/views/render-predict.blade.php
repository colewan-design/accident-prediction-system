

<h3 class="text-2xl">Accident Prediction</h3>

<div class="flex flex-col gap-3 mt-3 text-gray-700">
    @if ($predictions->count())
        @foreach ($predictions as $pred)
            @if ($pred->accident_prediction >= 10 && $pred->accident_prediction <= 30)
                <div class="bg-lime-500 p-3 w-3/4 rounded">
                    <div class="flex flex-col test-sm">
                        <span>Location: <span class="font-semibold">{{$pred->location}}</span></span>
                        <span>Direction: <span class="font-semibold">{{$pred->direction}}</span></span>
                        <span>Total Accidents: <span class="font-semibold">{{$pred->total_accidents}}</span></span>
                        <span>Prediction: <span class="font-semibold">{{$pred->accident_prediction}}%</span></span>
                    </div>    
                </div>
            @endif
            @if ($pred->accident_prediction >= 31 && $pred->accident_prediction <= 55)
                <div class="bg-yellow-500 p-3 w-3/4 rounded">
                    <div class="flex flex-col test-sm">
                        <span>Location: <span class="font-semibold">{{$pred->location}}</span></span>
                        <span>Direction: <span class="font-semibold">{{$pred->direction}}</span></span>
                        <span>Total Accidents: <span class="font-semibold">{{$pred->total_accidents}}</span></span>
                        <span>Prediction: <span class="font-semibold">{{$pred->accident_prediction}}%</span></span>
                    </div>  
                </div>
            @endif
            @if ($pred->accident_prediction >= 56 && $pred->accident_prediction <= 70)
                <div class="bg-orange-300 p-3 w-3/4 rounded">
                    <div class="flex flex-col test-sm">
                        <span>Location: <span class="font-semibold">{{$pred->location}}</span></span>
                        <span>Direction: <span class="font-semibold">{{$pred->direction}}</span></span>
                        <span>Total Accidents: <span class="font-semibold">{{$pred->total_accidents}}</span></span>
                        <span>Prediction: <span class="font-semibold">{{$pred->accident_prediction}}%</span></span>
                    </div>  
                </div>
            @endif
            @if ($pred->accident_prediction >= 71 && $pred->accident_prediction <= 85)
                <div class="bg-orange-500 p-3 w-3/4 rounded">
                    <div class="flex flex-col test-sm">
                        <span>Location: <span class="font-semibold">{{$pred->location}}</span></span>
                        <span>Direction: <span class="font-semibold">{{$pred->direction}}</span></span>
                        <span>Total Accidents: <span class="font-semibold">{{$pred->total_accidents}}</span></span>
                        <span>Prediction: <span class="font-semibold">{{$pred->accident_prediction}}%</span></span>
                    </div>
                </div>
            @endif
            @if ($pred->accident_prediction >= 86)
                <div class="bg-orange-500 p-3 w-3/4 rounded">
                    <div class="flex flex-col test-sm">
                        <span>Location: <span class="font-semibold">{{$pred->location}}</span></span>
                        <span>Direction: <span class="font-semibold">{{$pred->direction}}</span></span>
                        <span>Total Accidents: <span class="font-semibold">{{$pred->total_accidents}}</span></span>
                        <span>Prediction: <span class="font-semibold">{{$pred->accident_prediction}}%</span></span>
                    </div>  
                </div>
            @endif
        @endforeach
    @else
        <div class="bg-red-300 p-3 w-3/4 rounded">
            <div class="flex flex-col text-sm">
                <span>No prediction found. Must be within EDSA</span>
            </div>    
        </div>    
    @endif
   
</div>
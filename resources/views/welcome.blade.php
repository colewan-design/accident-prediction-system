<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    </head>
    <style>
        #map{
            height: 400px;
            width: 100%;
        }
    </style>
    <body>
        <!--NAVBAR-->
        <nav class="relative container mx-auto p-6">
            <!--Flex Container-->
            <div class="flex items-center justify-between">
                 <!--Logo-->
                <div class="pt-2">
                    <h3 class="text-7xl text-brightRed font-bold uppercase">TAPS</h3>
                </div>
                <!--Menu items-->
                <div class="hidden md:flex lg:flex space-x-6 items-center">
                    @include('home-nav')
                </div>
                <!--Button-->
                <!--
                @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <div class="flex gap-x-2">
                            <a href="{{ route('login') }}" class="hidden md:block p-3 px-6 pt-2 text-white bg-brightRed rounded-full baseline hover:bg-brightRedLight">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hidden md:block p-3 px-6 pt-2 text-white bg-veryDarkBlue rounded-full baseline hover:bg-darkBlue">
                                    Signup
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif
               -->
            </div>
        </nav>
        <!--Hero Section-->
        <section id="hero">
            <!--Flex container-->
            <div class="container flex flex-col-reverse md:flex-row 
             px-6 mx-auto mt-10 space-y-0 md:space-y-0">
                <!--Left item-->
                <div class="flex flex-col mb-32 space-y-8 md:w-1/2">
                    
                    <div id="predict_result">
                       
                    </div>
                   {{--  <form action="{{ route('twitter.fetch') }}" method="get">
                        @csrf
                        @method('get')
                        <input type="text" name="search">
                        <input type="hidden" name="trigger" value="user">
                        <button type="submit">submit</button>
                    </form> --}}
                    @if ($topAccidents->count())
                        <p class="text-red-500 font-semibold">Top Accident Prone Locations</p>
                    @endif
                    <div class="max-w-md flex text-darkGrayishBlue">
                        <div class="flex text-center flex-wrap gap-4 md:text-left">
                            @foreach ($topAccidents as $loc)
                                <button 
                                data-id="{{$loc->location}}"
                                class="capitalize top-search rounded-xl px-4 py-2 bg-red-300 text-gray-600 hover:bg-green-200 ease-in-out duration-300 hover:scale-110">
                                    <label class="flex gap-x-3 cursor-pointer">
                                    {{$loc->location}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 my-1 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    </label>
                                </button>
                            @endforeach
                        </div>
                   
                    </div>
                    <div class="flex justify-center md:justify-start">
                         <!--Button-->
                        <a href="" class="p-3 px-6 pt-2 text-white bg-brightRed rounded-full baseline hover:bg-brightRedLight">Get Started</a>
                    </div>
                </div>
             
                <!--Right item--->
                <div class="md:w-1/2">
                    <div class="flex flex-col items-center rounded-lg overflow-hidden px-2 py-1 justify-between
                        md:flex-row md:gap-y-3
                    ">
                        
                        <label class="relative w-full block">
                            <span class="sr-only">Search</span>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                              <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20" 
                                xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                              </svg>
                            </span>
                            <input id="input_search" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none sm:text-sm" placeholder="Search for metro-manila places..." type="text" name="search"/>
                        </label>
                        <div class="my-3 w-full ms:flex items-center px-2 rounded-lg space-x-4 mx-auto
                            md:my-5 md:w-fit
                        ">
                            <button id="btn_search" class="bg-brightRed text-white text-sm rounded-lg px-4 py-2 font-thin hover:bg-brightRedLight ">Search</button>
                        </div>
                    </div>
                    <span class="text-red-500 error-text search_error px-3"></span>
                    <div class="flex px-3" id="result-div" style="display: none">
                        <div class="card shadow-sm w-full bg-blue-200 rounded-sm p-3">
                            <p><span id="status" class="text-sm text-gray-600"></span></p>
                            <p><span class="text-red-500" id="error_message"></span></p>
                            <h5 class="font-semibold my-2" id="full_address"></h5>
                        </div>
                    </div>
                    <div id="div-taps" class="px-3 mt-3">

                    </div>
                    <div class="my-5 p-4">
                        <div id="map" class="border-slate-600">
                            Loading...
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--Footer-->
        <footer class="bg-veryDarkBlue">
            <!--Flex container-->
            <div class="container flex flex-col-reverse justify-between px-6 py-10 mx-auto space-y-8 md:flex-row md:space-y-0">
                <!--Logo and social links container-->
                <div class="flex flex-col-reverse items-center justify-between space-y-12 md:flex-col md:space-y-0 md:items-start">
                    <!--Logo-->
                    <div>
                       
                    </div>
                    <!--Social links container-->
                    <div class="flex justify-center space-x-4">
                        <!--Link1-->
                        <a href="#">
                          
                        </a>
                        <!--Link2-->
                        <a href="#">
                         
                        </a>
                        <!--Link3-->
                        <a href="#">
                         
                        </a>
                        <!--Link4-->
                        <a href="#">
                         
                        </a>
                        <!--Link5-->
                        <a href="#">
                        
                        </a>
                    </div>
                </div>
    
                <!--List container-->
                <div class="flex justify-round space-x-32">
                    
                </div>
            </div>
        </footer>
      
        <script>
            window.addEventListener("load", (event) => {
                var resultDiv = document.getElementById("result-div");

                var getUrl = "{{route('twitter.fetch')}}";

                $.ajax({
                    type: "GET",
                    url: getUrl,
                    data:{
                        _token:$("input[name=_token]").val(),
                        search: 'Manila',
                        trigger: 'load'
                        
                    },
                    success: function(data) {
                        $('#predict_result').html(data.html3)
                        if(data.status == 2){
                            alert(data.error_message);
                        }else{
                            var pinMap = data.result.results[0]
                            initMap(pinMap);
                        }
                       
                    }
                })
            });

            $("#btn_search").on('click', function (e) {
                e.preventDefault();
                var token = Math.random().toString(36).substr(2)
                let dataId = $('#input_search').val();

                $('#session-id-edit').val(Math.random().toString(36).substr(2))

                var getUrl = "{{route('twitter.fetch')}}";

                $.ajax({
                    type: "GET",
                    url: getUrl,
                    data:{
                        _token:$("input[name=_token]").val(),
                        search: dataId,
                        trigger:'user'
                    },
                    success: function(data) {
                        if(data.status == 2){
                            alert(data.error_message);
                        }

                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $('#render-div').html(data.html);
                            console.log(data)
                            if(data.result.status == 'OK'){
                                $('.search_error').text('');
                                $('#status').text('Success. You were able to fetch data')
                                $('#error_message').text('')
                                $('#full_address').text(data.result.results[0].formatted_address)
                                $("#result-div").css("display", "block")
                                /* $('#div-taps').html(data.html2) */
                                $('#predict_result').html(data.html3)
                            }else{
                                $('.search_error').text('');
                                $('#status').text('Error: '+ data.result.status)
                                $('#error_message').text('Oops something went wrong, unable to pin a location! Error message: '+data.result.error_message)
                                $('#full_address').text('')
                                /* $('#div-taps').html('') */
                                $('#predict_result').html(data.html3)
                            }
                        }
                            

                        
                    }
                }).done(function(data){
                    $("#result-div").css("display", "block")
                    var pinMap = data.result.results[0]
                    initMap(pinMap)
                });
            });
           
            $('.top-search').on('click',function(e){
                $('#input_search').val($(this).data('id'))
                $("#btn_search").click();
            });
         

            function initMap(pinMap){
                var options = {
                    zoom:12,
                    center:pinMap.geometry.location
                }
            
                var map = new 
                google.maps.Map(document.getElementById('map'),options);

                var marker = new google.maps.Marker({
                    position: pinMap.geometry.location,
                    map:map
                });

                var infoWindow = new google.maps.infoWindow({
                    content: '<h1>Test</h1>'
                });

                marker.addEventLister('click', function(){
                    infoWindow.open(map, marker);
                });
               
            
            }
            
        </script>
          <script async src="https://maps.googleapis.com/maps/api/js?key={{ config('api.google_api_key') }}&libraries=places&callback=initMap"></script>
    </body>
</html>

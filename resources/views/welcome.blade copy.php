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
    <body>

        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <input type="text" name="search" class="form-control rounded-0" placeholder="Search for location.." aria-label="Location" aria-describedby="basic-addon2" required>
                <button class="rounded-0 btn btn-outline-secondary" type="button">Search</button>
                <form>
                    <label class="relative block">
                        <input id="input_search" 
                            class="w-full bg-white placeholder:font-italitc border border-slate-400 drop-shadow-md rounded-md py-2 pl-3 pr-10 focus:outline-none"
                            placeholder="Enter your keyword to search" type="text" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button  id="btn_search" >
                                <svg class="h-5 w-5 fill-black" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30"
                                    height="30" viewBox="0 0 30 30">
                                    <path
                                        d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
                                    </path>
                                </svg>
                            </button>
                        </span>
                    </label>
                </form>
            </div>
            
        </div>
        <div class="message my-3">
            <span id="status" class="text-dark text-md font-weight-bold">Test</span><br>
            <span id="error_message" class="text-danger"></span>
        </div>
        <div id="render-div">
            <div id="render-map">
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdN3Okr3yJv0dqQ8rasugRYuR7xOx5sZ0&callback=initialize" async defer></script>

        <script>

            
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
                    },
                    success: function(data) {
                        console.log(data.result)
                        $('#render-div').html(data.html);
                        if(data.result.status == 'OK'){
                            $('#status').text('Success. You were able to fetch data')
                            $('#error_message').text('')
                            $('#full_address').text(data.result.results[0].formatted_address)
                        }else{
                            $('#status').text('Error: '+ data.result.status)
                            $('#error_message').text('Error Message: '+data.result.error_message)
                        }
                    }
                });
            });
            
        </script>
    </body>
</html>

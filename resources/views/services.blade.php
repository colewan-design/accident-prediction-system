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
               
            </div>
        </nav>
        <!--Hero Section-->
        <section id="hero">
            <!--Flex container-->
            <div class="container flex flex-col-reverse md:flex-row 
             px-6 mx-auto mt-10 space-y-0 md:space-y-0">
                <!--Left item-->
                <div class="flex flex-col mb-5 space-y-8 md:w-1/2">
                    
                    <h1 class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left">
                        Google Geocoding API
                    </h1>

                    <div class="max-w-md flex text-darkGrayishBlue mt-5">
                        This API is responsible for fetching coordinates using text location; this helps the system identify the exact coordinates from the text location extracted within the tweet, using our predictive API.
                    </div>

                    <div class="max-w-md flex text-darkGrayishBlue">
                        <div class="flex text-center flex-wrap gap-4 md:text-left">
                           
                        </div>
                   
                    </div>
                    <div class="flex justify-center md:justify-start">
                      {{--    <!--Button-->
                        <a href="" class="p-3 px-6 pt-2 text-white bg-brightRed rounded-full baseline hover:bg-brightRedLight">Get Started</a> --}}
                    </div>
                </div>
             
                <!--Right item--->
                <div class="md:w-1/2">
                    <div class="flex flex-col gap-x-5 items-center rounded-lg overflow-hidden px-2 py-1 justify-between
                        md:flex-row md:gap-y-3
                    ">
                        <h1 class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left">
                            Google Maps API
                        </h1>

                        <div class="max-w-lg flex text-darkGrayishBlue mt-5">
                           This API is responsible for dynamic map that can help users identify the spatial location of such extracted coordinates.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section>
            <div class="container mb-32 w-full mx-auto">
                <h1 class="text-5xl">NLP Traffic Prediction API</h1>
                <p>This predictive API was designed by us; which uses multiple predictive models and libraries to: extract, load, analyze, and classify tweets from MMDA; which then can be used for predicting using a simple NLP architecture to parse out the needed information. This information will then be fed into a predictive model that mimics results of a Gaussian algorithm; which estimates a likelihood of an accident within a certain social event within a certain location.</p>
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
    </body>
</html>

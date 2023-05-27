<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
        <small class="text-darkGrayishBlue">Traffic Accident Prediction System</small>
    </div>


</div>

<div class="bg-gray-200 bg-opacity-25">
    <div class="p-6">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" 
            height="24px" 
            viewBox="0 0 24 24" 
            width="24px" 
            fill="#000000"
            class="w-8 h-8 text-gray-400">
            <path d="M0 0h24v24H0V0z" fill="none"/>
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/>
            <circle cx="12" cy="9" r="2.5"/>
            </svg>
            
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                Top User Searches
            </div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, ipsa dicta. Quam tempora quidem quae laboriosam amet similique dolorum consequuntur.
            </div>

            <a href="https://laravel.com/docs">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    {{-- <div>Explore</div> --}}

                    {{-- <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div> --}}
                    
                </div>
            </a>
        </div>
        
        <div class="block w-full overflow-x-auto my-3" id="render_table">
            <form action="{{ route('search.count') }}" method="get">
                @method('GET')
                <input type="hidden" name="sort" value="desc">
                <input type="hidden" name="type" value="count">
                <div class="flex justify-end gap-x-3 text-right my-8 px-3">
                    <label class="relative block">
                        <span class="absolute inset-y-0 right-3 flex items-center pl-2">
                            <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20" 
                            xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                        </span>
                        
                        <input type="text" name="search"
                        class="shadow rounded border-0 focus:outline-none placeholder:text-sm" placeholder="Search by keyword..">
                    </label>
                    <button type="submit" class="bg-veryDarkBlue px-3 rounded text-white hover:bg-darkBlue text-xs">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
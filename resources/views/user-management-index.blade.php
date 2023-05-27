
<style>
    /* Toggle A */
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-gray-200 bg-opacity-25">
                    <div class="p-6">
                       
                
                        <div class="absolute" id="result_div">
                            <div class="flex items-center gap-x-1 font-semibold p-2 text-green-500 rounded-md max-w-fit text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                                  
                                  <span id="result_message">test</span>
                            </div>
                        </div>
                        
                        <div class="block w-full overflow-x-auto my-3" id="render_table">
                            <form action="{{ route('search.user') }}" method="get">
                                @method('GET')
                                <input type="hidden" name="sort" value="desc">
                                <input type="hidden" name="type" value="name">
                                <div class="flex flex-col mb-5">
                                    <div class="flex justify-end gap-x-3 text-right my-2 px-3">
                                        <label class="relative block">
                                            <span class="absolute inset-y-0 right-3 flex items-center pl-2">
                                                <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20" 
                                                xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                                </svg>
                                            </span>
                                            
                                            <input type="text" name="search" @isset($userSearch) value="{{ $userSearch }}" @endisset
                                            class="shadow rounded border-0 focus:outline-none placeholder:text-sm" placeholder="Search by keyword..">
                                        </label>
                                        <button type="submit" class="bg-veryDarkBlue px-3 rounded text-white hover:bg-darkBlue text-xs">Search</button>
                                       
                                    </div>
                                    <div class="flex">
                                       
                                        <div class="w-1/2 text-left text-gray-500 text-sm px-2">
                                           Sorted by:  
                                            <span class="text-brightRed font-bold capitalize">{{ $type }}</span>
                                        </div>
                                       
                                        @isset($userSearch)
                                        <div class="w-1/2 text-right text-gray-500 text-sm">
                                            You got 
                                            <span class="text-brightRed font-bold">{{ $users->total() }}</span>
                                            result(s) from keyword "<span class="font-bold text-black">{{$userSearch}}</span>".
                                            <a href="{{route('user-management.index')}}" class="ml-2 mr-4 text-brightRed underline">Clear result</a>
                                        </div>
                                        @endisset
                                    </div>
                                    
                                    
                                </div>
                            </form>
                            
                            <table class="items-center bg-transparent w-full border-collapse ">
                              <thead>
                                <tr>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        <div class="flex justify-start">
                                            Name
                                            <a href="
                                                @isset($userSearch) 
                                                    {{route('sort.user',['search'=>$userSearch, 'type'=>'name', 'sort'=>$sort])}}
                                                @else
                                                    {{route('sort.user',['type'=>'name', 'sort'=>$sort])}}
                                                @endisset
                                                " title="Sort asc/desc">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-400 w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                                </svg>      
                                            </a>
                                        </div>
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        <div class="flex justify-start">
                                            Email
                                            <a href="
                                                @isset($userSearch) 
                                                    {{route('sort.user',['search'=>$userSearch, 'type'=>'email', 'sort'=>$sort])}}
                                                @else
                                                    {{route('sort.user',['type'=>'email', 'sort'=>$sort])}}
                                                @endisset
                                                " title="Sort asc/desc">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-400 w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                                </svg>      
                                            </a>
                                        </div>
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        <div class="flex justify-start">
                                            Role
                                        </div>
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        <div class="flex justify-start">
                                            Active
                                        </div>
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-right">
                                        <div class="flex justify-end">
                                            Created
                                            <a href="
                                                @isset($userSearch) 
                                                    {{route('sort.user',['search'=>$userSearch, 'type'=>'created_at', 'sort'=>$sort])}}
                                                @else
                                                    {{route('sort.user',['type'=>'created_at', 'sort'=>$sort])}}
                                                @endisset
                                                "title="Sort asc/desc">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-400 w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                                </svg>      
                                            </a>
                                        <div>
                                    </th>
                                </tr>
                              </thead>
                      
                              <tbody>
                                @if ($users->count())
                                    @foreach ($users as $user)
                                        <tr>
                                            <th class="capitalize border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                <label for="" class="flex gap-x-2">
                                                    {{$user->name}}
                                                    <a href="#">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </a>
                                                </label>
                                            </th>
                                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                <label for="" class="flex gap-x-2">
                                                    {{$user->email}}
                                                    <a href="#">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </a>                                             
                                                </label>
                                                
                                            </th>
                                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                <label for="" class="flex gap-x-2">
                                                    {{$user->primaryRole()}}
                                                    <a href="#">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </a>                                             
                                                </label>
                                                
                                            </th>
                                           
                                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap text-left text-blueGray-700 ">
                                                <label for="toggle-{{$user->id}}" class="flex items-center cursor-pointer">
                                                    <!-- toggle -->
                                                    <div class="relative">
                                                        <!-- input -->
                                                        <input type="checkbox" data-id="{{$user->id}}" id="toggle-{{$user->id}}" class="is_active sr-only" @if($user->is_active) checked @endif>
                                                        <!-- line -->
                                                        <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                                                        <!-- dot -->
                                                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                                                    </div>
                                                   
                                                </label>
                                            </th>
                                            
                                            <td class="border-t-0 px-8 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap text-right p-4">
                                                {{$user->created_at}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th class="capitalize border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-red-500">
                                            No record found
                                        </th>
                                    </tr>
                                @endif
                               
                              
                              </tbody>
                      
                            </table>
                            <div class="my-5">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>                                
            </div>
        </div>
    </div>
</x-app-layout>
<script>
$("#result_div").hide()
$('.is_active').on('change',function(e){
    e.preventDefault();
    var token = Math.random().toString(36).substr(2)
    var isActive = 0;
    var dataId = $(this).data('id');

   
   
    if ($(this).is(':checked')) {
        var isActive = 1;
    }else{
        var isActive = 0;
    }

    $('#session-id-edit').val(Math.random().toString(36).substr(2))

    var getUrl = "{{route('user-management.update',':id')}}";
        getUrl = getUrl.replace(':id', dataId);

    $.ajax({
        type: "PUT",
        url: getUrl,
        data:{
            _token:$("input[name=_token]").val(),
            value: isActive,
            target: 'is_active'
        },
        success: function(data) {
            if(data.status == 0){
                
            }else{
                console.log(data)
                $("#result_div").show(function(){
                    $('#result_message').text(data.message)
                }).delay().fadeIn();

                $("#result_div").hide().delay(3000).fadeOut();
            }
        }
    })
});
</script>
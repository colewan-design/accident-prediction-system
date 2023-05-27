<div class="flex justify-end gap-x-3 text-right my-8 px-3">
    <label class="relative block">
        <span class="absolute inset-y-0 right-3 flex items-center pl-2">
            <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20" 
              xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
          </span>
        <input type="text" 
        class="shadow rounded border-0 focus:outline-none placeholder:text-sm" placeholder="Search by keyword..">
    </label>
    <button class="bg-veryDarkBlue px-3 rounded text-white hover:bg-darkBlue text-xs">Search</button>
</div>
<table class="items-center bg-transparent w-full border-collapse ">
  <thead>
    <tr>
        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
            <div class="flex justify-start">
                Keyword
                <a href="
                    @isset($search) 
                        {{route('sort.count',['search'=>$search, 'type'=>'keyword', 'sort'=>$sort])}}
                    @else
                        {{route('sort.count',['type'=>'keyword', 'sort'=>$sort])}}
                    @endisset
                    " title="Sort asc/desc">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-400 w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                    </svg>      
                </a>
            </div>
        </th>
        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-right">
            <div class="flex justify-end">
                Search Count 
                <a href="
                    @isset($search) 
                        {{route('sort.count',['search'=>$search, type =>'count', 'sort'=>$sort])}}
                    @else
                        {{route('sort.count',['type'=>'count', 'sort'=>$sort])}}
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
    @if ($searches->count())
        @foreach ($searches as $search)
            <tr>
                <th class="capitalize border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                    {{$search->keyword}}
                </th>
                <td class="border-t-0 px-8 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap text-right p-4">
                    {{number_format($search->count)}}
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
    {{ $searches->withQueryString()->links() }}
</div>
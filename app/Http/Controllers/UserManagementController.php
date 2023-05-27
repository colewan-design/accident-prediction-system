<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user-management-index')->with([
            'users'  => User::notSelf(Auth::user()->id)->orderBy('created_at','desc')->paginate(10),
            'sort'  =>  'desc',
            'type'  =>  'name'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $target = $request->target;
        $value = $request->value;

        $user = User::find($id);
        $user->$target = $value;
        $user->save();

        $message = $this->returnMessage($target,$value);

        $data = array(
            'message'   =>  $message,
        );

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sortCount(Request $request){
        
        $sort = $request->sort; 
        $type = $request->type;
        
        if($sort == 'desc'){
            $sort = 'asc';
        }else{
            $sort = 'desc';
        }

        if($request->has('search')){
            if($sort == 'desc'){
                $userSearch = Search::add(User::notSelf(Auth::user()->id),['name','email','created_at'],$type)
               
                ->orderByDesc($type)
                ->beginWithWildcard()
                ->endWithWildcard()
                ->paginate($perPage = 10)
                ->search($request->search);
            }else{
                $userSearch = Search::add(User::notSelf(Auth::user()->id),['name','email','created_at'],$type)
                ->orderByAsc($type)
                ->beginWithWildcard()
                ->endWithWildcard()
                ->paginate($perPage = 10)
                ->search($request->search);
            }

            return view('user-management-index')->with([
                'users'  =>  $userSearch,
                'sort'  =>  $sort,
                'userSearch'    =>  $request->search,
                'type'  =>  $type
            ]);

        }else{
            
            $userSearch = User::orderBy($type,$sort)->notSelf(Auth::user()->id)->paginate(10);

            return view('user-management-index')->with([
                'users'  =>  $userSearch,
                'sort'  =>  $sort,
                'type'  =>  $type
            ]);
        }

    }


    public function search(Request $request){

        $searches = Search::add(User::notSelf(Auth::user()->id), ['name','email','created_at'])
        ->beginWithWildcard()
        ->endWithWildcard()
        ->orderByDesc($request->type)
        ->paginate($perPage = 10)
        ->search($request->search);
       

        return view('user-management-index')->with([
            'users'  => $searches,
            'sort'  =>  $request->sort,
            'type'  =>  $request->type,
            'userSearch'    =>  $request->search
        ]);

          
    }

    public function returnMessage($target,$value){
        $message = 'Undefined notification';
        if($target == 'is_active'){
            if($value==true){
                $message = 'User login has been ENABLED.';
            }else{
                $message = 'User login has been DISABLED.';
            }
        }

        return $message;
    }
}

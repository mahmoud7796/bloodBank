<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\CreateRequestRequset;
use App\Http\Requests\Request\UpdateRequestRequset;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = \App\Models\Request::with(['governorate'=> function($query){
            $query->select('id','governorate_name_'.\LaravelLocalization::getCurrentLocale(). ' as governorate_name');
        },'user' => function($query){
            $query->select('id','name');
        },'city'=> function($query){
            $query->select('id','city_name_'.\LaravelLocalization::getCurrentLocale(). ' as city_name');
        }])->get();

        return view('requests.index',compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates=Governorate::select('id','governorate_name_'.\LaravelLocalization::getCurrentLocale(). ' as governorate_name')->get();
        $users=User::all();
        return view('requests.create',compact('governorates','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestRequset $request)
    {
        \App\Models\Request::create($request->all());

        alert()->success('Request Created Successfully' , 'Success');

        return redirect()->route('dashboard.requests.index');
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
    public function edit(\App\Models\Request $request)
    {
        $governorates=Governorate::select('id','governorate_name_'.\LaravelLocalization::getCurrentLocale(). ' as governorate_name')->get();
        $users=User::all();
        return view('requests.edit',compact('request','governorates','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestRequset $editedData, \App\Models\Request $request)
    {
        $request->update($editedData->all());

        alert()->success('Requests Updated Successfully' , 'Success');

        return redirect()->route('dashboard.requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\Request $request)
    {
        $request->delete();
        alert()->success('Request Deleted Successfully' , 'Success');
        return redirect()->route('dashboard.requests.index');
    }
}

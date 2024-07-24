<?php

namespace App\Http\Controllers;

use App\Models\works;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works=Works::orderBy('id','asc')->where('user_id',auth()->user()->id)->paginate(10);
        return view('FrontEnd.allworks',compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('FrontEnd.addwork');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Works::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'category'=>$request->category,
            'user_id'=>$request->user_id,
        ]);

        return redirect()->route('work.index')->with('status','Task added successfully!');
    }
    public function ChangeStatus($id , Request $request)
    {
        $work=Works::find($id);
        Works::where('id',$id)->update(['status'=> $request->status]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if (!$request->status){
             $works=Works::latest()->paginate(10);
             return view('FrontEnd.allworks', compact('works'));
        }
        $works=Works::where('status',$request->status)->paginate(10);
        return view('FrontEnd.allworks', compact('works'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $work=Works::find($id);
        return view('FrontEnd.editwork',compact('work'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $work=Works::find($id);
        $work->title = $request->title;
        $work->description = $request->description;
        $work->category = $request->category;
        $work->user_id = $request->user_id;
        $work->save();
        return redirect()->route('work.index')->with('status','Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $work=Works::find($id)->delete();
        return redirect()->route('work.index')->with('status','product Deleted successfully');
    }
}

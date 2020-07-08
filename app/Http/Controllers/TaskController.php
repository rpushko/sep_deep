<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $user;


    public function __construct()
    {
        $this->middleware('auth');
        $this->user=Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       // $tasks=Task::all(); //vybor vseh zadach vseh userov
        $tasks=$this->user->tasks;
        return view('tasks.index',['tasks'=>$tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);


      /* $userId=Auth::user()->id;


        $task=new Task();
        $task->name=$request->name;
        $task->user_id=$userId;
        $task->save();

      */
     // $user=Auth::user();
        $this->user
            ->tasks()
            ->create(
              [
                  'name'=>$request->name,
                  ]);//konstruktor zaprosa s usloviem id tekushego usera
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    //{
        //
   // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $tasks)
    {
        return view('tasks.edit',['tasks'=>$tasks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $tasks)
    {
        $tasks->name = $request->name;
        $tasks->save();
        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $tasks)
    {
       $tasks->delete();
        return redirect()->route('tasks.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Http\Repository\ItaskRepository;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{

    protected $repository;


    public function __construct(ItaskRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

        $id = Auth::id(); 

        //if Guido is authenticated
        if ($id == 2){
            $lists = $this->repository->getAllLists();
            return view ('admin')->with('lists',$lists)->with('userId',$id);
        //if employee is authenticated 
        } else {
            $lists = $this->repository->getListsByUser($id);
        return view('EmployeeView')->with('lists',$lists)->with('userId',$id);
    }
    //if no user is loggedin
    } else {
    return view('auth/login');

    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function List() {
        return view ("auth/login");
    }

    public function create(){

    }


    public function createTask() {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->repository->createTask($request);

        return $this->index();
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
    public function update($id)
    {
        $this->repository->completeTask($id);
        return $this->Index();
    }


    public function getTasks($list){

        $tasks = $this->repository->getTasksForList($list);

        return $tasks;
    }


    public function getCompletedTasks($list) {
        $tasks = $this->repository->getTasksForList($list);

        $completedTaskCount = 0;

        foreach ($tasks as $task) {
            if ($task->completed_at != null){
                $completedTaskCount += 1;
            }
            # code...
        }

        return $completedTaskCount;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->deleteTask($id);
           return $this->Index();
    }
}


?>
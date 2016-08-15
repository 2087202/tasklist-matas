<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Repository\ItaskRepository;
use App\TaskList;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


       protected $repository;


    public function __construct(ItaskRepository $repository)
    {
        $this->repository = $repository;
    }

   public function index()
    {
        if (Auth::check()) {

        $id = Auth::id(); 

        //if Guido is authenticated
        if ($id == 2){
            $lists = $this->repository->getAllLists();
            $employees = $this->repository->getEmployees();
            return view ('admin')->with('lists',$lists)->with('employees',$employees)->with('userId',$id);
        //if employee is authenticated 
        } else {
            $lists = $this->repository->getListsByUser($id);
        return view('EmployeeView')->with('lists',$lists)->with('userId',$id);;
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
    public function create()
    {   
            $id = Auth::id();
          $employees = $this->repository->getEmployees();
          return view ("CreateList")->with('employees',$employees)->with('userId',$id);
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
        
        $returnString = "";

         $this->validate($request, [
        'name' => 'required|max:255',
    ]); 
         $userid = Auth::id();
      $save = $this->repository->CreateListForUser($request); 
         $employees = $this->repository->getEmployees();
     

      return view("CreateListResult")->with('status',$save)->with('employees',$employees)->with('userId',$userid);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($list)
    {
    $this->repository->deleteList($list);

        return $this->index();    }

    public function Filter(Request $request){

        $userid = Auth::id();
        $id = $request->id;
       $lists = $this->repository->getListsByUser($id);
         $employees = $this->repository->getEmployees();
        return view ('admin')->with('lists',$lists)->with('employees',$employees)->with('userId',$userid);
 
        }
}

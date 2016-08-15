<?php



namespace App\Http\Repository;

use App\Http\Repository\ItaskRepository;

use App\TaskList;
use App\Task;
use App\User;
use Carbon\Carbon ;


class Repository implements ItaskRepository {


    public function getAllLists()
    {
          $lists = TaskList::all();

          return $lists;

    }

    public function createListForUser($request)
    {
        
        $list = new TaskList;
        $list->name = $request->name;
        $list ->employee_id = $request->category;
      $save = $list->save();
      return $save;

    }


    //createTask($list)
    public function createTask($request)
    {
        $task = new Task;
        $task->content = $request->content;
        $task->list_id = $request->id;
        $save = $task->save();

        return $save;
    }

    public function getTasksForList($list){
        $tasks = Task::where('list_id',$list->id)->get();

        return $tasks;

    }

    public function getListsByUser($userId)
    {
      $lists = TaskList::where('employee_id',$userId)->get();
     
      
      
      return $lists;
    }

    public function completeTask($id){
        $task = Task::where('id',$id)->first();
        $task->completed_at = Carbon::now();
        $task->save();
    }

    public function deleteTask($id)
    {

        $task = Task::withTrashed()->where('id',$id)->first();
        $task->forceDelete();
        // TODO: Implement deleteTask() method.
    }


    public function deleteList($id){

        $list = TaskList::where('id',$id)->first();

               $tasks = Task::where('list_id',$list->id)->get();
           
                    foreach ($tasks as $task) {
                        if ($task->completed_at !=null){
                            $task->delete();
                        } 

                        
           
                    } 
                     if ($tasks->count() == 0) {
        
             $list->delete();
                }
                

        
 
      

       }
        
    

    public function getEmployees() {
        $employees = User::Lists('name','id');
        return $employees;
    }



}





?>
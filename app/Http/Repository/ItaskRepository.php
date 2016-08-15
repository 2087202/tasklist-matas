<?php

namespace App\Http\Repository;

interface ItaskRepository {

	public function getAllLists();
	public function getListsByUser($userId);
	public function createListForUser($request);
	public function createTask($list);
	public function completeTask($id);
	public function deleteTask($id);
	public function deleteList($list);
	public function getEmployees();
	public function getTasksForList($list);
}



?>
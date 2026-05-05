<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
class TaskController extends Controller
{
public function index()
{
$tasks = auth()->user()->tasks()->latest()->get();
return view('tasks.index', compact('tasks'));
}
public function store(Request $request)
{
auth()->user()->tasks()->create([
'title' => $request->title
]);
return redirect()->back();
}
public function update(Task $task)
{
$task->is_done = !$task->is_done;
$task->save();
return redirect()->back();
}
public function destroy(Task $task)
{
$task->delete();
return redirect()->back();
}
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        // if (!$user || $user->role_id !== Role::ADMIN) {
        //     return response()->json([
        //         'error' => 'Unauthorized'
        //     ], 403);
        // }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'modul' => 'required|string',
        ]);

        $task = Task::create([
            'users_id' => $user->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'modul' => $request->modul,
        ]);

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ], 200);
    }

    public function update($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'task' => $task
        ], 200);
    }

    public function update_store(Request $request, $id)
    {
        $user = Auth::user();
        // if (!$user || $user->role_id !== Role::ADMIN) {
        //     return response()->json([
        //         'error' => 'Unauthorized'
        //     ], 403);
        // }

        $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'modul' => 'sometimes|required|string',
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        $task->update($request->only(['judul', 'deskripsi', 'modul']));

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PostRepository;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository $tasks
     * @return void
     */
    public function __construct(PostRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request $request
     * @return Response
     */
    public function index(Request $request)
    {


        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
}

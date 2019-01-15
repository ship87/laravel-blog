<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\BlogService;

class PostController extends Controller
{
    /**
     * Display a list of all of the user's task.
     *
     * @param  Request $request
     * @return Response
     */
    public function index(BlogService $blogService, $id, $slug)
    {

        $post = $blogService->getPost($id, $slug);

        if (! $post) {
            abort(404);
        }

        dd($post);

        // echo $id;

        //  echo $slug;

        // return view('tasks.index', [
        //     'tasks' => $this->tasks->forUser($request->user()),
        // ]);
    }
}

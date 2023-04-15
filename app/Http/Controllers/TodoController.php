<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $todos = $this->getTodos(request('search'));
        return view('todos.index', [
            'todos' => $todos,
            'categories' => $categories
        ]);
    }

    private function getTodos($search) {
        if (!isset($search)) {
            $todos = Todo::orderBy('prior', 'asc')->paginate(10)->withQueryString();
        } else {
            $todos = Todo::where('name', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        }
        return $todos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('todos.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'prior' => 'required|max:99',
            'category_id' => 'required'
        ]);
        Todo::create([
            'name' => $request->name,
            'prior' => $request->prior,
            'category_id' => $request->category_id
        ]);
        return redirect()->route('todos.index')->with('message', 'Todo successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $categories = Category::all();
        return view('todos.update', [
            'categories' => $categories,
            'todo' => $todo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'name' => 'required|min:3',
            'prior' => 'required|max:99',
            'category_id' => 'required'
        ]);
        $todo->update([
            'name' => $request->name,
            'prior' => $request->prior,
            'category_id' => $request->category_id
        ]);
        return redirect()->route('todos.index')->with('message', 'Todo successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('message', 'Todo successfully deleted');
    }

    
    public function todosByCategory($id) {
        if ($id == 9999) {
            $todos = Todo::orderBy('prior', 'asc')->paginate(10)->withQueryString();
        } else {
            $todos = Todo::where('category_id', $id)
                ->orderBy('prior', 'asc')
                ->paginate(10)->withQueryString();
        }
        $categories = Category::all();
        
        return view('todos.index', [
            'todos' => $todos,
            'categories' => $categories
        ]);
    }
}

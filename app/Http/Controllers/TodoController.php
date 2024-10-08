<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request('search')){
            $data = Todo::where('task', 'like','%')->get();


        }

        $data = Todo::orderBy('task', 'asc')->get(); 
        
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:3',
        ],
        [
            'task.required' => 'Task harus ada kata eraa',
            'task.min' => 'task minimal 3 karakter',
            'task.max' => 'task minimal 25 karakter ep ep',
        ]
    
         );

         $data = [
            'task'=> $request->input('task')
         ];

         Todo::create($data);
         return redirect()->route('todo')->with('success','Berhasil nyimpen kenangan ama dia');
    }

        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3',
        ],
        [
            'task.required' => 'Task harus ada kata eraa',
            'task.min' => 'task minimal 3 karakter',
            'task.max' => 'task minimal 25 karakter ep ep',
        ]);

        $data = [
            'task'=> $request->input('task'),
            'is_done'=> $request->input('is_done')
            
         ];

         Todo::where('id', $id)->update($data);
         return redirect()->route('todo')->with('success', 'Berhasil nyimpen data diaa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil delete data diaa');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Todo as TodoModal;
use Livewire\Component;

class Todo extends Component
{

    // Variables for todo action

    public $todo_action_type = null;
    public $todo_action_title = null;
    public $todo_action_description = null;
    public $todo_action_id = null;

    public function render()
    {

        $todoQuery = TodoModal::query();
        $todoQuery->whereCreatedBy(auth()->id());
        $todoQuery->orderby('created_at');
        $todos = $todoQuery->get();

        return view('livewire.todo', compact('todos'))->extends('layouts.app')->section('content');
    }

    public function create(){
        $this->todo_action_type = "Create";
        $this->dispatchBrowserEvent('toggleModalTodo');
    }

    public function store(){
        $this->validate([
            'todo_action_title'         =>    'required|max:70',
            'todo_action_description'   =>     'required',
        ]);
        TodoModal::create([
            'title'         =>  $this->todo_action_title,
            'description'   =>  $this->todo_action_description,
            'created_by'    => auth()->id(),
        ]);


        $this->resetAll();
        $this->dispatchBrowserEvent('toggleModalTodo');
    }

    public function edit($id){

        $todoQuery = TodoModal::query();
        $todoQuery->whereCreatedBy(auth()->id());
        $todo = $todoQuery->find($id);

        $this->todo_action_type = "Edit";
        $this->todo_action_title = $todo->title;
        $this->todo_action_description = $todo->description;
        $this->todo_action_id = $todo->id;

        $this->dispatchBrowserEvent('toggleModalTodo');
    }

    public function update(){
        $this->validate([
            'todo_action_title'         =>    'required|max:70',
            'todo_action_description'   =>     'required',
        ]);

        TodoModal::whereId($this->todo_action_id)
        ->whereCreatedBy(auth()->id())
        ->update([
            'title'         =>  $this->todo_action_title,
            'description'   =>  $this->todo_action_description,
            'created_by'    =>  auth()->id(),
        ]);


        $this->resetAll();
        $this->dispatchBrowserEvent('toggleModalTodo');
    }

    public function delete($id){

        $todoQuery = TodoModal::query();
        $todoQuery->whereId($id);
        $todoQuery->whereCreatedBy(auth()->id());
        $todoQuery->delete();

        return true;
    }


    public function toogleisCompleted($id){
        $todoQuery = TodoModal::query();
        $todoQuery->whereCreatedBy(auth()->id());
        $todo = $todoQuery->find($id);

        if($todo->is_completed){
            $todo->update(["is_completed" => false]);
        }else{
            $todo->update(["is_completed" => true]);
        }

    }

    public function resetAll(){
        $this->todo_action_type = null;
        $this->todo_action_title = null;
        $this->todo_action_description = null;
        $this->todo_action_id = null;

        $this->dispatchBrowserEvent('toggleModalTodo');
    }
}

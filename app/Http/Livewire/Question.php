<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Question extends Component
{
    public $model;

    public $message;

    public $questions;

    public function mount(){//este metodo funciona muy similar al metodo constructor
        $this->getQuestions();
    }

    public function getQuestions(){
        $this->questions = $this->model
                    ->questions()
                    ->orderBy('created_at','desc')
                    ->get();
    }

    public function store(){

        $this->validate([
            'message' => 'required',
        ]);
        $this->model->questions()->create([
            'body' => $this->message,
            'user_id' => auth()->id(),
        ]);

        $this->getQuestions();

        $this->message = "";
    }

    public function edit($questionId){
        dd('se editará el componente'.$questionId);
    }
    public function destroy($questionId){
        dd('se  eliminará el componente');
    }
    public function render()
    {
        return view('livewire.question');
    }
}

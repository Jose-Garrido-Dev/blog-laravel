<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Question extends Component
{
    public $model;

    public $message;

    public function store(){
        $this->model->questions()->create([
            'body' => $this->message,
            'user_id' => auth()->id(),
        ]);

        $this->message = "";
    }
    public function render()
    {
        return view('livewire.question');
    }
}

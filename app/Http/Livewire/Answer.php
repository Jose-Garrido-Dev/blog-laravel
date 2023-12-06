<?php

namespace App\Http\Livewire;

use App\Models\Answer as ModelsAnswer;

use Livewire\Component;

class Answer extends Component
{

    public $question;

    public $answers;

    public $open=false;

    public $answer_created = [
        'open' => false,
        'body' => '',
    ];

    public $answer_edit = [
        'id' => null,
        'body' => ''
    ];

    public $answer_to_answer = [
        'open' => false,
        'body' => '',
    ];

    public function mount(){
        $this->getAnswers();
    }

    public function getAnswers(){
        $this->answers = $this->question->answers()
                        ->when(!$this->open, function($query){
                            $query->take(0);
                        })
                        ->orderBy('id','desc')
                        ->get();
    }

    public function store(){

        $this->validate([
            'answer_created.body' => 'required',
        ]);
        $this->question->answers()->create([
            'body' => $this->answer_created['body'],
            'user_id' => auth()->id(), 
        ]);
        $this->reset('answer_created');
        $this->getAnswers();
    }

    public function edit($answerId){
        $answer = ModelsAnswer::find($answerId);

        $this->answer_edit = [
            'id' => $answer->id,
            'body' => $answer->body
        ];
    }

    public function update(){

        $this->validate([
            'answer_edit.body' => 'required'
        ]);
        $answer = ModelsAnswer::find($this->answer_edit['id']);
        $answer->update([
            'body' => $this->answer_edit['body']
        ]); 

        $this->getAnswers();

        $this->reset('answer_edit');
    } 

    public function cancel(){
        $this->reset('answer_edit');
    }

    public function destroy($answerId){
        $answer = ModelsAnswer::find($answerId);
        $answer->delete();
        $this->getAnswers();

        $this->reset('answer_edit');
    }

    public function show_answer(){
        $this->open = true;
        $this->reset('answer_created');
        $this->getAnswers();

    }


    public function render()
    {
        return view('livewire.answer');
    }
}

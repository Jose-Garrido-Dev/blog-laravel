<div>
    @auth
    <div class="flex">
        <figure class="mr-4">
            <img class="w-12 h-12 object-cover object-center rounded-full" src="{{auth()->user()->profile_photo_url}}" alt="">
        </figure>

        <div class="flex-1">
            <form wire:submit.prevent="store">
                <textarea wire:model.defer="message" name="" rows="3" class="border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm w-full" placeholder="Escribe tu mensaje"></textarea>
               <x-input-error for="message" class="mt-1"/>
                <div class="flex justify-end">
                    <x-button class="mt-2">
                        Comentar
                    </x-button>
               </div>
               

            </form>
            
       </div>  
    </div>
    
    @endauth
    <p class="text-lg font-semibold mt-6 mb-4 text-gray-800">
        Comentarios:
    </p>
    <hr class="h-px my-8 bg-gray-200 border-0 ">
    <ul class="space-y-6">
        @foreach ($questions as $question)
            <li wire:key="question-{{$question->id}}">
                <div class="flex">
                    <figure class="mr-4">
                        @if($question->user && $question->user->profile_photo_url)
                            <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ $question->user->profile_photo_url }}" alt="">
                        @else
                            <!-- Mostrar una imagen por defecto o un marcador de posición si la imagen no está disponible -->
                            <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ asset('ruta/a/imagen/por/defecto.jpg') }}" alt="">
                        @endif
                    </figure>
                    <div class="flex-1">
                        <p class="font-semibold">
                            @if($question->user)
                                {{ $question->user->name }}
                            @else
                                Usuario Anónimo
                            @endif
                            <span class="text-sm font-normal">
                                {{$question->created_at->diffForHumans()}}
                            </span>
                        </p>
                        @if ($question->id == $question_edit['id'])

                            <form wire:submit.prevent="update">
                                @csrf
                                <textarea wire:model="question_edit.body" class="border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm w-full" ></textarea>
                                
                                <x-input-error for="question_edit.body" class="mt-1" />


                                <div class="flex justify-end">
                                    <x-danger-button wire:click="cancel" class="mr-2">
                                        Cancelar
                                    </x-danger-button>
                                    <x-button>
                                        Actualizar
                                    </x-button>
                                </div>
                            </form>


                        @else
                            <p>
                                {{$question->body}}
                            </p>                 
                        @endif

                    </div>
                    {{--dropdown--}}
                    @role('Admin')
                    <div class="ml-8">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link class="cursor-pointer" wire:click="edit({{$question->id}})">
                                    Editar
                                </x-dropdown-link>
                                <x-dropdown-link class="cursor-pointer" wire:click="destroy({{$question->id}})">
                                    Eliminar
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endrole
                </div>

                 @livewire('answer',compact('question'), key('answer-'.$question->id))
            </li>
        @endforeach 
    </ul>

    @if ($model->questions->count()-$cant > 0)
        

    <div class="mt-4 rounded-lg flex">
        <hr class="flex-1">
        <button class=" border 1 px rounded-full text-gray-500"
        wire:click="show_more_question">
            Ver los {{$model->questions->count()-$cant}} comentarios restantes
        </button>
        <hr class="flex-1">
    </div>

    @endif

</div>

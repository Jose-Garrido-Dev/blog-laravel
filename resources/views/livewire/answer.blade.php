<div class="pl-16">
    @auth
    <button wire:click="$set('answer_created.open', true)">
        <i class="fas fa-reply text-blue-600"></i>
        responder
    </button>
    @endauth
    @if ($answer_created['open'])
        <div class="flex">
            <figure class="mr-4">
                @if($question->user && $question->user->profile_photo_url)
                    <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ $question->user->profile_photo_url }}" alt="">
                @endif
            </figure>
            <form class="flex-1" wire:submit.prevent="store" placeholder="Escriba su respuesta" class="border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        @csrf
                        <textarea wire:model="answer_created.body" class="border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm w-full" ></textarea>
                        
                        <x-input-error for="answer_created.body" class="mt-1" />


                        <div class="flex justify-end">
                            <x-danger-button class="mr-2" wire:click="$set('answer_created.open', false)">
                                Cancelar
                            </x-danger-button>
                            <x-button>
                                Responder
                            </x-button>
                        </div>
            </form>


        </div>
        
    @endif
@if($question->answers->count()> 0)
    <div class="mt-2">
        <button class="font-semibold text-blue-500" wire:click="show_answer">
            {{ $open ? 'Ocultar respuestas' : 'Mostrar respuestas' }}
        </button>
    </div>
@endif
    {{--Aqui se listarán las respuestas--}}
    <ul class="space-y-6 mt-4">
        @foreach($answers as $answer)
            <li wire:key="answer-{{$answer->id}}">
                <div class="flex">

                    

                    <figure class="mr-4">
                        @if($question->user && $question->user->profile_photo_url)
                            <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ $answer->user->profile_photo_url }}" alt="">
                        @endif
                    </figure>

                    <div class="flex-1">
                        <p class="font-semibold">
                            {{$answer->user->name}}

                            <span class="text-sm font-normal">
                                {{$answer->created_at->diffForHumans()}}
                            </span>
                        </p>

                            <p>
                                {{$answer->body}}
                            </p>
                     {{--       @auth
                            <button wire:click="$set('answer_created.open', true)" class="text-blue-600">
                                <i class="fas fa-reply"></i>
                                responder
                            </button>
                            @endauth --}}

                    </div>
                    @role('Admin')
                    <div class="ml-8">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link class="cursor-pointer" wire:click="edit({{$answer->id}})">
                                    Editar
                                </x-dropdown-link>
                                <x-dropdown-link class="cursor-pointer" wire:click="destroy({{$answer->id}})">
                                    Eliminar
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endrole

                </div>

            </li>
            @if ($answer->id == $answer_edit['id'])

            <form wire:submit.prevent="update">
                @csrf
                <textarea wire:model="answer_edit.body" class="border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm w-full" ></textarea>
                
                <x-input-error for="answer_edit.body" class="mt-1" />
        
        
                <div class="flex justify-end">
                    <x-danger-button wire:click="cancel" class="mr-2">
                        Cancelar
                    </x-danger-button>
                    <x-button>
                        Actualizar
                    </x-button>
                </div>
            </form>
            
            @endif
                
        @endforeach
    
    </ul>   

</div>
           
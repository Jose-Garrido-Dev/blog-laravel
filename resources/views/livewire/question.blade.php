<div>
    <div class="flex">
        <figure class="mr-4">
            <img class="w-12 h-12 object-cover object-center rounded-full" src="{{auth()->user()->profile_photo_url}}" alt="">
        </figure>

        <div class="flex-1">
            <form wire:submit.prevent="store">
                <textarea wire:model="message" name="" rows="3" class="border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm w-full" placeholder="Escribe tu mensaje"></textarea>
               <div class="flex justify-end">
                    <x-button class="mt-2">
                        Comentar
                    </x-button>
               </div>

            </form>
       </div>  
    </div>
</div>

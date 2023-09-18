<x-layout>
    
    <a href="/" class="inline-block text-black ml-4 mb-4"
                    ><i class="fa-solid fa-arrow-left"></i> Natrag
                </a>
                <div class="mx-4">
                    <x-card class="p-10">
                        <div
                            class="flex flex-col items-center justify-center text-center">
                            <h3 class="text-2xl mb-2">{{$user->name}}</h3>
                            <div class="text-xl font-bold mb-4">{{$user->email}}</div>
                            <div class="text-xl font-bold mb-4">{{$user->role}}</div>
                </div>
    
    </x-layout>
<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24"
                    >
                        <header class="text-center">
                            <h2 class="text-2xl font-bold uppercase mb-1">
                                Uredite!
                            </h2>
                            <p class="mb-4">Uredite: {{$user->name}}</p>
                        </header>
    
                        <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-6">
                                <label
                                    for="name"
                                    class="inline-block text-lg mb-2"
                                    >Ime Korisnika</label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="name" value="{{$user->name}}"
                                    placeholder="Primjer: Ime Prezime"
                                />
    
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label for="email" class="inline-block text-lg mb-2"
                                    >Email</label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="email" value="{{$user->email}}"
                                    placeholder="Primjer: email@gmail.com"
                                />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label
                                    for="password"
                                    class="inline-block text-lg mb-2"
                                    >Lozinka</label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="password" value="" type="password"
                                    placeholder="Lozinka mora imati najmanje 6 znakova!"
                                />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <button
                                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                                >
                                    Ažuriraj
                                </button>
    
                                <a href="/" class="text-black ml-4"> Natrag </a>
                            </div>
                        </form>
    </x-card>
    </x-layout>
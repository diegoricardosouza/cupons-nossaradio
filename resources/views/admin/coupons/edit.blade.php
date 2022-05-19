<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            {{ __('Editar Cupom') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <ul class="flex items-center mt-5">
            <li class="flex items-center ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-neutral-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <a href="{{ route('dashboard') }}" class="text-sm ml-1.5 font-semibold text-neutral-500 transition-all hover:text-violet-900">Home</a>
            </li>
            <li class="mx-1 text-neutral-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li>
                <a href="{{ route('coupons.index') }}" class="text-sm font-semibold text-neutral-500 transition-all hover:text-violet-900">Cupons</a>
            </li>
            <li class="mx-1 text-neutral-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li class="text-sm text-violet-900 font-semibold">
                Editar Cupom <span class="font-bold">{{ $coupon->name }}</span>
            </li>
        </ul>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg px-5 py-5">
                <form action="{{ route('coupons.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="flex">
                        <div class="flex-auto">
                            <div>
                                <label class="block">
                                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700">Nome</span>
                                    <input type="text" name="name" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" value="{{ $coupon->name ?? old('name') }}" />
                                </label>

                                @if ($errors->has('name'))
                                    <div class="text-red-700 mt-1 font-semibold text-sm">
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4">
                                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700 mb-3">Imagem</span>
                                <div class="flex items-center space-x-6">
                                    <div class="shrink-0">
                                        <img class="h-16 w-16 object-cover rounded-full preview-image" src="{{ url("storage/{$coupon->image}") }}" alt="{{ $coupon->name }}" />
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose profile photo</span>
                                        <input type="file" name="image" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-violet-50 file:text-violet-700
                                        hover:file:bg-violet-100
                                        "/>
                                    </label>
                                </div>

                                @if ($errors->has('image'))
                                    <div class="text-red-700 mt-1 font-semibold text-sm">
                                        <div class="error">{{ $errors->first('image') }}</div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4">
                                <label class="block">
                                    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700">Validade</span>
                                    <input type="date" name="validity" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" value="{{ $coupon->validity ?? old('validity') }}"
                                    pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"/>
                                </label>

                                @if ($errors->has('validity'))
                                    <div class="text-red-700 mt-1 font-semibold text-sm">
                                        <div class="error">{{ $errors->first('validity') }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="w-64 pl-6">
                            <div>
                                @if($cities)
                                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700 mb-3">Cidades</span>

                                    @foreach($cities as $city)
                                    <label class="flex items-center mb-1">
                                        <input type="checkbox" name="city[]" class="appearance-none checked:bg-violet-900"
                                        value="{{ $city->id }}"
                                        @if(in_array($city->id, $coupon->cities->pluck('id')->toArray())) checked @endif
                                        />
                                        <span class="ml-2 font-semibold text-slate-700 text-sm">{{ $city->name; }}</span>
                                    </label>
                                    @endforeach

                                    @if ($errors->has('name'))
                                        <div class="text-red-700 mt-1 font-semibold text-sm">
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="shadow bg-violet-900 hover:bg-violet-700 transition-all focus:shadow-outline focus:outline-none text-white font-bold py-2 px-8 rounded-full">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.querySelector('input[type=file]');
        const previewImage = document.querySelector('.preview-image');

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                previewImage.src = reader.result;
            });

            reader.readAsDataURL(file);
        });
    </script>
</x-app-layout>

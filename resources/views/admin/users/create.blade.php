<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            {{ __('Criar Usuário') }}
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
                <a href="{{ route('users.index') }}" class="text-sm font-semibold text-neutral-500 transition-all hover:text-violet-900">Usuários</a>
            </li>
            <li class="mx-1 text-neutral-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li class="text-sm text-violet-900 font-semibold">
                Adicionar Novo Usuário
            </li>
        </ul>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg px-5 py-5">
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label class="block">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700">Nome</span>
                            <input type="text" name="name" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" value="{{ old('name') }}" />
                        </label>

                        @if ($errors->has('name'))
                            <div class="text-red-700 mt-1 font-semibold text-sm">
                                <div class="error">{{ $errors->first('name') }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <label class="block">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700">E-mail</span>
                            <input type="email" name="email" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" value="{{ old('email') }}" />
                        </label>

                        @if ($errors->has('email'))
                            <div class="text-red-700 mt-1 font-semibold text-sm">
                                <div class="error">{{ $errors->first('email') }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <label class="block">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700">Senha</span>
                            <input type="password" name="password" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" value="{{ old('password') }}" />
                        </label>

                        @if ($errors->has('password'))
                            <div class="text-red-700 mt-1 font-semibold text-sm">
                                <div class="error">{{ $errors->first('password') }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <label class="block">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-semibold text-slate-700">Confirmar Senha</span>
                            <input type="password" name="password_confirmation" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" value="" />
                        </label>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="shadow bg-violet-900 hover:bg-violet-700 transition-all focus:shadow-outline focus:outline-none text-white font-bold py-2 px-8 rounded-full">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

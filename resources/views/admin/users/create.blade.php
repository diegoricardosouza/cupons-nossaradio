<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
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

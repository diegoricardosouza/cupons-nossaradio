<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                {{ __('Lista de Emails') }}
            </h2>

            <a href="{{ route('list.export') }}" class="flex items-center justify-center bg-green-700 hover:bg-green-600 transition-all rounded-full py-2 px-4 text-white text-xs uppercase">Exportar Emails</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center mt-5 justify-between">
        <div>
            <ul class="flex items-center">
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
                <li class="text-sm text-violet-900 font-semibold">
                    Lista de Emails
                </li>
            </ul>
        </div>

        <div>
            <a href="{{ route('list.create') }}" class="flex items-center justify-center bg-violet-900 hover:bg-violet-700 transition-all rounded-full py-2 px-2 pr-4 ml-4 text-white text-xs uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>

                Novo Email
            </a>
        </div>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('user_success'))
                <div class="bg-green-500 rounded-md py-3 px-3 mb-3 text-green-900">
                    {{ session()->get('user_success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-auto">
                @if($mails->total() > 0)
                <table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-violet-900 text-left text-xs font-semibold text-white uppercase tracking-wider"
                            >
                                E-mail
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-violet-900 text-xs font-semibold text-white uppercase tracking-wider w-36 text-center"
                            >
                                A????es
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($mails as $mail)
                        <tr>

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold">
                                {{ $mail->email }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('list.edit', $mail->id) }}" class="text-blue-600 mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('list.destroy', $mail->id) }}" class="flex" method="post">
                                        @csrf
                                        @method("DELETE")

                                        <button class="text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="p-3 rounded-md bg-blue-700 text-white">Nenhum email cadastrado!</div>
                @endif
            </div>

            @if($mails->total() > '6')
                <div class="mt-5">
                    @if(isset($dataForm))
                        {!! $mails->appends($dataForm)->links() !!}
                    @else
                        {!! $mails->links() !!}
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

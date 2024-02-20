<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QuechuLAB') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Aquí puedes empezar a agregar tu contenido -->
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-6 text-gray-500">
                        <!-- Aquí puedes utilizar los datos que pasaste desde el controlador -->
                        <!-- Por ejemplo, si pasaste una lista de usuarios, podrías hacer algo como esto: -->
                        <!--
                        -->
                        @livewire('dashboard')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
   
</x-app-layout>

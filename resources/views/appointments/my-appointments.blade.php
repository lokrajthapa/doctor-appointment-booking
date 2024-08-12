<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My  Appointments') }}
        </h2>
    </x-slot>



    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @foreach ($my_appointments as $my_appointment)

                <div class="container mx-auto bg-teal-400 h-20 m-4 rounded-lg">
                   <p class="text-center ">   Your  appointment is on {{ $my_appointment->appointment_time }} </p>
                </div>

                @endforeach




            </div>
        </div>
    </div>
</x-app-layout>

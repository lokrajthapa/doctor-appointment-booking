<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All  Appointments') }}
        </h2>
    </x-slot>



    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             <a href="{{ route('appointments.create') }}"> <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Book Appointment </button>      </a>
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                         <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                              {{ session('success') }}
                          </div>
                    @endif


                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Appointment Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Department name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($appointments)

                            @foreach ($appointments as $appointment)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $appointment->user_type }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $appointment->department_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $appointment->appointment_time }}
                                    </td>
                                    <td class="px-6 py-4">

                                        {{-- <a href="{{ route('appointments.edit', $appointment->id) }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Edit</a> --}}
                                        <form action="{{ route('appointments.destroy',$appointment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                           @endif

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

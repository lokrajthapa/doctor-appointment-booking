<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
             @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                  <form class="max-w-sm mx-auto" action="{{ route('appointments.store') }}" Method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                          <div class="mb-5">

                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}" />
                            <label for="Name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment Type</label>
                            <select id="appointment_type" name="appointment_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>choose Appointment Type</option>
                                <option value="virtual"> Virtual</option>
                                <option value="physical">Physical</option>

                            </select>
                        </div>
                        <div class="mb-5">
                         <label for="Department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Name</label>
                            <select id="department_id" name="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected >choose Department</option>
                                    @foreach ($departments as $department)
                                      <option value="{{ $department->id }}" > {{ $department->name  }}</option>
                                    @endforeach

                            </select>
                        </div>
                        <div class="mb-5">
                          <label for="Doctor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">   Doctor Name</label>
                          <select id="doctor_id" name="doctor_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option >choose doctor</option>
                        </select>
                        </div>
                        <div class="mb-5">
                            <label for="Appointment Time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment date</label>
                            <input type="date" id="appointment_time" name="appointment_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=""  />
                        </div>
                        <div class="mb-5">
                        <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Create Appointment</button>
                    </div>

            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const departmentSelect = document.getElementById('department_id');
                    const doctorSelect = document.getElementById('doctor_id');

                    const doctors = @json(
                        $departments->mapWithKeys(function ($department) {
                            return [$department->id => $department->doctors->pluck('name', 'id')];
                        }));

                    departmentSelect.addEventListener('change', function() {
                        const departmentId = departmentSelect.value;
                        const doctorsOptions = doctors[departmentId] || {};

                        doctorSelect.innerHTML = '<option value="">Select a Doctor</option>';

                        Object.keys(doctorsOptions).forEach(function(doctorId) {
                            const option = document.createElement('option');
                            option.value = doctorId;
                            option.textContent = doctorsOptions[doctorId];
                            doctorSelect.appendChild(option);
                        });
                    });
                });
            </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

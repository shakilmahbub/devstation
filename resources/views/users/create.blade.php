<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create user') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="p-6 text-gray-900 bg-white">
            <form method="post" action="{{ route('users.store') }}" class="bg-white p-6 rounded-lg">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="name">
                        Name
                    </label>
                    <input
                        class="form-control" id="name" name="name" type="text" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="email">
                        Email
                    </label>
                    <input class="form-control" id="email" name="email" type="email" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="role">
                        Role
                    </label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="0">Admin</option>
                        <option value="1">Employee</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="password">
                        Password
                    </label>
                    <input class="form-control" id="password" type="password" name="password" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="confirm_password">
                        Confirm Password
                    </label>
                    <input class="form-control" id="confirm_password" type="password" name="password_confirmation" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="btn btn-info">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>


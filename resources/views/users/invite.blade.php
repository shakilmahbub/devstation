<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invite user') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="p-6 text-gray-900 bg-white">
            <form method="post" action="{{ route('users.invite') }}" class="bg-white p-6 rounded-lg">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="email">
                        Email
                    </label>
                    <input class="form-control" id="email" name="email" type="email" required />
                </div>
                <input type="hidden" name="project_id" value="{{ $project_id }}">
                <div class="flex items-center justify-between">
                    <button
                        class="btn btn-info">
                        Invite
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>


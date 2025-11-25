<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit User</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.users.form')

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                Update User
            </button>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
        <p class="mt-3 text-gray-600">Selamat datang, Admin PNGLab!</p>

        <div class="grid grid-cols-3 gap-6 mt-6">
            <a href="{{ route('categories.index') }}" class="p-6 bg-white shadow rounded-lg">
                <h3 class="font-semibold text-lg">Manage Categories</h3>
            </a>

            <a href="{{ route('admin.courses.index') }}" class="p-6 bg-white shadow rounded-lg">
                <h3 class="font-semibold text-lg">Manage Courses</h3>
            </a>

            <a href="#" class="p-6 bg-white shadow rounded-lg">
                <h3 class="font-semibold text-lg">Manage Users</h3>
            </a>
        </div>
    </div>
</x-app-layout>

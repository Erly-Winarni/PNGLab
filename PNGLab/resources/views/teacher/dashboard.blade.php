<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold">Teacher Dashboard</h1>
        <p class="mt-3 text-gray-600">Selamat datang, Teacher PNGLab!</p>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <a href="{{ route('courses.index') }}" class="p-6 bg-white shadow rounded-lg">
                <h3 class="font-semibold text-lg">Course yang Anda Ajar</h3>
            </a>

            <a href="{{ route('contents.index') }}" class="p-6 bg-white shadow rounded-lg">
                <h3 class="font-semibold text-lg">Materi Pembelajaran</h3>
            </a>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">User Profile</h1>

            {{-- Tombol Edit Profile --}}
            <a href="{{ route('profile.edit') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Edit Profil
            </a>
        </div>

        {{-- Biodata --}}
        <div class="bg-white p-5 rounded-xl shadow mb-6">
            <h2 class="text-xl font-semibold mb-3">Informasi Pengguna</h2>

            {{-- Avatar --}}
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}"
                     class="w-24 h-24 object-cover rounded-full mb-4 border" alt="Avatar">
            @endif

            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

            {{-- Tambahan kolom password --}}
            <div class="flex items-center gap-3 mt-3">
                <p><strong>Password:</strong> ••••••••••</p>

                <a href="{{ route('profile.password.edit') }}"
                   class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm">
                    Edit Password
                </a>
            </div>
        </div>

        {{-- Student --}}
        @if ($user->role === 'student')
            <div class="bg-white p-5 rounded-xl shadow">
                <h2 class="text-xl font-semibold mb-4">Kursus yang Diikuti</h2>

                @forelse ($courses as $course)
                    <div class="mb-5 border-b pb-3">
                        <h3 class="text-lg font-bold">{{ $course->title }}</h3>
                        <p class="text-sm text-gray-600">Pengajar: {{ $course->teacher->name }}</p>

                        <div class="mt-2">
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-green-500 h-3 rounded-full"
                                     style="width: {{ $course->progress }}%"></div>
                            </div>
                            <p class="text-sm mt-1">Progress: {{ $course->progress }}%</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum mengikuti kursus apapun.</p>
                @endforelse
            </div>
        @endif

        {{-- Teacher --}}
        @if ($user->role === 'teacher')
            <div class="bg-white p-5 rounded-xl shadow">
                <h2 class="text-xl font-semibold mb-4">Kursus yang Diajar</h2>

                @forelse ($courses as $course)
                    <div class="mb-5 border-b pb-3">
                        <h3 class="text-lg font-bold">{{ $course->title }}</h3>
                        <p>Kategori: {{ $course->category->name }}</p>
                        <p><strong>Jumlah Student:</strong> {{ $course->students_count }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum membuat kursus apapun.</p>
                @endforelse
            </div>
        @endif

        {{-- Admin --}}
        @if ($user->role === 'admin')
            <div class="bg-white p-5 rounded-xl shadow">
                <h2 class="text-xl font-semibold mb-4">Statistik Platform</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-blue-100 p-4 rounded-xl text-center">
                        <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                        <p class="text-gray-600 text-sm">Total Users</p>
                    </div>

                    <div class="bg-green-100 p-4 rounded-xl text-center">
                        <p class="text-2xl font-bold">{{ $totalStudents }}</p>
                        <p class="text-gray-600 text-sm">Students</p>
                    </div>

                    <div class="bg-yellow-100 p-4 rounded-xl text-center">
                        <p class="text-2xl font-bold">{{ $totalTeachers }}</p>
                        <p class="text-gray-600 text-sm">Teachers</p>
                    </div>

                    <div class="bg-red-100 p-4 rounded-xl text-center">
                        <p class="text-2xl font-bold">{{ $totalCourses }}</p>
                        <p class="text-gray-600 text-sm">Courses</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>

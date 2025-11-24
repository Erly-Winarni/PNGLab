<x-app-layout>

<div class="p-6">
    {{-- Success/Error Messages --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Global Course Management</h1>

        {{-- Link CREATE diarahkan ke route Admin --}}
        <a href="{{ route('admin.courses.create') }}"
           class="bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-800 transition shadow-md">
            <i class="fas fa-plus mr-1"></i> Create New Course
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
        <table class="min-w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 font-bold text-sm text-gray-600 uppercase tracking-wider border-b-2">Title</th>
                    <th class="px-6 py-3 font-bold text-sm text-gray-600 uppercase tracking-wider border-b-2">Category</th>
                    <th class="px-6 py-3 font-bold text-sm text-gray-600 uppercase tracking-wider border-b-2">Teacher</th>
                    <th class="px-6 py-3 font-bold text-sm text-gray-600 uppercase tracking-wider border-b-2">Status</th>
                    <th class="px-6 py-3 font-bold text-sm text-gray-600 uppercase tracking-wider border-b-2 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($courses as $course)
                    <tr class="border-t hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4">
                            {{-- Link VIEW menggunakan route publik (courses.show) atau jika Anda ingin khusus admin: route('admin.courses.show', $course->slug) --}}
                            <a href="{{ route('courses.show', $course->slug) }}"
                               class="text-blue-700 font-semibold hover:underline">
                                {{ $course->title }}
                            </a>
                        </td>

                        <td class="px-6 py-4">
                            {{ $course->category?->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4 font-medium">
                            {{-- Nama Teacher --}}
                            {{ $course->teacher->name ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $course->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center space-x-2 whitespace-nowrap">
                            
                            {{-- Link EDIT diarahkan ke route Admin --}}
                            <a href="{{ route('admin.courses.edit', $course->id) }}"
                               class="text-green-600 hover:text-green-800 transition duration-150 font-medium">Edit</a>

                            {{-- Form DELETE diarahkan ke route Admin --}}
                            <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kursus ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 font-medium">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada kursus yang terdaftar di sistem.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $courses->links() }}
    </div>
</div>


</x-app-layout>
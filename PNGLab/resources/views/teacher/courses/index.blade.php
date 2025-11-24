<x-app-layout>

    <div class="p-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Course Management</h1>

            <a href="{{ route('teacher.courses.create') }}"
               class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                + Create Course
            </a>
        </div>

        {{-- Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 font-semibold">Title</th>
                        <th class="px-4 py-2 font-semibold">Category</th>
                        <th class="px-4 py-2 font-semibold">Teacher</th>
                        <th class="px-4 py-2 font-semibold">Status</th>
                        <th class="px-4 py-2 font-semibold text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($courses as $course)
                        <tr class="border-t">
                            <td class="px-4 py-3">
                                <a href="{{ route('teacher.courses.show', $course->slug) }}"
                                   class="text-blue-700 font-semibold hover:underline">
                                    {{ $course->title }}
                                </a>
                            </td>

                            <td class="px-4 py-3">
                                {{ $course->category?->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $course->teacher->name }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="px-3 py-1 text-sm rounded-lg
                                    {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $course->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('teacher.courses.show', $course->slug) }}" class="text-blue-600 hover:underline">View</a>

                                <a href="{{ route('teacher.courses.edit', $course->id) }}"
                                   class="text-green-600 hover:underline">Edit</a>

                                <form action="{{ route('teacher.courses.destroy', $course->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Delete this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>

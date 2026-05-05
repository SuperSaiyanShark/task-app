<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header -->
                    <h1 class="text-3xl font-bold mb-6">Task Manager</h1>

                    <!-- Add Task Form -->
                    <form method="POST" action="{{ route('tasks.store') }}" class="mb-8">
                        @csrf
                        <div class="flex gap-2">
                            <input
                                type="text"
                                name="title"
                                placeholder="Add a new task..."
                                required
                                class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            />
                            <button
                                type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
                            >
                                Add Task
                            </button>
                        </div>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </form>

                    <!-- Task List -->
                    @if($tasks->count() > 0)
                        <div class="space-y-2">
                            @foreach($tasks as $task)
                                <div class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                    <!-- Toggle Complete Button -->
                                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            type="submit"
                                            class="flex-shrink-0 text-xl {{ $task->is_done ? 'text-green-500' : 'text-gray-400 hover:text-yellow-500' }} transition"
                                            title="{{ $task->is_done ? 'Mark incomplete' : 'Mark complete' }}"
                                        >
                                            {{ $task->is_done ? '✓' : '○' }}
                                        </button>
                                    </form>

                                    <!-- Task Title -->
                                    <span class="flex-1 {{ $task->is_done ? 'line-through text-gray-400 dark:text-gray-500' : 'text-gray-900 dark:text-gray-100' }}">
                                        {{ $task->title }}
                                    </span>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="flex-shrink-0 text-red-600 hover:text-red-800 dark:hover:text-red-400 font-semibold transition"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">
                            No tasks yet. Create one to get started!
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

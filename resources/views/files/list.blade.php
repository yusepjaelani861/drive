<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <div class="overflow-hidden shadow-sm sm:rounded-lg mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name File
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Size
                            </th>
                            <th scope="col" class="px-6 py-3">
                                File Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Link Download
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Tools</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->files as $files)
                    <!-- Content -->
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 text-center">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $files->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ round($files->size / 1024 / 1024, 2) }} MB
                            </td>
                            <td class="px-6 py-4">
                                {{ $files->mime_type }}
                            </td>
                            <td class="px-6 py-4">
                                http://localhost:5000/files/{{ $files->short_url }}
                            </td>
                            <td class="px-6 py-4 text-right items-center justify-center">
                                <!-- Download Button -->
                                <button type="button" onclick="parent.open('/files/download/{{ $files->short_url }}')" class="ml-2 text-blue-600 dark:text-blue-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                </button>
                                <!-- Play Button -->
                                <button type="button" onclick="parent.open('/files/{{ $files->short_url }}')" class="ml-2 text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <!-- Delete Button -->
                                <button type="button" class="ml-2 text-blue-600 dark:text-blue-500 hover:underline" onclick="deleteFile('{{ $files->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="modal"></div>
            </div>
    </div>

</x-app-layout>

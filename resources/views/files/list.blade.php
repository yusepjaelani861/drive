<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-6">
            <!-- This is an example component -->
            <div class="max-w-7xl mx-auto">

            <div class="overflow-auto relative shadow-md sm:rounded-lg">
                <div class="p-4 float-right">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th>
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
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->files as $files)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-pre-line">
                                    {{ $files-> title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ round($files->size / 1024 / 1024, 2) }} MB
                                </td>
                                <td class="px-6 py-4">
                                    {{ $files->mime_type }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $files->original_url }}
                                </td>
                                <td class="flex px-6 py-4 text-right">
                                    <!-- Download Button -->
                                    <form action="{{ route('files.view', $files->short_url) }}" method="GET" target="_blank">
                                        <button type="submit" class="ml-2 text-blue-600 dark:text-blue-500 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </button>
                                    </form>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('files.delete', $files->short_url) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="ml-2 text-red-600 dark:text-red-500 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

    </div>

    <script>
        const search = document.getElementById('search');
        const table = document.querySelector('table');
        const tbody = table.querySelector('tbody');
        const tr = tbody.querySelectorAll('tr');

        search.addEventListener('keyup', () => {
            const searchValue = search.value.toLowerCase();
            tr.forEach(row => {
                const title = row.querySelector('th').textContent.toLowerCase();
                if (title.indexOf(searchValue) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

    </script>
</x-app-layout>

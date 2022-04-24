<?php
header('Access-Control-Allow-Origin: *');
?>
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="shadow-sm sm:rounded-lg max-w-7xl mx-auto py-12">
    <div class="max-w-fit mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex gap-8 items-center justify-center mt-4">
                <div id="mime-img" class="">
                <img src="https://safefileku.com/icon/mp4"/>
                </div>
                <!-- ... -->
                <div id="description" class="py-2">
                <p class="text-xl font-medium text-center mb-2 mx-4">{{ $file->title }}</p>
                <div class="grid grid-cols-2 gap-52 items-center justify-between my-2">
                    <span>Size:</span>
                    <span>{{ round($file->size / 1024 / 1024, 2) }} MB</span>
                </div>
                <div class="grid grid-cols-2 gap-52 items-center justify-between my-2">
                    <span>Download:</span>
                    <span>{{ $file->download_count }}</span>
                </div>
                <div class="grid grid-cols-2 gap-52 items-center justify-between my-2">
                    <span>Upload Date:</span>
                    <span>{{ date('d-m-Y', strtotime($file->created_at)) }}</span>
                </div>
                </div>
            </div>

            <div id="DownloadBtn" class="text-center mb-4">
                <button onclick="Download()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-ls px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Download
                </button>
            </div>
            <div id="IklanDirect" class="text-center mb-4">
                <a href="#" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xs text-xs px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4">
                    Fast Download
                </a>
            </div>
            <!-- Comment Box -->
                <form action="" class="w-full p-4">
                    <label class="block mb-2">
                    <span class="text-gray-600">Add a comment</span>
                    <textarea class="block w-full mt-1 rounded" rows="3"></textarea>
                    </label>
                    <button class="px-3 py-2 text-sm text-blue-100 bg-blue-600 rounded">Comment</button>
                </form>
        </div>
    </div>
    </div>
    <script>
        function Download()
        {
            var url = "{{ route('files.download', $file->short_url) }}";
            window.location.href = url;

        }

    </script>
    </div>
</x-guest-layout>

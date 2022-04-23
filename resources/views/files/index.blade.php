<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                    <label class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300" for="user_avatar">
                        Upload file
                    </label>
                    <input class="block w-full mb-4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="fileUpload" name="fileUpload" type="file">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                </form>
                <div class="h-6 mx-3 mb-3 mt-3 mr-3 relative max-w-xl rounded-full overflow-hidden">
                    <div class="w-full h-full bg-gray-200 absolute"></div>
                    <div id="bar" class="h-full bg-green-500 relative w-0"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let progress = 0;
        let invervalSpeed = 10;
        let incrementSpeed = 1;
        document.addEventListener("submit", function(){
            let bar = document.getElementById('bar');
            progressInterval = setInterval(function(){
                progress += incrementSpeed;
                bar.style.width = progress + "%";
                if(progress >= 100){
                    clearInterval(progressInterval);
                }
            }, invervalSpeed);
        });

    </script>
</x-app-layout>

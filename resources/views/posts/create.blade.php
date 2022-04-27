<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>
    <div class="py-5">
    <div class="max-w-8xl mx-auto sm:px-3 lg:px-5">
    <div class="overflow-hidden shadow-sm sm:rounded-lg">
    <form id="create-post">
    <div class="bg-white editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 max-w-7xl shadow-lg">
        <div class="grid grid-cols-1 space-y-2 mb-4">
            <div class="flex items-center justify-center w-full">
                <input name="file" id="file" type="file" onchange="readURL(event)" class="" accept="image/*">
                <img id="image-preview"/>
            </div>
        </div>
        <input name="title" id="title" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Title" type="text">
        <textarea id="body" name="body" class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" placeholder="Describe everything about this post here"></textarea>
        
        <!-- icons -->
        <div class="icons flex text-gray-500 m-2">
        <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
        <div id="count-bodytext" class="count ml-auto text-gray-400 text-xs font-semibold">300 characters remaining</div>
        </div>
        <!-- buttons -->
        <button type="submit" class="text-right border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-100 ml-2 bg-indigo-500">Post</button>
    </div>
    </form>
    </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
<script>
// Count Textarea Input Value
$(document).ready(function(){
    $('#text-body').keyup(function(){
        var text_length = $('#text-body').val().length;
        var text_remaining = 300 - text_length;
        $('#count-bodytext').text(text_remaining + ' characters remaining');
    });
});

// Preview Image after Upload 
var readURL = function(event) {
    if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('#image-preview').attr('src', event.target.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
}
var form = document.getElementById('create-post');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(form);
    $.ajax({
        type: 'POST',
        url: "{{ route('create.post') }}",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            if (data.success == true) {
                alert('Post created successfully');
                window.location.href = "{{ route('post.create') }}";
            } else {
                alert(data.error);
            }
        }
    });
});
</script>

<style>
    body {background:white !important;};
	.has-mask {
		position: absolute;
		clip: rect(10px, 150px, 130px, 10px);
	}
</style>
</x-app-layout>

<x-guest-layout>
<nav class="flex items-center justify-between flex-wrap bg-blue-600 p-6">
  <a href="/">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
    <span class="font-semibold text-xl tracking-tight">Drive MiteWP</span>
  </div>
  </a>
  <div class="block lg:hidden">
    <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
      <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
    </button>
  </div>
  <div class="w-full block lg:items-center lg:w-auto">
    <div>
      <a href="#" class="text-xl font-semibold px-6 py-2 rounded text-white mt-4">Join Us</a>
    </div>
  </div>
</nav>

    <div class="py-12">
    <div class="shadow-sm sm:rounded-lg max-w-7xl mx-auto py-12">
    <div class="max-w-fit mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex gap-8 items-center justify-center mt-4">
                <div id="mime-img" class="">
                    <svg width="120" height="120" viewBox="0 0 368 368" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <style>
                            .icon-text {
                                font: bold 80px sans-serif;
                            }
                    
                            .icon-text.realdrum {
                                font: bold 42px sans-serif;
                            }
                        </style>
                        <path d="M92 0C79.35 0 69 10.35 69 23V345C69 357.65 79.35 368 92 368H322C334.65 368 345 357.65 345 345V92L253 0H92Z" fill="#E2E5E7"></path>
                        <path d="M276 92H345L253 0V69C253 81.65 263.35 92 276 92Z" fill="#B0B7BD"></path>
                        <path d="M345 161L276 92H345V161Z" fill="#CAD1D8"></path>
                        <path d="M299 321C299 327.325 293.825 332.5 287.5 332.5H34.5C28.175 332.5 23 327.325 23 321V206C23 199.675 28.175 194.5 34.5 194.5H287.5C293.825 194.5 299 199.675 299 206V321Z" fill="{{ $rand_background }}"></path>
                        <path d="M287.5 332.5H69V344H287.5C293.825 344 299 338.825 299 332.5V321C299 327.325 293.825 332.5 287.5 332.5Z" fill="#CAD1D8"></path>
                        <text x="160" y="268" fill="white" class="icon-text mkv" text-anchor="middle" dominant-baseline="middle">{{ $file->extension }}</text>
                    </svg>
                </div>
                <!-- ... -->
                <div id="description" class="py-2 truncate">
                <p class="truncate text-xl font-medium text-center mb-2 mx-4">{{ $file->title }}</p>
                <div class="grid grid-cols-2 gap-5 items-center justify-between my-2">
                    <span>Size:</span>
                    <span>{{ round($file->size / 1024 / 1024, 2) }} MB</span>
                </div>
                <div class="grid grid-cols-2 gap-5 items-center justify-between my-2">
                    <span>Download:</span>
                    <span>{{ $file->download_count }}</span>
                </div>
                <div class="grid grid-cols-2 gap-5 items-center justify-between my-2">
                    <span>Upload Date:</span>
                    <span>{{ date('d-m-Y', strtotime($file->created_at)) }}</span>
                </div>
                </div>
            </div>

            <form  id="form-gcaptcha" class="text-center">
                <div class="flex justify-center mt-4">
                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                </div>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center">
                    Submit
                </button>
            </form>
            
            <div id="downloadFile" class="text-center mb-6">
                <a id="DownloadBtn" href="https://server1.mitewp.com/get/{{ $file->short_url }}" onclick="parent.open('https://marketingabsentremembered.com/ra61qgwp?key=fcb9030dd3ffd9d7396df51bb49b11bd')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-ls px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Download
                </a>
            </div>
            <!-- Download Button -->
            <!-- <form action="https://server1.mitewp.com/get/{{ $file->short_url }}" method="GET">
            <div id="download_element" class="text-center mb-6">
            <div id="recaptchav2" class="g-recaptcha"  data-sitekey="6Le4r5geAAAAABIlm-Tc-kTkog-L0sf-0XIjR3p6"></div>
                <button id="DownloadBtn" onclick="parent.open('https://marketingabsentremembered.com/ra61qgwp?key=fcb9030dd3ffd9d7396df51bb49b11bd')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-ls px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Download
                </button>
            </div>
            </form> -->

            <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                async defer>
            </script>

            <div id="IklanDirect" class="text-center mb-4">
                <a href="#" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xs text-xs px-2 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4">
                    Fast Download
                </a>
            </div>
            <!-- Comment Box -->
            <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v13.0&appId=990318908541854&autoLogAppEvents=1" nonce="ZEt4H1HX"></script>
<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments/drive.mitewp.com/{{ $file->short_url }}/{{ $file->title }}" data-width="" data-numposts="5"></div>
        </div>
    </div>
    
    </div>

    <div id="relate-upload" class="text-3xl py-4 px-5 mx-4 font-semibold">Relate Upload</div>
    
  <div class="grid lg:grid-cols-5 md:grid-cols-5 sm:grid-cols-2 grid-cols-1 gap-4 px-4 mx-5">
    @foreach ($files as $file)
    <!-- SMALL CARD ROUNDED -->
    <a href="{{ route('files.view', $file->short_url) }}">
    <div class="bg-gray-100 border-indigo-600 dark:bg-gray-100 bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-around cursor-pointer | hover:bg-indigo-400 dark:hover:bg-indigo-600 hover:border-transparent | transition-colors duration-500">
      <svg width="120" height="120" viewBox="0 0 368 368" fill="none" xmlns="http://www.w3.org/2000/svg">
          <style>
              .icon-text {
                  font: bold 80px sans-serif;
              }
      
              .icon-text.realdrum {
                  font: bold 42px sans-serif;
              }
          </style>
          <path d="M92 0C79.35 0 69 10.35 69 23V345C69 357.65 79.35 368 92 368H322C334.65 368 345 357.65 345 345V92L253 0H92Z" fill="#E2E5E7"></path>
          <path d="M276 92H345L253 0V69C253 81.65 263.35 92 276 92Z" fill="#B0B7BD"></path>
          <path d="M345 161L276 92H345V161Z" fill="#CAD1D8"></path>
          <path d="M299 321C299 327.325 293.825 332.5 287.5 332.5H34.5C28.175 332.5 23 327.325 23 321V206C23 199.675 28.175 194.5 34.5 194.5H287.5C293.825 194.5 299 199.675 299 206V321Z" fill="{{ $rand_background }}"></path>
          <path d="M287.5 332.5H69V344H287.5C293.825 344 299 338.825 299 332.5V321C299 327.325 293.825 332.5 287.5 332.5Z" fill="#CAD1D8"></path>
          <text x="160" y="268" fill="white" class="icon-text mkv" text-anchor="middle" dominant-baseline="middle">{{ $file->extension }}</text>
      </svg>
      <div class="flex flex-col justify-center truncate">
        <p class="truncate text-gray-900 dark:text-gray-900 font-semibold mx-2">{{ $file->title }}</p>
        <p class="text-black dark:text-gray-800 text-justify font-semibold mx-2">Size: {{ round($file->size / 1024 / 1024, 2) }} MB</p>
        <p class="text-black dark:text-gray-800 text-justify font-semibold mx-2">Format: {{ $file->extension }}</p>
        <p class="text-black dark:text-gray-800 text-justify font-semibold mx-2">{{ $file->created_at }}</p>
      </div>
    </div>
    </a>
    <!-- END SMALL CARD ROUNDED -->
    @endforeach
    
  </div>

    
<script>
	function Download()
    {
        var url = "https://server1.mitewp.com/get/{{ $file->short_url }}";
        window.location.href = url;
    }

    const btn = document.getElementById('DownloadBtn');
    btn.classList.add('cursor-not-allowed');
    btn.classList.add('hidden');
    btn.href = '#';
    btn.text = 'Please wait ...';
    var count = 10;
    

    var form = document.getElementById('form-gcaptcha');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var response = grecaptcha.getResponse();
        if(response.length === 0) {
            alert('Please verify that you are not a robot');
        } else {
            form.remove();
            btn.classList.remove('cursor-not-allowed');
            btn.classList.remove('hidden');
            var CountdownInterval = setInterval(function() {
                if (count > 0) {
                    btn.text = 'Please wait ... (' + count + ')';
                    count--;
                } else {
                    clearInterval(CountdownInterval);
                    btn.classList.remove('cursor-not-allowed');
                    btn.classList.remove('hidden');
                    btn.href = 'https://drive.mitewp.com/get/{{ $file->short_url }}';
                    btn.text = 'Download';
                }
            }, 1000);
        }
    });
    


</script>
    </div>
</x-guest-layout>

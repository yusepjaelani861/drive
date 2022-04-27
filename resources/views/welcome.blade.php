<?php

use App\Models\Post;

$post = Post::with('images')->paginate(5);
?>
<x-guest-layout>

    <dh-component>
        <!--   more free components available at www.TailwindUIKit.com -->
        <nav class="w-full border-b">
            <div class="py-5 md:py-0 container mx-auto px-6 flex items-center justify-between">
            <div aria-label="Home. logo" role="img">
                <!-- <img class="w-12 md:w-auto" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/centre_aligned_simple-Svg1.svg" alt="logo" /> -->
                <h1 class="text-4xl font-bold text-gray-900">
                    <a href="{{ url('/') }}">
                        Savefileku
                    </a>
                </h1>
            </div>
            <div>
                <button onclick="toggleMenu(true)" class="sm:block md:hidden text-gray-500 hover:text-gray-700 focus:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                <svg aria-haspopup="true" aria-label="open Main Menu" xmlns="http://www.w3.org/2000/svg" class="md:hidden icon icon-tabler icon-tabler-menu" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round">
                    <path stroke="none" d="M0 0h24v24H0z"></path>
                    <line x1="4" y1="8" x2="20" y2="8"></line>
                    <line x1="4" y1="16" x2="20" y2="16"></line>
                </svg>
                </button>
                <div id="menu" class="md:block lg:block hidden">
                <button onclick="toggleMenu(false)" class="block md:hidden lg:hidden text-gray-500 hover:text-gray-700 focus:text-gray-700 fixed focus:outline-none focus:ring-2 focus:ring-gray-500 z-30 top-0 mt-6">
                    <svg aria-label="close main menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
                <ul class="flex text-3xl md:text-base items-center py-10 md:flex flex-col md:flex-row justify-center fixed md:relative top-0 bottom-0 left-0 right-0 bg-white md:bg-transparent z-20">
                    <li class="text-gray-700 hover:text-gray-900 cursor-pointer text-base lg:text-lg pt-10 md:pt-0">
                    <a href="#">Feature</a>
                    </li>
                    <li class="text-gray-700 hover:text-gray-900 cursor-pointer text-base lg:text-lg pt-10 md:pt-0 md:ml-5 lg:ml-10">
                    <a href="#">Marketplace</a>
                    </li>
                    <li class="text-gray-700 hover:text-gray-900 cursor-pointer text-base lg:text-lg pt-10 md:pt-0 md:ml-5 lg:ml-10">
                    <a href="#">Company</a>
                    </li>
                    <li class="text-gray-700 hover:text-gray-900 cursor-pointer text-base lg:text-lg pt-10 md:pt-0 md:ml-5 lg:ml-10">
                    <a href="#">Features</a>
                    </li>
                    <li class="text-gray-700 hover:text-gray-900 cursor-pointer text-base lg:text-lg pt-10 md:pt-0 md:ml-5 lg:ml-10">
                    <a href="#">Contact</a>
                    </li>
                </ul>
                </div>
            </div>
            @if (Route::has('login'))
            @auth
            <form action="{{ url('/dashboard') }}" method="GET">
                <button class="focus:outline-none lg:text-lg lg:font-bold focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 hidden md:block bg-transparent transition duration-150 ease-in-out hover:bg-gray-200 rounded border border-indigo-700 text-indigo-700 px-4 sm:px-8 py-1 sm:py-3 text-sm">Dashboard</button>
            </form>
            @else
            <form action="{{ route('login') }}" method="GET">
                <button class="focus:outline-none lg:text-lg lg:font-bold focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 hidden md:block bg-transparent transition duration-150 ease-in-out hover:bg-gray-200 rounded border border-indigo-700 text-indigo-700 px-4 sm:px-8 py-1 sm:py-3 text-sm">Sign In</button>
            </form>
            @endauth
            @endif
            </div>
        </nav>
        <div class="bg-gray-100">
            <div class="container mx-auto flex flex-col items-center py-12 sm:py-24">
            <div class="w-11/12 sm:w-2/3 lg:flex justify-center items-center flex-col mb-5 sm:mb-10">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl text-center text-gray-800 font-black leading-7 md:leading-10">
                Free Simple
                <span class="text-indigo-700">File Sharing & Storage</span>
                </h1>
                <p class="mt-5 sm:mt-10 lg:w-10/12 text-gray-400 font-normal text-center text-sm sm:text-lg">Upload your Image, Video, Document, Music, Config, App, and more file with everyone. </p>
            </div>
            <div class="flex justify-center items-center">
                <button class="flex focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 lg:text-xl lg:font-bold  rounded text-white px-4 sm:px-10 border border-indigo-700 py-2 sm:py-4 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>    
                    <p class="mx-2">Upload File</p>
                </button>
                <!-- <button class="ml-4 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-transparent transition duration-150 ease-in-out hover:border-indigo-600 lg:text-xl lg:font-bold  hover:text-indigo-600 rounded border border-indigo-700 text-indigo-700 px-4 sm:px-10 py-2 sm:py-4 text-sm">Demo</button> -->
            </div>
            </div>
            <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />


        <!-- ====== Blog Section Start -->
        <section class="pt-3 lg:pt-3 pb-10 lg:pb-20">
        <div class="container">
            <div class="flex flex-wrap justify-center -mx-4">
                <div class="w-full px-4">
                    <div class="text-center mx-auto mb-[60px] lg:mb-20 max-w-[510px]">
                    <span class="font-semibold text-lg text-primary mb-2 block">
                    Our Blogs
                    </span>
                    <h2 class="font-bold text-3xl sm:text-4xl md:text-[40px] text-dark mb-4">
                        Our Recent News
                    </h2>
                    <p class="text-base text-body-color">
                        There are many variations of passages of Lorem Ipsum available
                        but the majority have suffered alteration in some form.
                    </p>
                    </div>
                </div>
            </div>
            @foreach ($post as $post)
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 lg:w-1/3 px-4">
                    <div class="max-w-[370px] mx-auto mb-10">
                    <div class="rounded overflow-hidden mb-8">
                        <img src="{{ $post->images->image_path }}" alt="image" class="w-full" />
                    </div>
                    <div class="truncate">
                        <span class="bg-primary rounded inline-block text-center py-1 px-4 text-xs leading-loose font-semibold text-white mb-5">
                        {{ date('M d, Y', strtotime($post->created_at)) }}
                        </span>
                        <h3>
                            <a href="javascript:void(0)" class="truncate font-semibold text-xl sm:text-2xl lg:text-xl xl:text-2xl mb-4 inline-block text-dark hover:text-primary">
                            {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-base text-body-color truncate">
                            {{ $post->body }}
                        </p>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </section>
        <!-- ====== Blog Section End -->
        </div>
        </dh-component>
</x-guest-layout>

@extends('layouts.app')
@section('title', 'Home')
@section('content')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
    
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-up {
        animation: fadeInUp 1s ease-out forwards;
    }
    
    .delay-300 {
        animation-delay: 0.3s;
    }
    
    .gradient-bg {
        background: linear-gradient(to bottom, rgb(207, 2, 33), black);
    }
</style>
<div class="">
    <div class="relative w-full h-[98vh]">
        <img src="{{url('images/wallpaperflare.com_wallpaper (3).jpg')}}" alt="Nike Shoes"
            class="absolute w-full h-full">

        <div class="absolute inset-0 flex flex-col justify-center items-start text-white font-bold text-left pl-16">
            <h1 class="text-7xl text-black opacity-0 animate-fade-up">OWN THE</h1>
            <h1 class="text-7xl opacity-0 animate-fade-up delay-300">SPORT</h1>

            <a href="{{ route('products') }}"
                class="mt-4 px-8 py-4 bg-black text-white font-semibold rounded-lg shadow-md hover:bg-white text-2xl hover:text-black transition duration-700">
                SHOP NOW
            </a>
        </div>
    </div>
    <div class="gradient-bg">
        <h1 class="text-4xl md:text-6xl text-center font-bold text-white pt-20 md:pt-40">
            Elevate your game
        </h1>
        <h1 class="text-2xl md:text-4xl text-center font-bold text-white mt-4">
            Unleash your potential
        </h1>
        <h1 class="text-5xl md:text-7xl text-center font-bold text-white mt-30 md:mt-40">
            OUR CATEGORIES
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-2 w-full mx-auto p-6 h-auto md:h-[150vh]">
            <!-- Men -->
            <a href="{{route('products', ['category' => 'men']) }}" class="relative group flex items-center justify-center h-full">
                <img src="{{url('images/MenIcon2.png')}}" alt="Men"
                    class="w-full max-w-full h-full object-contain rounded-lg  group-hover:opacity-75 transition duration-300 p-4 md:p-6">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white 
                text-4xl md:text-6xl font-bold opacity-0 group-hover:opacity-100 transition duration-300">
                    Men
                </div>
            </a>

            <!-- Women -->
            <a href="{{route('products', ['category' => 'women']) }}" class="relative group flex items-center justify-center h-full">
                <img src="{{url('images/WomenIcon3.png')}}" alt="Women"
                    class="w-full max-w-full h-full object-contain md:p-8 rounded-lg group-hover:opacity-75 transition duration-300">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white 
                text-4xl md:text-6xl font-bold opacity-0 group-hover:opacity-100 transition duration-200">
                    Women
                </div>
            </a>

            <!-- Boys -->
            <a href="{{route('products', ['category' => 'boys']) }}" class="relative group flex items-center justify-center h-full">
                <img src="{{url('images/Kids.png')}}" alt="Boys"
                    class="w-full max-w-full h-full object-contain rounded-lg group-hover:opacity-75 transition duration-200">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white 
                text-4xl md:text-6xl font-bold opacity-0 group-hover:opacity-100 transition duration-200">
                    Boys
                </div>
            </a>

            <!-- Girls -->
            <a href="{{route('products', ['category' => 'girls']) }}" class="relative group flex items-center justify-center h-full">
                <img src="{{url('images/GirlsIcon.png')}}" alt="Girls"
                    class="w-full max-w-full h-full object-contain rounded-lg group-hover:opacity-75 transition duration-200 p-6 md:p-16">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white 
                text-4xl md:text-6xl font-bold opacity-0 group-hover:opacity-100 transition duration-200">
                    Girls
                </div>
            </a>
        </div>
    </div>
</div>
    
@endsection
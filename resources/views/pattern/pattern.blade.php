<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>{{$pattern->name}}</title>
</head>
<body class="antialiased">
<div class="relative">
<nav class="flex bg-gray-50 text-gray-700 border border-gray-200 py-3 px-5 rounded-lg dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('main')}}" class="text-sm text-gray-700 hover:text-gray-900 inline-flex items-center dark:text-gray-400 dark:hover:text-white">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Главная
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <a href="{{ route('pattern-list')}}" class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium dark:text-gray-400 dark:hover:text-white">Список</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="text-gray-400 ml-1 md:ml-2 text-sm font-medium dark:text-gray-500">{{$pattern->name}}</span>
            </div>
        </li>
    </ol>
</nav>
</div>
<div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
    <div class="w-full items-center mx-auto max-w-screen-lg">
        <div class="group grid w-full grid-cols-2">
            <div class="pl-16 relative flex items-end flex-col before:block before:absolute before:h-1/6 before:w-4 ">
                <div class="absolute top-0 left-0 bg-blue-500 w-4/6 px-12 py-14 flex flex-col justify-center rounded-xl group-hover:bg-sky-600 transition-all ">
                    <span class="block mb-10 font-bold group-hover:text-orange-300"> Шаблон проектирования</span>
                    <h2 class="text-white font-bold text-3xl">
                        {{$pattern->name}}
                    </h2>
                </div>
            </div>
            <div>
                <div class="pl-12">
                    <h1 class="text-1xl font-bold text-gray-500">Описание шаблона:</h1>
                    <p class="peer mt-2 mb-6 text-gray-400">
                        {{$pattern->description}}
                    </p>
                    <h1 class="text-1xl font-bold text-gray-500">Преимущества:</h1>
                    <p class="peer mt-2 mb-6 text-gray-400">
                        {{$pattern->advantages}}
                    </p>
                    <h1 class="text-1xl font-bold text-gray-500">Недостатки:</h1>
                    <p class="peer mt-2 mb-6 text-gray-400 ">
                        {{$pattern->disadvantages}}
                    </p>
                    <p class="mb-6 text-gray-400">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

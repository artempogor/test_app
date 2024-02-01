<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>{{$pattern->name}}</title>
</head>
<body class="antialiased">
<div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
    <div class="w-full items-center mx-auto max-w-screen-lg">
        <div class="group grid w-full grid-cols-2">
            <div class="pl-16 relative flex items-end flex-col before:block before:absolute before:h-1/6 before:w-4 ">
                <div class="absolute top-0 left-0 bg-blue-500 w-4/6 px-12 py-14 flex flex-col justify-center rounded-xl group-hover:bg-sky-600 transition-all ">
                    <span class="block mb-10 font-bold group-hover:text-orange-300">Шаблон проектирования</span>
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
                        {{dd($item)}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 10 Task List App</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script> 
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        .link{
            @apply font-medium text-gray-700 underline hover:text-gray-900 hover:font-bold
        }

        .btn-task{
            @apply rounded-md px-5 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 text-slate-700 hover:bg-slate-50
        }

        .btn-task-danger{
            @apply rounded-md px-5 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 text-red-500 hover:bg-slate-50
        }

        label{
            @apply font-medium block uppercase text-slate-700 mb-2
        }

        input, textarea{
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }

        .error{
            @apply text-red-500 text-sm
        }
    </style>

    @yield('styles')
</head>
<body class="container mx-auto mt-10 mb-10 max-w-lg">
    @if(session()->has('success'))
        <div x-data="{ flash: true }"> <!-- Alpine JS Flash Message -->
            <div x-show="flash" class="relative rounded-md border-2 border-green-300 bg-green-200 text-green-700 px-3 py-2 my-4" role="alert">
                <div class="font-bold">Success!</div>
                <div>
                    {{ session('success') }}
                </div>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg @click="flash = false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" @click="flash = false"
                    stroke="currentColor" class="h-6 w-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </span>
            </div>
        </div>
    @endif

    <h1 class="text-2xl font-bold">@yield('title')</h1>
    
    <div>
        @yield('content')
    </div>
</body>
</html>
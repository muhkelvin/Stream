<div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
    <div class="flex flex-shrink-0 items-center">
        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
    </div>
    <div class="hidden sm:ml-6 sm:block">
        <div class="flex space-x-4">
            @auth
                <a href="{{ route('admin.movies') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Movie</a>
                <a href="{{ route('admin.genres') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Genre</a>
                <a href="{{ route('admin.movies.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Add Movie</a>
                <a href="{{ route('admin.genres.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Add Genre</a>
            @else
            <a href="/" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
            <a href="{{route('genre.show',$genres[1]->slug)}}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{$genres[1]->name}}</a>
            <a href="{{route('genre.show',$genres[2]->slug)}}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{$genres[2]->name}}</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Genre List</a>
            @endauth
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        </div>
    </div>
</div>

<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
    @auth
        <span class="text-gray-700 text-sm font-medium mr-2">{{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium">Logout</button>
        </form>
    @else
        <a href="/login" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Login</a>
        <a href="/register" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Register</a>
    @endauth
</div>


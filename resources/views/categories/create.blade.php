<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'Create Category' }}
        </h2>
    </x-slot>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center pt-6 bg-gray-100 sm:justify-start sm:pt-0 min-h-fit">
            <div class="w-full px-8 py-8 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                <div class="flex justify-end w-full mb-6">
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-500 rounded-md text-sky-100 hover:bg-gray-600">
                        <- Back
                    </a>
                </div>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form action="{{ route('categories.index') }}" method="POST">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="name">
                                Name
                            </label>
                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="name" value="{{old('name')}}">
                            @error('name')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>  
                        <div class="flex items-center justify-start mt-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
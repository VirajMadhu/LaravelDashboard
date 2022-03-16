<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-4 bg-gray-200 border-b border-gray-200 text-center flex">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 bg-green-600 hover:bg-green-300 text-slate-200 rounded-md">Go Back</a>
                </div>

                <div class="py-5">
                    <form class="w-full max-w-lg p-4" method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <!--Name-->
                        <div class="md:items-center mb-6">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="post_name">
                                User Name
                            </label>
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"
                                id="name" name="name" type="text">
                            @error('name')
                                <span class="text-red-400 text-sm">*{{ $message }}</span>
                            @enderror
                        </div>
                        <!--Email-->
                        <div class="md:items-center mb-6">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="post_name">
                                User Email
                            </label>
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"
                                id="email" name="email" type="email">
                            @error('email')
                                <span class="text-red-400 text-sm">*{{ $message }}</span>
                            @enderror
                        </div>
                        <!--Password-->
                        <div class="md:items-center mb-6">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="post_name">
                                Password
                            </label>
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"
                                id="password" name="password" type="text">
                            @error('password')
                                <span class="text-red-400 text-sm">*{{ $message }}</span>
                            @enderror
                        </div>

                        <!--Button-->
                        <div class="md:flex">
                            <button
                                class="shadow bg-green-600 hover:bg-green-300 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                type="submit">
                                Create New User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

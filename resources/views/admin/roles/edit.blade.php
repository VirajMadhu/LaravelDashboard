<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <!--Back Button area-->
                <div class="p-4 bg-gray-200 border-b border-gray-200 text-center flex">
                    <a href="{{ route('admin.roles.index') }}"
                        class="px-4 py-2 bg-green-600 hover:bg-green-300 text-slate-200 rounded-md">
                        Go Back
                    </a>
                </div>

                <!--Edit detail area-->
                <div class="py-5">
                    <form class="w-full max-w-lg p-4" method="POST" action="{{ route('admin.roles.update', $role) }}">
                        <!--csrf => Cross-site request forgery (This will give protection from csrf attacks)-->
                        @csrf
                        <!--Method post not supported so we must use PUT-->
                        @method('PUT')

                        <div class="md:items-center mb-6">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="name">
                                role Name
                            </label>
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"
                                id="name" name="name" type="text" value="{{ $role->name }}" />
                            @error('name')
                                <span class="text-red-400 text-sm">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="md:flex">
                            <button
                                class="shadow bg-green-600 hover:bg-green-300 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                type="submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

                <!--Role per permission area-->
                <div class="mt-6 p-2">
                    <h2 class="text-2xl font-semibold">Role Permission</h2>
                    <!--Granted Permissions-->
                    <div class="flex space-x-2 mt-4 p-2">
                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                                <div class="px-4 py-2 bg-red-500 hover:bg-red-800 text-white rounded-md">
                                    <!--roles.permissions.revoke path on web.php-->
                                    <form
                                        action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit">{{ $role_permission->name }}</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!--Grante a Permissions-->
                    <div class="py-5">
                        <!--roles.permissions path on web.php-->
                        <form class="w-full max-w-lg p-4" method="POST"
                            action="{{ route('admin.roles.permissions', $role) }}">
                            @csrf

                            <!--DropBox-->
                            <div class="md:items-center mb-6">
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="permission">
                                    role Name
                                </label>

                                <select name="permission" id="permission"
                                    class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white">

                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>

                                @error('name')
                                    <span class="text-red-400 text-sm">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="md:flex">
                                <button
                                    class="shadow bg-green-600 hover:bg-green-300 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                    type="submit">
                                    Give Permission
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

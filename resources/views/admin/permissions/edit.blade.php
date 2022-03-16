<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-4 bg-gray-200 border-b border-gray-200 text-center flex">
                    <a href="{{ route('admin.permissions.index') }}"
                        class="px-4 py-2 bg-green-600 hover:bg-green-300 text-slate-200 rounded-md">Go Back</a>
                </div>

                <div class="py-5">
                    <form class="w-full max-w-lg p-4" method="POST"
                        action="{{ route('admin.permissions.update', $permission) }}">
                        <!--csrf => Cross-site request forgery (This will give protection from csrf attacks)-->
                        @csrf
                        <!--Method post not supported so we must use PUT-->
                        @method('PUT')

                        <div class="md:items-center mb-6">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="name">
                                Permission Name
                            </label>
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"
                                id="name" name="name" type="text" value="{{ $permission->name }}" />
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

                <div class="mt-6 p-2 bg-slate-100">
                    <h2 class="text-2xl font-semibold">Roles</h2>
                    <div class="flex space-x-2 mt-4 p-2">
                        @if ($permission->roles)
                            @foreach ($permission->roles as $permission_role)
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                    action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{ $permission_role->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="max-w-xl mt-6">
                        <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                                <select id="role" name="role" autocomplete="role-name"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
                    </div>
                    </form>
                </div>
                {{-- <!--Role per permission area-->
                <div class="mt-6 p-2">
                    <h2 class="text-2xl font-semibold">Permission Role</h2>
                    <!--Granted Permissions-->
                    <div class="flex space-x-2 mt-4 p-2">
                        @if ($permission->role)
                            @foreach ($permission->role as $permission_role)
                                <div class="px-4 py-2 bg-red-500 hover:bg-red-800 text-white rounded-md">
                                    <!--roles.permissions.remove path on web.php-->
                                    <form
                                        action="{{ route('admin.permissions.role.remove', [$permission->id, $permission_role->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit">{{ $permission_role->name }}</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!--Grante a Permissions-->
                    <div class="py-5">
                        <!--roles.permissions path on web.php-->
                        <form class="w-full max-w-lg p-4" method="POST"
                            action="{{ route('admin.permissions.role', $role) }}">
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
                </div> --}}
            </div>
        </div>
    </div>
</x-admin-layout>

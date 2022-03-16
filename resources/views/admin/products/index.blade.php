<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-5 bg-gray-200 border-b border-gray-200 text-center flex justify-end">
                    <a href="{{ route('admin.products.create') }}"
                        class="px-4 py-2 bg-green-600 hover:bg-green-300 rounded-md">Add New Product</a>
                </div>

                <div class="py-5">
                    <table
                        class='mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                            <tr class="text-white text-left bg-gray-900">
                                <th class="font-semibold text-sm uppercase px-6 py-4"> Permission </th>
                                <th class="font-semibold text-sm uppercase px-6 py-4 text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <!-- Display Permission -->
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            {{ $permission->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex justify-end">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                    class="px-4 py-2 bg-blue-500 hover:bg-blue-800 text-white rounded-md">
                                                    Edit
                                                </a>
                                                <div
                                                    class="px-4 py-2 bg-red-500 hover:bg-red-800 text-white rounded-md">
                                                    <form
                                                        action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                        method="post" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

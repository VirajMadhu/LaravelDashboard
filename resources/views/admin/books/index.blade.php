<x-admin-layout>
    <div class="container mx-auto p-6 ">
        <div class="mt-6 ">
            <!--Add new book Button-->
            <div class="p-5 bg-gray-200 border-b border-gray-200 text-center flex justify-end">
                <button
                    class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-400 rounded-md no-outline focus:shadow-outline select-none"
                    data-modal-toggle="ajaxModel" id="createNewBook">
                    Add new book
                </button>
            </div>

            <!--Table-->
            <div class="py-5">
                <table class="mx-auto whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 w-full data-table">
                    <thead class="bg-gray-900">
                        <tr class="text-white text-left bg-gray-900">
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Id </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Book Title </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Author </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4" width="300px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    </tbody>
                </table>
            </div>

            <!--Toggle Moddle-->
            <div id="ajaxModel" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
                <div class="relative px-4 w-full max-w-2xl h-full md:h-auto">

                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white"
                                id="modelHeading">
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="ajaxModel">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="p-4">
                            <form class="w-full p-4" id="bookForm" name="bookForm">
                                @csrf
                                <input type="hidden" name="book_id" id="book_id">
                                <div class="md:items-center mb-6">
                                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="title">
                                        Book Title
                                    </label>
                                    <input
                                        class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"
                                        id="title" name="title" type="text" />
                                    @error('name')
                                        <span class="text-red-400 text-sm">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="md:items-center mb-6">
                                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="author">
                                        Author
                                    </label>
                                    <input
                                        class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white"
                                        id="author" name="author" type="text" />
                                    @error('author')
                                        <span class="text-red-400 text-sm">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <input
                                    class="shadow uppercase bg-green-600 hover:bg-green-300 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                    type="submit" id="saveBtn" data-modal-toggle="ajaxModel" value="">
                                </input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.books.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'author',
                        name: 'author'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            //add new book
            $('#createNewBook').click(function() {
                $('#saveBtn').val("create-book");
                $('#book_id').val('');
                $('#bookForm').trigger("reset");
                $('#modelHeading').html("Create New Book");
            });


            $('body').on('click', '.editBook', function() {
                var book_id = $(this).data('id');
                $.get("{{ route('admin.books.index') }}" + '/' + book_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Book");
                    $('#saveBtn').val("edit-book");
                    $('#book_id').val(data.id);
                    $('#title').val(data.title);
                    $('#author').val(data.author);
                    toggleModal('ajaxModel');
                })
            });

            //save button onclick
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#bookForm').serialize(),
                    url: "{{ route('admin.books.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#bookForm').trigger("reset");
                        table.draw();
                        toggleModal('ajaxModel', false);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            //delete button onclick
            $('body').on('click', '.deleteBook', function() {

                if (confirm("Are you sure want to delete?")) {
                    var book_id = $(this).data("id");

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.books.store') }}" + '/' + book_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

        });
    </script>
</x-admin-layout>

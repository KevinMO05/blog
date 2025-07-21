<x-layouts.app>
     <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs >
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">
                Posts
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a href="{{route('admin.posts.create')}}" class="btn btn-blue text-xs"> Nuevo</a>
    </div>

    {{-- Table --}}
    <div class="relative overflow-x-auto mb-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-white">
            <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-zinc-800 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Titulo
                    </th>
                    <th scope="col" class="px-6 py-3" width="10px">
                        Editar
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-500 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                            {{ $post->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $post->title }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{route('admin.posts.edit', $post)}}" class="btn btn-blue text-xs ">Editar</a>
                                <form class="delete-form" action="{{route('admin.posts.destroy', $post)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-red  text-xs ">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>

     @push('js')
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás deshacer esta acción!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminarlo',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        </script>
    @endpush

</x-layouts.app>
<x-layouts.app>
    <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.posts.index')">
                Posts
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">
                Editar post
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>


    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-lg space-y-4">
            <h2 class="text-xl font-semibold mb-4">Crear Nuevo Post</h2>

            <div class="relative mb-8">
                <img id="imgPreview" class="w-full aspect-video object-cover object-center"
                    src="{{ $post->image_path ?  Storage::disk('s3')->url($post->image_path) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}"
                    alt="">

                <div class="absolute top-8 right-8 ">
                    <label class="*:text-white bg-gray-800 bg-opacity-50 px-4 py-2 rounded-lg cursor-pointer">Cambiar
                        imagen
                        <input type="file" class="hidden " onchange="previewImage(event, '#imgPreview')"
                            name="image" accept="image/*" id="">
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <flux:input name="title" label="Titulo" type="text" placeholder="Ingrese el titulo del post"
                    value="{{ old('title', $post->title) }}" required />
            </div>

            <div class="mb-4">
                <flux:input name="slug" id="slug" label="Slug" type="text"
                    placeholder="Ingrese el slug del post" value="{{ old('slug', $post->slug) }}" required />
            </div>

            <flux:select label="Categoría" name="category_id">
                @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}"
                        :selected="$category->id == old('category_id', $post->category_id)"> {{ $category->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:textarea label="Resumen" name="excerpt" placeholder="Ingrese un resumen del post" rows="3">
                {{ old('excerpt', $post->excerpt) }}
            </flux:textarea>

            <flux:textarea label="Contenido" name="content" placeholder="Ingrese el contenido del post" rows="10">
                {{ old('content', $post->content) }}
            </flux:textarea>

            <div>
                <p class="text-sm font-medium mb-1">Tags</p>
                <ul>@foreach ($tags as $tag)
                    <li>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                @checked(in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())))>
                               <span>
                                 {{$tag->name}}
                               </span>
                        </label>
                    </li>
                @endforeach</ul>
            </div>

            {{-- estado --}}
            <div>
                <p class="text-sm font-medium mb-1">Estado</p>
                <div class="space-x-2">
                    <label>
                        <input type="radio" name="is_published" value="0" @checked(old('is_published', $post->is_published) == 0) required>
                        <span class="ml-1">No publicado</span>
                    </label>
                    <label>
                        <input type="radio" name="is_published" value="1" @checked(old('is_published', $post->is_published) == 1) required>
                        <span class="ml-1">Publicado</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" type="submit">
                    Editar Post
                </flux:button>
            </div>
        </div>
    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                let input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                let imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                let file = input.files[0];

                //Creamos la url
                let objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                imgPreview.src = objectURL;

            }
        </script>
    @endpush
</x-layouts.app>

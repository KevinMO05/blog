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
                Nuevo post
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Crear Nuevo Post</h2>

        <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="mb-4">
                <flux:input name="title" oninput="string_to_slug(this.value, '#slug')" label="Titulo" type="text" placeholder="Ingrese el titulo del post"
                    value="{{ old('title') }}" required />
            </div>
            <div class="mb-4">
                <flux:input name="slug" id="slug" label="Slug" type="text" placeholder="Ingrese el slug del post"
                    value="{{ old('slug') }}" required />
            </div>

            <flux:select label="Categoría" name="category_id">
                @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}"> {{ $category->name }} </flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" type="submit">
                    Crear Post
                </flux:button>
            </div>
        </form>

    </div>
</x-layouts.app>

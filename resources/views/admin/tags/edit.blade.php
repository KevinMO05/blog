<x-layouts.app>
     <flux:breadcrumbs class="mb-8">
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.tags.index')">
                Tags
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">
                Editar Tag
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Editar Tag</h2>

            <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <flux:input
                        name="name"
                        label="Nombre"
                        type="text"
                        placeholder="Ingrese el nombre del tag"
                        value="{{ old('name', $tag->name) }}"
                        required
                    />
                </div>
                <div class="flex justify-end mt-4">
                <flux:button type="submit" variant="primary" type="submit">
                    Editar Tag
                </flux:button>
                </div>
            </form>

        </div>
</x-layouts.app>
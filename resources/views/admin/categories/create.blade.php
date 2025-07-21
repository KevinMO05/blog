<x-layouts.app>
     <flux:breadcrumbs class="mb-8">
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.categories.index')">
                Categorías
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">
                Nueva categoria
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Crear Nueva Categoría</h2>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <flux:input
                        name="name"
                        label="Nombre"
                        type="text"
                        placeholder="Ingrese el nombre de la categoría"
                        value="{{ old('name') }}"
                        required
                    />
                </div>
                <div class="flex justify-end mt-4">
                <flux:button type="submit" variant="primary" type="submit">
                    Crear Categoría
                </flux:button>
                </div>
            </form>

        </div>
</x-layouts.app>
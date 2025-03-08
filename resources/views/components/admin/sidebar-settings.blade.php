<aside class="w-64 bg-white p-6 shadow-md">
    <ul class="space-y-3">
        <x-admin.sidebar-nav-link href="/admin/settings" :active="request()->is('admin/settings')">Store Information</x-admin.sidebar-nav-link>
        <x-admin.sidebar-nav-link href="/admin/settings/localization" :active="request()->is('admin/settings/localization')">Localization</x-admin.sidebar-nav-link>
    </ul>
</aside>

<aside class="bg-white p-6 shadow-md">
    <ul class="space-y-3">
        <x-admin.sidebar-nav-link href="/admin/settings" :active="request()->is('admin/settings')">General Settings</x-admin.sidebar-nav-link>
        <x-admin.sidebar-nav-link href="/admin/settings/shipping" :active="request()->is('admin/settings/shipping')">Shipping Settings</x-admin.sidebar-nav-link>
        <x-admin.sidebar-nav-link href="/admin/settings/seo_social_media" :active="request()->is('admin/settings/seo_social_media')">SEO & Social Media</x-admin.sidebar-nav-link>
        <x-admin.sidebar-nav-link href="/admin/settings/appearance" :active="request()->is('admin/settings/appearance')">Appearance Settings</x-admin.sidebar-nav-link>
        <x-admin.sidebar-nav-link href="/admin/settings/users" :active="request()->is('admin/settings/users')">Users Management</x-admin.sidebar-nav-link>
        <x-admin.sidebar-nav-link href="/admin/settings/security" :active="request()->is('admin/settings/security')">Security & Maintenance</x-admin.sidebar-nav-link>
    </ul>
</aside>

<aside x-data="{ open: true }"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform
              sm:translate-x-0 transition-transform duration-200 ease-in-out"
    :class="{ '-translate-x-full': !open }">

    <!-- Logo -->
    <!-- <div class="h-16 flex items-center justify-center border-b border-gray-200">
        <a href="{{ route('user.dashboard.dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
            <span class="font-semibold text-lg">Admin</span>
        </a>
    </div> -->

    <!-- Navigation -->
    <nav class="mt-4 px-4 space-y-1">
        <x-nav-link :href="route('user.dashboard.dashboard')"
            :active="request()->routeIs('user.dashboard.dashboard')">
            📊 {{ __('Dashboard') }}
        </x-nav-link>

        <x-nav-link :href="route('user.products.products')"
            :active="request()->routeIs('user.products.products')">
            📦 {{ __('Products') }}
        </x-nav-link>

        <x-nav-link :href="route('user.orders.orders')"
            :active="request()->routeIs('user.orders.orders')">
            🧾 {{ __('Orders') }}
        </x-nav-link>

        <x-nav-link :href="route('user.wishlist.wishlist')"
            :active="request()->routeIs('user.wishlist.wishlist')">
            ♥️ {{ __('Wishlist') }}
        </x-nav-link>

        <x-nav-link :href="route('user.cart.cart')"
            :active="request()->routeIs('user.cart.cart')">
            🛒 {{ __('Cart') }}
        </x-nav-link>
    </nav>

    <!-- User Section -->
    <div class="absolute bottom-0 w-full border-t border-gray-200 p-4">
        <x-dropdown align="top" width="48">
            <x-slot name="trigger">
                <button class="w-full flex items-center justify-between text-sm font-medium text-gray-600 hover:text-gray-800">
                    <span></span>
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</aside>
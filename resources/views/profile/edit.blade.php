<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Profile</h1>
                <p class="text-sm text-gray-500 mt-1">Manage your account settings.</p>
            </div>

            <div class="max-w-2xl space-y-6">

                <div class="bg-white rounded-2xl border border-gray-200 p-6 transition hover:shadow-sm">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 p-6 transition hover:shadow-sm">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="bg-white rounded-2xl border border-red-200 p-6 transition hover:shadow-sm">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
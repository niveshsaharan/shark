<x-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                {{ config('shopify-app.app_name') }}
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                @if (session()->has('error'))
                    <x-flash.error class="mb-4">
                       {{ session('error') }}
                    </x-flash.error>
                @endif
                <form action="{{ route('authenticate') }}" method="POST">
                    {{ csrf_field() }}
                    <div>
                        <label for="shop" class="block text-sm font-medium leading-5 text-gray-700">
                            {{__('Enter your Shopify domain')}}
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="shop"
                                   type="text"
                                   name="shop"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                   autofocus="autofocus"
                                   placeholder="example.myshopify.com"
                                   required
                            />
                        </div>
                    </div>

                    <div class="mt-6">
                      <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                          {{__('Go')}}
                        </button>
                      </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

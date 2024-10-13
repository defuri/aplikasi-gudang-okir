<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

        @include('layouts.notif')

        <div
            class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center focus-within:ring-1 focus-within:ring-blue-700 rounded-lg"
                        method="GET" action="{{ route('search') }}">
                        @csrf
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" value="hak" name="tabel" id="" required class="hidden">
                            <input type="text" id="simple-search" name="cari" value="{{ $query ?? '' }}"
                                class="bg-gray-50 border border-gray-300 rounded-l-lg text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Cari">
                        </div>
                        <button type="submit"
                            class="bg-blue-700 text-white font-semibold text-sm border rounded-r-lg border-blue-700 py-2 px-5 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">id</th>
                            <th scope="col" class="px-4 py-3">nama</th>
                            <th scope="col" class="px-4 py-3">created at</th>
                            <th scope="col" class="px-4 py-3">updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hak as $data)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}</th>
                                <td class="px-4 py-3">{{ $data->id }}</td>
                                <td class="px-4 py-3">{{ $data->nama }}</td>
                                <td class="px-4 py-3">{{ $data->created_at }}</td>
                                <td class="px-4 py-3">{{ $data->updated_at }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    dari
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $hak->total() }}</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                    <li>
                        {{ $hak->links() }}
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>

@extends($user->id_hak === 1 ? 'layouts.owner' : 'layouts.gudangLayout')

@section('namaHalaman', 'Stok')
@section('namaOperator', $user->id_hak === 1 ? 'Super Admin' : 'Admin Gudang')
@section('judul', 'Data Stok')

@section('content')
    @include('layouts.breadcrumb')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">

        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            {{-- ! advanced table --}}
            <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">

                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

                    @include('layouts.notif')

                    <div
                        class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col lg:flex-row items-center justify-between space-y-3 lg:space-y-0 lg:space-x-4 p-4">
                            <div class="w-full lg:w-1/2">
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
                                        <input type="text" value="stok" name="tabel" id="" required
                                            class="hidden">
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
                            <div
                                class="w-full lg:w-auto flex flex-col lg:flex-row space-y-2 lg:space-y-0 items-stretch lg:items-center justify-end lg:space-x-3 flex-shrink-0">
                                <div class="lg:flex lg:items-center lg:gap-3">
                                    <form action="" id="formCheckbox">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="checkboxStok" name="cetakCheckbox" value="semua"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkboxStok"
                                                class="ml-2 text-sm select-none font-medium text-gray-900 dark:text-gray-300">Tampilkan
                                                Stok
                                                Kosong</label>
                                        </div>
                                    </form>
                                    <form action="/cetak-stok" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="mt-4 lg:mt-0 w-full justify-center text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Cetak
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">#</th>
                                        <th scope="col" class="px-4 py-3">id</th>
                                        <th scope="col" class="px-4 py-3">gudang</th>
                                        <th scope="col" class="px-4 py-3">produk</th>
                                        <th scope="col" class="px-4 py-3">stok</th>
                                        <th scope="col" class="px-4 py-3">created at</th>
                                        <th scope="col" class="px-4 py-3">updated at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stok as $data)
                                        <tr class="border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration }}</th>
                                            <td class="px-4 py-3">{{ $data->id }}</td>
                                            <td class="px-4 py-3">{{ $data->gudang->nama }}</td>
                                            <td class="px-4 py-3">{{ $data->produk->nama }}</td>
                                            <td class="px-4 py-3">{{ $data->stok }}</td>
                                            <td class="px-4 py-3">{{ $data->formatted_created_at }}</td>
                                            <td class="px-4 py-3">{{ $data->formatted_updated }}</td>
                                        </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                            aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                Menampilkan
                                <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                                dari
                                <span class="font-semibold text-gray-900 dark:text-white">{{ count($stok) }}</span>
                            </span>
                            <ul class="inline-flex items-stretch -space-x-px">
                                <li>
                                    {{ $stok->links() }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('checkboxStok');

            const updateCheckboxState = () => {
                const urlParams = new URLSearchParams(window.location.search);
                const hasEmptyStock = document.querySelector('meta[name="has-empty-stock"]');

                // Check if we're showing empty stock based on URL parameter
                const showingEmpty = urlParams.has('show_empty');

                // If there are empty stock items in results, check the box
                if (hasEmptyStock && hasEmptyStock.content === 'true') {
                    checkbox.checked = true;
                } else {
                    checkbox.checked = showingEmpty;
                }
            };

            checkbox.addEventListener('change', function() {
                let url = new URL(window.location.href);

                if (this.checked) {
                    url.searchParams.set('show_empty', '1');
                } else {
                    url.searchParams.delete('show_empty');
                }

                // Preserve the search query if it exists
                const searchQuery = url.searchParams.get('cari');
                if (searchQuery) {
                    url.searchParams.set('cari', searchQuery);
                }

                fetch(url.toString())
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        const newTable = doc.querySelector('table');
                        if (newTable) {
                            document.querySelector('table').innerHTML = newTable.innerHTML;
                        }

                        const newPagination = doc.querySelector('nav[aria-label="Table navigation"]');
                        if (newPagination) {
                            document.querySelector('nav[aria-label="Table navigation"]').innerHTML =
                                newPagination.innerHTML;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Set initial checkbox state
            updateCheckboxState();
        });
    </script>
@endsection

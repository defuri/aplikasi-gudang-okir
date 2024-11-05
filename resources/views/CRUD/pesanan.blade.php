<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        @include('layouts.notif')

        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-800 relative shadow-sm sm:rounded-lg overflow-hidden">

            <!-- Search and Add Button Section -->
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <!-- Search Form -->
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
                            <input type="text" value="pesanan" name="tabel" id="" required class="hidden">
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

                <!-- Add Data Button -->
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                        class="flex items-center border-2 border-gray-200 dark:border-gray-600 justify-center text-gray-900 dark:text-gray-300 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Data
                    </button>
                </div>
            </div>

            <!-- Add Data Modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <div
                        class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 max-h-[450px] overflow-hidden">
                        <!-- Modal Header -->
                        <div class="sticky top-0 z-10 bg-white dark:bg-gray-800 border-b sm:mb-5 dark:border-gray-600">
                            <div class="flex justify-between items-center pb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Data</h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="defaultModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                        </div>

                        <!-- Modal Form -->
                        <div class="max-h-[350px] overflow-y-auto pr-5">
                            <form action="{{ route('pesanan.store') }}" method="POST" id="pesananForm">
                                @csrf
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <!-- Customer Select -->
                                    <div>
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                            pelanggan:</label>
                                        <select name="pelanggan_id" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" disabled selected>Pilih pelanggan</option>
                                            @foreach ($pelanggan as $DataPelanggan)
                                                <option value="{{ $DataPelanggan->id }}">{{ $DataPelanggan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Date Picker -->
                                    <div>
                                        <label for="default-datepicker"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                        <div class="relative max-w-sm">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker datepicker-autohide type="text" required name="tanggal"
                                                id="default-datepicker"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Pilih tanggal">
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Selection -->
                                <p class="text-sm text-gray-900 dark:text-white mb-2">Pilih Produk:</p>
                                @foreach ($produk as $DataProduk)
                                    <div class="ml-2">
                                        <div class="flex items-center mb-3 select-none">
                                            <input id="CheckboxProduk{{ $DataProduk->id }}" type="checkbox"
                                                value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="CheckboxProduk{{ $DataProduk->id }}"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $DataProduk->nama }}
                                            </label>
                                        </div>
                                        <input type="number" name="jumlah[{{ $DataProduk->id }}]"
                                            id="JumlahProduk{{ $DataProduk->id }}" min="1"
                                            class="hidden mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Masukan jumlah" required=""
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                @endforeach

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="flex items-center text-gray-900 justify-center bg-primary-700 border-gray-200 dark:border-gray-600 border-2 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:text-white dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Tambah data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">No Pesanan</th>
                            <th scope="col" class="px-4 py-3">Pelanggan</th>
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">Created At</th>
                            <th scope="col" class="px-4 py-3">Updated At</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $data)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-4 py-3">{{ $data->id }}</td>
                                <td class="px-4 py-3">{{ $data->pelanggan->nama }}</td>
                                <td class="px-4 py-3">{{ $data->tanggal }}
                                <td class="px-4 py-3">{{ $data->created_at }}</td>
                                <td class="px-4 py-3">{{ $data->updated_at }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="apple-imac-27-dropdown-button"
                                        data-dropdown-toggle="dropDownAksi{{ $loop->iteration }}"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="dropDownAksi{{ $loop->iteration }}"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href="#"
                                                    data-modal-target="modalTampil{{ $loop->iteration }}"
                                                    data-modal-toggle="modalTampil{{ $loop->iteration }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Tampilkan
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div id="modalTampil{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full md:inset-0">
                                <div class="relative p-4 w-full max-w-xl">
                                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                        <!-- Modal Header -->
                                        <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                            <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                                                <h3 class="font-semibold text-xl">Pesanan no: {{ $data->id }}</h3>
                                                <p class="font-bold text-lg">{{ $data->pelanggan->nama }}</p>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="modalTampil{{ $loop->iteration }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Modal Content -->
                                        <div class="mb-4">
                                            <div
                                                class="grid grid-cols-3 text-sm uppercase text-gray-700 bg-slate-50 dark:bg-gray-700 dark:text-gray-400 py-3 px-2">
                                                <p class="font-bold">Produk</p>
                                                <p class="font-bold">Jumlah</p>
                                                <p class="font-bold">Total</p>
                                            </div>
                                            <div class="flex flex-col space-y-2 text-sm mt-2">
                                                @foreach ($data->detailPesanan as $currentDetail)
                                                    <div
                                                        class="grid grid-cols-3 border-b border-gray-200 dark:border-gray-700 py-2">
                                                        <p class="text-gray-500 dark:text-gray-400">
                                                            {{ $currentDetail->produk->nama }}</p>
                                                        <p class="text-gray-500 dark:text-gray-400">
                                                            {{ $currentDetail->jumlah }}</p>
                                                        <p class="text-gray-500 dark:text-gray-400">
                                                            {{ $currentDetail->total }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="flex justify-between items-center mt-3">
                                            <div class="flex items-center space-x-3">
                                                <button type="button"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Cetak
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    dari
                    <span class="font-semibold text-gray-900 dark:text-white">{{ count($pesanan) }}</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                    <li>
                        {{ $pesanan->links() }}
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/pesanan.js') }}"></script>

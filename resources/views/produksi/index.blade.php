@extends('layouts.produksiLayout')

@section('content')
    <div class="pt-20 pb-8 mt-4">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Dashboard Produksi</h2>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Total Products Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Produk</h3>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalProduk }}</p>
                    </div>
                </div>
            </div>

            <!-- Raw Materials Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-300" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7c-2 0-3 1-3 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Bahan Baku</h3>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalBahanBaku ?? '0' }}</p>
                    </div>
                </div>
            </div>

            <!-- Suppliers Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Suppliers</h3>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalSuplier ?? '0' }}</p>
                    </div>
                </div>
            </div>

            <!-- Transactions Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Transactions</h3>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalTransaksi ?? '0' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Sections -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Resource Management -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sumber Daya</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="/satuan"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Satuan</span>
                    </a>
                    <a href="/suplier"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Suplier</span>
                    </a>
                    <a href="/bahan-baku"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Bahan Baku</span>
                    </a>
                    <a href="/transaksi-bahan-baku"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Transaksi</span>
                    </a>
                </div>
            </div>

            <!-- Product Management -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Manajemen Produk</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="/rasa"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Rasa</span>
                    </a>
                    <a href="/kategori"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                    </a>
                    <a href="/pack"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Pack</span>
                    </a>
                    <a href="/produk"
                        class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Produk</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="mt-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Transaksi Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiBahanBaku as $data)
                                    <div id="modalTampil{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full md:inset-0">
                                        <div class="relative p-4 w-full max-w-xl max-h-[90vh]">
                                            <div
                                                class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 overflow-hidden">
                                                <!-- Modal Header -->
                                                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                                                        <h3 class="font-semibold text-xl">Transaksi no:
                                                            {{ $data->id }}
                                                        </h3>
                                                        <p class="font-bold text-lg">{{ $data->tanggal }}</p>
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
                                                    <div class="overflow-x-auto">
                                                        <div class="inline-block min-w-[500px] align-middle">
                                                            <div class="overflow-hidden">
                                                                <!-- Header Table -->
                                                                <div
                                                                    class="grid grid-cols-5 mb-3 text-xs capitalize text-gray-700 bg-slate-50 dark:bg-gray-700 dark:text-gray-400 py-3">
                                                                    <p class="font-bold pl-4">Bahan Baku</p>
                                                                    <p class="font-bold">Jumlah</p>
                                                                    <p class="font-bold">Satuan</p>
                                                                    <p class="font-bold">Harga</p>
                                                                    <p class="font-bold">Total</p>
                                                                </div>

                                                                <!-- Table Content with Scroll -->
                                                                <div class="overflow-y-auto max-h-[50vh]">
                                                                    <div class="flex flex-col space-y-2 text-sm">
                                                                        @foreach ($data->detailTransaksiBahanBaku as $currentDetail)
                                                                            <div
                                                                                class="grid grid-cols-5 border-b border-gray-200 dark:border-gray-700 pb-2">
                                                                                <p
                                                                                    class="text-gray-500 dark:text-gray-400 pl-4">
                                                                                    {{ $currentDetail->bahanBaku->nama }}
                                                                                </p>
                                                                                <p
                                                                                    class="text-gray-500 dark:text-gray-400">
                                                                                    {{ $currentDetail->jumlah }}</p>
                                                                                <p
                                                                                    class="text-gray-500 dark:text-gray-400">
                                                                                    {{ $currentDetail->satuan->nama }}
                                                                                </p>
                                                                                <p
                                                                                    class="text-gray-500 dark:text-gray-400">
                                                                                    Rp {{ $currentDetail->harga }}</p>
                                                                                <p
                                                                                    class="text-gray-500 dark:text-gray-400">
                                                                                    Rp {{ $currentDetail->total }}</p>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="flex justify-between items-center mt-3">
                                                    <div class="flex items-center space-x-3">
                                                        <form action="/cetak-transaksi-bahan-baku" method="post">
                                                            @csrf
                                                            <input type="hidden" name="dariTanggal"
                                                                value="{{ $data->tanggal }}">
                                                            <input type="hidden" name="keTanggal"
                                                                value="{{ $data->tanggal }}">
                                                            <input type="hidden" name="normal" value="true">
                                                            <button type="submit"
                                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="currentColor"
                                                                    viewBox="0 0 24 24">
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
                                        </div>
                                    </div>

                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">{{ $data->id }}</td>
                                        <td class="px-4 py-3">{{ $data->formatTanggal() }}</td>
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
                                                <div class="py-1">
                                                    <a href="#"
                                                        data-modal-target="modalTampil{{ $loop->iteration }}"
                                                        data-modal-toggle="modalTampil{{ $loop->iteration }}"
                                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Tampil</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="5" class="px-6 py-4 text-center">No recent transactions found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

@endsection

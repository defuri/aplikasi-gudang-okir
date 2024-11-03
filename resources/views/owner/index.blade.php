@extends('layouts.owner')

@section('content')
    <div class="p-4">
        <!-- Welcome Section -->
        <x-welcome />

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Total Products -->
            <a href="{{ route('produk.index') }}">
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 dark:text-gray-400">Total Produk</h3>
                        <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $totalProduk ?? '' }}</p>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Lihat semua produk</p>
                </div>
            </a>

            <!-- Low Stock Products -->
            <a href="{{ route('produk.index') }}">
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 dark:text-gray-400">Peringatan Stok</h3>
                        <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ count($stokMenipis) ?? '' }}</p>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Lihat stok yang menipis</p>
                </div>
            </a>

            <!-- Total Suppliers -->
            <a href="{{ route('suplier.index') }}">
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 dark:text-gray-400">Suplier Aktif</h3>
                        <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $totalSuplier ?? '' }}</p>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Suplier terdaftar</p>
                </div>
            </a>

            <!-- Total Users -->
            <a href="{{ route('akun.index') }}">
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 dark:text-gray-400">Sistem</h3>
                        <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $totalUser ?? '' }}</p>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Akun aktif</p>
                </div>
            </a>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Menu Cepat</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('produk.index') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full mr-4">
                        <svg class="w-6 h-6 text-blue-500 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-gray-800 dark:text-white font-medium">Tambah Produk</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Membuat produk baru</p>
                    </div>
                </a>

                <a href="/stok"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full mr-4">
                        <svg class="w-6 h-6 text-yellow-500 dark:text-yellow-300" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-gray-800 dark:text-white font-medium">Cek Stok</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tampilkan stok</p>
                    </div>
                </a>

                <a href="{{ route('suplier.index') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full mr-4">
                        <svg class="w-6 h-6 text-green-500 dark:text-green-300" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-gray-800 dark:text-white font-medium">Tambah Suplier</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tambahkan suplier baru</p>
                    </div>
                </a>

                <a href="{{ route('transaksi-bahan-baku.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full mr-4">
                        <svg class="w-6 h-6 text-purple-500 dark:text-purple-300" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-gray-800 dark:text-white font-medium">Catat Transaksi Bahan Baku</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Catat data baru</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Aktivitas Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">id</th>
                                <th scope="col" class="px-6 py-3">log_name</th>
                                <th scope="col" class="px-6 py-3">aktivitas</th>
                                <th scope="col" class="px-6 py-3">causer_id</th>
                                <th scope="col" class="px-6 py-3">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activity as $currentActivity)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $currentActivity->id }}</td>
                                    <td class="px-6 py-4">{{ $currentActivity->log_name }}</td>
                                    <td class="px-6 py-4 text-nowrap">
                                        @php
                                            $description = $currentActivity->description;
                                            $badgeColor = '';

                                            if ($description == 'LOGIN') {
                                                $badgeColor = 'green';
                                            } elseif ($description == 'LOGOUT') {
                                                $badgeColor = 'red';
                                            } elseif (str_contains(strtolower($description), 'insert')) {
                                                $badgeColor = 'green';
                                            } elseif (str_contains(strtolower($description), 'update')) {
                                                $badgeColor = 'yellow';
                                            } elseif (str_contains(strtolower($description), 'delete')) {
                                                $badgeColor = 'red';
                                            }
                                        @endphp

                                        @if ($badgeColor)
                                            <span
                                                class="bg-{{ $badgeColor }}-100 text-{{ $badgeColor }}-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-{{ $badgeColor }}-900 dark:text-{{ $badgeColor }}-300">
                                                {{ $description }}
                                            </span>
                                        @else
                                            {{ $description }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $currentActivity->causer_id }}</td>
                                    <td class="px-6 py-4">
                                        {{ $currentActivity->created_at->setTimezone('Asia/Jakarta')->format('H:i d-m-Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="5" class="text-center px-6 py-4">
                                        Tidak ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-8"></div>
        <x-footer />
    </div>
@endsection

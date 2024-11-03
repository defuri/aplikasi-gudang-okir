@extends('layouts.gudangLayout')

@section('content')
    <div class="mt-24"></div>

    <x-welcome />

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- Total Produk Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Produk</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalProduk }}</p>
            </div>
        </div>

        <!-- Stok Menipis Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Stok Menipis</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ count($stokMenipis) }} produk</p>
            </div>
        </div>

        <!-- Total Transaksi Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Transaksi</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalTransaksi }} hari ini</p>
            </div>
        </div>

        <!-- Nilai Inventory Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nilai Inventory</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">Rp {{ $nilaiInventori }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Low Stock Tables -->
    <div class="grid gap-6 mb-8 md:grid-cols-1">
        <!-- Low Stock Alert Table -->
        <div class="min-w-0 p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Peringatan Stok Menipis</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Produk</th>
                            <th scope="col" class="px-4 py-3">Stok</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokMenipis as $currentStokMenipis)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $currentStokMenipis->produk->nama }}</td>
                                <td class="px-4 py-3">{{ $currentStokMenipis->stok }}</td>
                                @if ($currentStokMenipis->stok <= 500)
                                    <td class="px-4 py-3"><span
                                            class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-300">Kritis</span>
                                    </td>
                                @else
                                    <td class="px-4 py-3"><span
                                            class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Warning</span>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Recent Activity Table -->
        <div class="min-w-0 p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Aktivitas Terkini</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">log_name</th>
                            <th scope="col" class="px-4 py-3">description</th>
                            <th scope="col" class="px-4 py-3">username</th>
                            <th scope="col" class="px-4 py-3">waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activity as $currentActivity)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 text-bold">{{ $currentActivity->id }}</td>
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

    <x-footer />
@endsection

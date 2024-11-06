@extends($user->id_hak === 1 ? 'layouts.owner' : ($user->id_hak === 2 ? 'layouts.ProduksiLayout' : ($user->id_hak === 3 ? 'layouts.gudangLayout' : 'layouts.default')))

@section('namaHalaman', 'Aktivitas')
@section('namaOperator', $user->id_hak === 1 ? 'Owner' : ($user->id_hak === 2 ? 'Admin Produksi' : 'Admin Gudang'))
@section('judul', 'Log Aktivitas')

@section('content')
    @include('layouts.breadcrumb')

    <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-800 relative shadow-sm sm:rounded-lg overflow-hidden">


        <x-search :placeholder="'Cari Log Name'" :tabel="'activityOwner'" />

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">ID</th>
                        <th scope="col" class="px-4 py-3">log name</th>
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
                            <td>{{ $currentActivity->causer?->username ?? 'Unknown User' }}</td>
                            <td class="px-6 py-4">
                                {{ $currentActivity->created_at->setTimezone('Asia/Jakarta')->format('H:i d-m-Y') }}</td>
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
        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
            aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                Menampilkan
                <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                dari
                <span class="font-semibold text-gray-900 dark:text-white">{{ $activity->total() }}</span>
            </span>
            <ul class="inline-flex items-stretch -space-x-px">
                <li>
                    {{ $activity->links() }}
                </li>
            </ul>
        </nav>
    </div>

    <x-footer />
@endsection

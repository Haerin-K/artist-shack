@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">📊 Sales Report</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Daily Sales</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Orders</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesData as $data)
                        <tr class="border-b hover:bg-purple-50">
                            <td class="px-4 py-3 text-gray-800 font-semibold">{{ \Carbon\Carbon::parse($data->date)->format('F d, Y') }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $data->orders }}</td>
                            <td class="px-4 py-3 text-purple-600 font-bold">${{ number_format($data->revenue, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
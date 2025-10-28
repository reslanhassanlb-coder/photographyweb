<div>
    <div class="p-6 bg-gray-50 rounded-xl shadow-sm">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <button wire:click="previousMonth" class="px-3 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                    ‹
                </button>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ \Carbon\Carbon::create($year, $month)->format('F Y') }}
                </h2>
                <button wire:click="nextMonth" class="px-3 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                    ›
                </button>
            </div>

            <div class="flex items-center gap-3">
                <select wire:model="selectedPackage" class="border rounded-lg px-3 py-2 text-gray-700 focus:ring-2 focus:ring-blue-400">
                    <option value="">All Packages</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->title }}</option>
                    @endforeach
                </select>

                <select wire:model="selectedStatus" class="border rounded-lg px-3 py-2 text-gray-700 focus:ring-2 focus:ring-blue-400">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Days of the week -->
        <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-600 mb-3">
            <div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div><div>Sun</div>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-3 text-center">
            @php
                $daysInMonth = \Carbon\Carbon::create($year, $month)->daysInMonth;
                $firstDay = \Carbon\Carbon::create($year, $month)->startOfMonth()->dayOfWeekIso; // Monday = 1
            @endphp

            <!-- Empty cells before the first day -->
            @for ($i = 1; $i < $firstDay; $i++)
                <div></div>
            @endfor

            <!-- Calendar days -->
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $date = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
                    $count = isset($bookings[$date]) ? count($bookings[$date]) : 0;
                    $isToday = \Carbon\Carbon::parse($date)->isToday();
                @endphp

                <div
                    wire:click="openDay('{{ $date }}')"
                    class="relative p-3 rounded-lg border transition cursor-pointer
                    {{ $count > 0 ? 'bg-blue-50 border-blue-300 hover:bg-blue-100' : 'bg-white border-gray-200 hover:bg-gray-100' }}
                    {{ $isToday ? 'ring-2 ring-blue-400' : '' }}">

                    <span class="block text-gray-800 font-medium">{{ $day }}</span>

                    @if($count > 0)
                        <span class="absolute top-2 right-2 bg-green-400 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow" style="background-color:#72eb73" >
                            {{ $count }}
                        </span>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" wire:click.self="$set('showModal', false)">
            <div class="bg-white rounded-xl p-6 w-full max-w-md max-h-[80vh] overflow-y-auto shadow-lg animate-fade-in">
                <h3 class="text-lg font-bold mb-4 text-gray-800">
                    Bookings for {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
                </h3>

                @if(count($dayBookings) > 0)
                   <?php echo "<pre>";
                    //print_r($dayBookings);
                    echo "</pre>"; ?>
                    <ul class="space-y-3">
                        @foreach($dayBookings as $booking)
                            <li class="p-3 border rounded-lg bg-gray-50 text-left shadow-sm hover:shadow-md transition">
                                <div class="font-semibold text-blue-600">{{ $booking['client_name'] ?? 'Client' }}</div>
                                <div class="text-sm text-gray-600">Package: {{ $booking['package_name'] ?? '-' }}</div>
                                <div class="text-sm text-gray-600">Status: {{ ucfirst($booking['status'] ?? 'N/A') }}</div>
                                <div class="text-sm text-gray-600">Date: {{ $booking['date'] ?? 'N/A' }}</div>
                                <!--<div class="text-sm text-gray-500">Time: {{ \Carbon\Carbon::parse($booking['created_at'])->format('H:i') }}</div>-->
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center">No bookings for this day.</p>
                @endif

                <button wire:click="$set('showModal', false)" class="mt-5 w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Close
                </button>
            </div>
        </div>
    @endif

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.25s ease-in-out;
        }
    </style>
</div>

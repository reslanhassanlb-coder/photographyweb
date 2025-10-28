<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\PackageBooking;
use App\Models\Package;
use Carbon\Carbon;

class BookingCalendar extends Page
{
    protected static ?string $title = 'Booking Calendar';
    protected static string $view = 'filament.pages.booking-calendar';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Bookings';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'booking-calendar';

    public $month;
    public $year;
    public $bookings = [];
    public $packages;
    public $selectedPackage = '';
    public $selectedStatus = '';
    public $selectedDate = null;
    public $dayBookings = [];
    public $showModal = false;

    public static function getNavigationBadge(): ?string
    {
        return (string) PackageBooking::count();
    }

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->packages = Package::all();
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $bookings = PackageBooking::whereBetween('date', [$start, $end])
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'date' => $booking->date,
                    'client_name' => $booking->client_name,
                    'package_name' => $booking->package_name,
                    'status' => $booking->status,
                    'created_at' => $booking->created_at->format('H:i'),
                ];
            })
            ->toArray();

        $this->bookings = collect($bookings)->groupBy('date')->toArray();
    }


    public function previousMonth()
    {
        $date = Carbon::create($this->year, $this->month)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;
        $this->loadBookings();
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
        $this->loadBookings();
    }

    public function openDay($date)
    {
        $this->selectedDate = $date;

        $this->dayBookings = PackageBooking::with(['package', 'visitor'])
        ->whereDate('date', $date)
        ->get()
        ->map(function ($booking) {
            return [
                'id' => $booking->id,
                'client_name' => $booking->visitor->name ?? '',
                'client_email' => $booking->visitor->email ?? '',
                //'client_phone' => $booking->visitor->phone ?? '',
                'package_name' => $booking->package->title ?? '',
                'package_price' => $booking->package->price ?? '',
                'package_offer_price' => $booking->package->offer_price ?? '',
                //'package_description' => $booking->package->description ?? '',
                'date' => $booking->date,
                //'status' => $booking->status,
                'created_at' => $booking->created_at->format('H:i'),
            ];
        })
        ->toArray();

        $this->showModal = true;
    }

    public function updatedSelectedPackage()
    {
        $this->loadBookings();
    }

    public function updatedSelectedStatus()
    {
        $this->loadBookings();
    }
}

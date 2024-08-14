<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders->map(function ($order, $index) {
            $data = [
                'NO' => $index + 1, 
                'Tiket acara yang Dibeli' => $order->event->event_name,
                'Pemesanan pada' => $order->created_at->format('l, d F Y'), 
                'No Transaksi' => $order->no_transaction,
                'Nama Orang Tua' => $order->name_buyer,
                'Nama Anak' => $order->first_name,
                'Usia Anak' => $order->last_name,
                'Email Pembeli' => $order->email_buyer,
                'Gender' => $order->gender,
                'No HP' => $order->phone_number,
                'Tanggal Lahir' => $order->birth_date,
                'Jumlah Pembelian' => $order->qty,
                'Tipe Tikcet' => $order->ticket_type,
                'Harga' => $order->price,
                'Total Harga' => $order->total_amount,
                'Status' => $order->status,
            ];

            // Add health event specific columns
            if ($order->event->event_type == 'health') {
                $data = array_merge($data, [
                    'NIK' => $order->nik,
                    'BIB' => $order->bib,
                    'Golongan Darah' => $order->blood_type,
                    'Komunitas' => $order->community,
                    'Kontak Darurat' => $order->urgent_contact,
                    'Ukuran Baju' => $order->size_shirt,
                    'Nama Acara' => $order->event_name,
                    'Nomor Kontak Darurat' => $order->number_urgen_contact,
                    'Hubungan Kontak Darurat' => $order->relation_urgen_contact,
                ]);
            }

            return $data;
        });
    }

    public function headings(): array
    {
        // Base headings
        $headings = [
            'NO',
            'Tiket acara yang Dibeli',
            'Pemesanan pada',
            'No Transaksi',
            'Nama Orang Tua',
            'Nama Anak',
            'Usia Anak',
            'Email Pembeli',
            'Gender',
            'No HP',
            'Tanggal Lahir',
            'Jumlah Pembelian',
            'Tipe Ticket',
            'Harga',
            'Total Harga',
            'Status',
        ];

        // Check if any order has event_type 'health' to add additional headings
        if ($this->orders->firstWhere('event.event_type', 'health')) {
            $healthHeadings = [
                'NIK',
                'BIB',
                'Golongan Darah',
                'Komunitas',
                'Kontak Darurat',
                'Ukuran Baju',
                'Nama Acara',
                'Nomor Kontak Darurat',
                'Hubungan Kontak Darurat',
            ];
            $headings = array_merge($headings, $healthHeadings);
        }

        return $headings;
    }
}

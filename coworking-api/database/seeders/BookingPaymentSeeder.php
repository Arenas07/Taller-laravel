<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Member;
use App\Models\Room;
use Carbon\Carbon;

class BookingPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();
        $rooms   = Room::all();

        foreach ($rooms as $room) {
            $start = Carbon::now()->addDays(rand(1,10))->setTime(rand(8,18), 0);

            for ($i=0; $i<rand(1,3); $i++) {
                $end = (clone $start)->addHours(rand(1,3));

                $booking = Booking::create([
                    'member_id' => $members->random()->id,
                    'room_id'   => $room->id,
                    'start_at'  => $start,
                    'end_at'    => $end,
                    'status'    => 'confirmed',
                    'purpose'   => fake()->sentence(3),
                ]);

                if (rand(0,1)) {
                    $payment = Payment::create([
                        'booking_id' => $booking->id,
                        'method'     => fake()->randomElement(['card','cash','transfer']),
                        'amount'     => rand(50, 500),
                        'status'     => 'paid',
                    ]);
                }

                $start = $end->addHours(1); 
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Field;
use App\Models\FieldAvailability;
use App\Models\FieldCategory;
use App\Models\Payment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat 10 pengguna
//        User::factory()->count(10)->create();

        // Membuat 5 kategori lapangan
        FieldCategory::factory()->count(5)->create();

        // Membuat 10 lapangan, setiap lapangan dihubungkan ke kategori secara acak
//        Field::factory(10)->create()->each(function ($field) {
//            // Membuat ketersediaan waktu untuk setiap lapangan
//            foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
//                FieldAvailability::factory()->create([
//                    'field_id' => $field->id,
//                    'day_of_week' => $day,
//                ]);
//            }
//        });

        // Membuat 20 booking
//        Booking::factory()->count(20)->create();
//
//        // Membuat 20 payment
//        Payment::factory()->count(20)->create();

    }
}

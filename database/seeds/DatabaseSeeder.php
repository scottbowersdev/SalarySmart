<?php

use App\Category;
use App\Month;
use App\Payment;
use App\RecurringPayment;
use App\User;
use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        factory(User::class, 10)->create()->each(
            function($user) {

                $faker = Faker::create();

                $dt = Carbon::now();

                for($i = 0; $i <= 12; $i++) {

                    // Create month
                    $month = Month::create([
                        'user_id' => $user->id, 
                        'date' => $dt->year.'-'.$dt->month.'-01',
                        'income' => $user->monthly_salary, 
                    ]);

                    $dt->addMonth();

                }
            
            }
        );
        
        factory(Category::class, 40)->create();

        factory(Wishlist::class, 60)->create();

        factory(RecurringPayment::class, 6)->create()->each(
            function($recurringPayment) {

                $faker = Faker::create();

                $months = Month::all();

                foreach($months as $month) {

                    Payment::create([
                        'month_id' => $month->id, 
                        'category_id' => $recurringPayment->category_id, 
                        'recurring_payment_id' => $recurringPayment->id, 
                        'day' => $recurringPayment->date, 
                        'name' => $recurringPayment->name, 
                        'price' => $recurringPayment->price, 
                        'paid' => rand(0,1)
                    ]);

                }

            }
        );

        $users = User::has('categories')->get();

        foreach($users as $user) {

            $faker = Faker::create();
            $dt = Carbon::now();

            $months = $user->months()->get();

            foreach($months as $month) {

                // Set day
                $day = rand(1,27);
                if($day < 10) {
                    $day = '0'.$day;
                }

                for($payCount = 0; $payCount <= 3; $payCount++) {
                    Payment::create([
                        'month_id' => $month->id, 
                        'category_id' => $user->categories()->get()->random()->id, 
                        'recurring_payment_id' => '0',  
                        'day' => $day, 
                        'name' => $faker->sentence(3), 
                        'price' => $faker->randomFloat(2, 1, 400), 
                        'paid' => rand(0,1)
                    ]);
                }

                $dt->addMonth();

            }

        }

    }
}

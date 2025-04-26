<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\User;
use App\Notifications\BirthDayNotification;
use Illuminate\Console\Command;

class SendBirthdayEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-birthday-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // User::whereDate('birth_date', now()->format('Y-m-d'))->get();
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(BirthDayNotification::class);
        }

        // Product::all()->each(function ($product) {
        //     $product->quantity = $product->quantity + 50;
        //     $product->save();
        // });
    }
}

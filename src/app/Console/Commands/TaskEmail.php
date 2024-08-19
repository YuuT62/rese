<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class TaskEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:task_email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically send an email on the day of your reservation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = explode(' ',new Carbon('today', 'Asia/Tokyo'))[0];
        $reservations=Reservation::DateSearch($date)->get();
        foreach($reservations as $reservation){
            $contact_email = new ContactEmail($reservation);
            Mail::send( $contact_email );
        }
    }
}

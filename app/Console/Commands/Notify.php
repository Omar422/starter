<?php

namespace App\Console\Commands;

use App\User;
use App\Mail\NotifyMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail everyday';

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
     * @return mixed
     */
    public function handle()
    {
        //$mails = User::select('email')->get(); // data collection
        $emails = User::pluck('email')->toArray(); // return an array
        foreach($emails as $email) {
            // code to send mail
            $data = [
                'title' =>  'Programming',
                'body'  =>  'PHP'
            ];
            Mail::To($email)->send(new NotifyMail($data));
        }
    }
}

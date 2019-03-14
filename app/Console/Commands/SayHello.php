<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'say:hello';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     
    

  $users =  
             [
    [ 'email' => 'Uzairdurrani91@gmail.com', 'name'=> 'Uzair' , 'Content'=>'F.B Area'],

             ['email' => 'Hamzali91@gmail.com', 'name'=> 'Hamza', 'Content'=>'North nazimabad']

];

     $bar = $this->output->createProgressBar(count($users));


foreach ($users as $user ) {
    
 //Save in a Database
if ($this->getoutput()->isVerBose()) {
    # code...
     $this->info("\nSuccesfully data save" . $user['email']);
   $this->info("\nSuccesfully data save" . $user['name']);
   $this->info("\nSuccesfully data save" . $user['Content']);
}
//   $this->info("Succesfully data save" . $user['email']);
  // $this->info("Succesfully data save" . $user['name']);

    $bar->advance();


}


    $bar->finish();



    }


}

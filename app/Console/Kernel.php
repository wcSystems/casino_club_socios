<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\User;
use App\Contract;
use Notification;
use Carbon\Carbon;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use App\Models\Attlog;
use App\Models\Employee;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            /* $users = User::all();
            $contracts = Contract::all();
            $now = Carbon::now();
            foreach($contracts as $contract){
                if($contract->end_date != null){
                    $start_date = new Carbon($contract->start_date);
                    $end_date = new Carbon($contract->end_date);
                    $end_date_aux = new Carbon($end_date);
                    $end_date_aux = $end_date_aux->subDays(5);
                    if($now->lessThanOrEqualTo($end_date) && $now->greaterThanOrEqualTo($end_date_aux)){
                        Notification::send($users, new ContractFinishing($contract));
                    }
                }
            } */

        $host = "http://192.168.5.181/";
        $resC = new Client();
        $totalMatches = json_decode($resC->post($host."ISAPI/AccessControl/AcsEvent?format=json" ,[
            'auth' =>  ['admin', 'Cas1n01234','digest'],
            'body' => json_encode([
                "AcsEventCond"=> [
                    "searchID"=> "1",
                    "searchResultPosition"=> 0,
                    "maxResults"=> 1,
                    "major"=> 5,
                    "minor"=> 75,
                    "startTime"=> "2022-01-01T00:00:00+00:00",
                    "endTime"=> "2022-12-31T23:59:00+0:00"
                ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["totalMatches"];
        
        $totalMatches30 = floor($totalMatches/30);
        $searchResultPosition = count(Attlog::all());
        set_time_limit(1000);
        if( $totalMatches > $searchResultPosition ){
            for ($i=0; $i < $totalMatches30 ; $i++) {
                $res = new Client();
                $query2 = json_decode($res->post($host."ISAPI/AccessControl/AcsEvent?format=json" ,[
                    'auth' =>  ['admin', 'Cas1n01234','digest'],
                    'body' => json_encode([
                        "AcsEventCond"=> [
                            "searchID"=> "1",
                            "searchResultPosition"=> $searchResultPosition,
                            "maxResults"=> 30,
                            "major"=> 5,
                            "minor"=> 75,
                            "startTime"=> "2022-01-01T00:00:00+00:00",
                            "endTime"=> "2022-12-31T23:59:00+0:00"
                        ]])])->getBody()->getContents(), TRUE)["AcsEvent"]["InfoList"];
                $searchResultPosition +=30;
                foreach ($query2 as $key => $value) { Attlog::create($value); }
            }
        }





        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

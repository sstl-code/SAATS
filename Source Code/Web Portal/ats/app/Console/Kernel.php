<?php

namespace App\Console;

use Mail;
use App\Models\User;
use App\Class\PMClass;
use App\Models\Location;
use App\Models\TPmApproval;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule
            ->call(function () {
               $strlog= DB::connection('pgsql')->table("ats.mail_log")
                    ->where("is_sent", 0)->limit(30)
                    ->get();
               foreach($strlog as $log){     
                $details = [
                    'title' => $log->subject,
                    'body' => $log->mail_body
                ];
                Mail::to($log->mail_to)->send(new NotificationMail($details)); 
                DB::connection('pgsql')->table("ats.mail_log")->where("id", $log->id)->update(['is_sent'=>1]);
               }  
            })

            ->everyMinute();
            $schedule
            ->call(function () {
                 $PMClass = new PMClass();
              $supervisorData=User::where('is_supervisor','t')->get();
            foreach($supervisorData as $supervisor)
            {
                     $pmToken= $PMClass->pm_login($supervisor->email,'Password@123');
                        if($pmToken){
                        $tasks=$PMClass->getDraftcases($pmToken);
                        foreach($tasks as $task){
                            $StrpmData=TPmApproval::where('pm_project_id',$task->pro_uid)->first();
                            if(!empty($StrpmData)){
                             dd($StrpmData);
                                $tecnicianData=User::where('id',$StrpmData->tpm_technician_id)->first();
                                $supervisorData=User::where('id',$StrpmData->tpm_supervisor_id)->first();
                                print_r($supervisorData);
                                 print_r($tecnicianData);
                                $site_code="";
                                $location=Location::where('tl_location_id',$StrpmData->tpm_asset_site_id)->first();
                                    if(!empty($location)){
                                        $site_code=$location->tl_location_code." ".$location->tl_location_address;
                                    }
                                TPmApproval::where('pm_project_id',$task->pro_uid)->update(['technician_name'=>$tecnicianData->name,'approver_name'=>$supervisorData->name,'case_no'=>$task->app_number,'site_code'=>$site_code,'task_title'=>$task->app_tas_title]); 
                        }
                        }
                        }
           }
            })
        ->everyTwoMinutes(); 
            
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

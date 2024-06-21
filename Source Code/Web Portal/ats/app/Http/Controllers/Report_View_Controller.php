<?php

namespace App\Http\Controllers;

use App\Models\User;
use ReflectionObject;
use App\Models\Report;
use App\Models\TPmApproval;
use Illuminate\Http\Request;
use App\Exports\FarToAtsExport;
use PHPJasper\Exception;
use PHPJasper\PHPJasper;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class Report_View_Controller extends Controller
{
    public function index(Request $request) 
    {
        $data=Report::where('id',1)->get();
        $technicians=User::where('is_supervisor','f')->where('is_admin','f')->orderBy('name')->get();
        return view('report',compact('data','technicians'));
    }
    public function generateReport(Request $request) 
    {
        $reportData=Report::where('id',$request->rptId)->first();
        
        $validator = Validator::make($request->all(), [
            'rptId' => 'required',
            'rptformat' => 'required',
        ]);
        if($validator->fails())
        {
           return redirect('/report')->withErrors([
                'message' => $validator->errors()->all(),
            ]);
        }
        $input =  public_path('jasper/input/').$reportData->jasper_file;   

       $jasper = new PHPJasper();
        $outputfileName=time().trim($reportData->jasper_file,'.jrxml');
        $output = public_path('jasper/output/'.$outputfileName);    
        $outputfileName= $outputfileName.".".$request->rptformat;
        $options = [
            'format' => [$request->rptformat],
            'locale' => 'en',
            'params' => ['LogoURL'=>url('assets/images/SSTLLogo.png')],
            'db_connection' => [
                'driver' => 'postgres', //mysql, ....
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'database' => env('DB_DATABASE'),
                'port' => env('DB_PORT')
            ]
        ];
        
       
        
       $data= $jasper->process(
            $input,
            $output,
            $options
        )->execute();
     //   header('Content-Disposition: inline; filename="'.$outputfileName.'"');
      // header('Content-Type: application/octet-stream'); 
        //ob_clean();

        return redirect()->to(url('jasper/output/')."/".$outputfileName);

    }
   /* public function generateOutputFile(Request $request) 
    {
        $reportData=Report::where('id','15')->first();
        
        $input =  public_path('jasper/input/').$reportData->jasper_file;   

        $jasper = new PHPJasper();
        $outputfileName=time().trim($reportData->jasper_file,'.jrxml');
        $output = public_path('jasper/output/'.$outputfileName);    
        $outputfileName= $outputfileName.".xlsx";
        $options = [
            'format' => ['xlsx'],
            'locale' => 'en',
            'params' => ['LogoURL'=>url('assets/images/SSTLLogo.png')],
            'db_connection' => [
                'driver' => 'postgres', //mysql, ....
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'database' => env('DB_DATABASE'),
                'port' => env('DB_PORT')
            ]
        ];
        
        $jasper = new PHPJasper();
        
       $data= $jasper->process(
            $input,
            $output,
            $options
        )->execute();
     //   header('Content-Disposition: inline; filename="'.$outputfileName.'"');
      // header('Content-Type: application/octet-stream'); 
        //ob_clean();
        TPmApproval::where('task_status','Completed')->where('task_title', 'not like', "Audit%")->update(['output_file_generated'=>'t']);
        return redirect()->to(url('jasper/output/')."/".$outputfileName);

    }*/

    public function generateOutputFile(Request $request) 
    {
      return Excel::download(new FarToAtsExport, date('dmY_His').'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}

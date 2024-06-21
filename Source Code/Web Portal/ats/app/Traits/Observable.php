<?php

namespace App\Traits;

use App\Models\SystemLog;
use Illuminate\Support\Str;
use App\Models\Asset_type_model;
use App\Models\AssetTaggingHistory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait Observable
{
  
    /* Handle model event
     
    public static function bootObservable()
    {
        $newValues=[];
        $oldValues=[];
        /**
         * Data creating and updating event
         */
        /*
      $model='\\'.get_called_class();
   
      $model =new $model;
      
        
        
      
        static::deleted(function (Model $model) {
            static::storeLog($model, static::class, 'DELETED');
        });
      
    switch(get_called_class())
       {
        case 'App\Models\Asset_type_model':
        { 
            Log::debug(app()->request);
            if(app()->request->id && app()->request->typename){
               // static::storeLog($model, static::class, 'UPDATED');
               $oldData=$model->find(app()->request->id);
               $oldDataArray=['at_asset_type_description'=> $oldData->at_asset_type_description,
                                'at_asset_type_name' => $oldData->at_asset_type_name,
                                'at_asset_type_category' => $oldData->at_asset_type_category,
                                'at_asset_type_status' => $oldData->at_asset_type_status
                             ];
               $newData=['at_asset_type_description'=> app()->request->description,
                         'at_asset_type_name' => app()->request->typename,
                         'at_asset_type_category' => app()->request->catagory,
                         'at_asset_type_status' => app()->request->status
                        ];
                 $fieldName=['at_asset_type_description'=>'Description','at_asset_type_name'=>'Name','at_asset_type_status'=>'Status','at_asset_type_category'=>'Category'];       
                $changeData=array_diff($newData,$oldDataArray); 
               
                foreach($changeData as $key=>$value)
                {
                    $fieldNameLabel=$fieldName[$key];
                    $newValues[0][$fieldNameLabel]=$newData[$key];
                    $oldValues[0][$fieldNameLabel]=$oldDataArray[$key];
                  //  array_push($changeValues,["oldValue->".$key=>$oldDataArray[$key],"newValue->".$key=>$newData[$key]]);
                }  
                $modelId=app()->request->id;
                static::storeLog($model, static::class, 'UPDATED',$modelId,$oldValues,$newValues);   
            }
            static::saved(function ($model) {
                // create or update?
                if ($model->wasRecentlyCreated) {
                    
                $newData[0]=['Description'=> app()->request->description,
                             'Name' => app()->request->typename,
                             'Category' => app()->request->catagory,
                             'Status' => app()->request->status
                             ];
                static::storeLog($model, static::class, 'CREATED',0,[],$newData);
                } else {
                    static::storeLog($model, static::class, 'UPDATED');
                }
            });
                
        }
          
        }
       
    }
    */
    /** 
     
     * Generate the model name
     * @param  Model  $model
     * @return string
     */
    public static function getTagName(Model $model)
    {
        return !empty($model->tagName) ? $model->tagName : Str::title(Str::snake(class_basename($model), ' '));
    }

    /**
     * Retrieve the current login user id
     * @return int|string|null
     */
    public static function activeUserId()
    {
        return Auth::guard(static::activeUserGuard())->id();
    }

    /**
     * Retrieve the current login user guard name
     * @return mixed|null
     */
    public static function activeUserGuard()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
        return null;
    }

    /**
     * Store model logs
     * @param $model
     * @param $modelPath
     * @param $action
     */
    public static function storeLog($moduleName, $modelPath, $action,$modelId=0,$oldDataArray=[],$newData=[],$userID,$source)
    {
     //  $changeData=array_diff($newData,$oldDataArray); 
           if(count($newData)>0){   
                foreach($newData as $key=>$value)
                {
                    if(!isset($oldDataArray[$key]) || $newData[$key]!=$oldDataArray[$key]){
                    $newValues[0][$key]=str_replace("'","",$newData[$key]);
                    $oldValues[0][$key]=isset($oldDataArray[$key])?str_replace("'","",$oldDataArray[$key]):null;
                    
                }
                }  

      //  if ($action !== 'CREATED') {
        //    $oldValues = $model->getAttributes();
        //}
    
        $systemLog = new SystemLog();
        $systemLog->system_logable_id = $modelId;
        $systemLog->system_logable_type = $modelPath;
        $systemLog->user_id = $userID;
        $systemLog->guard_name =$source;
        $systemLog->module_name = $moduleName;
        $systemLog->action = $action;
        $systemLog->old_value = !empty($oldValues) ? json_encode(array_values($oldValues)) : null;
        $systemLog->new_value = !empty($newValues) ? json_encode(array_values($newValues)) : null;
        $systemLog->ip_address = request()->ip();
        $systemLog->save();
      }
    }
}
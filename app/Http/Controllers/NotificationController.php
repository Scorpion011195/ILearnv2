<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SettingUserService;
use Auth;
use Session;

class NotificationController extends Controller
{
    //
    private $settingUserService;

    public function __construct(SettingUserService $settingUserService){
        $this->settingUserService = $settingUserService;
    }

    public function addInforOfNotification(Request $request)
    {
    	//Input 
    	$notificationButton = $request->notificationButton;
    	$timeReminder = $request->timeReminder;
    	$typeReminder = $request->typeReminder;

    	$userId = Auth::user()->id;

    	// Insert to setting_user
    	$arrSettingUser = ['time_reminder_id' => $timeReminder, 'type_reminder_id' => $typeReminder, 'isOn' => $notificationButton];

    	$this->settingUserService->updateByColumn('user_id', $userId, $arrSettingUser);
    	$dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }

    public function getIsOn(){

    	$user_id = Auth::user()->id;
        $userSetting = $this->settingUserService->getSettingFromUserId($user_id);
        $isOn = $userSetting->isOn;

        $dataResponse = ["data"=>true, 'checkIsOn' => $isOn];
        return json_encode($dataResponse);
    } 

    public function getIsStartNotification(){
    	$isStartNotification = Session::get('isStartNotification');

    	$dataResponse = ["data"=>true, 'isStartNotification' => $isStartNotification];
        return json_encode($dataResponse);
    }

    public function endIsStartNotification(){
    	Session::put('isStartNotification', false);

    	$dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }

    public function getTimeReminder()
    {
    	$user_id = Auth::user()->id;
        $rowTimeReminder = $this->settingUserService->getTimeReminderFromUserId($user_id);
        $timeReminder = $rowTimeReminder['time'];
        $timeReminder = 3000;//$timeReminder*60*1000;

        $dataResponse = ["data"=>true, 'timeReminder' => $timeReminder];
        return json_encode($dataResponse);
    }

    public function getWordToPush(){
    	$user_id = Auth::user()->id;
    	$wordUsers = $this->settingUserService->getWordUserFromUserId($user_id);

    	if(count($wordUsers) > 0) {
    		$dataResponse = ["data"=>true, 'wordUsers' => $wordUsers];
        	return json_encode($dataResponse);
    	}
    	else{
    		$dataResponse = ["data"=>falses];
        	return json_encode($dataResponse);
    	}
        
    }

    public function getTypeReminder()
    {
    	$user_id = Auth::user()->id;
    	$rowTypeReminder = $this->settingUserService->getTypeReminderFromUserId($user_id);
        $typeReminder = $rowTypeReminder['type'];

        $dataResponse = ["data"=>true, 'typeReminder' => $typeReminder];
        return json_encode($dataResponse);

    }
}

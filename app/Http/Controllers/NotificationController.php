<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SettingUserService;
use Auth;

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
}

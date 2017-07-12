<?php

namespace App\Http\Controllers;

// This is a file to define some objests
// Do not remove it!
class MyConstant
{
	const STATUS_USER = ['Hoạt động'=>1,'Bị khóa'=>0];

	const ROLE_USER = ['superadmin' => 1, 'admin' => 2, 'editor' => 3, 'contributor' => 4, 'user' => 5];
}
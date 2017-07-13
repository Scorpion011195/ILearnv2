<?php

namespace App\Http\Controllers;

// This is a file to define some objests
// Do not remove it!
class MyConstant
{
	const STATUS_USER = ['Hoạt động'=>1,'Bị khóa'=>0];

	const ROLE_USER = ['superadmin' => 1, 'admin' => 2, 'editor' => 3, 'contributor' => 4, 'user' => 5];

    const CRAWLER_VDICT_LANGPAIR = ['en-vi' => 1, 'vi-en' => 2];

    const TYPE_WORD_VIETNAMESE_VDICT = ['danh từ' => 1,
                                        'nội động từ' => 2,
                                        'ngoại động từ' => 2,
                                        'động từ' => 2,
                                        'tính từ' => 3,
                                        'trạng từ' => 4,
                                        'thán từ' => 5,
                                        'giới từ' => 6,
                                        'phó từ' => 7,
                                        'chưa xác định' => 8
                                       ];
}

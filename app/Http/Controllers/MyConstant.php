<?php

namespace App\Http\Controllers;

// This is a file to define some objests
// Do not remove it!
class MyConstant
{
	const STATUS_USER = ['Hoạt động'=>1,'Bị khóa'=>0];

	const ROLE_USER = ['superadmin' => 1, 'admin' => 2, 'editor' => 3, 'contributor' => 4, 'user' => 5];

    const CRAWLER_VDICT_LANGPAIR = ['en-vi' => 1, 'vi-en' => 2];
    const CRAWLER_VDICT_NAME = ['Anh - Việt' => 1, 'Việt - Anh' => 2];

    const TYPE_WORD_VIETNAMESE_VDICT = ['chưa xác định' => 1,
                                        'danh từ' => 2,
                                        'nội động từ' => 3,
                                        'ngoại động từ' => 4,
                                        'động từ' => 5,
                                        'tính từ' => 6,
                                        'trạng từ' => 7,
                                        'thán từ' => 8,
                                        'giới từ' => 9,
                                        'phó từ' => 10,
                                        'mạo từ' => 11,
                                        'liên từ' => 12,
                                        "danh từ,  số nhiều as,  a's'" => 13,
                                        'động từ had' => 14
                                       ];

    const LANGUAGE = ['Anh' => 1,'Nhật' => 2, 'Việt' => 3];

    const LANGUAGE_TRANSLATE_PARAGRAPH = ['en' => 'Anh','ja' => 'Nhật', 'vi' => 'Việt'];

    const LANGUAGE_FORM_LANGPAIR = ['31' => 3, '13' => 1];
}

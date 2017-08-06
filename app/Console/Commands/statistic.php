<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class statistic extends Command{
    /**
     * Tên của cron job
     *
     * @var string
     */
    protected $name = 'email:everyHour';
 
    /**
     * Mô tả cho cron job
     *
     * @var string
     */
    protected $description = 'Command description.';
 
    /**
     * Hàm khởi tạo
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
 
    /**
     * Đây là hàm chính sẽ chạy khi cron job được thực thi
     * Chúng ta sẽ viết lời gọi tới command xử lý nghiệp vụ,
     * cụ thể trong ví dụ này là App\Commands\EmailCommand
     * @return mixed
     */
    public function fire()
    { 
        //Khai báo đường dẫn tới command class
        Bus::dispatchFromArray('App\Commands\EmailCommand', []);
    } 
}

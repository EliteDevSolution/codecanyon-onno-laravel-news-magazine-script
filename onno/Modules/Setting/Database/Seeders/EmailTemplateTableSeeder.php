<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\EmailTemplate;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        EmailTemplate::create(['email_group' => 'active_account', 'subject' => 'Active Account', 'template_body' =>"" ]);
        EmailTemplate::create(['email_group' => 'password_reset', 'subject' => 'Reset Password', 'template_body' =>'']);
    }
}

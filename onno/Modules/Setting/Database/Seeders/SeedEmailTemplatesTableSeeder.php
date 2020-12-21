<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\EmailTemplate;

class SeedEmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailTemplate::create([
            'email_group'       => 'registration',
            'subject'           => 'Registration successful',
            'template_body'     => '<table id="backgroundTable" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td valign="top"><table border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td width="600" height="50">&nbsp;</td></tr><tr><td style="color: #999999;" width="600" height="90">{SITE_LOGO}</td></tr><tr><td style="background: whitesmoke; border: 1px solid #e0e0e0; font-family: Helvetica,Arial,sans-serif;" valign="top" bgcolor="whitesmoke" width="600" height="200"><table style="margin-left: 15px;" align="center"><tbody><tr><td width="560" height="10">&nbsp;</td></tr><tr><td width="560"><h4>New Account</h4><p style="font-size: 12px; font-family: Helvetica,Arial,sans-serif;">Hi {USERNAME},</p><p style="font-size: 12px; line-height: 20px; font-family: Helvetica,Arial,sans-serif;">Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe.<br /> To open your {SITE_NAME} homepage, please follow this link:<br /> <a style="color: #11a7db; text-decoration: none;" href="{SITE_URL}"><strong>{SITE_NAME} Account</strong></a><br /><br /> Link doesn\'t work? Copy the following link to your browser address bar:<br /><br />{SITE_URL}<br /><br /> Your username: {USERNAME}<br /> Your email address: {USER_EMAIL}<br /><br /><br />{SIGNATURE}</p></td></tr><tr><td width="560" height="10">&nbsp;</td></tr></tbody></table></td></tr><tr><td width="600" height="10">&nbsp;</td></tr><tr><td align="right">&nbsp;</td></tr></tbody></table></td></tr></tbody></table>',
            'lang'              => 'en',
        ]);

        EmailTemplate::create([
            'email_group'       => 'forgot_password',
            'subject'           => 'Forgot Password',
            'template_body'     => '<table id="backgroundTable" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td valign="top"><table border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td width="600" height="50">&nbsp;</td></tr><tr><td style="color: #999999;" width="600" height="90">{SITE_LOGO}</td></tr><tr><td style="background: whitesmoke; border: 1px solid #e0e0e0; font-family: Helvetica,Arial,sans-serif;" valign="top" bgcolor="whitesmoke" width="600" height="200"><table style="margin-left: 15px;" align="center"><tbody><tr><td width="560" height="10">&nbsp;</td></tr><tr><td width="560"><h4>New Password</h4><p style="font-size: 12px; line-height: 20px; font-family: Helvetica,Arial,sans-serif;">Forgot your password, huh? No big deal.<br />To create a new password, just follow this link:<br /> <a style="color: #11a7db; text-decoration: none;" href="{PASS_KEY_URL}"><strong>Create new password</strong></a><br /><br /> Link doesn\'t work? Copy the following link to your browser address bar:<br /> {PASS_KEY_URL}<br /><br /> You received this email, because it was requested by a {SITE_NAME} user.This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.<br /><br />Thank you,<br /><br /> Best Regards,<br /> {SITE_NAME}</p></td></tr><tr><td width="560" height="10">&nbsp;</td></tr></tbody></table></td></tr><tr><td width="600" height="10">&nbsp;</td></tr><tr><td align="right"><span style="font-size: 10px; color: #999999; font-family: Helvetica,Arial,sans-serif;">{SIGNATURE}</span></td></tr></tbody></table></td></tr></tbody></table>',
            'lang'              => 'en',
        ]);
        EmailTemplate::create([
            'email_group'       => 'activate_account',
            'subject'           => 'Activate Account',
            'template_body'     => '<table id="backgroundTable" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td valign="top"><table border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td width="600" height="50">&nbsp;</td></tr><tr><td style="color: #999999;" width="600" height="90">{SITE_LOGO}</td></tr><tr><td style="background: whitesmoke; border: 1px solid #e0e0e0; font-family: Helvetica,Arial,sans-serif;" valign="top" bgcolor="whitesmoke" width="600" height="200"><table style="margin-left: 15px;" align="center"><tbody><tr><td width="560" height="10">&nbsp;</td></tr><tr><td width="560"><h4>Activate Account</h4><p style="font-size: 12px; font-family: Helvetica,Arial,sans-serif;">Hi {USERNAME},</p><p style="font-size: 12px; line-height: 20px; font-family: Helvetica,Arial,sans-serif;">Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe. To verify your email address, please follow this link:<br /> <a style="color: #11a7db; text-decoration: none;" href="{ACTIVATE_URL}"><strong>Complete Registration</strong></a><br /><br /> Link doesn\'t work? Copy the following link to your browser address bar:<br /> {ACTIVATE_URL}<br /><br /> Your username: {USERNAME}<br /> Your email address: {USER_EMAIL}<br /> Your password: {PASSWORD}<br /><br /><br /> {SIGNATURE}</p></td></tr><tr><td width="560" height="10">&nbsp;</td></tr></tbody></table></td></tr><tr><td width="600" height="10">&nbsp;</td></tr><tr><td align="right">&nbsp;</td></tr></tbody></table></td></tr></tbody></table><p>&nbsp;</p>',
            'lang'              => 'en',
        ]);
        EmailTemplate::create([
            'email_group'       => 'reset_password',
            'subject'           => 'Reset Password',
            'template_body'     => '<table id="backgroundTable" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td valign="top"><table border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td width="600" height="50">&nbsp;</td></tr><tr><td style="color: #999999;" width="600" height="90">{SITE_LOGO}</td></tr><tr><td style="background: whitesmoke; border: 1px solid #e0e0e0; font-family: Helvetica,Arial,sans-serif;" valign="top" bgcolor="whitesmoke" width="600" height="200"><table style="margin-left: 15px;" align="center"><tbody><tr><td width="560" height="10">&nbsp;</td></tr><tr><td width="560"><h4>New Password</h4><p style="font-size: 12px; font-family: Helvetica,Arial,sans-serif;">Hi {USERNAME},</p><p style="font-size: 12px; line-height: 20px; font-family: Helvetica,Arial,sans-serif;">You have changed your password.<br />Please, keep it in your records so you don\'t forget it:<br />Your username: {USERNAME}<br />Your email address: {USER_EMAIL}<br />Your new password: {NEW_PASSWORD}<br /><br /><br /> Best Regards,<br /> {SITE_NAME}</p></td></tr><tr><td width="560" height="10">&nbsp;</td></tr></tbody></table></td></tr><tr><td width="600" height="10">&nbsp;</td></tr><tr><td align="right"><span style="font-size: 10px; color: #999999; font-family: Helvetica,Arial,sans-serif;">{SIGNATURE}</span></td></tr></tbody></table></td></tr></tbody></table>',
            'lang'              => 'en',
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}

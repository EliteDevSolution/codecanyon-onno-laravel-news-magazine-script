<?php

namespace Modules\Setting\Http\Controllers;

use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Modules\Language\Entities\Language;
use Modules\Setting\Entities\Setting;
use Validator;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Mail;
use Modules\Setting\Entities\EmailTemplate;
use File;
use Image;
use Illuminate\Support\Facades\Storage;
use App;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $countries      = Countries::all();

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        return view('setting::index',
            [
                'activeLang'    => $activeLang,
                'countries'     => $countries
            ]);
    }

    //update settings
    public function updateSettings(Request $request)
    {
        $default_language   = $request->default_language ?? settingHelper('default_language');


        $company_language   = $request->company_language;
        $seo_language       = $request->seo_language;
        $onesignal_language = $request->onesignal_language;

        foreach ($request->except('_token', 'company_language', 'seo_language', 'onesignal_language') as $key => $value) :

            // if ($request->$key != null) :
            if ($key == 'logo') :
                if ($request->file('logo')) :

                    $validation = Validator::make($request->all(), [
                        'logo'  => 'required|mimes:jpg,JPG,JPEG,jpeg,gif,png|max:5120',
                    ])->validate();

                    $setting    = Setting::where('title', 'logo')->first();
                    if (File::exists($setting->value)) :
                        unlink($setting->value);
                    endif;

                    $requestImage       = $request->file('logo');

                    $fileType           = $requestImage->getClientOriginalExtension();
                    $originalImageName  = date('YmdHis') . "_logo_" . rand(1, 50) . '.' . $fileType;

                    if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                        $directory              = 'images/';
                    else:
                        $directory              = 'public/images/';
                    endif;

                    $originalImageUrl   = $directory . $originalImageName;

                    Image::make($requestImage)->save($originalImageUrl);

                    $setting->value     = str_replace("public/","",$originalImageUrl);
                    $setting->lang      = $default_language;

                    $setting->save();
                endif;

            elseif ($key == 'favicon'):
                if ($request->file('favicon')) :

                    $validation     = Validator::make($request->all(), [
                        'favicon'   => 'required|mimes:jpg,JPG,JPEG,jpeg,gif,png,ico|max:5120',
                    ])->validate();

                    $setting        = Setting::where('title', 'favicon')->first();
                    if (File::exists($setting->value)) :
                        unlink($setting->value);
                    endif;

                    $requestImage       = $request->file('favicon');

                    $fileType           = $requestImage->getClientOriginalExtension();
                    $originalImageName  = date('YmdHis') . "_favicon_" . rand(1, 50) . '.' . $fileType;

                    if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                        $directory              = 'images/';
                    else:
                        $directory              = 'public/images/';
                    endif;

                    $originalImageUrl   = $directory . $originalImageName;

                    Image::make($requestImage)->save($originalImageUrl);

                    $setting->value     = str_replace("public/","",$originalImageUrl);
                    $setting->lang      = $default_language;

                    $setting->save();

                endif;

            elseif ($key == 'og_image'):
                if ($request->file('og_image')) :

                    $validation     = Validator::make($request->all(), [
                        'og_image'  => 'required|mimes:jpg,JPG,JPEG,jpeg,gif,png,ico|max:5120',
                    ])->validate();

                    $setting = Setting::where('title', 'og_image')->first();
                    if (File::exists($setting->value)) :
                        unlink($setting->value);
                    endif;
                    $requestImage       = $request->file('og_image');

                    $fileType           = $requestImage->getClientOriginalExtension();
                    $originalImageName  = date('YmdHis') . "_og_image_" . rand(1, 50) . '.' . $fileType;


                    if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                        $directory              = 'images/';
                    else:
                        $directory              = 'public/images/';
                    endif;

                    $originalImageUrl   = $directory . $originalImageName;

                    Image::make($requestImage)->save($originalImageUrl);

                    $setting->value     = str_replace("public/","",$originalImageUrl);
                    $setting->lang      = $default_language;

                    $setting->save();

                endif;

            else:

                if ($key == "application_name" || $key == "address" || $key == "email" || $key == "phone" || $key == "zip_code" || $key == "city" || $key == "state" || $key == "country" || $key == "website" || $key == "company_registration" || $key == "tax_number" || $key == "about_us_description") :

                    $setting            = Setting::where('title', $key)->where('lang', $company_language)->first();

                    if ($setting == "") :
                        $setting        = new Setting();
                        $setting->title = $key;
                        $setting->value = $value;
                        $setting->lang  = $company_language;
                    else :
                        $setting->value = $value;
                        $setting->lang  = $company_language;
                    endif;

                elseif ($key == "seo_title" || $key == "seo_keywords" || $key == "seo_meta_description" || $key == "author_name" || $key == "og_title" || $key == "og_description") :

                    $setting            = Setting::where('title', $key)->where('lang', $seo_language)->first();

                    if ($setting == "") :
                        $setting        = new Setting();
                        $setting->title = $key;
                        $setting->value = $value;
                        $setting->lang  = $seo_language;
                    else :
                        $setting->value = $value;
                        $setting->lang  = $seo_language;
                    endif;

                elseif ($key == "onesignal_action_message" || $key == "onesignal_accept_button" || $key == "onesignal_cancel_button") :

                    $setting            = Setting::where('title', $key)->where('lang', $onesignal_language)->first();

                    if ($setting == "") :
                        $setting        = new Setting();
                        $setting->title = $key;
                        $setting->value = $value;
                        $setting->lang  = $onesignal_language;
                    else :
                        $setting->value = $value;
                        $setting->lang  = $onesignal_language;
                    endif;

                elseif ($key == "custom_footer_js") :

                    $setting            = Setting::where('title', $key)->where('lang', $default_language)->first();

                    if ($setting == "") :
                        $setting        = new Setting();
                        $setting->title = $key;
                        $setting->value = base64_encode($value);
                        $setting->lang  = $default_language;
                    else :
                        $setting->value = base64_encode($value);
                        $setting->lang  = $default_language;
                    endif;

                else :
                    $setting = Setting::where('title', $key)->where('lang', $default_language)->first();

                    if ($setting == "") :
                        $setting        = new Setting();
                        $setting->title = $key;
                        $setting->value = $value;
                        $setting->lang  = $default_language;
                    else :
                        $setting->value = $value;
                        $setting->lang  = $default_language;
                    endif;

                endif;

                $setting->save();

            endif;
            // endif;
        endforeach;

        return redirect()->back()->with('success', __('successfully_updated'));

    }

    //view email template list
    public function emailTemplates()
    {
        $emailTemplates = EmailTemplate::all();
        return view('setting::email_templates', ['emailTemplates' => $emailTemplates]);
    }

    //edit an email template
    public function editEmailTemplates($id)
    {
        $emailTemplate  = EmailTemplate::find($id);
        return view('setting::edit_email_template', ['emailTemplate' => $emailTemplate]);
    }

    //update email template
    public function updateEmailTemplate(Request $request)
    {
        Validator::make($request->all(), [
            'email_group'       => 'required',
            'subject'           => 'required|min:5',
            'template_id'       => 'required',
            'template_body'     => 'required|min:10',
        ])->validate();

        $emailTemplate                  = EmailTemplate::find($request->template_id);

        $emailTemplate->subject         = $request->subject;
        $emailTemplate->template_body   = $request->template_body;

        $emailTemplate->save();

        return redirect()->route('email-templates')->with('success', __('successfully_updated'));
    }

    public function getCompanyInfo(Request $request)
    {

        $settings           = Setting::where('lang', $request->lang)->get();

        if ($request->type == 'company') :
            $needles        = ['application_name', 'address', 'email', 'phone', 'zip_code', 'city', 'state', 'country', 'website', 'company_registration', 'tax_number', 'about_us_description'];
        elseif ($request->type == 'seo') :
            $needles        = ['seo_title', 'seo_keywords', 'seo_meta_description', 'author_name', 'og_title', 'og_description'];
        else :
            $needles        = ['onesignal_action_message', 'onesignal_accept_button', 'onesignal_cancel_button'];
        endif;

        if ($settings->count() != 0) :

            foreach ($needles as $needle) :
                $i = 1;
                foreach ($settings as $setting) :

                    if ($i == 1) :

                        if (in_array($needle, $setting->toArray())) :
                            $data[$needle] = $setting->value;
                            $i++;
                        else :
                            $data[$needle] = '';
                        endif;

                    endif;

                endforeach;
            endforeach;

        else :
            foreach ($needles as $needle) :
                $data[$needle] = "";
            endforeach;
        endif;

        return response()->json($data);
    }

    public function sendTestMail(Request $request)
    {

        try {
            $data[]     = 'test email setting';

            Mail::send('setting::send_email_test', compact('data'), function ($message) use ($request) {

                $message->to($request->email)->subject(__('test_mail_subject'));
                $message->from('ovoocms@gmail.com');

            });

            return redirect()->back()->with('success', __('test_mail_success_message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
    }

    public function generalSetting()
    {
        $countries      = Countries::all();

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        return view('setting::general',
            [
                'activeLang'    => $activeLang,
                'countries'     => $countries
            ]);
    }

    public function companySetting()
    {
        $countries      = Countries::all();

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        return view('setting::company_information',
            [
                'activeLang'    => $activeLang,
                'countries'     => $countries
            ]);
    }

    public function settingEmail()
    {
        return view('setting::email_setting');
    }

    public function settingStorage()
    {
        return view('setting::storage_setting');
    }

    public function settingSeo()
    {
        $countries      = Countries::all();

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        return view('setting::seo_setting',
            [
                'activeLang'    => $activeLang,
                'countries'     => $countries
            ]);
    }

    public function settingRecaptcha()
    {
        return view('setting::recaptcha_setting');
    }

    public function settingCustom()
    {
        return view('setting::custom_setting');
    }

    public function settingsUrl()
    {
        return view('setting::url_setting');
    }

    public function settingsFfmpeg()
    {
        return view('setting::settings_ffmpeg');
    }

    public function cronInformation()
    {
        return view('setting::cron_information');
    }

    public function scheduleRun($slug)
    {

        try {

            if($slug == "newsletter"){

               \Artisan::call('queue:cron'); 


            }elseif($slug == "video-convert"){

                \Artisan::call('videoConverter:cron');

            }else{

                \Artisan::call('schedulepost:cron');

            }

            return redirect(route('cron-information'))->with('success', __('cron_job_completed_successfully'));

        } catch (\Exception $e) {

            return redirect(route('cron-information'))->with('error', __('cron_job_completed_unsuccessfully'));
        }
    }
}

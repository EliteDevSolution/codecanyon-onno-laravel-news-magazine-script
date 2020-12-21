<?php

namespace Modules\Language\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Modules\Language\Entities\LanguageConfig;
use Modules\Language\Entities\Language;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Entities\EmailTemplate;
use File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Language\Entities\FlagIcon;
use Session;
use Barryvdh\TranslationManager\Models\Translation;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $languages      = Language::orderBy('name', 'ASC')->paginate(10);
        $flagIcons      = FlagIcon::all();

        return view('language::index', [
            'activeLang'    => $activeLang,
            'languages'     => $languages,
            'flagIcons'     => $flagIcons
        ]);
    }

    //update default language
    public function setDefaultLanguage(Request $request)
    {
        $setting        = Setting::where('title', 'default_language')->first();
        $setting->value = $request->default_language;

        $setting->save();

        return redirect()->back()->with('success', __('default_language_changed'));
    }

    //add new language
    public function addNewLanguage(Request $request)
    {
        Validator::make($request->all(), [
            'name'              => 'required',
            'status'            => 'required',
            'icon_class'        => 'required',
            'text_direction'    => 'required',
            'code'              => 'required|min:1|max:5|unique:languages'
        ])->validate();

        ini_set('max_execution_time', 600); //600 seconds

        $langListObj                = new Language();

        $langListObj->name              = $request->name;
        $langListObj->code              = $request->code;
        $langListObj->icon_class        = $request->icon_class;
        $langListObj->text_direction    = $request->text_direction;
        $langListObj->status            = $request->status;

        $langListObj->save();

        $langConfigObj                  = new LanguageConfig();

        $langConfigObj->language_id     = $langListObj->id;
        $langConfigObj->name            = $request->name;
        $langConfigObj->script          = $request->script;
        $langConfigObj->native          = $request->native;
        $langConfigObj->regional        = $request->regional;

        $langConfigObj->save();

        foreach (\Config::get('site.email_templates') as $value) {

            $email_template                 = EmailTemplate::where('email_group', $value)->first();

            $new_template                   = new EmailTemplate();
            $new_template->email_group      = $value;
            $new_template->template_body    = $email_template->template_body;
            $new_template->subject          = $email_template->subject;
            $new_template->lang             = $request->code;

            $new_template->save();
        }

        $path                   = base_path('resources/lang/' . $request->code);

        //make file if not exist
        if (!File::isDirectory($path)) :

            File::makeDirectory($path, 0777, true, true);
            File::copyDirectory(base_path('resources/lang/en'), base_path('resources/lang/' . $request->code));

            // Write File
            $newJsonString = file_get_contents(base_path('resources/lang/phrase.json'));
            file_put_contents(base_path('resources/lang/' . $request->code . '.json'), stripslashes($newJsonString));

            //translations save to database
            Artisan::call('translations:reset');
            Artisan::call('translations:import');

        endif;

        return redirect()->back()->with('success', __('new_language_added'));
    }

    //view language edit page
    public function editLanguageInfo($id)
    {
        $langInfo       = Language::find($id);
        $langConfig     = LanguageConfig::where('language_id', $id)->first();
        $flagIcons      = FlagIcon::all();

        return view('language::edit_language', [
            'langInfo'      => $langInfo,
            'langConfig'    => $langConfig,
            'flagIcons'     => $flagIcons
        ]);
    }

    //update language info
    public function updateLanguageInfo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name'              => 'required',
            'status'            => 'required',
            'text_direction'    => 'required',
            'icon_class'        => 'required',
            'code'              => 'required|min:2|max:5'
        ])->validate();

        ini_set('max_execution_time', 600); //600 seconds

        $langListObj            = Language::find($id);
        $langConfigObj          = LanguageConfig::where('language_id', $id)->first();

        $langListObj->name      = $request->name;
        //if language code change
        if ($langListObj->code != $request->code):
            // if 'not match';
            $oldFilePath        = base_path('resources/lang/' . $langListObj->code . '.json');
            $newFilePath        = base_path('resources/lang/' . $request->code . '.json');
            $oldFolderPath      = base_path('resources/lang/' . $langListObj->code);
            $newFolderPath      = base_path('resources/lang/' . $request->code);

            // rename file name
            if (!empty($oldFilePath)) :
                File::move($oldFilePath, $newFilePath);
            endif;
            //rename or make directory name
            if (File::isDirectory($oldFolderPath)) :
                File::move($oldFolderPath, $newFolderPath);
            else:
                File::makeDirectory($newFolderPath, 0777, true, true);
                File::copyDirectory(base_path('resources/lang/en'), $newFolderPath);
            endif;

            $langListObj->code = $request->code;

            Artisan::call('translations:reset');
            Artisan::call('translations:import');

        endif;

        $langListObj->icon_class        = $request->icon_class;
        $langListObj->text_direction    = $request->text_direction;
        $langListObj->status            = $request->status;

        $langListObj->save();

        $langConfigObj->language_id     = $langListObj->id;
        $langConfigObj->name            = $request->name;
        $langConfigObj->script          = $request->script;
        $langConfigObj->native          = $request->native;
        $langConfigObj->regional        = $request->regional;

        $langConfigObj->save();

        return redirect()->route('language-settings')->with('success', __('successfully_updated'));
    }

    //update phrase
    public function updatePhrase(Request $request, $code)
    {
        ini_set('max_execution_time', 600); //600 seconds
        
        $req_data       = $request->all();
        $data           = array_change_key_case(array_slice($req_data, 1));

        // Write File
        $newJsonString  = json_encode($data);

        file_put_contents(base_path('resources/lang/' . $code . '.json'), $newJsonString);

        // Artisan::call('translations:reset');
        Artisan::call('translations:import --replace');

        return redirect()->route('language-settings')->with('success', __('successfully_updated'));
    }

    //view edit phrase
    public function editPhraseList($id)
    {

        $langInfo       = Language::find($id);
        $langConfig     = LanguageConfig::where('language_id', $id)->first();

        $path           = base_path('resources/lang/' . $langInfo->code);

        if (!File::isDirectory($path)) :
            File::makeDirectory($path, 0777, true, true);
            File::copyDirectory(base_path('resources/lang/en'), base_path('resources/lang/' . $langInfo->code));

            Artisan::call('translations:import --replace');
        endif;
        // Read File
        if (file_exists(base_path('resources/lang/' . $langInfo->code . '.json'))) :

            $jsonString     = file_get_contents(base_path('resources/lang/' . $langInfo->code . '.json'));
        else :
            $newJsonString  = file_get_contents(base_path('resources/lang/phrase.json'));
            // Write File

            file_put_contents(base_path('resources/lang/' . $langInfo->code . '.json'), stripslashes($newJsonString));

            $jsonString     = file_get_contents(base_path('resources/lang/' . $langInfo->code . '.json'));

            Artisan::call('translations:import --replace');
        endif;

        $langData       = json_decode($jsonString, true);

        return view('language::edit_phrase', [
            'langInfo'      => $langInfo,
            'langConfig'    => $langConfig,
            'langData'      => $langData,
        ]);
    }

    //delete language
    public function deleteLanguage(Request $request)
    {
        $id = $request->id;

        if ($id == 1) :
            $data['status']     = "error";
            $data['message']    = "You can not delete this.";
        else:
            $langInfo           = Language::find($id);
            $langConfig         = LanguageConfig::where('language_id', $id)->first();

            $path               = base_path('resources/lang/' . $langInfo->code);

            //delete folder
            if (File::isDirectory($path)) :
                File::deleteDirectory($path);
            endif;

            $langJson           = base_path('resources/lang/' . $langInfo->code . '.json');

            //delete phrase file
            if (file_exists($langJson)) :
                unlink($langJson);
            endif;

            $langInfo->delete();
            $langConfig->delete();

            Artisan::call('translations:reset');
            Artisan::call('translations:import');

            $data['status'] = "success";
            $data['message'] = "Successfully Deleted";
        endif;

        echo json_encode($data);
    }

    //edit default message
    public function editDefaultMessages($id)
    {
        $langInfo   = Language::find($id);
        $path       = base_path('resources/lang/' . $langInfo->code);

        if (!File::isDirectory($path)) :
            File::makeDirectory($path, 0777, true, true);
            File::copyDirectory(base_path('resources/lang/en'), base_path('resources/lang/' . $langInfo->code));

        endif;

        if (!file_exists(base_path('resources/lang/' . $langInfo->code . '.json'))) :
            $newJsonString  = file_get_contents(base_path('resources/lang/phrase.json'));
            // Write File
            file_put_contents(base_path('resources/lang/' . $langInfo->code . '.json'), stripslashes($newJsonString));

        endif;
        Artisan::call('translations:reset');
        Artisan::call('translations:import');

        $defaultMsg     = Translation::where('locale', $langInfo->code)
                                ->where(function ($query) {
                                    $query->where('group', 'validation')
                                        ->orWhere('group', 'auth')
                                        ->orWhere('group', 'passwords')
                                        ->orWhere('group', 'pagination');
                                    })->get();

        return view('language::edit_default_msg', [
            'langInfo'      => $langInfo,
            'defaultMsg'    => $defaultMsg,
        ]);
    }

    //update default message
    public function updateDefaultMessages(Request $request, $code)
    {
        $req_data       = $request->all();
        $data           = array_change_key_case(array_slice($req_data, 1));
        //save to database
        foreach ($data as $key => $singleData) {
            $defaultMsg = Translation::where('locale', $code)->where('key', $key)->first();
            if ($defaultMsg != null) :
                $defaultMsg->value = $singleData;
                $defaultMsg->save();
            endif;
        }

        //save to file from database
        Artisan::call('translations:export {group}', ['group' => 'validation']);
        Artisan::call('translations:export {group}', ['group' => 'auth']);
        Artisan::call('translations:export {group}', ['group' => 'passwords']);
        Artisan::call('translations:export {group}', ['group' => 'pagination']);

        return redirect()->route('language-settings')->with('success', __('successfully_updated'));
    }
}

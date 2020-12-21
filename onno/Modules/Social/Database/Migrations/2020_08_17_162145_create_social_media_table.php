<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Social\Entities\SocialMedia;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('icon_bg_color')->nullable();
            $table->string('text_bg_color')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });


        $social = new SocialMedia(); 
        $social->name = 'Facebook'; 
        $social->url = '#'; 
        $social->icon_bg_color = '#0061C2'; 
        $social->text_bg_color = '#056ED8'; 
        $social->icon = 'fa fa-facebook';
        $social->save();

        $social = new SocialMedia(); 
        $social->name = 'Youtube'; 
        $social->url = '#'; 
        $social->icon_bg_color = '#FE031C'; 
        $social->text_bg_color = '#E50017'; 
        $social->icon = 'fa fa-youtube-play';
        $social->save();
        
        $social = new SocialMedia(); 
        $social->name = 'Twitter'; 
        $social->url = '#'; 
        $social->icon_bg_color = '#2391FF'; 
        $social->text_bg_color = '#349AFF'; 
        $social->icon = 'fa fa-twitter';
        $social->save();
        
        $social = new SocialMedia(); 
        $social->name = 'Linkedin'; 
        $social->url = '#'; 
        $social->icon_bg_color = '#349AFF'; 
        $social->text_bg_color = '#349affd9'; 
        $social->icon = 'fa fa-linkedin';
        $social->save();
        
        $social = new SocialMedia(); 
        $social->name = 'Skype'; 
        $social->url = '#'; 
        $social->icon_bg_color = '#4ba3fcd9'; 
        $social->text_bg_color = '#4BA3FC'; 
        $social->icon = 'fa fa-skype';
        $social->save();
        
        $social = new SocialMedia(); 
        $social->name = 'Pinterest'; 
        $social->url = '#'; 
        $social->icon_bg_color = '#C2000D'; 
        $social->text_bg_color = '#c2000dd9'; 
        $social->icon = 'fa fa-pinterest-square';
        $social->save();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media');
    }
}

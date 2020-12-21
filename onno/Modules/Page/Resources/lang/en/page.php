<?php

return [
    'page_type' => [
        \Modules\Page\Enums\PageType::DEFAULT => 'Default',
        \Modules\Page\Enums\PageType::CONTACT_US => 'Contact Page',
    ],
    'page_template_type' => [
    	\Modules\Page\Enums\PageTemplateType::WITHOUT_SIDEBAR => 'Without sidebar',
    	\Modules\Page\Enums\PageTemplateType::WITH_RIGHT_SIDEBAR => 'With Right sidebar',
    	//\Modules\Page\Enums\PageTemplateType::WITH_LEFT_SIDEBAR => 'With Left sidebar',
    ]
];
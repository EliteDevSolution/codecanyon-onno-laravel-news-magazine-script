<?php

return [
    "send_email_type" => [
        \Modules\Newsletter\Enums\SendEmailType::MULTIPLE => 'Multiple',
        \Modules\Newsletter\Enums\SendEmailType::SINGLE => 'Single',
        \Modules\Newsletter\Enums\SendEmailType::CUSTOM => 'Custom',
    ],
    "bulk_email_type" => [
        // \Modules\Newsletter\Enums\BulkEmailType::TOP_5 => 'Top 5',
        // \Modules\Newsletter\Enums\BulkEmailType::TOP_10 => 'Top 10',
        // \Modules\Newsletter\Enums\BulkEmailType::TOP_15 => 'Top 15',
        \Modules\Newsletter\Enums\BulkEmailType::POPULAR_POST => 'Popular Posts',
        \Modules\Newsletter\Enums\BulkEmailType::LATEST_POST => 'Latest Posts',
        \Modules\Newsletter\Enums\BulkEmailType::RECOMMENDED_POST => 'Recommended Posts',
    ],
];

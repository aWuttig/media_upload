<?php

return [
    'media_upload:temporaryFiles:list' => [
        'class' => \Fab\MediaUpload\Command\ListTemporaryFilesCommand::class,
    ],
    'media_upload:temporaryFiles:flush' => [
        'class' => \Fab\MediaUpload\Command\FlushTemporaryFilesCommand::class,
    ],
];
<?php

return [
    'errors' => [
        'translate' => [
            'fileNotFound' => 'Translation file not found (%s)'
        ],
        'upload' => [
            1 => 'The uploaded file exceeds the defined limit.',
            2 => 'The file exceeds the limit set in MAX_FILE_SIZE in the HTML form.',
            3 => 'File upload was partially done.',
            4 => 'No files have been uploaded.',
            6 => 'Missing temporary folder.',
            7 => 'Failed to write file to disk.',
            8 => 'An extension of PHP interrupts the file upload.'
        ]
    ],

    'validations' => [
        'requiredField' => 'The (%s) field is required',
        'invalidExtension' => 'File with invalid extension. Allowed extensions are: (%s)'
    ]
];

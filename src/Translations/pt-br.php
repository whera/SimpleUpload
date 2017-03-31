<?php

return [
    'errors' => [
        'translate' => [
            'fileNotFound' => 'Arquivo de tradução não encontrado. (%s)'
        ],
        'upload' => [
            1 => 'O arquivo enviado excede o limite definido.',
            2 => 'O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML.',
            3 => 'O upload do arquivo foi feito parcialmente.',
            4 => 'Nenhum arquivo foi enviado.',
            6 => 'Pasta temporária ausênte.',
            7 => 'Falha ao escrever o arquivo em disco.',
            8 => 'Uma extensão do PHP interrompeu o upload do arquivo.'
        ]
    ],

    'validations' => [
        'requiredField' => 'O campo (%s) é obrigatório.',
        'invalidExtension' => 'Arquivo com extensão inválida. As extensões permitidas são: (%s)'
    ]
];

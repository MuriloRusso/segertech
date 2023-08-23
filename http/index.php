<?php // silence is good

/*  Define o break line */
define('PHP_EOFL', '<br>');

/* Realizar testes no container */
define('CONTAINER_CHECK', true);
define('CONTAINER_CHECK_ALIAS', true);
define('CONTAINER_CHECK_SETTINGS', true);

/* Verificar se as configurações existem */
define('CONTAINER_CHECK_SETTINGS_ARRAY', [
    'alias', 'app', 'database', 'mail'
]);

/* Constantes usadas para versionar */
define('PHP_MINIMAL_VERSION', '7.1');
define('PHP_MAXIMAL_VERSION', '7.4.5');
define('PHP_CURRENT_VERSION', phpversion());

/* Verificar a performance do servidor */
define('START_EXECUTION_AT', round(microtime(true) * 1000));

/* Função para imprimir as saídas na tela */
if( !function_exists('info') ) {
    function info($text)
    {
        if( is_array($text) ) {
            $text = implode(' ', $text) . PHP_EOFL;
        } else {
            $text = $text . PHP_EOFL;
        }

        echo $text;
    }
}

if( !defined('PHP_MINIMAL_VERSION') ) {
    info('PHP_MINIMAL_VERSION não foi definida');
}

if( !defined('PHP_CURRENT_VERSION') ) {
    info('PHP_CURRENT_VERSION não foi definida');
}

if( defined('PHP_MAXIMAL_VERSION') ) {

    /*
     | Verifique se a versão max é maior que a min
     */

    if( !version_compare(PHP_MAXIMAL_VERSION, PHP_MINIMAL_VERSION, '>=') ) {
        info([
            'Limite das versões do PHP inválido:',
            'Min:', PHP_MINIMAL_VERSION, 'e', 'Max:', PHP_MAXIMAL_VERSION,
        ]);
    }

    /*
     | Verifique se a versão atual do servidor é compatível com a max
     */

    if( !version_compare(PHP_CURRENT_VERSION, PHP_MAXIMAL_VERSION, '<=') ) {
        info([
            'A atual versão do PHP no servidor é inválida: ',
            'Atual:', PHP_CURRENT_VERSION, 'e', 'Max:', PHP_MAXIMAL_VERSION,
        ]);
    }

}

/*
| Verifique se a versão atual do servidor é compatível com a min
*/

if( !version_compare(PHP_CURRENT_VERSION, PHP_MINIMAL_VERSION, '>=') ) {
    info([
        'A versão do PHP no servidor é inválida: ',
        'Atual: ', PHP_CURRENT_VERSION, 'e', 'Min:', PHP_MINIMAL_VERSION,
    ]);
}

/*
| Verificando a sessão do PHP
*/

if( !function_exists('session_save_path') ) {
    info('A função session_save_path não existe');
} elseif ( !file_exists($session_path = session_save_path()) ) {
    info([ 'Path da sessão não existe:', $session_path ]);
} elseif ( !file_exists($session_path) || !is_writable($session_path) ) {
    info([ 'Acesso negado ao diretório:', $session_path ]);
}

/*
| Verificando o upload de arquivos
*/

if( !function_exists('sys_get_temp_dir') ) {
    info('A função sys_get_temp_dir não existe');
} elseif ( !file_exists($temp_upload_dir = sys_get_temp_dir()) ) {
    info([ 'Path temporário do upload não existe:', $temp_upload_dir ]);
} elseif ( !file_exists($temp_upload_dir) || !is_writable($temp_upload_dir) ) {
    info([ 'Acesso negado ao diretório:', $temp_upload_dir ]);
}

/*
| Verificando o arquivo bootstrap e container
*/

if( defined('CONTAINER_CHECK') && CONTAINER_CHECK ) {
    $bootstrap =__DIR__ . '/bootstrap.php';
    
    if( file_exists($bootstrap) ) {
        require($bootstrap);
    } else {
        info(['Arquivo não encontrado: ', $bootstrap]);
    }

    if( !isset($container) ) {
        info('Container não definido');
    }
}

/*
| Verificando os arquivos de configuração
*/

if( defined('CONTAINER_CHECK_SETTINGS') && CONTAINER_CHECK_SETTINGS && isset($container) ) {

    if( !defined('CONTAINER_CHECK_SETTINGS_ARRAY') ) {
        info('CONTAINER_CHECK_SETTINGS_ARRAY não foi definido');
    } elseif ( !is_array(CONTAINER_CHECK_SETTINGS_ARRAY) || !count(CONTAINER_CHECK_SETTINGS_ARRAY) ) {
        info('CONTAINER_CHECK_SETTINGS_ARRAY não é um array válido');
    } else {
        foreach(CONTAINER_CHECK_SETTINGS_ARRAY as $file) {
            try {
                $container->settings($file)->check();
            } catch (\Exception $Exception) {
                info([
                    'Settings', $Exception->getMessage()
                ]);
            }
        }
    }

} elseif ( defined('CONTAINER_CHECK_SETTINGS') && CONTAINER_CHECK_SETTINGS && !isset($container) ) {
    info('Não é possível testar os arquivos de configurações, o container não foi definido');
}

/*
| Verificando as classes com alias
*/

if(defined('CONTAINER_CHECK_ALIAS') && CONTAINER_CHECK_ALIAS && isset($container)) {

    try {
        
        $aliases = $container->settings('alias')->load();

    } catch (\Exception $Exception) {
        info([
            'Alias', $Exception->getMessage()
        ]);
    }

    if( isset($aliases) && is_array($aliases) && count($aliases) ) {
        foreach($aliases as $alias => $namespace) {
            if( !class_exists($namespace) ) {
                info([
                    'Erro no namespace:', $namespace,
                ]);
            } elseif( !class_exists($alias) ) {
                info([
                    'Alias da classe não existe:',
                    $alias, '=>', $namespace
                ]);
            }
        }
    }

} elseif ( defined('CONTAINER_CHECK_ALIAS') && CONTAINER_CHECK_ALIAS && !isset($container) ) {
    info('Não é possível testar os alias, o container não foi definido');
}

info([
    'PHP Versoin:', PHP_CURRENT_VERSION, PHP_EOFL,
    'Timeout:', ini_get('max_execution_time'), PHP_EOFL,
    'Finalizado em:', ((round(microtime(true) * 1000) - START_EXECUTION_AT) / 1000) .'ms', 
]);


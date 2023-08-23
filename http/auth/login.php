<?php

require_once __DIR__ . '/../bootstrap.php';

try {

    $request = $container->request()->json([
        'username',
        'password',
    ]);

    $validation = $container->validation('pt-br', $request, [
        'username' => 'required|min:3|max:191',
        'password' => 'required|min:3',
    ]);

    if( $validation->fails() ) {
        $container->response()->json([
            'message' => 'Verifique as informações',
            'errors' => $validation->errors()->toArray(),
        ], 422);
    }

    $account = $container->database('mysql')
                         ->select([ 'token', 'enable' ])
                         ->from('accounts')
                         ->where('enable', '=', '1')
                         ->andWhere('username', '=',     $request['username'])
                         ->andWhere('password', '=', md5($request['password']))
                         ->first();

    if( !$account ) {
        $container->response()->json([
            'errors' => [],
            'message' => 'Usuário e/ou Senha inválido',
        ], 401);
    }

    $token = $container->jwt()->encode([
        'iss' => APP_NAME,
        'sub' => $account['token'],
        'iat' => $container->now(0)->timestamp,
        'exp' => $container->now(7)->timestamp,
    ]);

    $container->response()->json([
        'token' => $token,
    ], 200);

} catch (\Exception $Exception) {
    $container->response()->json([
        'errors' => [],
        'message' => $Exception->getMessage(),
    ], 500);
}

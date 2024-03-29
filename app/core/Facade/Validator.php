<?php

namespace App\Core\Facade;

use Rakit\Validation\Validator as RakitValidator;

class Validator
{
    protected $Validator;

    public function __construct($validator)
    {
        $this->Validator = $validator;
    }

    public static function build($settings)
    {
        $validator = new RakitValidator($settings['messages']);
        $validator->setTranslations($settings['words']);
        return new static($validator);
    }
    
    public function validate($request, $validations)
    {
        $validation = $this->Validator
                           ->make($request, $validations);
        
        if($validation) {
            $validation->validate();
        }

        return $validation;
    }
}

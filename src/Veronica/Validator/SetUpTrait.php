<?php

namespace Veronica\Validator;

use Veronica\Validator\ValidatorInterface as Validator;

trait SetUpTrait
{

    protected Validator $validator;

    protected function initValidator() : static
    {
        $this->validator = \App\Veronica::getValidator();
        return $this;
    }

}

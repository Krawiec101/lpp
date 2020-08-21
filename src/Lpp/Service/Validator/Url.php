<?php
declare(strict_types=1);

namespace Lpp\Service\Validator;

class Url
{
    public function validate(string $url): bool
    {
        return (filter_var($url, FILTER_VALIDATE_URL) !== false);
    }
}

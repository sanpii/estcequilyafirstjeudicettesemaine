<?php
declare(strict_types = 1);

namespace AppBundle\Service;

class Linux implements FirstJeudi
{
    public function toArray(): array
    {
        return json_decode(
            file_get_contents('/dev/firstj')
        );
    }
}

<?php

namespace AppBundle\Service;

class Linux implements FirstJeudi
{
    public function toArray()
    {
        return json_decode(
            file_get_contents('/dev/firstj')
        );
    }
}

<?php

namespace Opteck\Responses;

use Opteck\Entities\Definition;
use Opteck\Response;

class GetDefinitions extends Response
{
    /**
     * @return \Opteck\Entities\Definition[]
     */
    public function getDefinitions()
    {
        $definitions = [];
        if (isset($this->data[static::FIELD_DATA])) {
            foreach ($this->data[static::FIELD_DATA] as $definitionData) {
                $definitions[] = new Definition($definitionData);
            }
        }

        return $definitions;
    }
}

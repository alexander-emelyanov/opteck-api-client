<?php

namespace Opteck\Responses;

use Opteck\Entities\OptionType;
use Opteck\Response;

class GetOptionTypes extends Response
{
    /**
     * @return \Opteck\Entities\OptionType[]
     */
    public function getOptionTypes()
    {
        $optionTypes = [];
        if (isset($this->data[static::FIELD_DATA])) {
            foreach ($this->data[static::FIELD_DATA] as $optionTypeData) {
                $optionTypes[] = new OptionType($optionTypeData);
            }
        }

        return $optionTypes;
    }
}

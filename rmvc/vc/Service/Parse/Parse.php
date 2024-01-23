<?php

namespace rmvc\vc\Service\Parse;

class Parse
{
    public static function parseRules($rules)
    {
        $arrayOfRules = [];
        
        foreach ($rules as $param => $rulesForParam) {
            $rulesForParam = explode('|', $rulesForParam);
            foreach ($rulesForParam as $rule) {
                if (preg_match('/(.*):(.*)/', $rule, $matches)) {
                    $arrayOfRules[$param][$matches[1]] = $matches[2];
                } else {
                    $arrayOfRules[$param][$rule] = null;
                }
            }
        }

        return $arrayOfRules;
    }


}
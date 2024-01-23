<?php

namespace rmvc\vc\Service\Request\Validation;

use rmvc\vc\DB\DB;
use rmvc\vc\Service\Parse\Parse;

class Validation
{

    public static function validate(array $data, array $rules)
    {
        $ParamRules = Parse::parseRules($rules);

        $validatedData = [];
        foreach ($ParamRules as $param=>$rules) {

                if (!array_key_exists($param, $data)) {
                    if (array_key_exists('required', $rules)) {
                        throw new \Exception('Invalid field - ' . $param. '. It should be.');
                    } else {
                        continue;
                    }
                }

                foreach ($rules as $rule => $value) {
                    // по-хорошему положить фолс в ячейку, если не была пройдена валидация. Потом пройтись циклом и выдать 1 общий эксепшен для всех ошибок.
                    switch ($rule) {
                        case 'string':
                            $validatedData[$param] = self::validateString($data[$param],  $param);
                            break;
                        case 'email':
                            $validatedData[$param] = self::validateEmail($data[$param]);
                            break;
                        case 'notNull':
                            $validatedData[$param] = self::validateNotNull($data[$param], $param);
                            break;
                        case 'max':
                            $validatedData[$param] = self::validateMaxLength($data[$param], $value,  $param);
                            break;
                        case 'min':
                            $validatedData[$param] = self::validateMinLength($data[$param], $value,  $param);
                            break;
                        case 'unique':
                            $validatedData[$param] = self::validateUnique($data[$param], $value,  $param);
                            break;
                        case 'phone':
                            $validatedData[$param] = self::validatePhone($data[$param],  $param);
                            $data[$param] = $validatedData[$param];
                            break;
                        // should be last
                        case 'same':
                            self::validateSame($data[$param], $data[$value],  $param, $value);
                            unset($validatedData[$param]);
                            break;
                    }

                }
        }

        return $validatedData;
    }

    public static function validateString(string $value, string $param): string
    {
        $value = trim($value);

        if (!preg_match('/^[+A-Za-zА-Яа-яЁё0-9@._-]*$/u', $value)) {
            throw new \Exception('Invalid string - ' . $param);
        }

        return $value;
    }

    public static function validateMaxLength(string $value, int $maxLength, string $param): string
    {
        $value = trim($value);

        if (mb_strlen($value) > $maxLength) {
            throw new \Exception('Invalid ' . $param . ' length. Max length: ' . $maxLength);
        } else {
            return $value;
        }
    }

    public static function validateMinLength(string $value, int $minLength, string $param): string
    {
        $value = trim($value);

        if (mb_strlen($value) < $minLength) {
            throw new \Exception('Invalid ' . $param . ' length. Min length: ' . $minLength);
        } else {
            return $value;
        }
    }

    public static function validateEmail(string $value): string
    {
        $value = trim($value);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Invalid email');
        } else {
            return $value;
        }
    }

    public static function validateNotNull($value, string $param = '')
    {
        if ($value == null) {
            throw new \Exception('Invalid field ' . $param . '. It should not be null');
        } else {
            return $value;
        }
    }

    public static function validateSame(string $value1, string $value2, string $param, string $param2)
    {
        if ($value1 != $value2) {
            throw new \Exception('Invalid field ' . $param . '. It should be the same as ' . $param2);
        }
    }

    public static function validateRequired(string $value, string $param = '')
    {
        if ($value == null) {
            throw new \Exception('field ' . $param . ' should not be null');
        }
    }
    
    public static function validatePhone(string $value, string $param = '')
    {
        // Можно применить валидацию по регулярному выражению и создать отдельную таблицу для номеров -> в одной колонке оставлять номер, что ввел юзер. В иной вставлять номер без кавычек, тире и первой цифры, если говорим про 1 регион. Либо создать создать отдельный метод юник для номеров.
        $phoneToDb = str_replace([' ', '(', ')', '-'], '', $value);
        
        $isPhone =  preg_match('/^(\+7|7|8)(\d{10}$)/u', $phoneToDb, $matches);

        if ($isPhone == false) {
            throw new \Exception('Invalid phone number - ' . $param);
        } else {
            return $matches[2];
        }
    }

    public static function validateUnique(string $value, string $tableAndColumn, string $param = '')
    {
        $tableAndColumn = explode('.', $tableAndColumn);
        $table = strtoupper($tableAndColumn[0]);
        $column = strtoupper($tableAndColumn[1]);

        $result = DB::query("SELECT $column FROM $table WHERE $column = :value", ['value' => $value]);

        if ($result == null) {
            return $value;
        } else {
            throw new \Exception('Invalid ' . $param . '. ' . $value . ' already exists');
        }
    }
    
}
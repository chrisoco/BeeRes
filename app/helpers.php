<?php

    /**
     * @param $phone
     * @return string
     */
    function replaceEmptyChars($phone): string
    {
        $phone = str_replace(' ', '', $phone);
        $phone = str_replace('-', '', $phone);

        return $phone;
    }

    /**
     * Convert Phone number to Nominatim expected Number
     *
     * Input: 0765813596 | 0041765813596 | +41765813596
     * Output: 41765813596
     *
     * @param $phone
     * @return string
     */

    function formatPhoneNum($phone): string
    {
        $phone = replaceEmptyChars($phone);

        $phone = str_replace('+', '', $phone);

        switch (substr($phone, 0, 2)) {

            case "00" : $phone = substr($phone, 2); break;
            case "07" :
            case "04" : $phone = '41' . substr($phone, 1); break;

        }
        return $phone;
    }



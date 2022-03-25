<?php

    /**
     * Replace empty chars and - from string.
     *
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
     * with added countrycode 41.
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

    /**
     * Reverse Phone format from db:
     * 417658135 to 076 581 35 96.
     *
     * @param $phone
     * @return string
     */
    function reverseFormatPhoneNum($phone): string
    {
        $num[0] = substr($phone, 2, 2);
        $num[1] = substr($phone, 4, 3);
        $num[2] = substr($phone, 7, 2);
        $num[3] = substr($phone, 9, 2);

        return '0'.$num[0].' '.$num[1].' '.$num[2].' '.$num[3];

    }



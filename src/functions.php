<?php
if (!function_exists('isCamelize')) {
    /**
     *判断是否是驼峰命名
     * @param string $key
     * @return bool
     */
    function isCamelize($key)
    {
        $keys = explode('_', $key);
        return count($keys) > 0 ? false : true;
    }
}

if (!function_exists('camelize')) {
    /**
     * 下划线转驼峰
     * 思路:
     * step1.原字符串转小写,原字符串中的分隔符用空格替换,在字符串开头加上分隔符
     * step2.将字符串中每个单词的首字母转换为大写,再去空格,去字符串首部附加的分隔符.
     * @param $unCamelizeWords
     * @param string $separator
     * @return string
     */
    function camelize($unCamelizeWords, $separator = '_')
    {
        $unCamelizeWords = $separator . str_replace($separator, " ", strtolower($unCamelizeWords));
        return ltrim(str_replace(" ", "", ucwords($unCamelizeWords)), $separator);
    }

}

if (!function_exists('unCamelize')) {
    /**
     * 驼峰命名转下划线命名 支持
     * 思路:
     * 小写和大写紧挨一起的地方,加上分隔符,然后全部转小写
     * @params str||array $camelCaps
     * @param $camelCaps
     * @param string $separator
     * @return array|string|void
     */
    function unCamelize($camelCaps, $separator = '_')
    {
        if (!$camelCaps) return;
        if (is_array($camelCaps)) {
            foreach ($camelCaps as $k => $item) {
                $camelCaps[$k] = unCamelize($item);
            }
        } else if (is_string($camelCaps)) {
            $camelCaps = strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
        }
        return $camelCaps;
    }
}

if (!function_exists('isDate')) {
    /**
     *判断是否是格式化时间
     * @param $dateStr
     * @return bool
     */
    function isDate($dateStr)
    {
        return strtotime(date('Y-m-d', strtotime($dateStr))) === strtotime($dateStr);
        /*date函数会给月和日补零，所以最终用unix时间戳来校验*/
    }
}



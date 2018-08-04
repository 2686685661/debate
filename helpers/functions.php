<?php

function millisecond()
{
    return ceil(microtime(true) * 1000);
}

/**
 * 页面json 输出
 * @param int $code
 * @param $msg
 * @param $paras
 */
function responseToJson($code = 0, $msg = '', $paras = null)
{
    $res["code"] = $code;
    $res["msg"] = $msg;
    if (!empty($paras)) {
        $res["result"] = $paras;
    }
    return response()->json($res);
}

function create_uuid($prefix = "")
{    //可以指定前缀
    $str = md5(uniqid(mt_rand(), true));
    $uuid = substr($str, 0, 8) . '-';
    $uuid .= substr($str, 8, 4) . '-';
    $uuid .= substr($str, 12, 4) . '-';
    $uuid .= substr($str, 16, 4) . '-';
    $uuid .= substr($str, 20, 12);
    return $prefix . $uuid;
}

/**
 * 获取用户密码加密字符串
 * @param $password
 * @param $salt
 * @return string
 */
function get_md5_password($password, $salt = '')
{
    return md5(md5($password) . $salt);
}
function get_salt()
{
    $uuid = create_uuid();
    $salt = substr($uuid, strlen($uuid) - 4, 4);
    return $salt;
}

/**
 * 获取随机串
 * @param int $len 需要几位随机数
 * @param bool $only_digit 是否只要数字
 * @return string
 */
function get_rand_str($len = 4, $only_digit = false)
{
    $chars = '0123456789';
    if (!$only_digit) {
        $chars .= 'abcdefghijklmnopqrstwyz';
    }
    mt_srand((double)microtime() * 1000000 * getmypid());
    $code = "";
    while (strlen($code) < $len)
        $code .= substr($chars, (mt_rand() % strlen($chars)), 1);
    return $code;
}

// 数字转中文
function numberToChinese($num, $m = 1)
{
    switch ($m) {
        case 0:
            $CNum = array(
                array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖'),
                array('', '拾', '佰', '仟'),
                array('', '萬', '億', '萬億')
            );
            break;
        default:
            $CNum = array(
                array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九'),
                array('', '十', '百', '千'),
                array('', '万', '亿', '万亿')
            );
            break;
    }

    if (!is_numeric($num)) {
        return false;
    }

    $flt = '';
    if (is_integer($num)) {
        $num = strval($num);
    } else if (is_numeric($num)) {
        $num = strval($num);
        $rs = explode('.', $num, 2);
        $num = $rs[0];
        $flt = $rs[1];
    }

    $len = strlen($num);
    $num = strrev($num);
    $chinese = '';

    for ($i = 0, $k = 0; $i < $len; $i += 4, $k++) {
        $tmp_str = '';
        $str = strrev(substr($num, $i, 4));
        $str = str_pad($str, 4, '0', STR_PAD_LEFT);
        for ($j = 0; $j < 4; $j++) {
            if ($str{$j} !== '0') {
                $tmp_str .= $CNum[0][$str{$j}] . $CNum[1][4 - 1 - $j];
            }
        }
        $tmp_str .= $CNum[2][$k];
        $chinese = $tmp_str . $chinese;
        unset($str);
    }
    if ($flt !== '') {
        $str = '';
        for ($i = 0; $i < strlen($flt); $i++) {
            $str .= $CNum[0][$flt{$i}];
        }
        $chinese .= "点{$str}";
    }
    return $chinese;
}

function filter_filename($filename)
{
    return str_replace(
        array('\\', '/', ':', '*', '"', '?', '<', '>', '|'),
        array('', '', '', '', '', '', '', '', ''),
        $filename
    );
}

function get_user_id()
{
    if (empty(session("user"))) {
        return 0;
    }
    return session('user')->id;
}
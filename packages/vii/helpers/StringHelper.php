<?php

namespace vii\helpers;

use Yii;
use yii\helpers\BaseStringHelper;
//use Hashids\Hashids;

class StringHelper extends BaseStringHelper
{

    public static function getId($id)
    {
        $id = (string) $id;
        return preg_replace('/[^0-9a-zA-Z]+/i', '', $id);
    }

    public static function getSlug($slug, $toLower = true)
    {
        if ($toLower == true)
            $slug = mb_strtolower($slug, 'UTF-8');

        return preg_replace('/[^a-z0-9\-\_]+/i', '', $slug);
    }

    public static function getPath($id)
    {
        $id = (string) $id;
        return preg_replace('/[^0-9a-zA-Z\-\_\.\\\ ]+/i', '', $id);
    }

    public static function getLink($url = null, $method = 'http://')
    {
        if (!empty($url) && !static::startsWith($url, 'http')) {
            return $method . $url;
        }

        return $url;
    }

     public static function asUrl($str = '') {
        $str = self::generateSlug($str);
        $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '-', $str);
        $str = strtolower($str);
        $str = preg_replace("/[\/_|+ -]+/", '-', $str);

        $str = trim($str, '-');
        return $str;
    }

    public static function generateSlug($str)
    {
        $str = trim(mb_strtolower($str, 'UTF-8'));
        $strFind = array(
            '- ', ' ', 'đ',
            'á', 'à', 'ạ', 'ả', 'ã', 'ă', 'ắ', 'ằ', 'ặ', 'ẳ', 'ẵ', 'â', 'ấ', 'ầ', 'ậ', 'ẩ', 'ẫ',
            'ó', 'ò', 'ọ', 'ỏ', 'õ', 'ô', 'ố', 'ồ', 'ộ', 'ổ', 'ỗ', 'ơ', 'ớ', 'ờ', 'ợ', 'ở', 'ỡ',
            'é', 'è', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ế', 'ề', 'ệ', 'ể', 'ễ',
            'ú', 'ù', 'ụ', 'ủ', 'ũ', 'ư', 'ứ', 'ừ', 'ự', 'ử', 'ữ',
            'í', 'ì', 'ị', 'ỉ', 'ĩ',
            'ý', 'ỳ', 'ỵ', 'ỷ', 'ỹ');
        $strReplace = array(
            '', '-', 'd',
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'i', 'i', 'i', 'i', 'i',
            'y', 'y', 'y', 'y', 'y');
        return preg_replace('/[^a-z0-9\-]+/i', '', str_replace($strFind, $strReplace, $str));
    }

    public static function generateToken() {
        return md5($_SERVER['REMOTE_ADDR'] . microtime() . mt_rand());
    }

    public static function generateRandom($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

//    // Laravel
//    public static function generateRandom($length = 10)
//    {
//        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
//    }




    public static function hashId($id, $length = 10)
    {
        return (new Hashids(Yii::$app->params['encryptKey'], $length))->encode($id);
    }

    public static function encrypt($data)
    {
        if (isset($data['entityId'])) {
            $data['entityId'] = (string) $data['entityId'];
        }
        
        return base64_encode(Yii::$app->security->encryptByKey(json_encode($data), Yii::$app->params['encryptKey']));
    }

    public static function decrypt($data)
    {
        return json_decode(Yii::$app->getSecurity()->decryptByKey(base64_decode($data), Yii::$app->params['encryptKey']), true);
    }

    public static function truncateText($str, $limit = 300, $tagAllow = '', $suffix = '...') {
        $str = ($tagAllow == '')
            ? strip_tags($str) //'<br><br/>'
            : strip_tags($str, $tagAllow);

        if (strlen($str) <= $limit) {
            return $str;
        }

        $str = mb_substr($str, 0, $limit, 'utf-8');
        return substr($str, 0, strrpos($str, " ")) . $suffix;
    }

    public static function convertNumberToWords1($number)
    {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'Không',
            1                   => 'Một',
            2                   => 'Hai',
            3                   => 'Ba',
            4                   => 'Bốn',
            5                   => 'Năm',
            6                   => 'Sáu',
            7                   => 'Bảy',
            8                   => 'Tám',
            9                   => 'Chín',
            10                  => 'Mười',
            11                  => 'Mười một',
            12                  => 'Mười hai',
            13                  => 'Mười ba',
            14                  => 'Mười bốn',
            15                  => 'Mười năm',
            16                  => 'Mười sáu',
            17                  => 'Mười bảy',
            18                  => 'Mười tám',
            19                  => 'Mười chín',
            20                  => 'Hai mươi',
            30                  => 'Ba mươi',
            40                  => 'Bốn mươi',
            50                  => 'Năm mươi',
            60                  => 'Sáu mươi',
            70                  => 'Bảy mươi',
            80                  => 'Tám mươi',
            90                  => 'Chín mươi',
            100                 => 'trăm',
            1000                => 'ngàn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'ngàn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
// overflow
            trigger_error(
                'self::convertNumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . self::convertNumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . self::convertNumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = self::convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= self::convertNumberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

    public static function convertNumberToWords($amount)
    {
        if($amount <=0)
        {
            return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);

        for ($i = 0; $i < $length; $i++)
            $unread[$i] = 0;

        for ($i = 0; $i < $length; $i++)
        {
            $so = substr($amount, $length - $i -1 , 1);

            if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
                for ($j = $i+1 ; $j < $length ; $j ++)
                {
                    $so1 = substr($amount,$length - $j -1, 1);
                    if ($so1 != 0)
                        break;
                }

                if (intval(($j - $i )/3) > 0){
                    for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
                        $unread[$k] =1;
                }
            }
        }

        for ($i = 0; $i < $length; $i++)
        {
            $so = substr($amount,$length - $i -1, 1);
            if ($unread[$i] ==1)
                continue;

            if ( ($i% 3 == 0) && ($i > 0))
                $textnumber = $TextLuythua[$i/3] ." ". $textnumber;

            if ($i % 3 == 2 )
                $textnumber = 'trăm ' . $textnumber;

            if ($i % 3 == 1)
                $textnumber = 'mươi ' . $textnumber;


            $textnumber = $Text[$so] ." ". $textnumber;
        }

        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

        return ucfirst($textnumber." đồng");
    }

}

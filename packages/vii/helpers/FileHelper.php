<?php

namespace vii\helpers;

use Yii;

class FileHelper extends \yii\helpers\FileHelper
{

    public static function getExtention($file)
    {
        if (($ext = pathinfo($file, PATHINFO_EXTENSION)) !== '')
            return strtolower($ext);
        return FALSE;
    }


    //
    public static function getUploadTempPath($filename)
    {
        $path = Yii::getAlias('@runtime') . '/temp/';
        static::createDirectory($path);
        return static::_processUploadPath($path, $filename);
    }

    public static function getUploadTempUrl($path)
    {
        return str_replace(Yii::getAlias('@runtime') . '/temp/', '', $path);
    }

    public static function getUploadTempPathExist($filename)
    {
        return Yii::getAlias('@runtime') . '/temp/' . $filename;
    }


    // Lay thong tin noi save tap tin khi upload
    public static function getUploadPath($filename = null)
    {
        $path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['uploadDir'] . '/';
        if (Yii::$app->controller->module->id != null) {
            // clearn app.id
            $path .= Yii::$app->controller->module->id . '/';
        }
        $path .= date('Y/m/d/');
        static::createDirectory($path);
        return static::_processUploadPath($path, $filename);
    }

    // Xu ly ten tap tin bị trung
    private static function _processUploadPath($path, $filename)
    {
        $fileInfo = pathinfo($filename);
        $filename = static::generateSlug($fileInfo['filename']);
        $extension = strtolower($fileInfo['extension']);
        $basename = $filename . '.' . $extension;

        $newPath = $path . $basename;
        $newName = $basename;

        $counter = 1;
        while (file_exists($newPath)) {
            if ($counter > 10) {
                $counter = md5(microtime());
            }
            $newName = $filename . '-' . $counter . '.' . $extension;
            $newPath = $path . '/' . $newName;
            $counter++;
        }

        return $path . $newName;
    }

    // URL tra ve sau khi upload xong
    public static function getUploadUrl($path)
    {
        return str_replace(Yii::getAlias('@webroot') . '/' . Yii::$app->params['uploadDir'] . '/', '', $path);
    }

    // URL tra ve sau khi upload xong
    public static function getUploadSrc($path)
    {
        return Yii::$app->params['uploadUrl'] . '/' . Yii::$app->params['uploadDir'] . '/' . $path;
    }


    public static function getUploadSource($path)
    {
        $src = Yii::getAlias('@webroot') . '/' . $path;
        if (file_exists($src))
            return $src;

        return null;
    }

    // Xoa tap tin da upload
    public static function removeUploaded($url)
    {
        $path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['uploadDir'] . '/';
        return static::removeFile($path . $url);
    }

    public static function removeFile($file)
    {
        if (file_exists($file) && is_file($file)) {
            chmod($file, 0755);
            return (unlink($file)) ? true : false;
        } else return false;
    }

    public static function readFile($path)
    {
        if (file_exists($path) AND is_file($path)) {
            return file_get_contents($path);
        }

        return '';
    }

    public static function writeFile($path, $data, $mode = 0755, $recursive = true)
    {
        $pathDir = pathinfo($path, PATHINFO_DIRNAME);
        if (!is_dir($pathDir)) {
            mkdir($pathDir, $mode, $recursive);
        }

        return file_put_contents($path, $data);
    }

    // Lay danh dach cac ext cho phep upload
    public static function getWhitelist()
    {
        $extWhitelist = [];
        foreach (static::listMimetype() as $key => $val) {
            $extWhitelist = array_merge($extWhitelist, array_keys($val));
        }
        return $extWhitelist;
    }

    public static function listMimetype()
    {
        return [
            'text' => [
                'txt' => 'text/plain',
                'rtf' => 'application/rtf',
            ],
            'image' => [
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
                'ico' => 'image/x-icon',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
            ],
//            'flash' => [
//                'swf' => 'application/x-shockwave-flash',
//            ],
            'video' => [
                'mp4' => 'video/mp4',
                'avi' => 'video/x-msvideo',
                'flv' => 'video/x-flv',
                'wmv' => 'video/x-ms-wmv',
                'mpeg' => 'video/mpeg',
            ],
            'audio' => [
                'mp3' => 'audio/mpeg3',
            ],
            'archive' => [
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                '7z' => 'application/x-7z-compressed',
                'gz' => 'application/x-gzip',
            ],
            'document' => [
                'pdf' => 'application/pdf',
                'xps' => 'application/vnd.ms-xpsdocument',
                'prc' => 'application/x-mobipocket-ebook',
                'txt' => 'text/plain',
                'rtf' => 'application/rtf',
                'epub' => 'application/epub+zip',

                'doc' => 'application/msword',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',

                'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',

                'xls' => 'application/vnd.ms-excel',
                'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

                'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',

                'ppt' => 'application/vnd.ms-powerpoint',
                'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',

                'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',

                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            ],
            'other' => [

            ],
        ];
    }

    /**
     * Lấy danh sách các folder trong folder
     * @param $dir
     * @param array $ignore
     * @return array
     */
    public static function findDirectories($dir, $ignore = array())
    {
        $dirList = glob($dir . '/*', GLOB_ONLYDIR);
        $result = [];
        foreach ($dirList as $dir) {
            $name = basename($dir);
            if (!in_array($name, $ignore))
                $result[$name] = $name;
        }
        return $result;
    }


    public static function getDirectorySize($path)
    {
        $bytesTotal = 0;
        $path = realpath($path);
        if ($path !== false && is_dir($path)) {
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)) as $object) {
                $bytesTotal += $object->getSize();
            }
        }
        return $bytesTotal;
    }

    public static function formatSize($size, $decimal = 2)
    {
        $mod = 1024;
        $units = explode(' ', 'B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }

        return number_format($size, $decimal) . ' ' . $units[$i];
    }

    public static function removeDirectory($dir, $options = [])
    {
        parent::removeDirectory($dir, $options = []);
        return true;
    }

    /**
     * Function: sanitizeFilename
     * Returns a safe filename, by replacing all dangerous characters
     *
     * @param $string - The string to sanitize.
     * @param bool $forceLowercase - Force the string to lowercase?
     * @param bool $onlyAlphanumeric - If set to *true*, will remove all non-alphanumeric characters.
     * @param int $truncate - Number of characters to truncate to (default 100, 0 to disable).
     * @return mixed|string
     */
    public static function sanitizeFilename($string, $forceLowercase = true, $onlyAlphanumeric = false, $truncate = 100)
    {
        $strip = [
            "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "—", "–", ",", "<", ".", ">", "/", "?"
        ];

        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($onlyAlphanumeric) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
        $clean = ($truncate) ? substr($clean, 0, $truncate) : $clean;
        return ($forceLowercase) ? mb_strtolower($clean, 'UTF-8') : $clean;
    }

    public static function generateSlug($str)
    {
        $str = trim(mb_strtolower($str, 'UTF-8'));
        $strFind = array(
            '- ', ' ', '_', 'đ',
            'á', 'à', 'ạ', 'ả', 'ã', 'ă', 'ắ', 'ằ', 'ặ', 'ẳ', 'ẵ', 'â', 'ấ', 'ầ', 'ậ', 'ẩ', 'ẫ',
            'ó', 'ò', 'ọ', 'ỏ', 'õ', 'ô', 'ố', 'ồ', 'ộ', 'ổ', 'ỗ', 'ơ', 'ớ', 'ờ', 'ợ', 'ở', 'ỡ',
            'é', 'è', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ế', 'ề', 'ệ', 'ể', 'ễ',
            'ú', 'ù', 'ụ', 'ủ', 'ũ', 'ư', 'ứ', 'ừ', 'ự', 'ử', 'ữ',
            'í', 'ì', 'ị', 'ỉ', 'ĩ',
            'ý', 'ỳ', 'ỵ', 'ỷ', 'ỹ');
        $strReplace = array(
            '', '-', '-', 'd',
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'i', 'i', 'i', 'i', 'i',
            'y', 'y', 'y', 'y', 'y');
        return preg_replace('/[^a-z0-9\-]+/i', '', str_replace($strFind, $strReplace, $str));
    }
}

<?php

namespace BeeJee\Utils;

use Exception;

trait ImageUpload
{
    public $imageUploadPath = '/tmp/';
    public $tmpPath = '/tmp/';
    public $types = array('image/gif', 'image/png', 'image/jpeg');
    public $size = 1024000;
    public $maxSizeX = 320;
    public $maxSizeY = 240;
    public $imageFuncs = [
        'image/jpeg' => 'imagejpg',
        'image/png' => 'imagepng',
        'image/gif' => 'imagegif'
    ];

    /**
     * @return bool
     */
    public function isValidTypes($image)
    {
        return in_array($image['type'], $this->types);
    }

    /**
     * @return bool
     */
    public function isValidSize($image)
    {
        return $image['size'] <= $this->size;
    }

    /**
     * @param $type
     * @param $name
     * @return resource
     */
    public function getSource($type, $name)
    {
        switch ($type) {
            case 'image/png':
                $source = imagecreatefrompng($name);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($name);
                break;
            default:
                $source = imagecreatefromjpeg($name);

        }
        return $source;
    }

    /**
     * @param $type
     * @return string
     */
    public function getImageFunc($type)
    {
        return isset($this->imageFuncs[$type]) ? $this->imageFuncs[$type] : 'imagejpg';
    }

    /**
     * @param     $file
     * @return mixed
     */
    public function resize($file)
    {
        $imageFunc = $this->getImageFunc($file['type']);
        $source = $this->getSource($file['type'], $file['tmp_name']);
        $width = imagesx($source);
        $height = imagesy($source);
        $newName = $this->getNewName($file['name']);

        if ($width > $this->maxSizeX || $height > $this->maxSizeY) {
            $dest = imagecreatetruecolor($this->maxSizeX, $this->maxSizeY);
            imagecopyresampled($dest, $source, 0, 0, 0, 0, $this->maxSizeX, $this->maxSizeY, $width, $height);
            $imageFunc($dest, $this->tmpPath . $newName);
            imagedestroy($dest);
        } else {
            imagejpeg($source, $this->tmpPath . $newName);
        }
        imagedestroy($source);
        return $newName;
    }

    /**
     * @param $name
     * @return string
     */
    public function getNewName($name)
    {
        $exploded = explode('.', $name);
        return implode('.', [md5($name), end($exploded)]);
    }

    /**
     * @param $name
     * @throws Exception
     */
    public function copy($name)
    {
        if (!@copy($this->tmpPath . $name, $this->imageUploadPath . $name)) {
            throw new Exception('Copy error');
        }
        unlink($this->tmpPath . $name);
    }

    /**
     * @param $image
     * @return mixed
     * @throws Exception
     */
    public function upload($image)
    {
        if (!$this->isValidSize($image) || !$this->isValidTypes($image)) {
            throw new Exception('Size and type not valid');
        }
        $newImageName = $this->resize($image);
        $this->copy($newImageName);
        return $newImageName;
    }
}

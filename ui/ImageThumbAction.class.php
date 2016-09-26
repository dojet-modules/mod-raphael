<?php
/**
 *
 * Filename: ImageThumbAction.class.php
 *
 * @author liyan
 * @since 2016 9 26
 */
namespace Mod\Raphael;

use \ModuleRaphael;

class ImageThumbAction extends XBaseAction {

    public function execute() {
        $width = MRequest::getParam('width');
        $height = MRequest::getParam('height');
        $hash = MRequest::getParam('hash');

        $oriImagePath = MRaphaelImageService::getImagePath($hash);
        if (!file_exists($oriImagePath)) {
            $this->display404();
        }

        $thumbRoot = Config::runtimeConfigForKeyPath('image.thumb_root').$width.'x'.$height;
        if (!file_exists($thumbRoot)) {
            //  缩略图分辨率非法
            print 'illegal resolution';
            $this->display404();
        }

        $image = new MImage($oriImagePath);
        $image->resize($width, $height);
        $thumbPath = MRaphaelImageService::getThumbPath($hash, $width, $height);
        $path = dirname($thumbPath);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }
        $image->saveTo($thumbPath, 50);
        $image->display();
    }

}

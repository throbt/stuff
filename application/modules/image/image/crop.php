<?php
  /**
 * @copyright crainbandy.com
 * @since November 6th, 2008
 * @author bryan maxwell - www.crainbandy.com
 * --------------------------
 * @name crop_image
 * @package image editing
 * @subpackage cropping
 * --------------------------
 * @link http://www.crainbandy.com/2008/11/06/crop-an-image-with-php/434
 *
 * This is a function that allows you to take any image $image and crop it to a specific size.
 *
 * @example crop_image('images/something.jpg', 'images/cropped.jpg', 125, 125);
 *
 * $_SERVER['DOCUMENT_ROOT'] is included on all image paths. - escaped !
 *
 * @param string $src_image
 * @param int $width
 * @param int $height
 * @param bool $cropped_image
 * @param bool $link
 * @return either true if it worked, or false if it didn't. or a string link to the image that has been cropped depending on $link's value.
 */
  
function crop_image($src_image, $width, $height, $cropped_image = false, $link = false) {
    /**
     * Setup some variables
     */
    $dir = dirname($src_image);
    $image_filename = $src_image;

    /**
     * Get the extension
     */
    $len = strlen($image_filename);
    $extension = substr($image_filename, $len - 4, $len);

    /**
     * Create the handles
     */
    $src_file = $image_filename;

    /**
     * What kind of file is it?
     * --
     * Clean it up a bit, then instantiate the image.
     */
    $clean_extension = str_replace('.', '', $extension);
    switch ($extension) {
    case '.jpg':
    case '.gif':
    case '.png':
        /**
         * Use a variable as a function name to call it, dynamically.
         */
        $type = ($clean_extension == 'jpg') ? 'jpeg' : $clean_extension;
        $dynamic_function = "imagecreatefrom$type";
        break;
    }
    $src = $dynamic_function($image_filename);
    $dest = imagecreatetruecolor($width, $height);

    /**
     * Are we renaming this? or just following suit with $src_image appending to it?
     */
    if (!$cropped_image) {
        $cropped_image = str_replace($extension, '_cropped'.$extension, $image_filename);
    } else {
        $cropped_image = "/$dir/$cropped_image";
    }

    /**
     * Get size of the $src_file
     */
    $size_array = getimagesize($src_file);

    /**
     * Set the size of the crop from the image.
     */
    $crop_width = 125;
    $crop_x = $crop_width / 2;
    $crop_height = 125;
    $crop_y = $crop_height / 2;

    /**
     * Set original sizes
     */
    $original_width = $size_array[0];
    $original_height = $size_array[1];

    /**
     * Logic
     */
    if ($crop_width > $original_width || $crop_height > $original_height) {
        die('Image dimensions are too big for the crop x-y you provided.');
    }

    /**
     * Output the image
     */
    imagecopy($dest, $src, 0, 0, $crop_x, $crop_y, $original_width, $original_height);
    switch ($extension) {
    case '.jpg':
    case '.gif':
    case '.png':
        $dynamic_function = "image$type";
        $result = $dynamic_function($dest, $cropped_image);
        break;
    }

    /**
     * Little bit of error control.
     */
    if ($result) {
        if ($link) {
            return $cropped_image;
        } else {
            return true;
        }
    }

    /**
     * Trash.
     */
    imagedestroy($dest);
}
?>
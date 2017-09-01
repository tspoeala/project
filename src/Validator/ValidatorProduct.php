<?php
/**
 * Created by PhpStorm.
 * User: teodora.spoeala
 * Date: 8/10/2017
 * Time: 5:59 PM
 */

namespace Src\Validator;


use App\Request;

class ValidatorProduct
{
    private $errors = [];

    public function validatePhoto(Request $request)
    {
        $photoData = $request->getFilesData('photo');
        if (null != $photoData) {
            $fileName = $photoData['name'];
            $fileSize = $photoData['size'];
            $fileTmp = $photoData['tmp_name'];
            $explode = explode('.', $photoData['name']);
            $fileExt = strtolower(end($explode));
            $fileType = mime_content_type($fileTmp);
            $mimetypes = array("image/jpeg", "image/pjpeg", "image/png");
            $extensions = array("jpeg", "jpg", "png");


            if (!in_array($fileType, $mimetypes)) {
                $this->errors['extensions'] = "extension not allowed, please choose a JPEG or PNG file.";

            }

            if (!in_array($fileExt, $extensions)) {
                $this->errors['extensions'] = "extension not allowed, please choose a JPEG or PNG file.";

            }

            if ($fileSize > 2097152) {
                $this->errors['size'] = 'File size must be excately 2 MB';
            }


            if (empty($errors)) {
                move_uploaded_file($fileTmp, "src/Resources/images/" . $fileName);
            }
        }
    }

    public function validatePhotoUpdate(Request $request)
    {
        $file_name = $request->getFilesData('photo')['name'];
        $file_tmp = $request->getFilesData('photo')['tmp_name'];
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "src/Resources/images/" . $file_name);
        }
    }

    public function validateTitle($productData)
    {
        if (empty($productData['title'])) {
            $this->errors['titleEmpty'] = "Title is empty!";
        }
        if (!preg_match('/^[A-Za-z,;. 0-9]+$/', $productData['title'])) {
            $this->errors['title'] = "Title should contain letters, numbers and , ; or . !";
        }
    }

    public function validateDescription($productData)
    {
        if (empty($productData['description'])) {
            $this->errors['descriptionEmpty'] = "Description is empty!";
        }
    }

    public function validatePrice($productData)
    {
        if (empty($productData['price'])) {
            return $this->errors['priceEmpty'] = "Price is empty!";
        }

        if (!preg_match('/^[,;. 0-9]+$/', $productData['price'])) {
            $this->errors['price'] = "Price should contain numbers and , ; or . !";
        }
    }

    public function array_has_dupes($array)
    {
        return count($array) !== count(array_unique($array));
    }

    public function validateCharacteristics($productData)
    {

        if (empty($productData['characteristic'])) {
            $this->errors['characteristic'] = "Please choose the characteristics!";
        }
        if ($this->array_has_dupes($productData['characteristic'])) {
            $this->errors['dupes'] = "You choose the same characteristic more times!";
        }
        //return $this->errors;


    }


    public function validate($productData, $request)
    {
        $this->validatePhoto($request);

        $this->validateTitle($productData);

        $this->validateDescription($productData);

        $this->validatePrice($productData);

        if (strpos(Request::uri(), 'addProduct') === false) {
            return $this->errors;
        }

        //
        $this->validateCharacteristics($productData);
        return $this->errors;

    }

    public function validateUpdate($productData, $request)

    {
        $this->validatePhotoUpdate($request);

        $this->validateTitle($productData);

        $this->validateDescription($productData);

        $this->validatePrice($productData);


        return $this->errors;
    }
}
<?php

namespace App\Media\Model;

use Core\Classes\SessionData;
use Core\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id_media';

    /**
     * Function upload file
     * 
     * @param array $file
     */
    public function uploadFileCustom(array $file)
    {
        $fileUpload = $file;
        $target_file_name = null;
        if (!is_null($fileUpload)) {
            $source_path  = $fileUpload['tmp_name'];
            $file_name = $fileUpload['name'];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $target_file_name = time() . "-" . uniqid() . "." . $file_extension;
            $target_directory = "../web/assets/media/" . $target_file_name;
            $uploads = [];

            move_uploaded_file($source_path, $target_directory);
            $uploads['status'] = true;
            $uploads['file'] = $target_file_name;
        }

        return $uploads;
    }

    /**
     * Function store media
     * 
     * @param array $file
     * @param array $data_media example: ['id_relation' => '', 'jenis_dokumen' => '']
     * 
     */
    public function storeMedia(array $file, array $data_media)
    {
        if (isset($file) && $file['name'] != '') {
            $dokumen = $this->uploadFileCustom($file);
            $data_media = [
                'path_media' => $dokumen['file'],
                'id_relation' => $data_media['id_relation'],
                'id_entity' => SessionData::get()->get('id_user'),
                'jenis_dokumen' => $data_media['jenis_dokumen'],
            ];
            $this->insert($data_media);
        }

        return $dokumen;
    }

    /**
     * Function update media
     * 
     * @param array $file
     * @param array $data_media example: ['id_relation' => '', 'jenis_dokumen' => '']
     * 
     */
    public function updateMedia(array $file, array $data_media, Model $model, string $id_tabel)
    {
        if (isset($file) && $file['name'] != '') {
            $media_data = $model->select('media.*')->leftJoin('media', 'media.id_relation', '=', $model->table . '.' . $model->primaryKey)->where($model->primaryKey, $id_tabel)->first();
            $this->deleteMedia($media_data);
            $dokumen = $this->storeMedia($file, $data_media);

            return $dokumen;
        }
    }

    /**
     * Function delete media
     * 
     * @param string $file
     * 
     */
    public function deleteFile(string $file)
    {
        if (file_exists(__DIR__ . '/../../../../web/assets/media/' . $file)) {
            unlink(__DIR__ . '/../../../../web/assets/media/' . $file);

            return true;
        }

        return false;
    }

    /**
     * Function delete media
     * 
     */
    public function deleteMedia($data_media)
    {
        if (is_array($data_media) && $data_media['path_media'] != null) {
            $this->deleteFile($data_media['path_media']);
            $this->where('id_media', $data_media['id_media'])->delete();
        }

        return true;
    }
}

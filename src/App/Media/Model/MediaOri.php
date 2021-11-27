<?php

namespace App\Media\Model;

use Core\GlobalFunc;
use PDOException;

class MediaOri
{
    private $table = 'media';
    private $primaryKey = 'id_media';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll()
    {
        $sql = "SELECT media.*, entitas.idEntitas, member.idMember FROM " . $this->table . " 
        LEFT JOIN entitas ON media.id_entity = entitas.idEntitas LEFT JOIN member on media.idRelation = member.idMember";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($idMedia, $fileUpload, $idRelation, $idEntity = 1, $jenisDokumen = null)
    {
        $file = $fileUpload;
        $namaMedia = $file['name'];
        $namaSementara = $file['tmp_name'];
        $ekstensi_diperbolehkan    = array('png', 'jpg', 'pdf');
        $x = explode('.', $namaMedia);
        $nama = strtolower($x['0']);
        $ekstensi = strtolower(end($x));
        $ukuran    = $file['size'];
        $filename = $nama . "" . uniqid() . "." . $ekstensi;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1055070) {
                move_uploaded_file($namaSementara, __DIR__ . '/../../../../web/assets/media/' . $filename);
                $dateCreate = date('Y-m-d');
                $sql = "INSERT INTO " . $this->table . " VALUES ('$idMedia', '$filename', '$idRelation', '$idEntity', '$jenisDokumen', '$dateCreate', '$dateCreate')";
            }
        }

        try {
            $data = $this->conn->prepare($sql);

            $data->execute();

            return $data->rowCount();
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function uploadFile($file)
    {
        $fileUpload = $file;
        $target_file_name = null;
        if (!is_null($fileUpload)) {
            $source_path  = $fileUpload['tmp_name'];
            $file_name = $fileUpload['name'];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $target_file_name = time() . "-" . uniqid() . "." . $file_extension;
            $target_directory = "../web/assets/media/" . $target_file_name;
            $file_type = $fileUpload['type'];
            $euy = array();
            if ($file_type != "image/gif" && $file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "application/pdf" && $file_type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                // $euy['status']         =           "FAILED";
                // $euy['message']        =           "Invalid file type. (File type only jpg, jpeg, gif, and png allowed)";
                // return $euy;
            } else {
                move_uploaded_file($source_path, $target_directory);
            }
        }

        return $target_file_name;
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $data_test = [])
    {
        $pathMedia = $data_test['pathMedia'];
        $idRelation = $data_test['idRelation'];
        $idEntity = $data_test['idEntity'];

        $sql = "UPDATE " . $this->table . " SET pathMedia = '$pathMedia', idEntity = '$idEntity', idRelation = '$idRelation' WHERE " . $this->primaryKey . "='$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function deleteFile($file)
    {
        
        if (file_exists(__DIR__ . '/../../../../web/assets/media/' . $file)) {
            unlink(__DIR__ . '/../../../../web/assets/media/' . $file);

            return true;
        }

        return false;
    }

    public function selectOneMedia($where)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $where;

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function downloadFile($filename)
    {
        $filepath =  __DIR__ . '/../../../../web/assets/media/' . $filename;

        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'
                                        .basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));

            // Flush system output buffer
            flush(); 
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    }
}

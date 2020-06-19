        $uploader = new FileUploader($imageName,$imageTmp,$imageSize,$imageType);

        if($uploader->uploadFile())
        {
            echo "<script>alert(\"Image uploaded successfully!\")</script>";
        }

        if (!$user->validateForm())
        {
            $user->createFormErrorSessions();
            header("Refresh:0");
            die();
        }

        $users = $user->readAll($connection->conn);

        if ($users->num_rows >0)
        {
            while ($row=$users->fetch_assoc())
            {
                if($row['username'] == $username)
                {
                    echo "<script>alert(\"Username already exists!\")</script>";
                    header("Refresh:0");
                    die();
                }
            }
        }

        $targetPath = $uploader::getTargetDirectory().$uploader->getFileOriginalName();
        $result = $user->save($connection->conn,$targetPath);

        if($result)
        {
            echo "<script>alert(\"User account created successfully!\")</script>";
            $connection->closeConnection();
        }
        else
        {
            echo 'An Error occurred.';
            echo '<br>';
        }
    }
?>
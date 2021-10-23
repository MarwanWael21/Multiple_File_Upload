<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $uploaded_files = $_FILES['single_file'];
        $img = [];

        $img = $uploaded_files['name'];
        $image_size = $uploaded_files['size'];
        $image_temp = $uploaded_files['tmp_name'];
        $image_type = $uploaded_files['type'];
        $image_error = $uploaded_files['error'];

        $allowed_extenstion = ['jpg', 'jpeg', 'gif', 'png'];

        if ($image_error[0] == 4) {
            echo "<div>You Must Upload file</div>";
        } else {

        $count = count($img);

        for ($i = 0; $i < $count; $i++) {
            
        $errors = [];
        $image_extenstion[$i] = explode('.' ,$img[$i]);
        $dump[$i] = strtolower(end($image_extenstion[$i]));

        $randImg[$i] = rand(0, 100000000) . "." . $dump[$i];


        if ($image_size[$i] > 100000) {
            $errors[] = '<div>Image can\'t Be This Large x</div>';
        }
        if (!in_array($dump[$i], $allowed_extenstion)) {
            $errors[] = "File Must Be Image";
        }
        
        if (empty($errors)) {
            move_uploaded_file($image_temp[$i], $_SERVER['DOCUMENT_ROOT'] . "\Files Upload\up\\" . $randImg[$i]);
            echo "<div>Image ". ($i + 1) ." Uploaded</div>";
            $allImages[] = $randImg[$i];
        } else {
            echo "<div>Error In File Number ". ($i + 1) . "</div>";
            foreach ($errors as $err) {
                echo $err;
            }
        }

        }

        // echo realpath(dirname(getcwd())); Get Current Directory

    }
}
?>
    <form action="" method="post" enctype = "multipart/form-data">
        <input type="file" name="single_file[]" multiple = "multiple" id=""> <br> <br>
        <input type="submit" value="Upload">
    </form>
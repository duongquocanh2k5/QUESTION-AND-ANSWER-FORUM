<?php
$target_dir= 'upload';
$target_file = basename($_FILES["questionimg"]["name"]);
$upload0k = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
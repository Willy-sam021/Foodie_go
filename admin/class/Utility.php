<?php

class Utility{
   public static function sanitize($bad){
    $pure=strip_tags($bad);
    $pure=addslashes($pure);
    $pure=htmlentities($pure);
    $pure=htmlspecialchars($pure);
     return $pure;
    }

    // $bad="<script>alert('hello world')</script>";
    // echo sanitize($bad);
}

?>
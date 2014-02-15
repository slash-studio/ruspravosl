<?php
function GetPOST()
{
   return array_map('trim', $_POST);
}
?>
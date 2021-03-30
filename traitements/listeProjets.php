<?php
if(empty($_SESSION["grade"]) || $_SESSION["grade"] < 1){
    header("location:index");
}
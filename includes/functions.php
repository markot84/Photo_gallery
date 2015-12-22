<?php

function strip_zeros_from_date( $marked_string=""){     
    $no_zeros = str_replace('*0','',$marked_string);        # str_replace -> Replace all occurrences of the search string with the replacement string
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

function redirect_to( $location = NULL ){                   # The special NULL value represents a variable with no value
    if ($location != NULL){
        header("Location: {$location}");                    # header — Send a raw HTTP header, with Location sends redirect too
        exit();
    }
}

function output_message($message=""){
    if(!empty($message)){
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}
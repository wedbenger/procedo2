<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function convert_date($date) {
    return date("d/m/Y H:i", strtotime($date));
}
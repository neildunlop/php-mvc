<?php

class Contact extends Controller
{
    public function index($name='') {

        echo 'Hello Contact' . $name;
    }

}
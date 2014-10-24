<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo Form::open(array('action' => 'SessionsController@store'));
echo Form::label('email', 'E-Mail Address'); echo '<br>';
echo Form::text('email');echo '<br>';
echo Form::label('password', 'Password');echo '<br>';
echo Form::password('password');echo '<br>';
echo Form::submit('Login!');echo '<br>';
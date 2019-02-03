<?php declare(strict_types=1);

use PerfectApp\FormBuilder\FormGenerator;

$formElements = ['TextInput' =>
    ['name' => 'username', 'placeholder' => 'Enter Username', 'required' => 'required'], 'PasswordInput' =>
    ['name' => 'password', 'maxlength' => '20'], 'SubmitButton' =>
    ['name' => 'login', 'value' => 'Log in']];

// instantiate a new formGenerator object
$fg = new FormGenerator($formElements);

// add element labels
$fg->addFormPart('<table style="float:left;"><tr><td>User
Name<td></tr><tr><td>Password<td></tr></table>');

// add a table to the form code
$fg->addFormPart("<table>\n");

// add a table row as element header
$fg->addElementHeader('<tr><td>');

// add closing tags
$fg->addElementFooter('</td></tr>');

// generate form
$fg->createForm();

// add a closing </table> tag
$fg->addFormPart('</table>');

// display the form
echo $fg->getFormCode();

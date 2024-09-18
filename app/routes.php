<?php

/*
    Can add the routs and the conntroller
*/

return [
    '/' => '../app/Controllers/user/login.php',
    '/user/login' => '../app/Controllers/user/login.php',
    '/user/register' => '../app/Controllers/user/register.php',
    '/user/logout' => '../app/Controllers/user/logout.php',
    '/user/lostPassword' => '../app/Controllers/user/lostPassword.php',
    '/user/userSettings' => '../app/Controllers/user/userSettings.php',
    '/user/changePassword' => '../app/Controllers/user/changePassword.php',
    '/user/changeEmail' => '../app/Controllers/user/changeEmail.php',
    '/user/delete' => '../app/Controllers/user/delete.php',


    '/quiz/create' => '../app/Controllers/quiz/create.php',
    '/quiz/store' => '../app/Controllers/quiz/store.php', 
    '/quiz/show/{id}' => '../app/Controllers/quiz/show.php',

    '/project' => '../app/Controllers/project/index.php',

];
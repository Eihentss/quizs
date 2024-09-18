<?php

class RoleMiddleware {
    // Pārbauda, vai lietotājs ir pieteicies
    public static function auth() {
        if (!isset($_SESSION['user'])) {
            // Ja lietotājs nav pieteicies, novirza uz pieteikšanās lapu
            header("Location: /login");
            exit();
        }
    }

    // Pārbauda, vai lietotājs ir administrators
    public static function isAdmin() {
        self::auth(); // Pārbauda, vai lietotājs ir pieteicies
        if ($_SESSION['user']['role'] !== 'admin') {
            // Ja lietotājs nav admins, novirza uz lietotāja paneļa lapu
            header("Location: /dashboard");
            exit();
        }
    }

    // Pārbauda, vai lietotājam ir piekļuve noteiktai lomai (admin vai user)
    // public static function hasRole($role) {
    //     self::auth(); // Pārbauda, vai lietotājs ir pieteicies
    //     if ($_SESSION['user']['role'] !== $role) {
    //         // Ja lietotājam nav piešķirta atbilstošā loma, novirza uz citu lapu
    //         header("Location: /no-access");
    //         exit();
    //     }
    // }
}

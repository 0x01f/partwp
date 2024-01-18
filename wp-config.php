<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'tankarma_wp3' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'tankarma_wp3' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'ZUw10&9*k' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'v,lP![e77AKHR&<Au:_Y,#6?Ju)gT(NULl{y `nOE+PSwM[Wo?*kA|Nz/=Ci}H#+' );
define( 'SECURE_AUTH_KEY',  'U<+yZ% E85ujZuZd%?A]tROVTP!}sMLFr^7$NO`fH%=L{I[LbxNz&D!c;)_71G.l' );
define( 'LOGGED_IN_KEY',    'zNpNqXSYCY/lKxWOA*lRV_}iV3{FvJ4B9sISp):U(R%6mzpu*=nazv>?|3(U6.!T' );
define( 'NONCE_KEY',        '@&JA $fCgLUhN0}YD$|YX}zY;du)96Xfj]p-tbg98Rq4z}`OZ;A_$b8!(X*6,U_s' );
define( 'AUTH_SALT',        'c3x/~e|Ow!BC<-?=9A(FffrEs7#!aIE@jG4Fb1K<o&3>@1r}x<Z[)Hw 9>?$,K0Z' );
define( 'SECURE_AUTH_SALT', 'O(VM[50dtPd:Uq5:*/oZwya kZR05{Z*id$ g?D}*#(>Zx)2CB #@u$J_>pz7uGI' );
define( 'LOGGED_IN_SALT',   '2rvBM,A}Pt4@-;SRJ!^<E9w_aL45U=Jv{dm^H#BY8~#XZ76[I/!</TPIJrRe(}oW' );
define( 'NONCE_SALT',       '7KJ[-^Cod(a1oufL]ySXh{>G-&68rJDrx*)P=AL(QdzRH|k4s`23~/()K.VV=uS@' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';

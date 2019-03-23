<?php
/**
 * Created by PhpStorm.
 * User: lucky
 * Date: 22.02.19
 * Time: 18:41
 */

namespace shop;


class ErrorHandler
{
    public function __construct() {
        if(DEBUG) {
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e) {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

//You want to give write permissions to the folder
//Нужно дать права на запись в папку.
    protected function logErrors($massage = '', $file = '', $line = '') {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$massage} | Файл: {$file} | Строка: {$line} \n--------------------\n", 3, ROOT . '/tmp/errors.log');
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $responce = 404) {
        http_response_code($responce);
        if ($responce == 404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die;
        }
        if(DEBUG) {
            require WWW . '/errors/dev.php';
        }else{
            require WWW . '/errors/prod.php';
        }
        die;
    }

}
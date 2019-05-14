<?php

/**
 * Simple Response Class
 */

namespace App\Http;

class Response
{
    public static function view($file, $params = [])
    {

    /**
     * Requires the desired view
     * 
     * The view method in \App\Http\Response, takes a view name
     * as required argument and search for that file
     * in the \src\Views folder, and any optional
     * parameter can be passed by in the
     * second argument array
     * 
     * @param  string  $file
     */

    $view = dirname(__DIR__) . '/Views/' . $file . '.php';
    $level = ob_get_level();
    ob_start();
    ob_implicit_flush(false);
    extract($params, EXTR_OVERWRITE);
    try {
        if(!file_exists($view)){
          return self::notFound("The view: $file.php does not exist in the views folder");
        }
        require $view;
        echo ob_get_clean();
    } catch (\Exception $e) {
        while (ob_get_level() > $level) {
            ob_end_clean();
        }
        throw $e;
    } catch (\Throwable $e) {
        while (ob_get_level() > $level) {
            ob_end_clean();
        }
        throw $e;
    }
}
    public static function notFound($msg = "")
    {

    /**
     * Requires the 404 not found view
     * and exits the app.
     */

      self::view('404', ["msg" => $msg]);
      exit();
    }
}

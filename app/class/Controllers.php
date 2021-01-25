<?php
namespace App\Dgclass;

class Controllers
{

    public function loadModel($model_name){
        $models = new Models();
        return $models->load(ucfirst($model_name));
    }

    public function view($view)
    {
        $folderf = '';
        $default_folder = _DEFAULTFOLDER_TEMPLATE_;
        $arguments = func_get_args();
        if (isset($arguments[1])) {
            if (is_array($arguments[1])) {
                if (count($arguments[1]) != 0) {
                    foreach ($arguments[1] as $key => $value) {
                        ${$key} = $value;
                    }
                }
                if (isset($arguments[2])) {
                    if (!is_null($arguments[2]) || !$arguments[2] == "") {
                        $folderf = $arguments[2];
                    } else {
                        $folderf = $default_folder;
                    }
                } else {
                    $folderf = $default_folder;
                }
            } else {
                if (isset($arguments[2])) {
                    if (count($arguments[2]) != 0) {
                        foreach ($arguments[2] as $key => $value) {
                            ${$key} = $value;
                        }
                    }
                }
                if ($arguments[1] == "" || $arguments[1] == null) {
                    $folderf = $default_folder;
                } else {
                    $folderf = $arguments[1];
                }
            }
        } else {
            $folderf = $default_folder;
        }

        if (is_array($view)) {
            require APP . 'views/_templates/' . $folderf . '/header.php';
            foreach ($view as $key => $value) {
                require APP . 'views/' . $value . '.php';
            }
            require APP . 'views/_templates/' . $folderf . '/footer.php';
        } else {
            require APP . 'views/_templates/' . $folderf . '/header.php';
            require APP . 'views/' . $view . '.php';
            require APP . 'views/_templates/' . $folderf . '/footer.php';
        }
    }
}
?>
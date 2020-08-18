<?php
function scanCache()
{
    $list = scandir($_SERVER['DOCUMENT_ROOT'].'/temp/');
    unset($list[0],$list[1]);
    return array_values($list);
}

function clearCache()
{
    $list = scancache();

    foreach ($list as $file)
    {
        if (is_dir($_SERVER['DOCUMENT_ROOT'].'/temp/'.$file))
        {
            clear_dir($_SERVER['DOCUMENT_ROOT'].'/temp/'.$file.'/');
            rmdir($_SERVER['DOCUMENT_ROOT'].'/temp/'.$file);
        }
        else
        {
            if($file != "clear.php")
            {
                unlink($_SERVER['DOCUMENT_ROOT'].'/temp/'.$file);
            }
        }
    }
}
clearCache();

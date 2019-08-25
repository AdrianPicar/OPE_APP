 <?php
 // complete path for images
        //$directory = opendir('/var/www/modules/modules/news/backend/lib/fileupload/server/php/files/');    
        $directory = opendir('\application\uploads\images');    
		
        // my webpage with tinymce instance is in the backend directory
        
        // path left to get images from my webpage perspective :)
        $path = "\application\uploads\images\\";
        
        $list = array();
        while($entry = readdir($directory)) {
            if($entry != '.' && $entry != '..') {
                $split = explode('.', $entry);
                $count = count($split);
                
                if($split[$count - 1] == 'gif'  || $split[$count - 1] == 'jpg' 
                || $split[$count - 1] == 'jpeg' || $split[$count - 1] == 'png') {
                    
                    $item = array(
                        'title' => $entry, 
                        'value'    => $path . $entry);
                    
                    $list[] = $item;
                }
            }
        }
        //var_dump($list);
        echo json_encode($list);
?>
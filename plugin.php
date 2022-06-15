<?php

class pluginTagSelection extends Plugin {

    public function adminBodyEnd()
    {
            $jsPath = $this->phpPath() . 'js' . DS;
            $scripts  = '<script>' . file_get_contents($jsPath . 'inline.js') . '</script>';
            return $scripts;
    }

    private function jsonData($query=false)
    {
        global $tags;

        $tagArray = array();
        foreach ($tags->db as $key => $tag){
            if($query!==false && strlen($query) > 0){
                if(!preg_match(sprintf('/%s/i', preg_quote($query)),$tag['name'])){
                    continue;
                }
            }
            if(strlen(trim($tag['name'])) > 0){
                $newtag = array();
                $newtag['id'] = $tag['name'];
                $newtag['text'] = $tag['name'];
                $tagArray[] = $newtag;
            }
        }
        return json_encode($tagArray);

    }


    public function init()
    {
        if ($this->webhook('plugins/tag-selection/json.json')) {
            $query = false;
            if(isset($_GET['q'])){
                $query = $_GET['q'];
            }
            header('Content-Type: application/json');
            echo '{  "results":' .$this->jsonData($query).'}';
            exit(0);
        }
    }
}

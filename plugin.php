<?php

class pluginTagSelection extends Plugin {

    public function adminBodyEnd()
    {
            $jsPath = $this->phpPath() . 'js' . DS;
            $scripts = '<script> var taglistData = '.$this->jsonData().';</script>';
            $scripts  .= '<script>' . file_get_contents($jsPath . 'inline.js') . '</script>';
            return $scripts;
    }

    private function jsonData()
    {
        global $tags;

        $tagArray = array();
        foreach ($tags->db as $key => $tag){
            if(strlen(trim($tag['name'])) > 0){
                $newtag = array();
                $newtag['id'] = $tag['name'];
                $newtag['text'] = $tag['name'];
                $tagArray[] = $newtag;
            }
        }
        return json_encode($tagArray);

    }
}

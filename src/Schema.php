<?php
namespace WuifDesign\SEO;

class Schema
{
    /**
     * Renders the schema for the given key
     *
     * @param $key
     * @param $data
     * @param $itemProp
     * @param $offset
     *
     * @return string
     * @throws \Exception
     */
    public function renderSchema($key, $data = null, $itemProp = null, $offset = '')
    {
        if($data == null) {
            $data = app('config')['seo.schema.'.$key];
            if($data == null) {
                throw new \Exception('Schema not found');
            }
        }
        return $this->renderElement($data, null, $offset.'    ');
    }

    /**
     * Renders a schema element
     *
     * @param $data
     * @param $itemProp
     * @param $offset
     * @param $is_visible
     *
     * @return string
     */
    public function renderElement($data, $itemProp, $offset = '', $is_visible = true)
    {
        $return = array();

        if(is_array($data)) {
            if($itemProp == null) {
                $return[] = $offset.'<div class="itemscope" itemscope itemtype="http://schema.org/'.$data["_type"].'">';
            } else {
                $return[] = $offset.'<div class="itemscope-'.$itemProp.'" itemprop="'.$itemProp.'" itemscope itemtype="http://schema.org/'.$data["_type"].'">';
            }
            $returnString = null;
            foreach($data as $key => $value) {
                if($key == '_type' || $key == '_hidden') { continue; }
                if(empty($value)) { continue; }
                $visible = true;
                if(isset($data['_hidden']) && $data['_hidden'] === true) {
                    $visible = false;
                }
                $return[] = $returnData = $this->renderElement($value, $key, $offset.'    ', $visible);
                if($returnString == null) {
                    $returnString = $returnData;
                }
            }
            if($returnString == null) { return null; }
            $return[] = $offset.'</div>';
        } else {
            if(!empty($data)) {
                if($is_visible) {
                    $return[] = $offset.'<span class="itemprop-'.$itemProp.'" itemprop="'.$itemProp.'">'.$data.'</span>';
                } else {
                    $return[] = $offset.'<meta itemprop="'.$itemProp.'" content="'.$data.'" />';
                }
            }
        }

        return implode(PHP_EOL, array_filter($return));
    }
}
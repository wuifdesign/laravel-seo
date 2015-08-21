<?php
namespace WuifDesign\SEO;

class Schema
{
    /**
     * Renders the schema for the given key
     *
     * @param $key
     *
     * @return string
     * @throws \Exception
     */
    public function renderSchema($key)
    {
        $data = app('config')['seo.schema.'.$key];
        if($data == null) {
            throw new \Exception('Schema not found');
        }
        return $this->renderElement($data, null);
    }

    /**
     * Renders a schema element
     *
     * @param $data
     * @param $itemProp
     * @param $offset
     * @param $meta_only
     *
     * @return string
     */
    protected function renderElement($data, $itemProp, $offset = '', $meta_only = false)
    {
        $isMetaOnly = false;
        if(isset($data['hidden']) && $data['hidden'] === true) {
            $isMetaOnly = true;
        }

        $return = array();
        if(is_array($data)) {
            if($itemProp == null) {
                $return[] = $offset.'<div class="itemscope" itemscope itemtype="http://schema.org/'.$data["type"].'">';
            } else {
                $return[] = $offset.'<div class="itemscope-'.$itemProp.'" itemprop="'.$itemProp.'" itemscope itemtype="http://schema.org/'.$data["type"].'">';
            }
            foreach($data['tags'] as $key => $value) {
                if(empty($value)) { continue; }
                $return[] = $this->renderElement($value, $key, $offset.'    ', $isMetaOnly);
            }
            $return[] = $offset.'</div>';
            $return = array_filter($return);
            if(count($return) == 2) {
                return null;
            }
        } else {
            if(!empty($data)) {
                if(!$meta_only) {
                    $return[] = $offset.'<span class="itemprop-'.$itemProp.'" itemprop="'.$itemProp.'">'.$data.'</span>';
                } else {
                    $return[] = $offset.'<meta itemprop="'.$itemProp.'" content="'.$data.'" />';
                }
            }
        }

        return implode(PHP_EOL, array_filter($return));
    }
}
<?php

class Product {
    
    public $title;
    public $id;
    public $url;
    public $type;

    public $pricePerUser;
    public $pricePerJob;
    public $minPrice;
    public $image;
    public $listOfIncludes;
    public $extraContent;
    public $helpSmalltext;
    public $helpBigText;
    public $other;

    
    function __construct($product) {

            $this->title = $product->post_title;
	        $this->id = $product->ID;
	        $postFields = get_fields($this->id);

            if(get_field('url_id', $this->id)){
                $this->url = get_field('url_id', $this->id);
            }else{
                $this->url = null;
            }

            if(get_field('type_of_product', $this->id)){
                $type = get_field('type_of_product', $this->id);
                if(count($type) >1){
                    $this->type = "Special";
                }else{
                    $this->type = $type[0];
                }
            }else{
                $this->type = null;
            }

            if(get_field('price_per_user', $this->id)){
                $this->pricePerUser = get_field('price_per_user', $this->id);
            }else{
                $this->pricePerUser = null;
            }

            if(get_field('price_per_jobposting', $this->id)){
                $this->pricePerJob = get_field('price_per_jobposting', $this->id);
            }else{
                $this->pricePerJob = null;
            }

            if(get_field('min_price', $this->id)){
                $this->minPrice = get_field('min_price', $this->id);
            }else{
                $this->minPrice = null;
            }

            if(get_the_post_thumbnail_url($this->id, 'full')){
                $this->image = get_the_post_thumbnail_url($this->id, 'full');
            }else{
                $this->image = null;
            }



            if(get_field('list_of_includes', $this->id)){
                $this->listOfIncludes = get_field('list_of_includes', $this->id);
            }else{
                $this->listOfIncludes = null;
            }

            if(get_field('custom_text', $this->id) && strlen(get_field('custom_text', $this->id)) > 1){
                $this->extraContent = get_field('custom_text', $this->id);
            }else{
                $this->extraContent = null;
            }

            $tmpHelp = get_field('help', $this->id);

            $helpSmalltemp = $tmpHelp['small_text'];
            $helpSmalltemp = str_replace(["\r\n", "\r", "\n"], "<br/>", $helpSmalltemp);
            $helpBigtext = $tmpHelp['full_text'];
            $helpBigtext = str_replace(["\r\n", "\r", "\n"], "<br/>", $helpBigtext);

            $this->helpSmalltext = $helpSmalltemp;
            $this->helpBigtext = $helpBigtext;
    }


    public function getPriceInNiceText($price){
        $lang = get_locale();
        if($lang === "da_DK"){
            return number_format(intval($price) , 0, ',', '.');
        }else{
            return number_format(intval($price) , 0, '.', ',');
        }
    }


}
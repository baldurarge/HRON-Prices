<?php

class Support {
    
    public $title;
    public $id;

    public $price;
    public $listOfIncludes;
    
    function __construct($product) {

            $this->title = $product->post_title;
	        $this->id = $product->ID;
	        $postFields = get_fields($this->id);




            if(get_field('price', $this->id)){
                $this->price = get_field('price', $this->id);
            }else{
                $this->price = 0;
            }


            if(get_field('list_of_includes', $this->id)){
                $this->listOfIncludes = get_field('list_of_includes', $this->id);
            }else{
                $this->listOfIncludes = null;
            }

    }


    public function getPriceInNiceText($price){

        return number_format(intval($price) , 0, ',', '.');
    }


}
<?php


class Addons {
    
    public $addonsArray;

    function __construct($addons){
        // $addonsArray = $addons;
        $addonsArrayTmp = array();
        foreach ($addons as $key => $value) {
            $addonClass = new Addon($value);

            array_push($addonsArrayTmp, $addonClass);
        }
        $this->addonsArray = $addonsArrayTmp;
    }


    public function getPriceInNiceText($price){

        return number_format(intval($price) , 0, ',', '.');
    }
}

class Addon {
    
    public $title;
    public $id;


    public $differentPrice;
    public $recruitPrice;
    public $recruitFrom;
    public $staffPrice;
    public $staffFrom;
    public $featured;
    public $products;
    public $image;
    public $singlePrice;
    public $singleFromPrice;
    
    function __construct($addon) {

            $this->title = $addon->post_title;
	        $this->id = $addon->ID;
	        $postFields = get_fields($this->id);

            
            $this->differentPrice = $postFields['different_price_for_each_product'];

            if($this->differentPrice){
                $this->recruitPrice = $postFields['recruit_price_group']['recruit_price'];
                $this->recruitFrom = $postFields['recruit_price_group']['recruit_from_price'];
                $this->staffPrice = $postFields['staff_price_group']['staff_price'];
                $this->staffFrom = $postFields['staff_price_group']['staff_from_price'];
            }else{
                $this->singlePrice = $postFields['price'];
                $this->singleFromPrice = $postFields['from_price'];
            }
            
            $this->featured = $postFields['featured'];

            if($this->featured){
                $this->image = $postFields['icon'];
            }else{
                $this->image = null;
            }

            $this->products = $postFields['included_in_product'];
          
    }


}
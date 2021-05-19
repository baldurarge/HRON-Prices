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


    public function getListOfAddons(){
        $html = '<span class="item-label-stuff item-label-stuff-recruit">Recruit</span>';
        $staffItemsAddons = '';
        $recruitItemsAddons = '';
        foreach ($this->addonsArray as $key => $value) {
            if($value->featured === false){
                
                // if(in_array("Recruit", $value->products) && in_array("Staff", $value->products)){
                //     if($value->differentPrice){
                //         if($value->staffFrom || $value->recruitFrom){
                //             if(intval($value->staffPrice) >= intval($value->recruitPrice)){
                //                 $html .= $this->getBasicHtml($value->title, $value->staffPrice, true, $value->id, "both");
                //             }else{
                //                 $html .= $this->getBasicHtml($value->title, $value->recruitPrice, true, $value->id, "both");
                //             }
                //         }else{
                //             if(intval($value->staffPrice) >= intval($value->recruitPrice)){
                //                 $html .= $this->getBasicHtml($value->title, $value->staffPrice, false, $value->id, "both");
                //             }else{
                //                 $html .= $this->getBasicHtml($value->title, $value->recruitPrice, false, $value->id, "both");
                //             }
                //         }
                //     }else{
                //         if($value->singleFromPrice){
                //             $html .= $this->getBasicHtml($value->title, $value->singlePrice, true, $value->id, "both");
                //         }else{
                //             $html .= $this->getBasicHtml($value->title, $value->singlePrice, false, $value->id, "both");
                //         }
                //     }
                // }else
                
                if(in_array("Recruit", $value->products)){
                    if($value->recruitPrice){
                        if($value->recruitFrom){
                            $recruitItemsAddons .= $this->getBasicHtml($value->title, $value->recruitPrice, true, $value->id, "recruit");
                        }else{
                            $recruitItemsAddons .= $this->getBasicHtml($value->title, $value->recruitPrice, false, $value->id, "recruit");
                        }
                    }else{
                        if($value->singleFromPrice){
                            $recruitItemsAddons .= $this->getBasicHtml($value->title, $value->singlePrice, true, $value->id, "recruit");

                        }else{
                            $recruitItemsAddons .= $this->getBasicHtml($value->title, $value->singlePrice, false, $value->id, "recruit");
                        }
                    }
                }
                
                if(in_array("Staff", $value->products)){
                    if($value->differentPrice){
                            
                        if($value->staffFrom){
                            $staffItemsAddons .= $this->getBasicHtml($value->title, $value->staffPrice, true, $value->id, "staff");
                        }else{
                            $staffItemsAddons .= $this->getBasicHtml($value->title, $value->staffPrice, false, $value->id, "staff");
                        }
                    }else{
                        if($value->singleFromPrice){
                            $staffItemsAddons .= $this->getBasicHtml($value->title, $value->singlePrice, true, $value->id, "staff");
                        }else{
                            $staffItemsAddons .= $this->getBasicHtml($value->title, $value->singlePrice, false, $value->id, "staff");
                        }
                    }
                }

            }
        }

        $html .= $recruitItemsAddons;
        $html .= '<span class="item-label-stuff item-label-stuff-staff">Staff</span>';
        $html .= $staffItemsAddons;

        return $html;


    }

    public function getFeaturedAddons(){
        $html = '<div class="settings_small_headline_container"><h5 class="ba_label">' . _e('Featured addons and Integration','prices') . '</h5></div><div class="featured_addons_container">';
        $featuredCount = 0;
        foreach ($this->addonsArray as $key => $value) {
            $feturedFound = false;
            if($value->featured){
                if(in_array("Recruit", $value->products) && in_array("Staff", $value->products)){
                    if($value->differentPrice){
                        if($value->staffFrom || $value->recruitFrom){
                            if(intval($value->staffPrice) >= intval($value->recruitPrice)){
                                $html .= $this->getFeaturedHtml($value->title, $value->staffPrice, true, $value->image, "both", $value->id);
                                $feturedFound = true;
                            }else{
                                $html .= $this->getFeaturedHtml($value->title, $value->recruitPrice, true, $value->image, "both", $value->id);
                                $feturedFound = true;
                            }
                        }else{
                            if(intval($value->staffPrice) >= intval($value->recruitPrice)){
                                $html .= $this->getFeaturedHtml($value->title, $value->staffPrice, false, $value->image, "both", $value->id);
                                $feturedFound = true;
                            }else{
                                $html .= $this->getFeaturedHtml($value->title, $value->recruitPrice, false, $value->image, "both", $value->id);
                                $feturedFound = true;
                            }
                        }
                    }else{
                        if($value->singleFromPrice){
                            $html .= $this->getFeaturedHtml($value->title, $value->singlePrice, true, $value->image, "both", $value->id);
                            $feturedFound = true;
                        }else{
                            $html .= $this->getFeaturedHtml($value->title, $value->singlePrice, false, $value->image, "both", $value->id);
                            $feturedFound = true;
                        }
                    }
                }elseif(in_array("Recruit", $value->products)){
                    if($value->recruitPrice){
                        if($value->recruitFrom){
                            $html .= $this->getFeaturedHtml($value->title, $value->recruitPrice, true, $value->image, "recruit", $value->id);
                            $feturedFound = true;
                        }else{
                            $html .= $this->getFeaturedHtml($value->title, $value->recruitPrice, false, $value->image, "recruit", $value->id);
                            $feturedFound = true;
                        }
                    }else{
                        if($value->singleFromPrice){
                            $html .= $this->getFeaturedHtml($value->title, $value->singleFromPrice, true, $value->image, "recruit", $value->id);
                            $feturedFound = true;

                        }else{
                            $html .= $this->getFeaturedHtml($value->title, $value->singlePrice, false, $value->image, "recruit", $value->id);
                            $feturedFound = true;
                        }
                    }
                }elseif(in_array("Staff", $value->products)){
                    if($value->differentPrice){
                            
                        if($value->staffFrom){
                            $html .= $this->getFeaturedHtml($value->title, $value->staffPrice, true, $value->image, "staff", $value->id);
                            $feturedFound = true;
                            
                        }else{
                            
                            $html .= $this->getFeaturedHtml($value->title, $value->staffPrice, false, $value->image, "staff", $value->id);
                            $feturedFound = true;

                        }
                    }else{
                        if($value->singleFromPrice){
                            $html .= $this->getFeaturedHtml($value->title, $value->singlePrice, true, $value->image, "staff", $value->id);
                            $feturedFound = true;
                        }else{
                            $html .= $this->getFeaturedHtml($value->title, $value->singlePrice, false, $value->image, "staff", $value->id);
                            $feturedFound = true;
                        }
                    }
                }

                if($feturedFound){
                    $featuredCount++;
                }
            }
           
        }

        $html .= '</div>';

        if($featuredCount <= 0){
            $html = "";
        }
        return $html;

        
    }




    public function getPriceInNiceText($price){
        $lang = get_locale();
        if($lang === "da_DK"){
            return number_format(intval($price) , 0, ',', '.');
        }else{
            return number_format(intval($price) , 0, '.', ',');
        }
    }


    private function getBasicHtml($title, $price, $from, $id, $product){
        if($from){
            $priceText = __('from','prices') .": " . '<span class="currency-display">kr.</span> <div class="priceForDisplay" data-price="'. $price .'">' . $this->getPriceInNiceText($price) . '</div>';
        }else{
            $priceText = '<span class="currency-display">kr.</span> <div class="priceForDisplay" data-price="'. $price .'">' . $this->getPriceInNiceText($price) . '</div>';
        }           

        $htmlReturner = "";

        $htmlReturner .= '<li class="single-addon" data-product="'. $product .'">
                            <input class="ba_hover single-addon-input" data-price="'. $price .'" data-myid="'.$id.'" type="checkbox" name="'. $product . $id .'" value="'. $id .'" id="'. $product . $id .'"  data-title="'.$title.'">
                            <label for="'. $product . $id .'" class="ba_hover">'. $title .'</label>
                            <div class="p_price">'. $priceText .'</div>
                        </li>';

        return $htmlReturner;
    }

    private function getFeaturedHtml($title, $price, $from, $image, $product, $id){
        if($from){
            $priceText = __('from','prices') .": " . '<span class="currency-display">kr.</span> <div class="priceForDisplay" data-price="'. $price .'">' . $this->getPriceInNiceText($price) . '</div>';
        }else{
            $priceText = '<span class="currency-display">kr.</span> <div class="priceForDisplay" data-price="'. $price .'">' . $this->getPriceInNiceText($price) . '</div>';
        }

        $htmlReturner = "";
        $htmlReturner .= '<div class="each_featured_addon ba_hover" data-product="'.$product.'" data-price="'.$price.'" data-title="'.$title.'" data-myid="'.$id.'">
                            <figure><img src="'. $image .'" alt="addons icon" /></figure>
                            <div class="content">
                                <h4>'. $title .'</h4>
                                <div class="p_price">'. $priceText .'</div>
                            </div>
                        </div>';

        return $htmlReturner;
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
    public $groups;
    
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
                $this->singlePrice = $postFields['default_price_group']['price'];
                $this->singleFromPrice = $postFields['default_price_group']['from_price'];
            }
            
            $this->featured = $postFields['featured'];

            if($this->featured){
                $this->image = $postFields['icon'];
            }else{
                $this->image = null;
            }

            $this->products = $postFields['included_in_product'];

            // $this->groups = $postFields;
          
    }


}
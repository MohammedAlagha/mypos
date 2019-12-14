<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{

    use Translatable;

    public $translatedAttributes = ['name','description'];

    protected $fillable = ['category_id', 'purchase_price','sale_price','image','stock'];

    protected $appends = ['image_path' , 'profit_percent','profit'];

    public function category()
    {

        return $this->belongsTo(Category::class);
    }//end of category

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/'. $this->image);
    }

    public function getProfitAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;

        return $profit;
    }

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;

        $profit_percent = $profit * 100 / $this->purchase_price;

         return  number_format((float)$profit_percent, 2, '.', '');   //Show a number to two decimal places
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'product_order');
    }
}

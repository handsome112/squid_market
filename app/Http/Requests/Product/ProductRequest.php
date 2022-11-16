<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Product, Image, Offer, Delivery, Livefeeds};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'category' => 'required|exists:categories,id',
            'uploadimage' =>
                'required|image|mimes:jpeg,jpg,png|dimensions:min_width=96,min_height=96|max:5000',
            'quantity' => 'required|numeric|min:0.01|max:999999',
            'productprice' => 'required|numeric|min:0.01|max:999999',
            'mesure' => 'required|max:10',
            'description' => 'required|max:5000',
            'ships_from' => 'required',
            'ships_to' => 'required',
            'ships_time' => 'required',
            'ships_with' => 'required',
            'ships_price' => 'required',
        ];
    }

    /**
     * Check if the country the user has chosen is valid
     */
    private function checkCountries()
    {
        if (
            !in_array($this->ships_from, array_keys(config('countries'))) or
            !in_array($this->ships_to, array_keys(config('countries')))
        ) {
            throw new \Exception('The chosen country is invalid!');
        }
    }

    private function conversorImage()
    {
        $image = $this->uploadimage->store('img'); #Save product image
        $path = base_path("/storage/app/$image"); #Take the product image path
        $type = pathinfo($path, PATHINFO_EXTENSION); #Get product image type
        $data = file_get_contents($path); #Get the product image
        $imageBase64 = "data:image/$type;base64," . base64_encode($data); #Convert product image to base64
        Storage::delete($image); #Delete the product image from the server as it is no longer needed
        return $imageBase64;
    }

    /**
     * Add product
     *
     * @return Illuminate\Routing\Redirector
     */
    public function add()
    {
        $this->checkCountries();

        #Create a new product
        $product = new Product();
        $product->seller_id = auth()->user()->id;
        $product->category_id = $this->category;
        $product->name = $this->name;
        $product->type = 'Physical';
        $product->description = $this->description;
        $product->conditions = $this->conditions;
        // $product->refund_policy = $this->refund_policy;
        $product->ships_from = $this->ships_from;
        $product->ships_to = $this->ships_to;
        $product->paymethod = $this->paymethod;
        $product->quantity = $this->quantity;
        $product->price = $this->productprice;
        $product->currency = $this->productcurrency;
        $product->mesure = $this->mesure;

        $ships_time = $this->ships_time;
        $ships_price = $this->ships_price;
        $ships_with = $this->ships_with;
        $product->ships_time = json_encode($ships_time);
        $product->ships_price = json_encode($ships_price);
        $product->ships_with = json_encode($ships_with);

        $product->image = $this->conversorImage();
        $product->save();
        $livefeed = new Livefeeds();
        $livefeed->event =
            auth()->user()->username .
            ' added product @' .
            $this->name .
            'for sale everywhere.';
        $livefeed->type = 'addsale';
        $livefeed->save();

        session()->flash(
            'success',
            'You have successfully created your Product!'
        );
        return redirect()->route('seller.dashboard');
    }

    /**
     * Edit product
     * @param  Product $product
     *
     * @return Illuminate\Routing\Redirector
     */
    public function edit(Product $product)
    {
        $this->checkCountries();

        $product->category_id = $this->category;
        $product->name = $this->name;
        $product->type = 'Physical';
        $product->description = $this->description;
        $product->conditions = $this->conditions;
        // $product->refund_policy = $this->refund_policy;
        $product->ships_from = $this->ships_from;
        $product->ships_to = $this->ships_to;
        $product->paymethod = $this->paymethod;
        $product->quantity = $this->quantity;
        $product->price = $this->productprice;
        $product->currency = $this->productcurrency;
        $product->mesure = $this->mesure;
        $ships_time = $this->ships_time;
        $ships_price = $this->ships_price;
        $ships_with = $this->ships_with;
        $product->ships_time = json_encode($ships_time);
        $product->ships_price = json_encode($ships_price);
        $product->ships_with = json_encode($ships_with);
        $product->image = $this->conversorImage();
        $product->save();
        session()->flash(
            'success',
            'You have successfully edited your Product!'
        );
        return redirect()->route('seller.dashboard');
    }
}
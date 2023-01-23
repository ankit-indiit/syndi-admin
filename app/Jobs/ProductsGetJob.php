<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProductsGetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $shop = \App\Models\User::first();
        $products = ['1594679132221', '1433809846333', '6615323541565'];
        foreach($products as $product):
            if($product == '1594679132221'):
                $related_product = ['1433809846333', '6615323541565'];
            elseif($product == '1433809846333'):
                $related_product = ['1594679132221', '6615323541565'];
            elseif($product == '6615323541565'):
                $related_product = ['1594679132221', '1433809846333'];
            endif;
            $product    = $shop->api()->rest('GET', '/admin/api/2021-10/products/'.$product.'.json')['body']['product'];
            $images     = json_encode($product['images']);
            $options    = json_encode($product['options']);
            $data       = Product::where('name', $product['title'])->first();
            $variants   = [];
            foreach($product['variants'] as $variant):
                
                $inventory_item_quantity = $shop->api()->rest('GET','/admin/api/2022-07/products/'.$product['id'].'/variants/'.$variant['id'].'.json');
                if($inventory_item_quantity['errors'] == false):
                    $inventory_item_quantity = $inventory_item_quantity['body']['variant']['inventory_quantity'];
                else:
                    $inventory_item_quantity = NULL;
                endif;
                if($variant['image_id'] == null):
                    $url = NULL;
                else:
                    $image = collect($product['images'])->where('id', $variant['image_id'])->first();
                    $url = $image['src'];
                endif;
                $variants[] = [
                    'title'                 => $variant['title'],
                    'sku'                   => $variant['sku'],
                    'inventory_quantity'    => $inventory_item_quantity,
                    'barcode'               => $variant['barcode'],
                    'option1'               => $variant['option1'],
                    'option2'               => $variant['option2'],
                    'option3'               => $variant['option3'],
                    'image_url'             => $url,
                ];
            endforeach;
            if($data == null):
                Product::create([
                    'name'                          => $product['title'],
                    'spec_name'                     => $product['vendor'],
                    'spec_value'                    => $product['handle'],
                    'descriptionHtml'               => $product['body_html'],
                    'available_name'                => $product['status'],
                    'available_value'               => $product['variants'][0]['inventory_quantity'],
                    'available_thumbnailImageUrl'   => isset($product['image']['src']) ? $product['image']['src'] : null,
                    'images'                        => $images,
                    'options'                       => $options,
                    'related_products'              => json_encode($related_product),
                    'variants'                      => $variants,
                ]);
            else:
                $data->update([
                    'name'                          => $product['title'],
                    'spec_name'                     => $product['vendor'],
                    'spec_value'                    => $product['handle'],
                    'descriptionHtml'               => $product['body_html'],
                    'available_name'                => $product['status'],
                    'available_value'               => $product['variants'][0]['inventory_quantity'],
                    'available_thumbnailImageUrl'   => isset($product['image']['src']) ? $product['image']['src'] : null,
                    'images'                        => $images,
                    'options'                       => $options,
                    'related_products'              => json_encode($related_product),
                    'variants'                      => $variants,
                ]);
            endif;
        endforeach;
    }
}

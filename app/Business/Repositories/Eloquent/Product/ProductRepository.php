<?php
namespace App\Business\Repositories\Eloquent\Product;

use App\Business\Repositories\Contracts\ProductRepositoryInterface;
use App\Business\Repositories\Eloquent\BaseRepositoryAbstract;
use App\Models\Product\Product;
use App\Support\FilterSupport;

class ProductRepository extends BaseRepositoryAbstract implements ProductRepositoryInterface
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $query): object
    {
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'id');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'name');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'description');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'price');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'price_min');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'price_max');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'stock');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'category_id');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'deleted');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'deleted_start');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'deleted_end');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'limit','25');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'page','1');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'order','DESC');


        $model = $this->model;
        if($query['id'])
        {
            $model = $model->where('products.id',$query['id']);
        }
        if($query['name'])
        {
            $model = $model->where('products.name','like','%'.$query['name'].'%');
        }
        if($query['description'])
        {
            $model = $model->where('products.description','like','%'.$query['description'].'%');
        }
        if($query['price'])
        {
            $model = $model->where('products.price',(float) $query['price']);   
        }
        if($query['price_min'])
        {
            $model = $model->where('products.price','>=',(float) $query['price_min']);   
        }
        if($query['price_max'])
        {
            $model = $model->where('products.price','<=',(float) $query['price_max']);   
        }
        if($query['stock'])
        {
            $model = $model->where('products.stock','>',0);   
        }
        if(!empty($query['category_id'][0]))
        {
            $model = $model->whereHas('category',function($q) use ($query){
                $q->whereIn('categories.id',$query['category_id']);
            });
        }
        if($query['deleted'])
        {
            $model = $model->whereNotNull('deleted_at');   
        }
        $model = $model->orderBy('products.id',$query['order']);
        return $model->paginate($query['limit']);
    }

    public function create(array $data): object
    {
        $product = $this->model->create($data);
        $product->category()->sync($data['category_id']);
        $product->meta()->create(['attributes' => $data['meta']]);
        return $product;
    }

    public function update(int $id, array $data): bool
    {
        $product = $this->find($id);
        $id = ($product->meta) ? ['id'=>$product->meta->id] : [];
        $product->category()->sync($data['category_id']);
        $product->meta()->updateOrCreate(
            $id,
            ['attributes'=>$data['meta']]
        );
        return $product ? $product->update($data) : false;
    }

}
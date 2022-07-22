# nova-model-link-field
Search models and append links to this models by nova field

This field allow to fill database "link" column with link to Application Model

**Scenario**
You have 4 models Product, Category, Blog, Order
and also you have model Post with fields "name", 'link' ....
You want have post with attached link to Product or Category etc.. 
In normal way, you have to create product_id or category_id ...
But you only need link. Thats why this field comes in. You can attach link to multiple models with search functionality

# INSTALLATION

```
composer require mateusztumatek/nova-model-link-field 
```

# Basic usage

Add ```NovaIsLinkableContract``` to your models that should be linkable
Example : 
```php
class Product extends Model implements NovaIsLinkableContract{

    /**
    * Generate link for nova link field 
    * @return string
    */
    public function novaLink(): string
    {
        return route('products.show', ['product' => $this->id]);
    }
}
```

And in your resource file
```php
    public function fields(NovaRequest $request)
        {
            return [                                          
                NovaModelLinkField::make('Link', 'link')
            ];
        }
```
If you want keep relative path to your application url you can use

```php
NovaModelLinkField::make('Link', 'link')->storeType('relative')
```

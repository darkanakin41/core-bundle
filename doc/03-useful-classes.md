Useful Classes
===

Those are classes that I have created to solve common cases

## Darkanakin41\CoreBundle\Reflection\EnhancedReflectionClass
On many project, I needed to have use reflection on classes with inheritance. 
The issue is that the PHP Reflection Class does not naturally provide the whole list of properties, including parents one.
So I have created a class which override getProperties() and provide the whole list of properties of a class.

## Darkanakin41\CoreBundle\Nomenclature\AbstractNomenclature
I love to work with nomenclature in order to manage in PHP Objects my list of status, types and so on, which I often use
as form choices elements.
So I've created this class to provide one function : ```getAllConstants()```

Using reflection, it return all constants from the class as an array.

For instance : 
```php
class Toto extends \Darkanakin41\CoreBundle\Nomenclature\AbstractNomenclature{
    const ONLINE = 'online';
    const OFFLINE = 'offline';
}
```

will output the following associative array : 

```php
$toto = ['ONLINE' => 'online', 'OFFLINE' => 'offline'];
```

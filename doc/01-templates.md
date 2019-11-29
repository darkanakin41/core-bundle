Using my Templates
===

In order to use the template I created, you need to update a few configuration described in the following lines.

## [symfony/form](https://github.com/symfony/form)

I've created a template for [symfony/form](https://github.com/symfony/form)
in order to make it render [Foundation](https://foundation.zurb.com/) markup.

In the configuration of KnpMenuBundle, you just need to update the following part : 
```yaml
twig:
    form_themes:
    - '@Darkanakin41Core/form/foundation.html.twig'
```

## [KnpLabs/KnpMenuBundle](https://github.com/KnpLabs/KnpMenuBundle)

I've created a template for [KnpLabs/KnpMenuBundle](https://github.com/KnpLabs/KnpMenuBundle) 
in order to make it render [Foundation](https://foundation.zurb.com/) markup.

In the configuration of KnpMenuBundle, you just need to update the following part : 
```yaml
knp_menu :
    twig :
        template : "@Darkanakin41Core/knp/menu/foundation.html.twig"
```

## [KnpLabs/KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle)

I've created a template for [KnpLabs/KnpMenuBundle](https://github.com/KnpLabs/KnpPaginatorBundle) 
in order to make it render [Foundation](https://foundation.zurb.com/) markup.

In the configuration of KnpPaginatorBundle, you just need to update the following part : 
```yaml
knp_paginator:
  template:
    pagination: "@Darkanakin41Core/knp/pagination/foundation.html.twig"
```


My Services and Extensions
===

I've created few services that help me handle cases on daily bases : 

## DateService
This service aim to provide a few functionnalities to handle Date display in twig : 

```twig
{# Render theDate in the given format #}
{{ format(theDate, 'Y-m-d') }}

{# Calcul the age of the date in year #}
{{ date_age(theDate) }}

{# 
    Create an horodatage for the given date. 
    i.e : if the date is today, only the time is displayed, otherwise the full date is displayed 
#}
{{ horodatage(theDate, theFullOutputFormat) }}
``` 

## EntityRenderService
This service aim to provide a simple way to render an entity, often as card in my case:
```twig
{{ entity_render(theEntity, theBlockName, params) }}
```

Based on the class name of the entity, the service look in ```template/entity``` for a file name ```classname.html.twig```
and will try to render the block selected with additional params

## SlugifyService
This service only propose the access to a slugify function that I often use when generating public routes
```twig
{{ slugify(anyText) }}
```
It will remove accentuated characters (because I'm french), replace space with dash and so on.

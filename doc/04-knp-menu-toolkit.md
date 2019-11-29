An extension to KnpMenuBundle
===

I like to use [KnpLabs/KnpMenuBundle](https://github.com/KnpLabs/KnpMenuBundle) when I am creating website or applications
using Symfony and Twig. 
Then, on my pages, I am using it to create my different menus. 

But, when I started to use this bundle in Symfony 4, I was lost on the way to render them. So I have created two usefull 
classes to help me.

## Darkanakin41\CoreBundle\Menu\AbstractMenu

This is a class in which I add all functions and stuff common to menus I'm creating such as the setting of 
translation domain to all items from a menu and initializing DependencyInjection

## Darkanakin41\CoreBundle\Menu\MenuService

This have only one role : to instantiate the right class and call the right method, and provide to the basic function of 
KnpMenuBundle in twig the right information to render the menu 



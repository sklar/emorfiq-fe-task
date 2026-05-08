# Requirements
1. Node >=16
2. Php
3. Figma

# Installation
1. npm i 
2. run index.php in php http server

# Modes
You can switch modes in index.php:2. 
In development the live reload will work in combination with node script development. The url in command line https://prnt.sc/cI4U0xLMEAzB is not working because there is no internal server included, it is just form Hot module replacement.

# Assets
## Css
1. Dir /assets/scss

### The idea of theming
1. If we need to change anything in our component (i.e. background in product-card) we use only variables to do it if it is possible. 
2. If it is not possible we can add custom css but never modifying css in the component itself.
3. The example of theming in css is in assets/scss/theme/product-card/
4. In the html it is preferred not to change anything but if you have to you can do it.

## Js 
1. Dir /assets/js
2. No javascript needed

## Images
1. Dir /public/images
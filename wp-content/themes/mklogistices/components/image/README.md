## USAGE
### Instantiation
Parameters should be passed to the module as an array.
```
$args = array(
    'image' => $image,
    'alt' => 'alt'
)
the_component('image', $args);
```

### Required Parameters
This module requires the following parameters to render properly:
1. 'image' - array || int || string - wordpress image object || wordpress image ID || image src url
1. 'alt' - string - Relevant and descriptive text about the image content and/or function. If not provided, the function will try to pull dynamically from wordpress database before throwing an error.

### Optional Parameters
The follow paremeters may be included
1.

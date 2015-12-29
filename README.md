#BLWrap

A very thin class that helps you make requests to the BrickLink API  

The heavy lifting is done by `guzzlehttp/guzzle` and `guzzlehttp/oauth-subscriber`.  
If you just want a simple way to make and sign request, you can use the above two packages and skip `blwrap` entirely.

##Installation
    
    composer require bacanu/blwrap
    


##Usage

###GET request
    
    $config = [  
            "consumerKey" => "[replace]",  
            "consumerSecret" => "[replace]",  
            "tokenValue" => "[replace]",  
            "tokenSecret" => "[replace]",  
    ];  
    $bl = new Client($config);  
    
    $result = $bl->execute('get', 'inventories/1');  
    
    //OR if you want request parameters
    
    $result = $bl->execute('get', 'orders', [
        "direction" => "in",
        "filed" = "false"
    ]);  
    
    
    
    
###POST, PUT, DELETE requests

    
    $config = [  
            "consumerKey" => "[replace]",  
            "consumerSecret" => "[replace]",  
            "tokenValue" => "[replace]",  
            "tokenSecret" => "[replace]",  
    ];  
    $bl = new Client($config);  
    
    $result = $bl->execute('put', 'inventories/1', [
        "quantity" => "+2"
    ]);  
    
    
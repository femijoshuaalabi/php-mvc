# php-mvc
This is just a simple PHP Model View Controller (MVC).

1. Download and exact the file to your project directory.
2. Open bootstrap folder in the root directory and locate config.php
3. Configure your database connection and save

<b style="red">P-MVC</b>
<div><span> The directory is structured with the name MVC</span></div>
M => Model => Create a file with the name of your new page
Example: Creating Model for Home Page

<pre>
<!-- language: php -->
<?php
class HomeModel extends Model {

    function __construct() {
        parent::__construct();
    }

}
?>
</pre>

V => View => Create a Folder with the name of your new page and create the index file for your view directory
Example: Path = Views/Home/index.php
Include your page view here

M => C => Create a file with the name of your new page
Example: Creating Controller for Home Page
<pre>
<!-- language: php -->
<?php
class Home extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->output->page('home/index');
    }

}
?>
</pre>
Please Note: This is just a simple MVC works... There are still more to do with it.
Thanks... Femi



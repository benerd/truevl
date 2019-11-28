
<?php 
class Test extends Controller {
 
function __construct()
{
parent::Controller();
}
 
function index()
{
echo "testing from index \n";
}
 
function test() {
echo "testing from test \n";
}
}
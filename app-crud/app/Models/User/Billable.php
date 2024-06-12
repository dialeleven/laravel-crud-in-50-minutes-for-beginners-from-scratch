<?php
use Laravel\Cashier\Billable;
 
class User extends Authenticatable
{
    use Billable;
}
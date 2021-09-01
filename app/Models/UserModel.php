<?php
namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
    protected $table = 'tbl_insert';
    protected $allowedFields =['fname','lname','email','pno'];
}
?>
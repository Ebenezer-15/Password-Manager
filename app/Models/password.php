<?php
// this specifies the path
namespace App\Models;
// helps in creating dummy data for testing purposes
use Illuminate\Database\Eloquent\Factories\HasFactory;

// for importing laravel model class, ORM functionality
// like querying, inserting, updating and deleting records in the database
use Illuminate\Database\Eloquent\Model;
// "Password" is a model class that represents the "passwords" table in the
// database and by adding "Model" class, we can use the ORM functionality like
//  querying, inserting, updating and deleting records in the database
class Password extends Model
{
    use HasFactory;
    // "passwords" is the name of the table in the database
    protected $table = 'passwords';
    // protected basically secures the mass assignment
    protected $fillable = [
        'user_id',
        'title',
        'link',
        'password',
        'favicon'
    ];
    protected $appends = ['favicon'];

    public function getFaviconAttribute()
    {
        return 'https://www.google.com/s2/favicons?domain=' . $this->link;
    }
    // the relationship between the Password model and the User model. One user
    // can have many passwords, so we define a one-to-many relationship but each password belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

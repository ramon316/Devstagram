<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];
    
    public function user()
    {
        /**Esta es una relación de n:1 */
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
    public function comentarios()
    {
        /**Relacion entre el post y los ocmentarios  */
        return $this->hasMany(Comentario::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        /**Lo que hace contains es que va a revisar la tabla y despues de eso verifica si existe el valor
         * Como ya tenemos la relación podemo sutilizarlo
         */

        return $this->likes->contains('user_id', $user->id);
    }
}

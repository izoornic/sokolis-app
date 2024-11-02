<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\UpravnikZgradaIndex;

class Zgrada extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function stanovi(): HasMany
    {
        return $this->hasMany(Stan::class, 'zgradaId');
    }

    public static function zgradeUpravnika()
    {
       return UpravnikZgradaIndex::select('zgradas.id', 'zgradas.naziv')
            ->leftJoin('zgradas', 'zgradas.id', '=', 'upravnik_zgrada_indices.zgradaId')
            ->where('upravnik_zgrada_indices.userId', '=', auth()->user()->id)
            ->pluck('zgradas.naziv', 'zgradas.id');
    }
}

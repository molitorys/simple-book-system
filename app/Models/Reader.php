<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = [
        'created_at',
        'nick',
        'nick_slug'
    ];

    protected $dates = [
        'created_at'
    ];

    public $timestamps = false;

    /**
     * Reader owns many books
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(\App\Models\Book::class);
    }

    public function latestBook()
    {
        return $this->hasOne(\App\Models\Book::class)->orderBy('added_at', 'DESC');   
    }

    /**
     * Create slug for nick
     *
     * @param string $nick
     * @return void
     */
    public function setNickAttribute(string $nick)
    {
        $this->attributes['nick'] = $nick;
        $this->attributes['nick_slug'] = str_slug($nick);
    }

    /**
     * Return reader details URL
     *
     * @return string
     */
    public function url()
    {
        return route('reader', ['slug' => $this->nick_slug, 'id' => $this->id]);
    }

    public function isSlugCorrect(string $slug)
    {
        return $this->nick_slug === $slug; 
    }

    /**
     * Create new reader and add book if given
     *
     * @param array $data
     * @return \App\Models\Reader
     */
    public static function create(array $data)
    {
        $reader = self::firstOrCreate(['nick' => $data['nick']]);

        if ($reader && array_get($data, 'book')) {
            $reader->books()->create([
                'title' => $data['book']
            ]);
        }

        return $reader;
    }

    /**
     * Return all readers
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getList()
    {
        return self::withCount('books')
                ->with('latestBook')
                ->orderBy('books_count', 'DESC')
                ->get();
    }

    /**
     * Return all readers
     *
     * @param int $id
     * @return \App\Models\Reader
     */
    public static function getWithBooks(int $id)
    {
        return self::with(['books' => function($query) {
            $query->orderBy('added_at', 'DESC');
        }])->find($id);    
    }
}

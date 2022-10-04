<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class PostsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::select('title','content','status','created_at')->get();
    }

    
    public function headings(): array
    {
        return [
            'title',
            'content',
            'status',
            'created_at',
        ];
    }

   
}

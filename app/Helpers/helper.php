<?php

namespace App\Helpers;

use App\Models\Admin\Produtos\Produtos;
use App\Models\Admin\Tecnologias\Tecnologias;
use App\Models\Admin\Blog\Post;

use Carbon\Carbon;

class Helper
{

    
    static function countProdutos($id)
    {
        $count_produtos = Produtos::whereCategoriaId($id)->count();

        return $count_produtos;
    }
    

    static function nameImgTecnologia($id)
    {
        $nameImgTec = Tecnologias::findOrFail($id);

        $capa = $nameImgTec->capa;

        return $capa;
    }


    static function nameTecnologia($id)
    {
        $nameTec = Tecnologias::findOrFail($id);

        $title = $nameTec->title;

        return $title;
    }
    
    static function countPost($id)
    {
        $count_post = Post::whereIdCategoryBlog($id)->count();
        
        return $count_post;
    }


    static function FormatDia($date)
    {
        // dd($date);
        // $dateFormat = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d H:i:s');
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dateNew = strftime('%d', strtotime($date));

        return $dateNew;
    }

    static function FormatMes($date)
    {

        // $dateFormat = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d H:i:s');
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dateNew = strftime('%b', strtotime($date));

        return $dateNew;
    }

    static function FormatAno($date)
    {
        
        // $dateFormat = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d H:i:s');
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dateNew = strftime('%Y', strtotime($date));

        return $dateNew;
    }

}





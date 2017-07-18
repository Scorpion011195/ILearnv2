<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\TranslateClient;
use App\Http\Requests\TranslateRequest;

class TranslateController extends Controller
{
    function getTranslateParagraph(){
        $listLanguages = MyConstant::LANGUAGE_TRANSLATE_PARAGRAPH;

        $params = ['listLanguages'=>$listLanguages];

        return view('user/pages/translate_text', $params);
    }

    function translateParagraph(Request $request){
        // Input
        $lang_from = $request->lang_from;
        $lang_to = $request->lang_to;
        $paragraph_from = $request->paragraph_from;

        // Text empty
        if(empty(trim($paragraph_from))){
            $dataResponse = ["code"=>false, "data"=>"empty"];
            return json_encode($dataResponse);
        }

        // Length text
        $length_paragraph_from = strlen($paragraph_from);
        $maxLength = 2000;
        if($length_paragraph_from > $maxLength){
            $dataResponse = ["code"=>false, "data"=>"maxLength"];
            return json_encode($dataResponse);
        }

        $tr = new TranslateClient(); // Default is from 'auto' to 'en'
        $tr->setSource($lang_from); // Translate from English
        $tr->setTarget($lang_to); // Translate to Georgian
        $tr->setUrlBase('http://translate.google.cn/translate_a/single'); // Set Google Translate URL base (This is not necessary, only for some countries)

        $paragraph_to = $tr->translate($paragraph_from);

        $dataResponse = ["code"=>true, "data"=>$paragraph_to];
        return json_encode($dataResponse);
    }
}

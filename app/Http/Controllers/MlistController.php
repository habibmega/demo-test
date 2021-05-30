<?php

namespace App\Http\Controllers;

use App\libs\Response\GlobalApiResponse;
use Illuminate\Http\Request;
use App\Models\Mlist;

class MlistController extends Controller
{
    public function getList(){
    	return (new GlobalApiResponse())->success('List record', 1, Mlist::all());
    }

    public function createLists(Request $request){
    	$newList= new Mlist;
    	$newList->title=$request['title'];
    	$newList->progress=0;
    	$newList->save();
    	return (new GlobalApiResponse())->success('List created',1,$newList);
    }
}

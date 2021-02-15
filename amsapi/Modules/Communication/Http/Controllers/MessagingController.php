<?php

namespace Modules\Communication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Communication\Transformers\Meassages as MessagesResource; 
use Modules\Communication\Entities\Messaging;

class MessagingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response     
     */


    public function index($id)
    {   
        $messages = Messaging::where('parent_id',$id)->get();
        return MessagesResource::collection($messages);
    }
    public function loggedUser() {   
        $user_id  = Auth()->user()->id;
        return $user_id;
    }

    public function topics()
    {
        $user_id  = Auth()->user()->id;
        // $messages = Messaging::all();
        $messages = Messaging::where('user_id',$user_id)->where('parent_id',null)->get();
        return MessagesResource::collection($messages);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $messages = new Messaging;
        $messages->body  = $request->body;
        $messages->parent_id  = $request->parent_id;
        $messages->user_id  = Auth()->user()->id;
        if($messages->save()){
            return new MessagesResource($messages) ;
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    public function logeduser()
    {
        $name = Auth()->user()->id;
        return $name;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('communication::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('communication::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $message_parent = Messaging::findOrFail($id);
        $message=Messaging::where("parent_id",$id);

        if($message_parent->delete()){
            $message->delete();
            return new MessagesResource($message);
        }
    }
}

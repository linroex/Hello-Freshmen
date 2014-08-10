<?php
class FreshmenController extends Controller{
    public function showIndex(){
        return View::make('template')->with(array(
            'count'=>Freshmen::all()->count()
        ));
    }
    public function add(){
        $validator = Validator::make(array(
            'type'=>Input::get('exam_type'),
            'ticket'=>Input::get('ticket'),
            'facebook'=>Input::get('facebook')
        ),array(
            'type'=>'required',
            'ticket'=>'required|numeric',
            'facebook'=>'required|unique:freshmen'
        ));

        if($validator->fails()){
            return $validator->messages()->all();
        }else{
            Freshmen::insert(array(
                'type'=>Input::get('exam_type'),
                'ticket'=>Input::get('ticket'),
                'facebook'=>Input::get('facebook')
            ));
            return 'ok';
        }
    }
    public function search(){
        $validator = Validator::make(array(
            'type'=>Input::get('exam_type'),
            'ticket'=>Input::get('ticket')
        ),array(
            'type'=>'required',
            'ticket'=>'required'
        ));

        if($validator->fails()){
            return json_encode(array('status'=>'error','data'=>$validator->messages()->all()));
        }else{
            $tickets = explode("\n", Input::get('ticket'));
            $result = array();
            foreach ($tickets as $ticket) {
                if(trim($ticket) != ''){
                    $data = Freshmen::whereRaw('ticket = ? and type = ?',[trim($ticket), Input::get('exam_type')])->get()->toArray();
                    if(!empty($data)){
                        array_push($result, $data[0]['facebook']);    
                    }else{
                        array_push($result, 'null');    
                    }    
                }
                
            }
            return json_encode(array('status'=>'success','data'=>$result));
        }
    }
}
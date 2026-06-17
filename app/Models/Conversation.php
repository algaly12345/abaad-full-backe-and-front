<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
     protected $casts = [
        'sender_id' => 'integer',
        'receiver_id' => 'integer',
        'last_message_id' => 'integer',
        'unread_message_count' => 'integer',
        'estate_id' => 'integer',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(Agent::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Agent::class, 'receiver_id');
    }


    public function last_message()
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }



    public function scopeWhereConversation($query,$sender_id,$receiver_id){
        $query->where(function($q)use($sender_id, $receiver_id){
            $q->where('sender_id',$sender_id)->where('receiver_id',$receiver_id);
        })->orWhere(function($q)use($sender_id, $receiver_id){
            $q->where('sender_id',$receiver_id)->where('receiver_id',$sender_id);
        });
    }



    public function scopeWhereUserType($query,$type){
        $query->where(function($q)use($type){
            $q->where('sender_type',$type)->orWhere('receiver_type',$type);
        });
    }
    
    
        public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }



}

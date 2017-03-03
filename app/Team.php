<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillables = ['name', 'size'];
   
    public function members()
    {
    	return $this->hasMany(User::class);
    }

    public function add($users)
    { 
        $this->guardAgainstTooManyMembers($users);

    	$method = $users instanceof User ?  'save' : 'saveMany';
    	return $this->members()->$method($users); 
    }


    public function remove($user)
    {
    	return $user instanceof User ? 
            $this->members()->where('id' ,$user->id)->delete() :
            $this->removeMany($user);
    }

    public function removeMany($object)
    {       
        foreach ($object as $id) { 
            $this->members()->where('id', $id->id)->delete();
        }
        return $this;
    }

    public function count()
    {
    	return $this->members()->count();
    }

    
    public function singleRemove(User $user)
    {
        
         $user->leaveTeam();
    }

    public function reset()
    {
        return $this->members()->update(['team_id' => null]);
    }
     
     public function guardAgainstTooManyMembers($users)
     {
         $numUsersToAdd = ($users instanceof User) ? 1 : count($users);
         $newTeamCount = $this->count() + $numUsersToAdd;
         if($newTeamCount > $this->size){
             throw new \Exception;
         }
         return true;   
     }

   
}

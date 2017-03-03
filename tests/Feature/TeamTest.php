<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TeamTest extends TestCase
{
	use DatabaseTransactions;
    
    /**    
    @test  
    @group naming 
    **/
    public function a_team_has_a_name()
    {
    	$team = factory(Team::class)->create(['name' => 'Acme']);

    	$this->assertEquals('Acme', $team->name);
    }

     /**    
     @test  
     @group addingAMember 
     **/
     public function a_team_can_add_members()
     {
     	$team = factory(Team::class)->create();
     	$user = factory(User::class)->create();
     	$user2 = factory(User::class)->create();

     	$team->add($user);
     	$team->add($user2);	
     	$this->assertEquals(2, $team->count());

     }

      /**    
      @test  
      @group addingMemmbers 
      **/
      public function a_team_can_add_many_members()
      {
      		$team = factory(Team::class)->create();
      		$users = factory(User::class, 2)->create();

      		$team->add($users);
      		$this->assertEquals(2, $team->count());
      }

      /**    
      @test  
      @group singleDeletion 
      **/
     public function a_team_can_remove_a_member()
     {
     	$team = factory(Team::class)->create();
     	$user = factory(User::class)->create();
     	$user2 = factory(User::class)->create();

     	$team->add($user);
     	$team->add($user2);

     	$team->singleRemove($user2);

     	$this->assertEquals(1, $team->count());
     }

      /** 
      @test  
      @group multipleDeletion
      */
      public function a_team_can_delete_multiple_members_at_once()
      {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $users = factory(User::class, 2)->create();

        $team->add($user);
        $team->add($users);
        $team->removeMany($users);

        $this->assertEquals(1, $team->count());
      }
      
       /**
       @test  
       @group teamSize 
       */
      function it_a_team_has_maximum_size()
      {
          $team = factory(Team::class)->create(['size' => 2]);    

          // $users = factory(User::class, 2)->create();
          // $team->add($users);
          // $this->assertEquals(2, $team->count());

          $this->setExpectedException('Exception');

          $user3 = factory(User::class, 3)->create();
          $team->add($user3);
      }

      /**    
      @test  
      @group restTeam 
      **/
  function it_team_can_remove_all_members_and_start_from_scratch()
  {
      $team = factory(Team::class)->create(['size' =>  5]);

      $users = factory(User::class, 3)->create();  
      $user4 = factory(User::class)->create();

      $team->add($users);
      $team->add($user4);
      $this->assertEquals(4, $team->count()); 

      $team->reset();
      $this->assertEquals(0, $team->count());
  }
}

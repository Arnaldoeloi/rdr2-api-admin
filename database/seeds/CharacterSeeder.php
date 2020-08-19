<?php

use Illuminate\Database\Seeder;

use App\Character;
use App\Gang;
use App\Quote;
use App\Nickname;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gang = Gang::create(['name'=>'Van der Linde', 'description' => 'A gang of outlaws, renegades and misfits, bonded together under the charismatic and idealistic Dutch van der Linde. They have chosen to live outside the law and now fear it may be catching up with them.']);
        
        $json = File::get("database/data/characters/vanderlinde-gang.json");
        $characters = json_decode($json);

        foreach($characters as $char){
            $character = Character::create([
                'id'            => $char->id,
                'name'          => $char->name,
                'gender'        => $char->gender,
                'age'           => $char->age,
                'status'        => $char->status,
                'cause_of_death'=> $char->cause_of_death,
                'date_of_birth' => $char->date_of_birth,
                'date_of_death' => $char->date_of_death,
                'nationality'   => $char->nationality,
                'voiced_by'     => $char->voiced_by,
                'description'   => $char->description,
                'image'         => $char->image,
                'artwork'       => $char->artwork,
            ]);
            
            foreach($char->quotes as $q){
                $quote = new Quote(['quote'=>$q]); 
                $character->quotes()->save($quote);
            }
            
            foreach($char->nicknames as $n){
                $nickname = new Nickname(['nickname'=>$n]); 
                $character->nicknames()->save($nickname);
            }
        }
    }
}

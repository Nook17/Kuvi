<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Social\Friend;

class DatabaseSeeder extends Seeder
{
 public function run()
 {
  $faker = Faker::create('pl_PL');

  /* ====================== VARIABLES ====================== */

  $number_of_user        = 20;
  $max_posts_per_user    = 20;
  $max_comments_per_post = 3;
  $password              = 'nook1771';

  /* ======================== USERS ======================== */

  DB::table('roles')->insert([
   'id'   => '1',
   'type' => 'admin',
  ]);

  DB::table('roles')->insert([
   'id'   => '2',
   'type' => 'user',
  ]);

  /* ======================== USERS ======================== */

  for ($user_id = 1; $user_id <= $number_of_user; $user_id++) {

   if ($user_id == 1) {
    DB::table('users')->insert([
     'name'     => 'Arek Demko',
     'email'    => 'arek@nook17.pl',
     'gender'   => 'm',
     'role_id'  => 1,
     'password' => bcrypt($password),
    ]);
   }

   $gender = $faker->randomElement(['m', 'f']);

   if ($gender == 'm') {
    $name   = $faker->firstNameMale . ' ' . $faker->lastNameMale;
    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
   } elseif ($gender == 'f') {
    $name   = $faker->firstNameFemale . ' ' . $faker->lastNameFemale;
    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
   }

   DB::table('users')->insert([
    'name'       => $name,
    'email'      => str_replace('-', '', str_slug($name)) . '@' . $faker->freeEmailDomain,
    'gender'     => $gender,
    'role_id'    => 2,
    'avatar'     => $avatar,
    'password'   => bcrypt('nook1771'),
    'created_at' => $faker->dateTimeThisYear($max = 'now'),
   ]);

   /* ======================= FRIENDS ======================= */

   for ($i = 1; $i <= $faker->numberBetween($min = 0, $max = $number_of_user - 1); $i++) {
    $friend_id = $faker->numberBetween($min = 1, $max = $number_of_user);

    $friendship_exists = Friend::where([
     'user_id'   => $user_id,
     'friend_id' => $friend_id,
    ])->orWhere([
     'user_id'   => $friend_id,
     'friend_id' => $user_id,
    ])->first();

    if (!$friendship_exists) {
     DB::table('friends')->insert([
      'user_id'    => $user_id,
      'friend_id'  => $friend_id,
      'accepted'   => 1,
      'created_at' => $faker->dateTimeThisYear($max = 'now'),
     ]);
    }
   } // FOR FRIENDS

   /* ======================== POSTS ======================== */

   for ($post_id = 1; $post_id <= $faker->numberBetween($min = 0, $max = $max_posts_per_user); $post_id++) {
    DB::table('posts')->insert([
     'user_id'    => $user_id,
     'content'    => $faker->paragraph($nbSenteces = 1, $variableNbSenteces = true),
     'created_at' => $faker->dateTimeThisYear($max = 'now'),
    ]);

    /* ======================== COMMENTS ======================== */

    for ($comment_id = 1; $comment_id <= $faker->numberBetween($min = 0, $max = $max_comments_per_post); $comment_id++) {
     DB::table('comments')->insert([
      'post_id'    => $post_id,
      'user_id'    => $faker->numberBetween($min = 1, $max = $number_of_user),
      'content'    => $faker->paragraph($nbSenteces = 1, $variableNbSenteces = true),
      'created_at' => $faker->dateTimeThisYear($max = 'now'),
     ]);
    } // FOR COMMENTS
   } // FOR POSTS
  } // FOR USERS
 } // function run()
}

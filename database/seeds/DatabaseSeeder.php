<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Create our 'all users' department
        $department_all = new \App\Department();
        $department_all->id = 1;
        $department_all->name = "All Users";
        $department_all->save();

        $departments = factory(App\Department::class,10)->create();
        foreach($departments as $department){
            $users = factory(App\User::class,10)->create();
            $department_all->users()->attach($users);
            $department->users()->attach($users);
            foreach($users as $user) {
                factory(App\UserShortcut::class, 5)->create(['user_id'=>$user->id]);
            }
            $shortcuts = factory(App\DepartmentShortcut::class, 10)->create();
            $department->shortcuts()->attach($shortcuts);
        }

    }
}

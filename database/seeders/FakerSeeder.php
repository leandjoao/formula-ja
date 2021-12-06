<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\AnswerItem;
use App\Models\Budget;
use App\Models\BudgetAnswered;
use App\Models\Contact;
use App\Models\Upload;
use Illuminate\Database\Seeder;
use Faker\Generator;

class FakerSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run(Generator $faker)
    {
        // Contacts Seed

        for ($i=0; $i < 20; $i++) {
            $contact = new Contact();
            $contact->name = $faker->firstName();
            $contact->email = $faker->email();
            $contact->phone = $faker->phoneNumber();
            $contact->subject = $faker->word();
            $contact->message = $faker->text();
            $contact->save();
        }

        // Upload Seed
        $upload = new Upload();
        $upload->file = $faker->word().'.pdf';
        $upload->user_id = 1;
        $upload->save();


        // Budgets Seed
        $status = ['finalizado', 'recusado', 'aguardando', 'enviado'];
        for ($i=0; $i < 20; $i++) {
            $budget = new Budget();
            $budget->upload_id = 1;
            $budget->user_id = 1;
            $budget->pet = boolval(($i % 2));
            $budget->status = $status[rand(0,3)];
            $budget->save();
        }

        // Budget Answer
        for ($i=0; $i < 3; $i++) {
            $answer = new BudgetAnswered();
            $answer->budget_id = 1;
            $answer->user_id = 1;
            $answer->answered_by = 1;
            $answer->description = $faker->text();
            $answer->save();
        }

        // Budget Answer Items

        for ($a=1; $a < 4; $a++) {
            for ($i=0; $i < 10; $i++) {
                $answerItems = new AnswerItem();
                $answerItems->budget_id = 1;
                $answerItems->partner_id = 1;
                $answerItems->answer_id = $a;
                $answerItems->item = $faker->word;
                $answerItems->price = doubleval(random_int(10, 1000));
                $answerItems->save();
            }
        }

    }
}
